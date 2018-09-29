
<style>

.table {
    background-color: white;
}
.table {
    width: 100%;
    margin-bottom: 20px;
}
.table-responsive {
    min-height: .01%;
    overflow-x: auto;
}
.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
}
table {
    border-collapse: collapse;
    border-spacing: 0;
}
thead {
    /* color: #2d90ca; */
}
tr {
    display: table-row;
    vertical-align: inherit;
    border-color: black;
    border : 1px solid;
}
.table>thead>tr>th {
    vertical-align: bottom;
    /* border-bottom: 2px solid #ddd; */
}
.table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td {
    padding: 5px;
}
.table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>th, .table>caption+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>td, .table>thead:first-child>tr:first-child>td {
    border-top: 0;
}
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    /* border-top: 1px solid #ddd; */
}
#id{
  height: 50px;
  width:50px;
}
body{
  font-size: 9px;
}
thead { display: table-row-group; }

.breakNow { page-break-inside:avoid; page-break-after:always; }

@page {
	/* size: 11in 100in; /* <length>{1,2} | auto | portrait | landscape */ */
	      /* 'em' 'ex' and % are not allowed; length values are width height */
 /* <any of the usual CSS values for margins> */
	             /*(% of page-box width for LR, of height for TB) */
	margin-header: 5mm; /* <any of the usual CSS values for margins> */
	margin-footer: 5mm; /* <any of the usual CSS values for margins> */
	marks: /*crop | cross | none*/
	header: html_myHTMLHeaderOdd;
	footer: html_myHTMLFooterOdd;
	background: ...
	background-image: ...
	background-position ...
	background-repeat ...
	background-color ...
	background-gradient: ...
  border:1px solid;
}
.wrapping-div {
        display: block;
        page-break-inside: avoid !important;
    }

.wrapping-div tbody, .wrapping-div tr, .wrapping-div td, .wrapping-div th {
        page-break-inside: avoid !important;
    }
