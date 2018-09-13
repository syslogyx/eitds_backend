<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\PdfTemp;
class CreatePdfTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdf_temps', function (Blueprint $table) {
            $table->increments('id');
            $table->json('data')->nullable();
            $table->timestamps();
        });
        $data = array(
            array(
            "data" => '{}'
            )
        );

        PdfTemp::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pdf_temps');
    }
}
