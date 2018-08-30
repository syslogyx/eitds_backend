
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
    color: #2d90ca;
}
tr {
    display: table-row;
    vertical-align: inherit;
    border-color: inherit;
}
.table>thead>tr>th {
    vertical-align: bottom;
    border-bottom: 2px solid #ddd;
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
    border-top: 1px solid #ddd;
}
#id{
  height: 50px;
  width:50px;
}
</style>
<div>
          <table class="table table-condensed table-hover table-responsive">
              <thead class="thead-default">
                 @if($pdfSettingData !='')
                  <tr>
                      <!-- <th style="text-align: center;" colspan="2"><img id='logo' style="height: 50px;width:50px;" src="{{ public_path('img/'.@$pdfSettingData->logo) }}"> </th> -->
                      <th style="text-align: center;" colspan="13"><b>{{ @$pdfSettingData->header_heading }}</b></th>
                  </tr>
                @endif
                  <tr>
                      <!-- <th style="text-align: center;">User</th>
                      <th style="text-align: center;">Device</th> -->
                      <th style="text-align: center;">Product</th>
                      <th style="text-align: center;">Mode</th>
                      <th style="text-align: center;">Test Case</th>
                      <th style="text-align: center;">Test Point 3 V</th>
                      <th style="text-align: center;">Test Point 3 T</th>
                      <th style="text-align: center;">Test Point 4 V</th>
                      <th style="text-align: center;">Test Point 4 T</th>
                      <th style="text-align: center;">Test Point 4 P L</th>
                      <th style="text-align: center;">Test Point 4 P H</th>
                      <th style="text-align: center;">Status</th>
                      <th style="text-align: center;">Date</th>
                  </tr>
              </thead>
              <tbody>
                   @foreach($productList as $data)
                  <tr>

                      <!-- <td style="text-align: center;" >{{ $data->username }}</td>
                      <td style="text-align: center;" >{{ $data->device_id }}</td> -->
                      <td style="text-align: center;" >{{ $data->product_id }}</td>
                      <td style="text-align: center;" >{{ $data->mode }}</td>
                      <td style="text-align: center;" >{{ $data->test_case }}</td>
                      <td style="text-align: center;" >{{ $data->test_point_3_voltage }}</td>
                      <td style="text-align: center;" >{{ $data->test_point_3_time }}</td>
                      <td style="text-align: center;" >{{ $data->test_point_4_voltage }}</td>
                      <td style="text-align: center;" >{{ $data->test_point_4_time }}</td>
                      <td style="text-align: center;" >{{ $data->test_point_4_pulse_low }}</td>
                      <td style="text-align: center;" >{{ $data->test_point_4_pulse_high }}</td>
                      <td style="text-align: center;" >{{ $data->status }}</td>
                      <td style="text-align: center;" >{{ $data->date}}</td>
                      <!-- <td></td> -->
                  </tr>
                  @endforeach

              </tbody>
          </table>
          <div class="row col-sm-12" style="padding-right: 0px;">
          <ul id="pagination-sec1" class="pagination-sm" style="float: right;margin-top: 5px;margin-bottom: 45px"></ul>
      </div>
      </div>