</style>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<div>

  <div id="tableToExport">
      <div>
        <img src="http://eitdsapi.syslogyx.com/img/1538054261.png" width="150" height="35"/>
      </div><br>
    @if($productId == 0)
    @foreach ($finalResponse as $key => $value)
    <div id="export-table">
      <div class="table-responsive wrapping-div">
        <table class=" table table-condensed table-bordered"  id="hidden_table">
          <thead class="thead-default">
            <tr>
                <td style="border:1px solid" colspan="2" style="text-align:center"><h4>Product Id : </h4></td>
                <td style="border:1px solid" colspan="2" style="text-align:center"><h4>{{$value["project_id"]}}</h4></td>
                <td style="border:1px solid" colspan="7" style="text-align:center"><h4>EITDS v2.0</h4></td>
                <td style="border:1px solid" colspan="2" style="text-align:center"><h4>Report Date : </h4></td>
                <td style="border:1px solid" colspan="2" style="text-align:center"><h4>{{$now}}</h4></td>
            </tr>
            <tr>
                <td style="border:1px solid" colspan="15" style="text-align:center"><h4>FUNCTIONAL TESTS</h4></td>
            </tr>
            <tr>
              <th style="border:1px solid;text-align: center;vertical-align: middle;">Test Case</th>
              <th style="border:1px solid;text-align: center;vertical-align: middle;">Test Condition</th>
              <th style="border:1px solid;text-align: center;vertical-align: middle;">Mode</th>
              <th style="border:1px solid;text-align: center;vertical-align: middle;">Time (ms)</th>
              <th style="border:1px solid;text-align: center;vertical-align: middle;">Voltage (V)</th>
              <th colspan="10" style="border:1px solid;text-align: center;vertical-align: middle;">Actual Output / Expected Output</th>
            </tr>
            <tr>
              <th style="border:1px solid;text-align: center;vertical-align: middle;">TP3_T</th>
              <th style="border:1px solid;text-align: center;vertical-align: middle;">TP4_T</th>
              <th style="border:1px solid;text-align: center;vertical-align: middle;">TP1_V</th>
              <th style="border:1px solid;text-align: center;vertical-align: middle;">TP3_V</th>
              <th style="border:1px solid;text-align: center;vertical-align: middle;">No. of Pulses</th>
              <th style="border:1px solid;text-align: center;vertical-align: middle;">TP4_Width</th>
              <th style="border:1px solid;text-align: center;vertical-align: middle;">TP4_Gap</th>
              <th style="border:1px solid;text-align: center;vertical-align: middle;">TP4_V</th>
              <th style="border:1px solid;text-align: center;vertical-align: middle;">TP7_V</th>
              <th style="border:1px solid;text-align: center;vertical-align: middle;">TP7_V2</th>
            </tr>
          </thead>
          @foreach ($value["test_cases"] as $key2 => $value2)
            @if($value2['ActualLength'] > 0)
            <tbody class="level1">
              <tr>
                  <td style="border:1px solid ;text-align: center;vertical-align: middle;" rowspan="{{($value2['mode_length'] * 2)}}">TC#{{$value2['Test Case']}} </td>
                  <td style="border:1px solid ;text-align: center;vertical-align: middle;" rowspan="{{($value2['mode_length'] * 2)}}">{{$value2['Test Condition']}}</td>
                  <td style="border:1px solid ;text-align: center;vertical-align: middle;" rowspan="{{($value2['mode_length'] * 2)}}">{{$value2['Valid for Modes']}} </td>

                  @if(count($value2["Mode_data"]) > 0)
                  <td style="border:1px solid" rowspan="2" >{{$value2["Mode_data"][0]['mode_name']}}</td>
                  <td style="border:1px solid" rowspan="2" >{{$value2["Mode_data"][0]['Time (ms)']}}</td>
                  <td style="border:1px solid" rowspan="2" >{{$value2["Mode_data"][0]['Voltage (V)']}}</td>
                  <td style="border:1px solid">Expected</td>
                  <td style="border:1px solid"> {{(isset($value2["Mode_data"][0]['Expected']['test_point_3_time']) ? $value2["Mode_data"][0]['Expected']['test_point_3_time'] : 0)}}</td>
                  <td style="border:1px solid"> {{(isset($value2["Mode_data"][0]['Expected']['test_point_4_time'])?$value2["Mode_data"][0]['Expected']['test_point_4_time']:0)}}</td>
                  <td style="border:1px solid"> {{(isset($value2["Mode_data"][0]['Expected']['test_point_1_voltage'])?$value2["Mode_data"][0]['Expected']['test_point_1_voltage']:0)}}</td>
                  <td style="border:1px solid"> {{(isset($value2["Mode_data"][0]['Expected']['test_point_2'])?$value2["Mode_data"][0]['Expected']['test_point_2']:0)}}</td>
                  <td style="border:1px solid"> {{(isset($value2["Mode_data"][0]['Expected']['test_point_3_voltage'])?$value2["Mode_data"][0]['Expected']['test_point_3_voltage']:0)}}</td>
                  <td style="border:1px solid"> {{(isset($value2["Mode_data"][0]['Expected']['number_of_pulse'])?$value2["Mode_data"][0]['Expected']['number_of_pulse']:0)}}</td>
                  <td style="border:1px solid"> {{(isset($value2["Mode_data"][0]['Expected']['test_point_4_pulse_high'])?$value2["Mode_data"][0]['Expected']['test_point_4_pulse_high']:0)}}</td>
                  <td style="border:1px solid"> {{(isset($value2["Mode_data"][0]['Expected']['test_point_4_pulse_low'])?$value2["Mode_data"][0]['Expected']['test_point_4_pulse_low']:0)}}</td>
                  <td style="border:1px solid"> {{(isset($value2["Mode_data"][0]['Expected']['test_point_4_voltage'])?$value2["Mode_data"][0]['Expected']['test_point_4_voltage']:0)}}</td>
                  <td style="border:1px solid"> {{(isset($value2["Mode_data"][0]['Expected']['test_point_5'])?$value2["Mode_data"][0]['Expected']['test_point_5']:0)}}</td>
                  <td style="border:1px solid"> {{(isset($value2["Mode_data"][0]['Expected']['test_point_6'])?$value2["Mode_data"][0]['Expected']['test_point_6']:0)}}</td>
                  <td style="border:1px solid"> {{(isset($value2["Mode_data"][0]['Expected']['test_point_7_V'])?$value2["Mode_data"][0]['Expected']['test_point_7_V']:0)}}</td>
                  <td style="border:1px solid"> {{(isset($value2["Mode_data"][0]['Expected']['test_point_7_V2'])?$value2["Mode_data"][0]['Expected']['test_point_7_V2']:0)}}</td>
                  @endif
              </tr>
              @foreach ($value2["Mode_data"] as $key3 => $value3)
              @if($key3 > 0)
                <tr>
                  <td style="border:1px solid" rowspan="2" >{{$value3['mode_name']}}</td>
                  <td style="border:1px solid" rowspan="2" >{{(isset($value3['Time (ms)'])?$value3['Time (ms)']:0)}}</td>
                  <td style="border:1px solid" rowspan="2" >{{(isset($value3['Voltage (V)'])?$value3['Voltage (V)']:0)}}</td>
                  <td style="border:1px solid">Expected</td>
                  <td style="border:1px solid"> {{(isset($value3['Expected']['test_point_3_time']) ? $value3['Expected']['test_point_3_time'] : 0)}}</td>
                  <td style="border:1px solid"> {{(isset($value3['Expected']['test_point_4_time'])?$value3['Expected']['test_point_4_time']:0)}}</td>
                  <td style="border:1px solid"> {{(isset($value3['Expected']['test_point_1_voltage'])?$value3['Expected']['test_point_1_voltage']:0)}}</td>
                  <td style="border:1px solid"> {{(isset($value3['Expected']['test_point_2'])?$value3['Expected']['test_point_2']:0)}}</td>
                  <td style="border:1px solid"> {{(isset($value3['Expected']['test_point_3_voltage'])?$value3['Expected']['test_point_3_voltage']:0)}}</td>
                  <td style="border:1px solid"> {{(isset($value3['Expected']['number_of_pulse'])?$value3['Expected']['number_of_pulse']:0)}}</td>
                  <td style="border:1px solid"> {{(isset($value3['Expected']['test_point_4_pulse_high'])?$value3['Expected']['test_point_4_pulse_high']:0)}}</td>
                  <td style="border:1px solid"> {{(isset($value3['Expected']['test_point_4_pulse_low'])?$value3['Expected']['test_point_4_pulse_low']:0)}}</td>
                  <td style="border:1px solid"> {{(isset($value3['Expected']['test_point_4_voltage'])?$value3['Expected']['test_point_4_voltage']:0)}}</td>
                  <td style="border:1px solid"> {{(isset($value3['Expected']['test_point_5'])?$value3['Expected']['test_point_5']:0)}}</td>
                  <td style="border:1px solid"> {{(isset($value3['Expected']['test_point_6'])?$value3['Expected']['test_point_6']:0)}}</td>
                  <td style="border:1px solid"> {{(isset($value3['Expected']['test_point_7_V'])?$value3['Expected']['test_point_7_V']:0)}}</td>
                  <td style="border:1px solid"> {{(isset($value3['Expected']['test_point_7_V2'])?$value3['Expected']['test_point_7_V2']:0)}}</td>

                </tr>
                @endif
                @foreach ($value3["Actual"] as $key4 => $value4)
                  @if((count($value3["Actual"])-1)==$key4)
                      <tr>
                        <td style="border:1px solid">Actual</td>
                        <td style="border:1px solid"> {{$value4['test_point_3_time']}}</td>
                        <td style="border:1px solid"> {{$value4['test_point_4_time']}}</td>
                        <td style="border:1px solid"> {{$value4['test_point_1_voltage']}}</td>
                        <td style="border:1px solid"> {{$value4['test_point_2']}}</td>
                        <td style="border:1px solid"> {{$value4['test_point_3_voltage']}}</td>
                        <td style="border:1px solid"> {{$value4['number_of_pulse']}}</td>
                        <td style="border:1px solid"> {{$value4['test_point_4_pulse_high']}}</td>
                        <td style="border:1px solid"> {{$value4['test_point_4_pulse_low']}}</td>
                        <td style="border:1px solid"> {{$value4['test_point_4_voltage']}}</td>
                        <td style="border:1px solid"> {{$value4['test_point_5']}}</td>
                        <td style="border:1px solid"> {{$value4['test_point_6']}}</td>
                        <td style="border:1px solid"> {{$value4['test_point_7_V']}}</td>
                        <td style="border:1px solid"> {{$value4['test_point_7_V2']}}</td>
                        <td style="border:1px solid"> {{ explode(' ',$value4["created_at"])[0]}}</td>
                      </tr>
                  @endif
                @endforeach
              @endforeach
            </tbody>
          @endif
        @endforeach
      </table>
    </div>
    @endforeach
    @else
    @foreach ($finalResponse as $key => $value)
    @if($productId == $value["project_id"])
    <div id="export-table">
      <div class="table-responsive wrapping-div">
        <table class=" table table-condensed table-bordered"  id="hidden_table">
          <thead class="thead-default">
            <tr>
                <td  colspan="2" style="border:1px solid;text-align:center;padding: 0px"><h4>Product Id : </h4></td>
                <td  colspan="2" style="border:1px solid;text-align:center;padding: 0px"><h4>{{$value["project_id"]}}</h4></td>
                <td  colspan="7" style="border:1px solid;text-align:center;padding: 0px"><h4>EITDS v2.0</h4></td>
                <td  colspan="2" style="border:1px solid;text-align:center;padding: 0px"><h4>Report Date : </h4></td>
                <td  colspan="2" style="border:1px solid;text-align:center;padding: 0px"><h4>{{$now}}</h4></td>
            </tr>
            <tr>
                <td  colspan="15" style="border:1px solid;text-align:center;padding: 0px"><h4>FUNCTIONAL TESTS</h4></td>
            </tr>
            <tr>
                <th rowspan="2" style="border:1px solid;text-align: center;vertical-align: middle;padding: 0px">Test Case</th>
                <th rowspan="2" style="border:1px solid;text-align: center;vertical-align: middle;padding: 0px">Test Condition</th>
                <th rowspan="2" style="border:1px solid;text-align: center;vertical-align: middle;padding: 0px">Mode</th>
                <th rowspan="2" style="border:1px solid;text-align: center;vertical-align: middle;padding: 0px">Time (ms)</th>
                <th rowspan="2" style="border:1px solid;text-align: center;vertical-align: middle;padding: 0px">Voltage (V)</th>
                <th colspan="10" style="border:1px solid;text-align: center;vertical-align: middle;padding: 0px">Actual Output / Expected Output</th>
            </tr>
            <tr>
                <th style="border:1px solid;text-align: center;vertical-align: middle;padding: 0px">TP3_T</th>
                <th style="border:1px solid;text-align: center;vertical-align: middle;padding: 0px">TP4_T</th>
                <th style="border:1px solid;text-align: center;vertical-align: middle;padding: 0px">TP1_V</th>
                <th style="border:1px solid;text-align: center;vertical-align: middle;padding: 0px">TP3_V</th>
                <th style="border:1px solid;text-align: center;vertical-align: middle;padding: 0px">No. of Pulses</th>
                <th style="border:1px solid;text-align: center;vertical-align: middle;padding: 0px">TP4_Width</th>
                <th style="border:1px solid;text-align: center;vertical-align: middle;padding: 0px">TP4_Gap</th>
                <th style="border:1px solid;text-align: center;vertical-align: middle;padding: 0px">TP4_V</th>
                <th style="border:1px solid;text-align: center;vertical-align: middle;padding: 0px">TP7_V</th>
                <th style="border:1px solid;text-align: center;vertical-align: middle;padding: 0px">TP7_V2</th>
            </tr>
          </thead>
            <tbody class="level1" >
          @foreach ($value["test_cases"] as $key2 => $value2)
            @if($value2['ActualLength'] > 0)


                @foreach ($value2["Mode_data"] as $key3 => $value3)
                    <tr style="border:1px solid">
                        @if($key3 == 0)
                        <td style="border:1px solid;padding: 0px;text-align: center;vertical-align: middle;" rowspan="{{($value2['mode_length'] )}}"> TC#{{$value2['Test Case']}}</td>
                        <td style="border:1px solid;padding: 0px;text-align: center;vertical-align: middle;" rowspan="{{($value2['mode_length'])}}">{{$value2['Test Condition']}}</td>
                        @endif
                        @if(count($value2["Mode_data"]) > 0))
                        <td style="border:1px solid;text-align: center;vertical-align: middle;    padding: 0px">{{$value3['mode_name']}}</td>
                        <td style="border:1px solid;text-align: center;vertical-align: middle;    padding: 0px">{{$value3['Time (ms)']}}</td>
                        <td style="border:1px solid;text-align: center;vertical-align: middle;    padding: 0px">{{$value3['Voltage (V)']}}</td>

                        <td style="border:1px solid;text-align: center;vertical-align: middle;    padding: 0px"> {{$value3['test_point_3_time']}}/<b>{{(isset($value3['Expected']['test_point_3_time']) ? $value3['Expected']['test_point_3_time'] : 0)}}</b></td>
                        <td style="border:1px solid;text-align: center;vertical-align: middle;    padding: 0px"> {{$value3['test_point_4_time']}}/<b>{{(isset($value3['Expected']['test_point_4_time']) ? $value3['Expected']['test_point_4_time'] : 0)}}</b></td>
                        <td style="border:1px solid;text-align: center;vertical-align: middle;    padding: 0px"> {{$value3['test_point_1_voltage']}}/<b>{{(isset($value3['Expected']['test_point_1_voltage']) ? $value3['Expected']['test_point_1_voltage'] : 0)}}</b></td>
                        <td style="border:1px solid;text-align: center;vertical-align: middle;    padding: 0px"> {{$value3['test_point_3_voltage']}}/<b>{{(isset($value3['Expected']['test_point_3_voltage']) ? $value3['Expected']['test_point_3_voltage'] : 0)}}</b></td>
                        <td style="border:1px solid;text-align: center;vertical-align: middle;    padding: 0px"> {{$value3['number_of_pulse']}}/<b>{{(isset($value3['Expected']['number_of_pulse']) ? $value3['Expected']['number_of_pulse'] : 0)}}</b></td>
                        <td style="border:1px solid;text-align: center;vertical-align: middle;    padding: 0px"> {{$value3['test_point_4_pulse_high']}}/<b>{{(isset($value3['Expected']['test_point_4_pulse_high']) ? $value3['Expected']['test_point_4_pulse_high'] : 0)}}</b></td>
                        <td style="border:1px solid;text-align: center;vertical-align: middle;    padding: 0px"> {{$value3['test_point_4_pulse_low']}}/<b>{{(isset($value3['Expected']['test_point_4_pulse_low']) ? $value3['Expected']['test_point_4_pulse_low'] : 0)}}</b></td>
                        <td style="border:1px solid;text-align: center;vertical-align: middle;    padding: 0px"> {{$value3['test_point_4_voltage']}}/<b>{{(isset($value3['Expected']['test_point_4_voltage']) ? $value3['Expected']['test_point_4_voltage'] : 0)}}</b></td>
                        <td style="border:1px solid;text-align: center;vertical-align: middle;    padding: 0px"> {{$value3['test_point_7_V']}}/<b>{{(isset($value3['Expected']['test_point_7_V']) ? $value3['Expected']['test_point_7_V'] : 0)}}</b></td>
                        <td style="border:1px solid;text-align: center;vertical-align: middle;    padding: 0px"> {{$value3['test_point_7_V2']}}/<b>{{(isset($value3['Expected']['test_point_7_V2']) ? $value3['Expected']['test_point_7_V2'] : 0)}}</b></td>
                        @endif

                    </tr>
                    @endforeach


          @endif
        @endforeach
        <tr style="border:1px solid">
          <td style="border:1px solid" colspan="15"></td>
        </tr>
        <tr style="border:1px solid">
          <td style="border:1px solid;text-align: center;vertical-align: middle;" colspan="4">Tested By</td>
          <td style="border:1px solid;text-align: center;vertical-align: middle;" colspan="4">Verified By</td>
          <td  style="border:1px solid;text-align: center;vertical-align: middle;" colspan="4">Approved By</td>

