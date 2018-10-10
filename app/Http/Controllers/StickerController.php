<?php

namespace App\Http\Controllers;

use App\Sticker;
use App\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DateTime;
use PDF;
use App\PdfTemp;
class StickerController extends Controller
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
     public function generateId() {
         $posted_data = Input::all();
         $object = Sticker::where('tempId',$posted_data['product_id'])->get();
         if (count($object)>0) {
            return response()->json(['status_code' => 200, 'message' => 'Product is exist', 'data' => $object]);
         } else {
            return response()->json(['status_code' => 203, 'message' => 'Product does not exist']);

         }
     }

     public function download()
     {
      $object = PdfTemp::where(['id'=>2])->get();
      $list = json_decode($object[0]->data,true);
      $json=[];
      $pageSize=35;
      $count=count($list);
      $pages=ceil($count/$pageSize);
            for ($i = 0; $i < $pages;$i++) {
              $tempArr=[];
              for ($j = ($i*$pageSize); $j < (($i*$pageSize)+$pageSize); $j++) {
                if($j<$count){
                  array_push($tempArr,$list[$j]);
                }
              }
              array_push($json,$tempArr);
            }
            // return count($json[0]);
        if ($count>0) {
          $now = new DateTime();
          $now = $now->format('Y-m-d H:i:s');
          view()->share(compact('json'));
          $pdf = PDF::loadView('report/sticker')->setPaper('A4', 'landscape');
          return $pdf->download('sticker_'.$now.'.pdf');
        } else {
          return response()->json(['status_code' => 203, 'message' => 'Sticker list not found']);
        }
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getStickerList()
    {
         $posted_data = Input::all();

        $object = Sticker::where(['seriesName'=>$posted_data['seriesName']])->where('id', '>=', $posted_data['startIndex'])->limit($posted_data['limit'])->get();
        // $object = Sticker::where(['seriesName'=>$posted_data['seriesName']])->get();
        $data['data']=$object;
        PdfTemp::where('id',2)->update($data);
        if (count($object)>0) {
           return response()->json(['status_code' => 200, 'message' => 'Product is exist', 'data' => $object]);
        } else {
           return response()->json(['status_code' => 203, 'message' => 'Product does not exist']);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Sticker  $sticker
     * @return \Illuminate\Http\Response
     */
    public function show(Sticker $sticker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sticker  $sticker
     * @return \Illuminate\Http\Response
     */
    public function edit(Sticker $sticker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sticker  $sticker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sticker $sticker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sticker  $sticker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sticker $sticker)
    {
        //
    }
}
