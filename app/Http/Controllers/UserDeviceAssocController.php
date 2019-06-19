<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserDeviceAssoc;
use App\Device;
use DateTime;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class UserDeviceAssocController extends BaseController {


    function assignDeviceToUser() {
      try{
  	       DB::beginTransaction();
           $posted_data = Input::all();

           $object = new UserDeviceAssoc();

            $find= UserDeviceAssoc::where('user_id',$posted_data['user_id'])->latest()->first();


           if ($object->validate($posted_data)) {
             $tempdate=new DateTime();
             $posted_data['date']=$tempdate->format('Y-m-d');
             $posted_data['status']='ENGAGE';
              $model = UserDeviceAssoc::create($posted_data);
              if ($model){
                  $deviceObj=new Device();
                  $device = Device::where('id', $posted_data['device_id'])->where('status','<>', 'ENGAGE')
                ->update(['status' =>'ENGAGE']);
                  if($device){
                    if($find=='' || $find['status']=='ENGAGE'){
                        $updateDevice = Device::where('id',  $find['device_id'])
                      ->update(['status' =>'NOT ENGAGE']);
                    }

                   DB::commit();
                   return response()->json(['status_code' => 200, 'message' => 'Asssign successfully', 'data' => $model]);

                 }else {
                   return response()->json(['status_code' => 404, 'message' => 'Device already engage.']);
                 }
              }else{
                return response()->json(['status_code' => 404, 'message' => 'Unable to assign']);
              }
            } else {
              throw new \Dingo\Api\Exception\StoreResourceFailedException('Unable to assign.', $object->errors());
            }
        }
        catch(\Exception $e){
              DB::rollback();
              throw $e;
          }

    }
    public function getUserIdByDeviceId($id) {
        $deviceId=Device::where("device_id",$id)->pluck('id')->first();
        $user['user_id'] = UserDeviceAssoc::where("device_id",$deviceId)->latest()->pluck('user_id')->first();
        $user['token'] = time();
        if ($user['user_id']!=null){
          return response()->json(['status_code' => 200, 'message' => 'User info', 'data' => $user]);
        }else{
          return response()->json(['status_code' => 404, 'message' => 'Record not found']);
        }
    }

    public function getDeviceIdByUserIdOld($id) {

        $user = UserDeviceAssoc::where("user_id",$id)->latest()->first();
        if ($user){
          $deviceId=Device::where("id",$user['device_id'])->pluck('device_id')->first();
          $user['device_name']=$deviceId;
          return response()->json(['status_code' => 200, 'message' => 'User info', 'data' => $user]);
        }else{
          return response()->json(['status_code' => 404, 'message' => 'Record not found']);
        }
    }

    public function getDeviceIdByUserId($id) {

        $user = UserDeviceAssoc::with(array('Device.deviceInfo'=>function($query)use ($id){
        $query->where('user_id',$id)->latest()->first();
                }))->where("user_id",$id)->latest()->first();
        if ($user){

          $user['device_name']=$user['device']['device_id'];
          return response()->json(['status_code' => 200, 'message' => 'User info', 'data' => $user]);
        }else{
          return response()->json(['status_code' => 404, 'message' => 'Record not found']);
        }
    }

    public function resetDeviceById($id) {
      $device = Device::where('id',  $id)
      ->update(['status' =>'NOT ENGAGE']);
        $user = UserDeviceAssoc::where("device_id",$id)->latest()->first();
        if ($device){
          $posted_data['user_id']=$user['user_id'];
          $posted_data['device_id']=$user['device_id'];
          $posted_data['status']='NOT ENGAGE';
          $tempdate=new DateTime();
          $posted_data['date']=$tempdate->format('Y-m-d');

          $model = UserDeviceAssoc::create($posted_data);
          return response()->json(['status_code' => 200, 'message' => 'Device reset successfully', 'data' => $device]);

        }else{
          return response()->json(['status_code' => 404, 'message' => 'Device unable to reset.']);
        }
    }

    public function getDeviceUserInfo() {

      //  return UserDeviceAssoc::with("User.userInfo","Device")->where('user_id',75)->get();

        return UserDeviceAssoc::with(array('User.userInfo'=>function($query){
                $query->where('user_id',75);
              }))->with(array('Device.deviceInfo'=>function($query){
                $query->where('user_id',75);
              }))->where('user_id',75)->get();


    }





}
