<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DateTime;
use App\UserProduct;
use App\Mode;
use App\Status;
use App\TestCase;
use App\User;
use App\PdfSetting;

use PDF;
use Excel;
class UserProductController extends Controller
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
    public function addTestCaseResult()
    {
          $posted_data = Input::all();

          $json['user_id']=$posted_data['UID'];
          $json['device_id']=$posted_data['DID'];
          $json['product_id']=$posted_data['PID'];
          $json['mode']=$posted_data['M'];
          $json['test_case']=$posted_data['TC'];
          $json['test_point_3_voltage']=$posted_data['TP3_V'];
          $json['test_point_3_time']=$posted_data['TP3_T'];
          $json['test_point_4_voltage']=$posted_data['TP4_V'];
          $json['test_point_4_time']=$posted_data['TP4_T'];
          $json['test_point_4_pulse_low']=$posted_data['TP4_P_L'];
          $json['test_point_4_pulse_high']=$posted_data['TP4_P_H'];
          $json['status']=$posted_data['STAT'];
          $tempdate=new DateTime();
          $json['date']=$tempdate->format('Y-m-d');
          // return $json;
          $model=UserProduct::create($json);
          if ($model){
            return response()->json(['status_code' => 200, 'message' => 'Test case result added successfully']);
          }else{
            return response()->json(['status_code' => 404, 'message' => 'Test case result unable to add']);
          }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProductsByUserId($id)
    {
              if($id==0){
                 $product = UserProduct::distinct()->pluck('product_id');
              }else{
                 $product = UserProduct::where("user_id",$id)->distinct()->pluck('product_id');
              }

             if (count($product)>0){
               $res['product_ids']=$product;
               return response()->json(['status_code' => 200, 'message' => 'product list', 'data' => $res]);

             }else{
               return response()->json(['status_code' => 404, 'message' => 'Record not found']);
             }

    }

    public function getProductHistoryByDateAndProductId() {
              $posted_data = Input::all();
              $productList='';
              if(isset($posted_data['user_id'])){
                  $productList = UserProduct::where("user_id",$posted_data['user_id']);
              }

              if(!isset($posted_data['date']) && !isset($posted_data['product_id'])){
                if(isset($posted_data['user_id'])){
                    $productList = $productList->get();
                }else{
                    $productList=UserProduct::All();
                }

              }else{
                if(isset($posted_data['date']) && !isset($posted_data['product_id'])){
                  if(isset($posted_data['user_id'])){
                      $productList = $productList->where("date",$posted_data['date'])->get();
                  }else{
                      $productList=UserProduct::where("date",$posted_data['date'])->get();
                  }

                }elseif (!isset($posted_data['date']) && isset($posted_data['product_id'])) {
                  if(isset($posted_data['user_id'])){
                      $productList = $productList->where("product_id",$posted_data['product_id'])->get();
                  }else{
                      $productList=UserProduct :: where("product_id",$posted_data['product_id'])->get();
                  }

                }else{
                  if(isset($posted_data['user_id'])){
                    $productList = $productList->where("date",$posted_data['date'])->where("product_id",$posted_data['product_id'])->get();
                  }else{
                      $productList=UserProduct :: where("date",$posted_data['date'])->where("product_id",$posted_data['product_id'])->get();
                  }

                }
              }


             if (count($productList)>0){
               for ($x = 0; $x < count($productList); $x++) {
                    $temp=$productList[$x];
                    $productList[$x]->username=User::where('id',$temp["user_id"])->pluck('name')->first();
                    $productList[$x]->mode=Mode::where('id',$temp["mode"])->pluck('description')->first();
                    $productList[$x]->test_case=TestCase::where('id',$temp["test_case"])->pluck('description')->first();
                    $productList[$x]->status=Status::where('id',$temp["status"])->pluck('description')->first();
                }
               return response()->json(['status_code' => 200, 'message' => 'Product list', 'data' => $productList]);

             }else{
               return response()->json(['status_code' => 404, 'message' => 'Record not found']);
             }

    }


    public function download($userId,$date,$productId,$type)
    {

              $productList='';
              // return $type;
              if($userId!= -1){
                  $productList = UserProduct::where("user_id",$userId);
              }

              if($date== -1 && $productId == -1 ){
                if($userId!= -1){
                    $productList = $productList->get();
                }else{
                    $productList=UserProduct::All();
                }

              }else{
                if($date != -1 && $productId == -1){
                  if(isset($posted_data['user_id'])){
                      $productList = $productList->where("date",$date)->get();
                  }else{
                      $productList=UserProduct::where("date",$date)->get();
                  }

                }elseif ($date == -1 && $productId != -1) {
                  if($userId!= -1){
                      $productList = $productList->where("product_id",$productId)->get();
                  }else{
                      $productList=UserProduct :: where("product_id",$productId)->get();
                  }

                }else{
                  if($userId!= -1){
                    $productList = $productList->where("date",$date)->where("product_id",$productId)->get();
                  }else{
                      $productList=UserProduct :: where("date",$date)->where("product_id",$productId)->get();
                  }

                }
              }


             if (count($productList)>0){
               for ($x = 0; $x < count($productList); $x++) {
                    $temp=$productList[$x];

                    $productList[$x]->mode=Mode::where('id',$temp["mode"])->pluck('description')->first();
                    $productList[$x]->test_case=TestCase::where('id',$temp["test_case"])->pluck('description')->first();
                    $productList[$x]->status=Status::where('id',$temp["status"])->pluck('description')->first();
                    unset($productList[$x]->updated_at);
                    unset($productList[$x]->created_at);


                }

                $pdfSettingData = PdfSetting::where('status','ACTIVE')->get();
                $pdfSettingData=count($pdfSettingData)>0?$pdfSettingData[0]:'';
                // return $pdfSettingData;
                $now = new DateTime();
                $now = $now->format('Y-m-d H:i:s');
                if($type==='PDF'){
                  $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('report/pdf', compact('productList','pdfSettingData'))->setPaper('A4', 'landscape');
                  return $pdf->download('report_'.$now.'.pdf');
                }elseif ($type==='CSV') {
                  // Generate and return the spreadsheet
                   Excel::create('Report_'.$now, function($excel) use ($productList,$now) {

                       // Set the spreadsheet title, creator, and description
                       $excel->setTitle('Report_'.$now);
                       $excel->setCreator('Laravel')->setCompany('Syslogyx Pvt Ltd');
                       $excel->setDescription('Report_'.$now.' file');

                       // Build the spreadsheet, passing in the payments array
                       $excel->sheet('sheet1', function($sheet) use ($productList) {
                           $sheet->fromArray($productList);
                       });

                   })->download('csv');
                }
             }else{
               return response()->json(['status_code' => 404, 'message' => 'Record not found']);
             }

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
