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
use App\Sticker;
use App\series;
use App\Pdf_column_table;
use Config;
use PDF;
use Excel;
use \stdClass;
use App\PdfTemp;

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
          $json['token']=$posted_data['token'];

          $FIXED_COL=Config::get('constants.FIXED_COL');
          $test_case='Test_Case_'.$json['test_case'];
          $mode=Mode::where('id',$json['mode'])->pluck('description')->first();

          $condition=$FIXED_COL[$test_case]['Mode'][$mode];

          $json=$this->checkStatus($condition,$json);

          $tempdate=new DateTime();
           $json['date']=$tempdate->format('Y-m-d');


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
    public function checkStatus($obj,$json)
    {
      $status='1';
      $notOkColumn=array();
      $condition=$obj['Expected'];
      foreach ($condition as $key => $value) {
        $len=explode("-",$value);
        if($key=='test_point_3_time' || $key=='test_point_4_time'){
          if(count($len)==1){
            if($len[0]>0){
              if($json[$key] < ($len[0]-$obj['Time (ms)']) || $json[$key] > ($len[0]+$obj['Time (ms)']) ){
                $status='2';
                array_push($notOkColumn,$key);
              }
            }else{
              if($json[$key] > 0 || $json[$key] < 0){
                $status='2';
                array_push($notOkColumn,$key);
              }
            }
          }else{
            if($json[$key] < ($len[0] - $obj['Time (ms)']) || $json[$key] > ($len[1] + $obj['Time (ms)'])  ){
              $status='2';
              array_push($notOkColumn,$key);
            }
          }
        }else if($key=='test_point_1_voltage' || $key=='test_point_3_voltage'  || $key=='test_point_4_voltage' || $key=='test_point_7_V' || $key=='test_point_7_V2'){

          if($len[0]==0){
            if($json[$key] > ($len[0] + ($obj['Voltage (V)']*2)) ){
              $status='2';
              array_push($notOkColumn,$key);
            }
          }elseif($json[$key] < ($len[0] - $obj['Voltage (V)']) || $json[$key] > ($len[0] + ($obj['Voltage (V)']*2))  ){
              $status='2';
              array_push($notOkColumn,$key);
          }
        }else if($key=='number_of_pulse'){
            if($len[0]>=0){
              if($len[0]!=$json[$key] && $len[0]!='!0'){
                  $status='2';
                  array_push($notOkColumn,$key);
              }elseif($len[0]==$json[$key]){
                // if($json['test_point_4_pulse_high']!=$condition['test_point_4_pulse_high']){
                //   $status='2';
                //   array_push($notOkColumn,'test_point_4_pulse_high');
                // }
                // if($json['test_point_4_pulse_low']!=$condition['test_point_4_pulse_low']){
                //   $status='2';
                //   array_push($notOkColumn,'test_point_4_pulse_low');
                // }
              }elseif($len[0]=='!0'){
                if($json[$key]==0){
                  $status='2';
                  array_push($notOkColumn,$key);
                }else{
                  $highPulse=explode("-",$json['test_point_4_pulse_high']);
                  $lowPulse=explode("-",$json['test_point_4_pulse_low']);
                  // for ($i=0; $i < count($highPulse); $i++) {
                  //   if($highPulse[$i]!=$condition['test_point_4_pulse_high']){
                  //     $status='2';
                  //     array_push($notOkColumn,'test_point_4_pulse_high');
                  //     break;
                  //   }
                  // }
                }

              }

            }else {
              $status='2';
              array_push($notOkColumn,$key);
            }
        }

        $json['status']=$status;
        $json['not_ok_column']=implode(",",$notOkColumn);


      }
      // die();
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
    public function getResult() {
        $posted_data = Input::all();
        $posted_data['status']=2;
        $products= UserProduct::where($posted_data)->get();

        if(count($products)>0){

          return response()->json(['status_code' => 202, 'message' => 'Status', 'status' => 'NOT OK']);
        }else{
            $tempdate=new DateTime();
            $d=$tempdate->format('m/Y');
            $seriesName= series::select('series_name')->where(['month_year'=>$d])->pluck('series_name')->first();
            $finalId=Sticker::where(['seriesName'=>$seriesName])->pluck('finalId')->last();
            $id=Sticker::all()->pluck('id')->last();
            if($finalId!=""){
              $finalId=str_pad($finalId+1, 6, "0", STR_PAD_LEFT);
              $id=$id+1;
            }else{
              $finalId='000001';
              $id=1;
            }
            $exist=Sticker::where(['tempId'=>$posted_data['product_id']])->get();
            if(count($exist)==0){
              Sticker::create(['tempId'=>$posted_data['product_id'],'seriesName'=>$seriesName,'finalId'=>$finalId,'id'=>$id]);
            }
            return response()->json(['status_code' => 200, 'message' => 'Status', 'status' => 'OK']);
        }
    }

    public function getProductHistoryByDateAndProductId() {
              $posted_data = Input::all();
              $productList='';
              if(isset($posted_data['user_id'])){
                  $productList = UserProduct::where(["user_id"=>$posted_data['user_id'],'status'=>$posted_data['status']]);
              }

              if(!isset($posted_data['date']) && !isset($posted_data['product_id'])){
                if(isset($posted_data['user_id'])){
                    $productList = $productList->get();
                }else{
                    $productList=UserProduct::where(['status'=>$posted_data['status']])->get();
                }

              }else{
                if(isset($posted_data['date']) && !isset($posted_data['product_id'])){
                  if(isset($posted_data['user_id'])){
                      $productList = $productList->where("date",$posted_data['date'])->get();
                  }else{
                      $productList=UserProduct::where(["date"=>$posted_data['date'],'status'=>$posted_data['status']])->get();
                  }

                }elseif (!isset($posted_data['date']) && isset($posted_data['product_id'])) {
                  if(isset($posted_data['user_id'])){
                      $productList = $productList->where("product_id",$posted_data['product_id'])->get();
                  }else{
                      $productList=UserProduct :: where(["product_id"=>$posted_data['product_id'],'status'=>$posted_data['status']])->get();
                  }

                }else{
                  if(isset($posted_data['user_id'])){
                      $productList = $productList->where("date",$posted_data['date'])->where("product_id",$posted_data['product_id'])->get();
                  }else{
                      $productList=UserProduct :: where(["date"=>$posted_data['date'],"product_id"=>$posted_data['product_id'],'status'=>$posted_data['status']])->get();
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
              $status =!isset($posted_data['status'])?'':$posted_data['status'];
              $productList='';
              $productList=UserProduct::where($posted_data)->get();

              // if(isset($posted_data['user_id'])){
              //   $productList = UserProduct::where(["user_id"=>$posted_data['user_id']]);
              //     if($status!=''){
              //       $productList = UserProduct::where(["user_id"=>$posted_data['user_id'],'status'=>$status]);
              //     }
              // }
              // if(!isset($posted_data['date']) && !isset($posted_data['product_id'])){
              //   if(isset($posted_data['user_id'])){
              //       $productList = $productList->get();
              //   }else{
              //         $productList=UserProduct::All();
              //         if($status!=''){
              //           $productList=UserProduct::where(['status'=>$status])->get();
              //         }
              //   }
              //
              // }else{
              //   if(isset($posted_data['date']) && !isset($posted_data['product_id'])){
              //     if(isset($posted_data['user_id'])){
              //         $productList = $productList->where("date",$posted_data['date'])->get();
              //     }else{
              //       $productList=UserProduct::where(["date"=>$posted_data['date']])->get();
              //       if($status!=''){
              //         $productList=UserProduct::where(["date"=>$posted_data['date'],'status'=>$status])->get();
              //       }
              //     }
              //
              //   }elseif (!isset($posted_data['date']) && isset($posted_data['product_id'])) {
              //     if(isset($posted_data['user_id'])){
              //         $productList = $productList->where("product_id",$posted_data['product_id'])->get();
              //     }else{
              //       $productList=UserProduct :: where(["product_id"=>$posted_data['product_id']])->get();
              //       if($status!=''){
              //         $productList=UserProduct :: where(["product_id"=>$posted_data['product_id'],'status'=>$status])->get();
              //       }
              //     }
              //
              //   }else{
              //     if(isset($posted_data['user_id'])){
              //       $productList = $productList->where("date",$posted_data['date'])->where("product_id",$posted_data['product_id'])->get();
              //     }else{
              //       $productList=UserProduct :: where(["date"=>$posted_data['date'],"product_id"=>$posted_data['product_id']])->get();
              //       if($status!=''){
              //         $productList=UserProduct :: where(["date"=>$posted_data['date'],"product_id"=>$posted_data['product_id'],'status'=>$status])->get();
              //       }
              //     }
              //
              //   }
              // }

  // return  $productList;
             if (count($productList)>0){
               if(!isset($posted_data['user_id'])){
                  $productIds = UserProduct::distinct()->pluck('product_id');
               }else{
                  $productIds = UserProduct::where("user_id",$posted_data['user_id'])->distinct()->pluck('product_id');
               }

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
                        $temp2=array('Test_Case_'.$testCases[$y] => array('Timer'=>array(),'Impact'=>array(),'Timer & Impact'=>array()) );
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
                $FIXED_COL = [];

                // return $finalResponse;
                // $FIXED_COL_arr = [];
                foreach ($finalResponse as $k => $v) {
                  $FIXED_COL=Config::get('constants.FIXED_COL');
                  foreach ( $v as $k2 => $v2) {
                    foreach ( $v2 as $k3 => $v3) {
                      foreach ( $v3 as $k4 => $v4) {

                          $FIXED_COL[$k4]['Mode']['Timer']['Actual']=$v3[$k4]['Timer'];

                          $FIXED_COL[$k4]['Mode']['Impact']['Actual']=$v3[$k4]['Impact'];

                          $FIXED_COL[$k4]['Mode']['Timer & Impact']['Actual']=$v3[$k4]['Timer & Impact'];
                      }
                    }

                    $finalResponse[$k][$k2]=$FIXED_COL;
                  }
                }


                foreach ( $finalResponse as $frk1 => $frv1) {
                  foreach ( $frv1 as $frk2 => $FIXED_COL) {
                    foreach ( $FIXED_COL as $fk1 => $fv1) {
                      $count=0;
                      if(isset($fv1['Mode']['Timer']) && count($fv1['Mode']['Timer']['Actual'])==0){
                        unset($finalResponse[$frk1][$frk2][$fk1]['Mode']['Timer']);
                      }else if(isset($fv1['Mode']['Timer'])){
                        $count=$count+count($fv1['Mode']['Timer']['Actual']);
                      }

                      if(isset($fv1['Mode']['Impact']) && count($fv1['Mode']['Impact']['Actual'])==0 ){
                        unset($finalResponse[$frk1][$frk2][$fk1]['Mode']['Impact']);
                      }else if(isset($fv1['Mode']['Impact'])){
                        $count=$count+count($fv1['Mode']['Impact']['Actual']);
                      }

                      if(isset($fv1['Mode']['Timer & Impact']) && count($fv1['Mode']['Timer & Impact']['Actual'])==0){
                        unset($finalResponse[$frk1][$frk2][$fk1]['Mode']['Timer & Impact']);
                      }else if(isset($fv1['Mode']['Timer & Impact'])){
                        $count=$count+count($fv1['Mode']['Timer & Impact']['Actual']);
                      }

                      $finalResponse[$frk1][$frk2][$fk1]['ActualLength']=$count;
                    }
                  }
                }



                  $pdfSettingData = PdfSetting::where('status','ACTIVE')->get();
                  $pdfSettingData=count($pdfSettingData)>0?$pdfSettingData[0]:'';
                  $selectedColumns = explode(",",$pdfSettingData->selected_columns);
                  $pdfColumnTable=Pdf_column_table::get();


                  for ($y = 0; $y < count($pdfColumnTable); $y++) {
                     $pdfColumnTable[$y]->status=false;
                    for ($z = 0; $z < count($selectedColumns); $z++) {
                      if($pdfColumnTable[$y]->id==$selectedColumns[$z]){
                        $pdfColumnTable[$y]->status=true;
                      }
                    }
                  }


                  $pdfSettingData->selected_columns=$pdfColumnTable;
                  $data['data']=json_encode($finalResponse);
                  $temp=PdfTemp::where('id',1)->update($data);


               return response()->json(['status_code' => 200, 'message' => 'Product list', 'data' => $finalResponse,'columnList'=>$pdfSettingData]);

             }else{
               return response()->json(['status_code' => 404, 'message' => 'Record not found']);
             }

    }



    public function download($userId,$date,$productId,$type)  {
               $queryDate=Input::all();
               $productId=0;
               if(isset($queryDate['product_id']) && $queryDate['product_id'] !=''){
                  $productId=$queryDate['product_id'];
               }
// return $product_Id;
               $finalResponse=PdfTemp::where(['id'=>1])->get();
               $finalResponse = json_decode($finalResponse[0]->data,true);
               $data = [];
               	for($i=0; $i<count($finalResponse); $i++){
                 $arr = [];
                 foreach ($finalResponse[$i] as $key => $value) {
                    $arr["project_id"] = $key;
							      $arr["test_cases"] = [];
                    foreach ($value as $key1 => $value1) {
                      $value1["Mode_data"] = [];
                      foreach ($value1 as $key2 => $value2) {
    						  			if($key2 == "Mode"){
                          // unset($value1[$key2]);
                          $mode_length = sizeof($value2);

										      $value1["mode_length"] = $mode_length;
                          foreach ($value2 as $key3 => $value3) {
                            $value3["mode_name"] = $key3;
    											  array_push($value1["Mode_data"],$value3);
                            foreach ($value3 as $key4 => $value4) {
    												  if($key4 == "Actual"){
                                foreach ($value4 as $key5 => $value5) {
                                  $value5["not_ok_columns"] = [];
    														  $value5["not_ok_columns"] = explode(',', $value5["not_ok_column"]);
                                  if(count($value4) == ($key5 + 1)){
      															// value1["Mode_data"] = value5;
      															$k = count($value1["Mode_data"]) - 1;
      															// value1["Mode_data"][0].merge(value5);

  															    $value1["Mode_data"][$k]["user_id"]=$value5["user_id"];
  								                  $value1["Mode_data"][$k]["device_id"]=$value5["device_id"];
  								                  $value1["Mode_data"][$k]["product_id"]=$value5["product_id"];
  								                  $value1["Mode_data"][$k]["mode"]=$value5["mode"];
  								                  $value1["Mode_data"][$k]["test_case"]=$value5["test_case"];
  								                  $value1["Mode_data"][$k]["test_point_3_voltage"]=$value5["test_point_3_voltage"];
  								                  $value1["Mode_data"][$k]["test_point_3_time"]=$value5["test_point_3_time"];
  								                  $value1["Mode_data"][$k]["test_point_4_voltage"]=$value5["test_point_4_voltage"];
  								                  $value1["Mode_data"][$k]["test_point_4_time"]=$value5["test_point_4_time"];
  								                  $value1["Mode_data"][$k]["test_point_4_pulse_low"]=$value5["test_point_4_pulse_low"];
  								                  $value1["Mode_data"][$k]["test_point_4_pulse_high"]=$value5["test_point_4_pulse_high"];
  								                  $value1["Mode_data"][$k]["status"]=$value5["status"];
  								                  $value1["Mode_data"][$k]["date"]=$value5["date"];
  								                  $value1["Mode_data"][$k]["created_at"]=$value5["created_at"];
  								                  $value1["Mode_data"][$k]["updated_at"]=$value5["updated_at"];
  								                  $value1["Mode_data"][$k]["test_point_1_voltage"]=$value5["test_point_1_voltage"];
  								                  $value1["Mode_data"][$k]["test_point_2"]=$value5["test_point_2"];
  								                  $value1["Mode_data"][$k]["test_point_5"]=$value5["test_point_5"];
  								                  $value1["Mode_data"][$k]["test_point_6"]=$value5["test_point_6"];
  								                  $value1["Mode_data"][$k]["test_point_7_V"]=$value5["test_point_7_V"];
  								                  $value1["Mode_data"][$k]["test_point_7_V2"]=$value5["test_point_7_V2"];
  								                  $value1["Mode_data"][$k]["number_of_pulse"]=$value5["number_of_pulse"];
  								                  $value1["Mode_data"][$k]["not_ok_column"]=$value5["not_ok_column"];
  								                  $value1["Mode_data"][$k]["not_ok_columns"]=$value5["not_ok_columns"];
  								                  $value1["Mode_data"][$k]["token"]=$value5["token"];
  								                  $value1["Mode_data"][$k]["username"]=$value5["username"];
  								                  $value1["Mode_data"][$k]["test_case_name"]=$value5["test_case_name"];
  														   }
    													 }
    												 }
    											 }
    										 }
    						  			}
    						  		}
                      array_push($arr["test_cases"],$value1);
                   }
               }
               array_push($data,$arr);
             }
               $finalResponse = $data;
               // return $finalResponse;
               // $finalResponse=json_decode($finalResponse[0]->data,true);
               $pdfSettingData = PdfSetting::where('status','ACTIVE')->get();
               $pdfSettingData=count($pdfSettingData)>0?$pdfSettingData[0]:'';
               $selectedColumns = explode(",",$pdfSettingData->selected_columns);
               $pdfColumnTable=Pdf_column_table::get();


               for ($y = 0; $y < count($pdfColumnTable); $y++) {
                  $pdfColumnTable[$y]->status=false;
                 for ($z = 0; $z < count($selectedColumns); $z++) {
                   if($pdfColumnTable[$y]->id==$selectedColumns[$z]){
                     $pdfColumnTable[$y]->status=true;
                   }
                 }
               }

               $pdfSettingData->selected_columns=$pdfColumnTable;
               $now = new DateTime();
               $now = $now->format('d-m-Y');
               view()->share(compact('finalResponse','pdfSettingData','productId','now'));
               $pdf = PDF::loadView('report/pdf')->setPaper('A4', 'landscape');
               return $pdf->download('report_'.$now.'.pdf');



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
