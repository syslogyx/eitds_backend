
<style>


.table {
    width: 100%;
}
table {
    border-collapse: collapse;
}


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
}
.wrapping-div {
        display: block;
        page-break-inside: avoid !important;
    }

.wrapping-div tbody, .wrapping-div tr, .wrapping-div td, .wrapping-div th {
        page-break-inside: avoid !important;
    }
    #table td{
            color: black;
            font-weight: 600;
            padding: 0px;
        }
        #table tr{
            font-size: 9px;
        }
        #table td{
            border: 1px solid black;
            text-align: center;

        }
</style>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<div>

  <table class="table " id="table">
                          <tbody>
                              @foreach ($json as $key => $value)
                              <tr>
                                @foreach ($value as $k1 => $v1)
                                  <td style="width:10px !important">
                                       {{@$v1['seriesName']}}{{@$v1['finalId'][0]}}{{@$v1['finalId'][1]}}<br>
                                       {{@$v1['finalId'][2]}}{{@$v1['finalId'][3]}}{{@$v1['finalId'][4]}}{{@$v1['finalId'][5]}}
                                  </td>
                                @endforeach
                              </tr>
                              @endforeach

                          </tbody>
                      </table>
</div>
