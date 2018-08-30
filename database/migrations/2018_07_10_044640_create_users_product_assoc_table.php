<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersProductAssocTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('user_product_assoc', function (Blueprint $table) {


           $table->integer('user_id')->unsigned();
           $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
           $table->string('device_id');
           $table->string('product_id');
           $table->string('mode');
           $table->string('test_case');
           $table->string('test_point_3_voltage');
           $table->string('test_point_3_time');
           $table->string('test_point_4_voltage');
           $table->string('test_point_4_time');
           $table->string('test_point_4_pulse_low');
           $table->string('test_point_4_pulse_high');
           $table->string('status');
           $table->string('date');
           $table->timestamps();
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
