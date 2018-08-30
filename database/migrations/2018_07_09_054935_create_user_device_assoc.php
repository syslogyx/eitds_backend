<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDeviceAssoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('user_device_assoc', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('device_id')->unsigned();
           $table->foreign('device_id')->references('id')->on('devices')->onUpdate('cascade')->onDelete('cascade');
           $table->integer('user_id')->unsigned();
           $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
