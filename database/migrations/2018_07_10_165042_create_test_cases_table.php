<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\TestCase;

class CreateTestCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_cases', function (Blueprint $table) {
            $table->increments('id');
              $table->string('description');
            $table->timestamps();
        });
        $data = array(
            array(
            "description" => "Test case 1"
            ),
            array(
            "description" => "Test case 2"
          ),
          array(
            "description" => "Test case 3"
            ),
          array(
            "description" => "Test case 4"
            )
        );

        TestCase::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_cases');
    }
}
