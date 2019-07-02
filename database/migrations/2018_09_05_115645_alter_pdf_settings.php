<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\PdfSetting;
class AlterPdfSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pdf_settings', function (Blueprint $table) {
          $table->string('selected_columns');
        });
		$data = array(
            array(
              "footer_heading"=> "tests",
"header_heading"=>"tests",
"logo"=>"1537509194.jpg",
"selected_columns"=> "1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22",
"status"=>"ACTIVE"
            )
        );

        PdfSetting::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pdf_settings', function (Blueprint $table) {
            //
        });
    }
}
