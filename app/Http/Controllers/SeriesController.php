<?php

namespace App\Http\Controllers;

use App\series;
use Illuminate\Http\Request;
use DateTime;
class SeriesController extends Controller
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
        //
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
     * @param  \App\series  $series
     * @return \Illuminate\Http\Response
     */
    public function getSeriesList()
    {
        $tempdate=new DateTime();
        $d=$tempdate->format('m/Y');
        $id= series::where(['month_year'=>$d])->pluck('id')->first();
        $data= series::where('id', '<', ($id+2))->get();
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\series  $series
     * @return \Illuminate\Http\Response
     */
    public function edit(series $series)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\series  $series
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, series $series)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\series  $series
     * @return \Illuminate\Http\Response
     */
    public function destroy(series $series)
    {
        //
    }
}
