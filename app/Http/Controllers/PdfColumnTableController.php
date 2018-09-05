<?php

namespace App\Http\Controllers;

use App\Pdf_column_table;
use Illuminate\Http\Request;

class PdfColumnTableController extends Controller
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
    public function getColumnList()
    {
        $pdf_column_table = Pdf_column_table::All();
        if ($pdf_column_table){
          return response()->json(['status_code' => 200, 'message' => 'Column List', 'data' => $pdf_column_table]);
        }else{
          return response()->json(['status_code' => 404, 'message' => 'Record not found..!']);
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
     * @param  \App\Pdf_column_table  $pdf_column_table
     * @return \Illuminate\Http\Response
     */
    public function show(Pdf_column_table $pdf_column_table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pdf_column_table  $pdf_column_table
     * @return \Illuminate\Http\Response
     */
    public function edit(Pdf_column_table $pdf_column_table)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pdf_column_table  $pdf_column_table
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pdf_column_table $pdf_column_table)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pdf_column_table  $pdf_column_table
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pdf_column_table $pdf_column_table)
    {
        //
    }
}
