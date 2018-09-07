
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

<?php
$data = json_encode($finalResponse);
$data = json_decode($data);

?>
{{$data->original->finalResponse}}
