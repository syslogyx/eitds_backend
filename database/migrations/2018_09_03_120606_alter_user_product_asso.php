<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserProductAsso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_product_assoc', function (Blueprint $table) {
          $table->string('test_point_1_voltage');
          $table->string('test_point_2');
          $table->string('test_point_5');
          $table->string('test_point_6');
          $table->string('test_point_7_V');
          $table->string('test_point_7_V2');
          $table->string('number_of_pulse');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_product_assoc', function (Blueprint $table) {
            //
        });
    }
}
