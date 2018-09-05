<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\TestCase;
class AlterTestCases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('test_cases', function (Blueprint $table) {
          $data = array(
              array(
              "description" => "Test case 5"
              ),
              array(
              "description" => "Test case 6"
            ),
            array(
              "description" => "Test case 7"
              ),
            array(
              "description" => "Test case 8"
            ),
              array(
              "description" => "Test case 9"
              ),
              array(
              "description" => "Test case 10"
            ),
            array(
              "description" => "Test case 11"
              ),
            array(
              "description" => "Test case 12"
            ),
            array(
            "description" => "Test case 13"
            ),
            array(
            "description" => "Test case 14"
          )
          );

          TestCase::insert($data);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_cases', function (Blueprint $table) {
            //
        });
    }
}