<td rowspan="4" style="border:1px solid;text-align: center;vertical-align: middle;" colspan="3"> <div style="color:#adacac">Company Seal</div>   </td>
        </tr>
        <tr  rowspan="2" style="border:1px solid" height="25px">
          <td style="border:1px solid;text-align: center;vertical-align: middle;" colspan="4"> <div style="color:#adacac">(Signature)</div> </td>
          <td style="border:1px solid;text-align: center;vertical-align: middle;"  colspan="4"> <div style="color:#adacac">(Signature)</div>  </td>
          <td style="border:1px solid;text-align: center;vertical-align: middle;"  colspan="4"> <div style="color:#adacac">(Signature)</div>  </td>

        </tr>
        <tr style="border:1px solid">
          <td style="border:1px solid;text-align: center;vertical-align: middle;" colspan="4"><div style="color:#adacac">(Name)</div> </td>
          <td style="border:1px solid;text-align: center;vertical-align: middle;" colspan="4"><div style="color:#adacac">(Name)</div> </td>
          <td style="border:1px solid;text-align: center;vertical-align: middle;" colspan="4"><div style="color:#adacac">(Name)</div> </td>
        </tr>
        <tr style="border:1px solid">
          <td style="border:1px solid;text-align: center;vertical-align: middle;" colspan="4"><div style="color:#adacac">(Designation)</div> </td>
          <td style="border:1px solid;text-align: center;vertical-align: middle;" colspan="4"><div style="color:#adacac">(Designation)</div> </td>
          <td style="border:1px solid;text-align: center;vertical-align: middle;" colspan="4"><div style="color:#adacac">(Designation)</div> </td>
        </tr>

  </tbody>
      </table>
    </div>
    @endif
    @endforeach
    @endif
  </div>
</div>
