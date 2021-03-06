<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use DB;
use DateTime;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use Excel;
use Config;
use App\UserDeviceAssoc;
use App\User;
class DeviceController extends BaseController {
    public function createDevice() {
        $posted_data = Input::all();

        $object = new Device();
        if ($object->validate($posted_data)) {
             $posted_data['status']='NOT ENGAGE';
             // return $posted_data;
             $device = Device::where("device_id",$posted_data['device_id'])->first();
             if($device){

               return response()->json(['status_code' => 201, 'message' => 'Device already created']);
             }else{
               $model = Device::create($posted_data);
               return response()->json(['status_code' => 200, 'message' => 'Device created successfully', 'data' => $model]);
             }

        } else {
          return response()->json(['status_code' => 422, 'message' =>'Unable to update device', 'error' => $object->errors()]);
            // throw new \Dingo\Api\Exception\StoreResourceFailedException('Unable to create device.', $object->errors());
        }
    }
    public function updateDevice() {
      $posted_data = Input::all();
      $object = Device::find($posted_data['id']);
      // $object = new Device();
      // return $object->validate($posted_data);
      if ($object->validate($posted_data)) {
            // $device = Device::where("device_id",$posted_data['device_id'])->first();
            // return $device;
            // if ($device){
            //    return response()->json(['status_code' => 201, 'message' => 'Device already created']);
            // }else{
              $device = Device::where('id',$posted_data['id'])->update($posted_data);
              if($device){
                $res = Device::find($posted_data['id']);
                return response()->json(['status_code' => 200, 'message' => 'Device updated successfully', 'data' => $res]);
              }else{
                return response()->json(['status_code' => 404, 'message' => 'Device not found']);
              }
            // }
      } else {
        return response()->json(['status_code' => 422, 'message' =>'Unable to update device', 'error' => $object->errors()]);
          // throw new \Dingo\Api\Exception\StoreResourceFailedException('Unable to update device.', $object->errors());
      }
    }
    public function getDevices() {
        $device = Device::where('status','NOT ENGAGE')->get();
        if ($device){
          return response()->json(['status_code' => 200, 'message' => 'Device list', 'data' => $device]);

        }else{
          return response()->json(['status_code' => 404, 'message' => 'Device not found']);
        }

    }
    public function getAllDevices() {
        $device = Device::All();
        if ($device){
          foreach($device as $data) {
             if($data['status']=='ENGAGE'){
               $userId=UserDeviceAssoc::select('user_id')->where('device_id',$data['id'])->latest()->first();
               $data['username']=User::where('id',$userId->user_id)->pluck('name')->first();
             }else{
               $data['username']='';
             }
           }
          return response()->json(['status_code' => 200, 'message' => 'Device list', 'data' => $device]);

        }else{
          return response()->json(['status_code' => 404, 'message' => 'Device not found']);
        }

    }
    public function getDeviceById($id) {
        $device = Device::where("id",$id)->first();
        if ($device){
          return response()->json(['status_code' => 200, 'message' => 'Device info', 'data' => $device]);

        }else{
          return response()->json(['status_code' => 404, 'message' => 'Device not found']);
        }
    }
    public function importDevices(Request $request) {

        try {
          $path = $request->file('csv_file')->getRealPath();
          $datas = Excel::load($path, function($reader) {

          })->get()->toArray();

          $array = array();
          foreach($datas as $data) {
             if($data['device_id']!=null){
               unset($data["0"]);
               $status='NOT ENGAGE';
               $array[] =implode(', ', ['"' .$data['device_id'] .'"','"'.$status.'"']);
             }
           }
           if(count($array)>0){
                 $array = Collection::make($array);
                 $insertString = '';
                 foreach ($array as $ch) {
                     $insertString .= '(' . $ch . '), ';
                 }
                 $insertString = rtrim($insertString, ", ");
                $model =  DB::insert("INSERT INTO devices (`device_id`,`status`) VALUES $insertString ON DUPLICATE KEY UPDATE `device_id`=VALUES(`device_id`)");
                return response()->json(['status_code' => 200, 'message' => 'Device Imported successfully', 'data' => $model]);

         } else {
             throw new \Dingo\Api\Exception\StoreResourceFailedException('Unable to import empty file.');
         }
        } catch (\Exception $e) {
          throw new \Dingo\Api\Exception\StoreResourceFailedException('Data already entered/invalid data in file',[$e->getMessage()]);
        }


    }


}
