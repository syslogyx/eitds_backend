<?php

namespace App\Http\Controllers;

use App\PdfSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PdfSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addPdfSetting(Request $request)
    {
         $url=explode("api",$request->url());
         $object = new PdfSetting();
         $image = $request->file('logo');
         $posted_data['logo'] =time().'.'.$image->getClientOriginalExtension();
         $posted_data['header_heading']=$request['header_heading'];
         $posted_data['footer_heading']=$request['footer_heading'];
         $posted_data['status']='ACTIVE';
        if ($object->validate($posted_data)) {
            $model = PdfSetting::create($posted_data);
            if($model){
                $destinationPath = public_path('/img');
                $image->move($destinationPath, $posted_data['logo']);
                PdfSetting::where('id','!=',$model['id'])->update(['status'=>'INACTIVE']);
                return response()->json(['status_code' => 200, 'message' => 'PDF setting completed successfully', 'data' => $model]);
            }else{
              throw new \Dingo\Api\Exception\StoreResourceFailedException('PDF setting not completed.');
            }
       } else {
           throw new \Dingo\Api\Exception\StoreResourceFailedException('PDF setting not completed.',$object->errors());
       }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PdfSetting  $pdfSetting
     * @return \Illuminate\Http\Response
     */
    public function getPdfSettings()
    {

      $model = PdfSetting::All();
      if(count($model)>0){
          return response()->json(['status_code' => 200, 'message' => 'PDF setting List', 'data' => $model]);
      }else{
        throw new \Dingo\Api\Exception\StoreResourceFailedException('No record found..!');
      }

    }

    public function changePdfSettingStatus(Request $request)
    {

      $posted_data=$request->all();
      $model = PdfSetting::where('id',$posted_data['id'])->update(['status'=>$posted_data['status']]);
      if($model){
          if($posted_data['status']=='ACTIVE'){
              PdfSetting::where('id','!=',$posted_data['id'])->update(['status'=>'INACTIVE']);
          }
          return response()->json(['status_code' => 200, 'message' => 'PDF setting status change successfully', 'data' => $model]);
      }else{
        throw new \Dingo\Api\Exception\StoreResourceFailedException('No record found..!');
      }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PdfSetting  $pdfSetting
     * @return \Illuminate\Http\Response
     */
    public function getActiveStatusPdfSetting()
    {
        return $pdfSettingData = PdfSetting::where('status','ACTIVE')->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PdfSetting  $pdfSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PdfSetting $pdfSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PdfSetting  $pdfSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(PdfSetting $pdfSetting)
    {
        //
    }
}
