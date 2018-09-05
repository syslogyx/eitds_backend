<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Pdf_column_table;
class CreatePdfColumnTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdf_column_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('column_name');
            $table->string('column_display_name');
            // $table->string('name');
            $table->timestamps();
        });

        $data = array(
            array(
              "column_name" => "Test_Case",
              "column_display_name" => "Test Case"
            ),
            array(
              "column_name" => "Test_Condition",
              "column_display_name" => "Test Condition"
            ),
            array(
              "column_name" => "Valid_for_Modes",
              "column_display_name" => "Valid for Modes"
            ),
            array(
              "column_name" => "Mode",
              "column_display_name" => "Mode"
            ),
            array(
              "column_name" => "Time_(ms)",
              "column_display_name" => "Time (ms)"
            ),
            array(
              "column_name" => "Voltage_(V)",
              "column_display_name" => "Voltage (V)"
            ),
            array(
              "column_name" => "Output",
              "column_display_name" => "Output"
            ),
            array(
              "column_name" => "test_point_3_time",
              "column_display_name" => "Time when Trigger Occurred (TP3_T) (sec)"
            ),
            array(
              "column_name" => "test_point_4_time",
              "column_display_name" => "Time when Trigger Occurred (TP4_T)"
            ),
            array(
              "column_name" => "test_point_1_voltage",
              "column_display_name" => "TP1 (VCC) (TP1_V)"
            ),
            array(
              "column_name" => "test_point_2",
              "column_display_name" => "TP2 (Int. Firing Pulse)"
            ),
            array(
              "column_name" => "test_point_3_voltage",
              "column_display_name" => "TP3_V (Neutralization Pulse)"
            ),
            array(
              "column_name" => "number_of_pulse",
              "column_display_name" => "No. of Pulses (PC)"
            ),
            array(
              "column_name" => "test_point_4_pulse_high",
              "column_display_name" => "Pulse Width (ms) TP4_P_H"
            ),
            array(
              "column_name" => "test_point_4_pulse_low",
              "column_display_name" => "Pulse Gap (ms) TP4_P_L"
            ),

            array(
              "column_name" => "test_point_4_voltage",
              "column_display_name" => "Pulse Amplitude (V) TP4_V"
            ),
            array(
              "column_name" => "test_point_5",
              "column_display_name" => "TP5 (3.3V Till 6 Sec)"
            ),
            array(
              "column_name" => "test_point_6",
              "column_display_name" => "TP6 (Int. Firing Pulse)"
            ),
            array(
              "column_name" => "test_point_7_V",
              "column_display_name" => "TP7 (Arming Safety) TP7_V @ 200ms (V)"
            ),
            array(
              "column_name" => "test_point_7_V2",
              "column_display_name" => "(Arming Safety) TP7_V2 @ 1.8 ms (V)"
            ),
            array(
              "column_name" => "status",
              "column_display_name" => "Final Status (OK/NOT OK)"
            ),
            array(
              "column_name" => "date",
              "column_display_name" => "Date"
            )


        );

        Pdf_column_table::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pdf_column_tables');
    }
}
