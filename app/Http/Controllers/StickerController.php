<?php

namespace App\Http\Controllers;

use App\Sticker;
use App\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
         $object = Sticker::where('tempId',$posted_data['product_id'])->get();;
         if (count($object)>0) {
            return response()->json(['status_code' => 200, 'message' => 'Product is exist', 'data' => $object]);
         } else {
            return response()->json(['status_code' => 203, 'message' => 'Product is not exist']);

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
        if (count($object)>0) {
           return response()->json(['status_code' => 200, 'message' => 'Product is exist', 'data' => $object]);
        } else {
           return response()->json(['status_code' => 203, 'message' => 'Product is not exist']);
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
