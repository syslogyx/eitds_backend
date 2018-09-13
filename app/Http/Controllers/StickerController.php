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
         $object = new Sticker();
         if ($object->validate($posted_data)) {
             $model = UserProduct::where('product_id',$posted_data['product_id'])->get();
             if(count($model)>0){
                $modelUserProduct = Sticker::where('product_id',$posted_data['product_id'])->get();
                $res=$modelUserProduct;
                if(count($modelUserProduct)==0){
                  $res = Sticker::create($posted_data);
                }
                return response()->json(['status_code' => 200, 'message' => 'Product is exist', 'data' => $res]);
             }else{
                return response()->json(['status_code' => 404, 'message' => 'Product is not exist']);
             }

         } else {
              return response()->json(['status_code' => 203, 'message' => 'Validation Error','error':$object->errors()]);

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
