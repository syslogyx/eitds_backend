<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->increments('id');
            $table->string('series_name');
            $table->string('month_year');
            $table->timestamps();
        });
        $data = array(
          array("series_name" => "AA","month_year" => "09/2018"),
          array("series_name" => "AB","month_year" => "10/2018"),
          array("series_name" => "AC","month_year" => "11/2018"),
          array("series_name" => "AD","month_year" => "12/2018"),
          array("series_name" => "AE","month_year" => "01/2019"),
          array("series_name" => "AF","month_year" => "02/2019"),
          array("series_name" => "AG","month_year" => "03/2019"),
          array("series_name" => "AH","month_year" => "04/2019"),
          array("series_name" => "AI","month_year" => "05/2019"),
          array("series_name" => "AJ","month_year" => "06/2019"),
          array("series_name" => "AK","month_year" => "07/2019"),
          array("series_name" => "AL","month_year" => "08/2019"),
          array("series_name" => "AM","month_year" => "09/2019"),
          array("series_name" => "AN","month_year" => "10/2019"),
          array("series_name" => "AO","month_year" => "11/2019"),
          array("series_name" => "AP","month_year" => "12/2019"),
          array("series_name" => "AQ","month_year" => "01/2020"),
          array("series_name" => "AR","month_year" => "02/2020"),
          array("series_name" => "AS","month_year" => "03/2020"),
          array("series_name" => "AT","month_year" => "04/2020"),
          array("series_name" => "AU","month_year" => "05/2020"),
          array("series_name" => "AV","month_year" => "06/2020"),
          array("series_name" => "AW","month_year" => "07/2020"),
          array("series_name" => "AX","month_year" => "08/2020"),
          array("series_name" => "AY","month_year" => "09/2020"),
          array("series_name" => "AZ","month_year" => "10/2020"),
          array("series_name" => "BA","month_year" => "11/2020"),
          array("series_name" => "BB","month_year" => "12/2020"),
          array("series_name" => "BC","month_year" => "01/2021"),
          array("series_name" => "BD","month_year" => "02/2021"),
          array("series_name" => "BE","month_year" => "03/2021"),
          array("series_name" => "BF","month_year" => "04/2021"),
          array("series_name" => "BG","month_year" => "05/2021"),
          array("series_name" => "BH","month_year" => "06/2021"),
          array("series_name" => "BI","month_year" => "07/2021"),
          array("series_name" => "BJ","month_year" => "08/2021"),
          array("series_name" => "BK","month_year" => "09/2021"),
          array("series_name" => "BL","month_year" => "10/2021"),
          array("series_name" => "BM","month_year" => "11/2021"),
          array("series_name" => "BN","month_year" => "12/2021"),
          array("series_name" => "BO","month_year" => "01/2022"),
          array("series_name" => "BP","month_year" => "02/2022"),
          array("series_name" => "BQ","month_year" => "03/2022"),
          array("series_name" => "BR","month_year" => "04/2022"),
          array("series_name" => "BS","month_year" => "05/2022"),
          array("series_name" => "BT","month_year" => "06/2022"),
          array("series_name" => "BU","month_year" => "07/2022"),
          array("series_name" => "BV","month_year" => "08/2022"),
          array("series_name" => "BW","month_year" => "09/2022"),
          array("series_name" => "BX","month_year" => "10/2022"),
          array("series_name" => "BY","month_year" => "11/2022"),
          array("series_name" => "BZ","month_year" => "12/2022"),
          array("series_name" => "CA","month_year" => "01/2023"),
          array("series_name" => "CB","month_year" => "02/2023"),
          array("series_name" => "CC","month_year" => "03/2023"),
          array("series_name" => "CD","month_year" => "04/2023"),
          array("series_name" => "CE","month_year" => "05/2023"),
          array("series_name" => "CF","month_year" => "06/2023"),
          array("series_name" => "CG","month_year" => "07/2023"),
          array("series_name" => "CH","month_year" => "08/2023"),
          array("series_name" => "CI","month_year" => "09/2023"),
          array("series_name" => "CJ","month_year" => "10/2023"),
          array("series_name" => "CK","month_year" => "11/2023"),
          array("series_name" => "CL","month_year" => "12/2023"),
          array("series_name" => "CM","month_year" => "01/2024"),
          array("series_name" => "CN","month_year" => "02/2024"),
          array("series_name" => "CO","month_year" => "03/2024"),
          array("series_name" => "CP","month_year" => "04/2024"),
          array("series_name" => "CQ","month_year" => "05/2024"),
          array("series_name" => "CR","month_year" => "06/2024"),
          array("series_name" => "CS","month_year" => "07/2024"),
          array("series_name" => "CT","month_year" => "08/2024"),
          array("series_name" => "CU","month_year" => "09/2024"),
          array("series_name" => "CV","month_year" => "10/2024"),
          array("series_name" => "CW","month_year" => "11/2024"),
          array("series_name" => "CX","month_year" => "12/2024"),
          array("series_name" => "CY","month_year" => "01/2025"),
          array("series_name" => "CZ","month_year" => "02/2025"),
          array("series_name" => "DA","month_year" => "03/2025"),
          array("series_name" => "DB","month_year" => "04/2025"),
          array("series_name" => "DC","month_year" => "05/2025"),
          array("series_name" => "DD","month_year" => "06/2025"),
          array("series_name" => "DE","month_year" => "07/2025"),
          array("series_name" => "DF","month_year" => "08/2025"),
          array("series_name" => "DG","month_year" => "09/2025"),
          array("series_name" => "DH","month_year" => "10/2025"),
          array("series_name" => "DI","month_year" => "11/2025"),
          array("series_name" => "DJ","month_year" => "12/2025"),
          array("series_name" => "DK","month_year" => "01/2026"),
          array("series_name" => "DL","month_year" => "02/2026"),
          array("series_name" => "DM","month_year" => "03/2026"),
          array("series_name" => "DN","month_year" => "04/2026"),
          array("series_name" => "DO","month_year" => "05/2026"),
          array("series_name" => "DP","month_year" => "06/2026"),
          array("series_name" => "DQ","month_year" => "07/2026"),
          array("series_name" => "DR","month_year" => "08/2026"),
          array("series_name" => "DS","month_year" => "09/2026"),
          array("series_name" => "DT","month_year" => "10/2026"),
          array("series_name" => "DU","month_year" => "11/2026"),
          array("series_name" => "DV","month_year" => "12/2026"),
          array("series_name" => "DW","month_year" => "01/2027"),
          array("series_name" => "DX","month_year" => "02/2027"),
          array("series_name" => "DY","month_year" => "03/2027"),
          array("series_name" => "DZ","month_year" => "04/2027"),
          array("series_name" => "EA","month_year" => "05/2027"),
          array("series_name" => "EB","month_year" => "06/2027"),
          array("series_name" => "EC","month_year" => "07/2027"),
          array("series_name" => "ED","month_year" => "08/2027"),
          array("series_name" => "EE","month_year" => "09/2027"),
          array("series_name" => "EF","month_year" => "10/2027"),
          array("series_name" => "EG","month_year" => "11/2027"),
          array("series_name" => "EH","month_year" => "12/2027"),
          array("series_name" => "EI","month_year" => "01/2028"),
          array("series_name" => "EJ","month_year" => "02/2028"),
          array("series_name" => "EK","month_year" => "03/2028"),
          array("series_name" => "EL","month_year" => "04/2028"),
          array("series_name" => "EM","month_year" => "05/2028"),
          array("series_name" => "EN","month_year" => "06/2028"),
          array("series_name" => "EO","month_year" => "07/2028"),
          array("series_name" => "EP","month_year" => "08/2028"),
          array("series_name" => "EQ","month_year" => "09/2028"),
          array("series_name" => "ER","month_year" => "10/2028"),
          array("series_name" => "ES","month_year" => "11/2028"),
          array("series_name" => "ET","month_year" => "12/2028"),
        );
        App\series::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('series');
    }
}
