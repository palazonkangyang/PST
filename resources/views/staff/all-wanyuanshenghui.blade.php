@extends('layouts.backend.app')

@section('main-content')

	<div class="page-container">

        <div class="page-content-wrapper">

            <div class="page-head">

                <div class="container">

                	<div class="page-title">
                        <h1>All 万缘胜会</h1>

                    </div><!-- end page-title -->

                </div><!-- end container -->

            </div><!-- end page-head -->

            <div class="page-content">

                <div class="container">

                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="/operator/index">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>All 万缘胜会</span>
                        </li>
                    </ul>

										@if($errors->any())

												<div class="alert alert-danger">

														@foreach($errors->all() as $error)
																<p>{{ $error }}</p>
														@endforeach

												</div>

										@endif

										@if(Session::has('success'))
												<div class="alert alert-success"><em> {{ Session::get('success') }}</em></div>
										@endif

										 @if(Session::has('error'))
												<div class="alert alert-danger"><em> {{ Session::get('error') }}</em></div>
										@endif

                    <div class="page-content-inner">

                        <div class="mt-bootstrap-tables">

                        	<div class="row">

                                <div class="col-md-12">

                                	<div class="portlet light">

                                        <div class="portlet-title">

                                            <div class="caption">
                                                <i class="icon-social-dribbble font-dark hide"></i>
                                                <span class="caption-subject font-dark bold uppercase">All 万缘胜会</span>
                                            </div><!-- end caption -->
                                        </div><!-- end portlet-title -->

                                        <div class="portlet-body">
                                          <form role="form" method="post" target="_blank" action="{{ URL::to('/staff/verticalprint-wanyuanshenghui') }}">
                                            {!! csrf_field() !!}

                                          <table border="0" cellspacing="5" cellpadding="5">
        <tbody><tr>
            <td>Minimum number:</td>
            <td><input type="text"   class="form-control input-sm" id="min" name="min"></td>
        </tr>
        <tr>
            <td>Maximum number:</td>
            <td><input type="text"   class="form-control input-sm" id="max" name="max"></td>
        </tr>
				<tr>
						<td>Type:</td>
						<td>	<select class="form-control  input-sm" id="type" name="type">
									<option value="甲">甲</option>
									<option value="乙">乙</option>
									<option value="丙">丙</option>
									<option value="丁">丁</option>
							</select></td>

				</tr>
    </tbody></table><table id="wanyuanshenghui-table"  class="table table-bordered display" cellspacing="0" width="100%">
        <thead>
            <tr>
              <th> <input type="checkbox" id="selectall"> </th>
              <th>Year Report</th>
              <th>Type</th>
              <th>Block No</th>

              <th>Word Print</th>
              <th>Actions</th>
            </tr>
        </thead>

                                                <tbody>
                                                	@foreach($wanyuanshenghuis as $wanyuanshenghui)

                                                	<tr>
                                                    <td>
                  <input type="checkbox" class="select_wanyuanshenghui" name="wanyuanshenghuis[]" value="{!! $wanyuanshenghui->id !!}">
                </td>
                                                		<td>{{ $wanyuanshenghui-> year_report  }}</td>
                                                		<td>
                                                      @if($wanyuanshenghui->type =='0')
                                                  			甲
                                                        @elseif($wanyuanshenghui->type =='1')
                                                        乙
                                                        @elseif($wanyuanshenghui->type =='2')
                                                        丙
                                                        @elseif($wanyuanshenghui->type =='3')
                                                        丁
                                                       @endif
                                                  		</td>
                                                    <td>{{ $wanyuanshenghui-> block_no }}</td>

                                                		<td><span>{!! nl2br($wanyuanshenghui-> word_print)  !!} </span></td>
                                                		<td>
                                                			<a target="_blank" href="{{ URL::to('/staff/wanyuanshenghui/edit/' . $wanyuanshenghui->id) }}" class="btn btn-outline btn-circle btn-sm purple">
                                                				<i class="fa fa-edit"></i> Edit
                                                			</a>

                                                		</td>
                                                	</tr>

                                                	@endforeach
                                                </tbody>

                                            </table>
                                            <button name="print" type="submit" class="btn btn-primary">万缘胜会 Print Vertical</button>
                                          </form>
                                        </div><!-- end portlet-body -->

                                    </div><!-- end portlet light -->

                                </div><!-- end col-md-12 -->

                            </div><!-- end row -->

                        </div><!-- end mt-bootstrap-tables -->

                    </div><!-- end page-content-inner -->

                </div><!-- end container -->

            </div><!-- end page-content -->

        </div><!-- end page-content-wrapper -->

    </div><!-- end page-container -->

@stop

@section('custom-js')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">

/* Custom filtering function which will search data in column four between two values */
$.fn.dataTable.ext.search.push(
  function( settings, data, dataIndex ) {
      var min = parseInt( $('#min').val(), 10 );
      var max = parseInt( $('#max').val(), 10 );
			  var typeinput =  $('#type').val();
      var block_no = parseFloat( data[3] ) || 0; // use data for the age column
			var type = data[2]; // use data for the age column

      if ( ( isNaN( min ) && isNaN( max ) && type == typeinput) ||
           ( isNaN( min ) && block_no <= max  && type == typeinput) ||
           ( min <= block_no   && isNaN( max  && type == typeinput) ) ||
           ( min <= block_no   && block_no <= max  && type == typeinput) )
      {
          return true;
      }
      return false;
  }
);
$('#selectall').change( function(){
  $('.select_wanyuanshenghui').prop( 'checked', $(this).prop('checked') );
});

$(document).ready(function() {
  var table = $('#wanyuanshenghui-table').DataTable({
    "bFilter": true,
    "iDisplayLength": 100,
    "bSort" : false
  });

  // Event listener to the two range filtering inputs to redraw on input
  $('#min, #max').keyup( function() {
      table.draw();
  } );

	  $('#type').change(function() {
		  table.draw();
		} );
} );
</script>

@stop
