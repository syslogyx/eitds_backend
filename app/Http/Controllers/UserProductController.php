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
use App\Pdf_column_table;
use Config;
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

          $json['test_point_1_voltage']=$posted_data['TP1_V'];
          $json['test_point_2']=$posted_data['TP2'];
          $json['test_point_5']=$posted_data['TP5'];
          $json['test_point_6']=$posted_data['TP6'];
          $json['test_point_7_V']=$posted_data['TP7_V'];
          $json['test_point_7_V2']=$posted_data['TP7_V2'];
          $json['number_of_pulse']=$posted_data['PC'];

          $FIXED_COL=Config::get('constants.FIXED_COL');
          $test_case='Test_Case_'.$json['test_case'];
          $mode=Mode::where('id',$json['mode'])->pluck('description')->first();

          $condition=$FIXED_COL[$test_case]['Mode'][$mode]['Excepted'];


          // $json=this->checkStatus($condition,$json);
          // print_r($condition);
          // die();

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
    public function checkStatus($condition,$json)
    {
      foreach ($condition as $key => $value) {
        if($value!='' &&  $value!=0){
          // if(){
          //   $json['status']=1;
          // }else{
          //   $json['status']=2;
          // }
        }

      }
      return $json;
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

    public function getProductHistoryByDateAndProductIdNew() {
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
                $productIds= UserProduct::distinct()->pluck('product_id');
                if (isset($posted_data['product_id'])){
                  $productIds= array($posted_data['product_id']);
                }

               for ($x = 0; $x < count($productList); $x++) {
                    $temp=$productList[$x];
                    $productList[$x]->username=User::where('id',$temp["user_id"])->pluck('name')->first();
                    $productList[$x]->mode=Mode::where('id',$temp["mode"])->pluck('description')->first();
                    $productList[$x]->test_case_name=TestCase::where('id',$temp["test_case"])->pluck('description')->first();
                    $productList[$x]->status=Status::where('id',$temp["status"])->pluck('description')->first();
                }
                $response=array();
                for ($y = 0; $y < count($productIds); $y++) {
                  $temp=array($productIds[$y] => array() );
                  array_push($response,$temp);
                  for ($z = 0; $z < count($productList); $z++) {
                    if($productIds[$y]==$productList[$z]->product_id){
                      array_push($response[$y][$productIds[$y]],$productList[$z]);
                    }
                   }
                }
                $finalResponse=array();
                $count=0;
                foreach ($response as $key => $value) {
                  foreach ( $value as $k => $v) {
                    $temp=array($k => array() );
                    array_push($finalResponse,$temp);
                    foreach ( $finalResponse[$count] as $k2 => $v2) {
                      $testCases=UserProduct::distinct()->select('test_case')->where('product_id', '=', $k2)->pluck('test_case');
                      for ($y = 0; $y < count($testCases); $y++) {
                        $temp2=array('Test_Case_'.$testCases[$y] => array('Timer Mode'=>array(),'Impact Mode'=>array(),'Timer & Impact Mode'=>array()) );
                        array_push($v2,$temp2);
                        for ($z = 0; $z < count($v); $z++) {
                          if($testCases[$y]==$v[$z]->test_case){
                              foreach ( $v2[$y]['Test_Case_'.$testCases[$y]] as $dk => $dv) {
                                if($dk==$v[$z]->mode){
                                    array_push($v2[$y]['Test_Case_'.$testCases[$y]][$dk],$v[$z]);
                                }
                              }
                          }
                         }
                      }
                      $finalResponse[$count++][$k]=$v2;
                    }
                  }

                }



                foreach ($finalResponse as $k => $v) {
                  foreach ( $v as $k2 => $v2) {
                    $FIXED_COL=Config::get('constants.FIXED_COL');
                    foreach ( $v2 as $k3 => $v3) {
                      foreach ( $v3 as $k4 => $v4) {
                        $FIXED_COL[$k4]['ActualLength']=count($v3[$k4]['Timer Mode'])+count($v3[$k4]['Impact Mode'])+count($v3[$k4]['Timer & Impact Mode']);
                        $FIXED_COL[$k4]['Mode']['Timer Mode']['Actual']=$v3[$k4]['Timer Mode'];
                        $FIXED_COL[$k4]['Mode']['Impact Mode']['Actual']=$v3[$k4]['Impact Mode'];
                        $FIXED_COL[$k4]['Mode']['Timer & Impact Mode']['Actual']=$v3[$k4]['Timer & Impact Mode'];
                      }
                    }
                    $finalResponse[$k][$k2]=$FIXED_COL;
                  }
                }
                // die();
               return response()->json(['status_code' => 200, 'message' => 'Product list', 'data' => $finalResponse]);

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

               $productIds= array($productId);
               if ($productId==-1){
                  $productIds= UserProduct::distinct()->pluck('product_id');
               }

               for ($x = 0; $x < count($productList); $x++) {
                    $temp=$productList[$x];

                    $productList[$x]->mode=Mode::where('id',$temp["mode"])->pluck('description')->first();
                    $productList[$x]->test_case=TestCase::where('id',$temp["test_case"])->pluck('description')->first();
                    $productList[$x]->status=Status::where('id',$temp["status"])->pluck('description')->first();
                    unset($productList[$x]->updated_at);
                    unset($productList[$x]->created_at);


                }


                 $response=array();
                 for ($y = 0; $y < count($productIds); $y++) {
                   $temp=array($productIds[$y] => array() );
                   array_push($response,$temp);
                   for ($z = 0; $z < count($productList); $z++) {
                     if($productIds[$y]==$productList[$z]->product_id){
                       array_push($response[$y][$productIds[$y]],$productList[$z]);
                     }
                    }
                 }
                 $finalResponse=array();
                 $count=0;
                 foreach ($response as $key => $value) {
                   foreach ( $value as $k => $v) {
                     $temp=array($k => array() );
                     array_push($finalResponse,$temp);
                     foreach ( $finalResponse[$count] as $k2 => $v2) {
                       $testCases=UserProduct::distinct()->select('test_case')->where('product_id', '=', $k2)->pluck('test_case');
                       for ($y = 0; $y < count($testCases); $y++) {
                         $temp2=array('Test_Case_'.$testCases[$y] => array('Timer Mode'=>array(),'Impact Mode'=>array(),'Timer & Impact Mode'=>array()) );
                         array_push($v2,$temp2);
                         for ($z = 0; $z < count($v); $z++) {
                           if($testCases[$y]==$v[$z]->test_case){
                               foreach ( $v2[$y]['Test_Case_'.$testCases[$y]] as $dk => $dv) {
                                 if($dk==$v[$z]->mode){
                                     array_push($v2[$y]['Test_Case_'.$testCases[$y]][$dk],$v[$z]);
                                 }
                               }
                           }
                          }
                       }
                       $finalResponse[$count++][$k]=$v2;
                     }
                   }

                 }



                 foreach ($finalResponse as $k => $v) {
                   foreach ( $v as $k2 => $v2) {
                     $FIXED_COL=Config::get('constants.FIXED_COL');
                     foreach ( $v2 as $k3 => $v3) {
                       foreach ( $v3 as $k4 => $v4) {
                         $FIXED_COL[$k4]['ActualLength']=count($v3[$k4]['Timer Mode'])+count($v3[$k4]['Impact Mode'])+count($v3[$k4]['Timer & Impact Mode']);
                         $FIXED_COL[$k4]['Mode']['Timer Mode']['Actual']=$v3[$k4]['Timer Mode'];
                         $FIXED_COL[$k4]['Mode']['Impact Mode']['Actual']=$v3[$k4]['Impact Mode'];
                         $FIXED_COL[$k4]['Mode']['Timer & Impact Mode']['Actual']=$v3[$k4]['Timer & Impact Mode'];
                       }
                     }
                     $finalResponse[$k][$k2]=$FIXED_COL;
                   }
                 }

                $pdfSettingData = PdfSetting::where('status','ACTIVE')->get();
                $pdfSettingData=count($pdfSettingData)>0?$pdfSettingData[0]:'';
                $selectedColumns = explode(",",$pdfSettingData->selected_columns);
                $pdfColumnTable=Pdf_column_table::whereIn('id',$selectedColumns)->get();
                $pdfSettingData->selected_columns= $pdfColumnTable;

                $now = new DateTime();
                $now = $now->format('Y-m-d H:i:s');
                if($type==='PDF'){
                  $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('report/pdf', compact('finalResponse','pdfSettingData'))->setPaper('A4', 'landscape');
                  return $pdf->download('report_'.$now.'.pdf');
                }elseif ($type==='CSV') {
                  // Generate and return the spreadsheet
                   Excel::create('Report_'.$now, function($excel) use ($finalResponse,$now) {

                       // Set the spreadsheet title, creator, and description
                       $excel->setTitle('Report_'.$now);
                       $excel->setCreator('Laravel')->setCompany('Syslogyx Pvt Ltd');
                       $excel->setDescription('Report_'.$now.' file');

                       // Build the spreadsheet, passing in the payments array
                       $excel->sheet('sheet1', function($sheet) use ($finalResponse) {
                           $sheet->fromArray($finalResponse);
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
