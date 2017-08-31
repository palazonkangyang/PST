@extends('layouts.backend.blank')

@section('main-content')



                    <div class="page-content-inner">

                        <div class="mt-bootstrap-tables">

                        	<div class="row">

                                <div class="col-md-12">

                                	<div class="portlet light">

                                        <div class="portlet-title">

                                            <div class="caption">
                                                <i class="icon-social-dribbble font-dark hide"></i>
                                                <span class="caption-subject font-dark bold uppercase">神主牌选位</span>
                                            </div><!-- end caption -->
                                        </div><!-- end portlet-title -->
                                        
                                        <div class="portlet-body">
                                            
                                            <table class="table table-bordered" id="shengzhupaislots-table">
                                                <thead>
                                                  <tr id="filter">
                                                                          <th></th>
                                                        <th>#</th>
                                                        <th>Blk</th>
                                                        <th>Level</th>
                                                        <th>Number</th>
                                                        <th>Price</th>
                                                        <th>Select Price</th>
                                                                            </tr>
                                                    <tr>

                                                    <th></th>
                                                    	<th>#</th>
                                                        <th>Blk</th>
                                                        <th>Level</th>
                                                        <th>Number</th>
                                                        <th>Price</th>
                                                        <th>Select Price</th>
                                                    </tr>
                                                </thead>

                                                @php

                                                	$count = 1;

                                               	@endphp

                                                <tbody>
                                                	@foreach($shengzhupaislots as $shengzhupaislot)

                                                	<tr>
                                                    <td>

                                                                              
                                                             <button type="button" class="btn btn-outline btn-circle btn-sm red" onClick="sendValue({{ $shengzhupaislot-> id }})">
                                                                <i class="fa fa-select"></i> Select
                                                            </button>

                                                            
                                                        </td>
                                                		<td>{{ $count++ }}</td>
                                                		<td>{{ $shengzhupaislot-> ss_blk }}</td>
                                                		<td>{{ $shengzhupaislot-> ss_level }}</td>
                                                		<td>{{ $shengzhupaislot-> ss_number }}</td>
                                                		<td>S$ {{ $shengzhupaislot-> price }}</td>
                                                        <td>S$ {{ $shengzhupaislot-> select_price }}</td>
                                                		
                                                	</tr>

                                                	@endforeach
                                                </tbody>

                                            </table>

                                        </div><!-- end portlet-body -->

                                    </div><!-- end portlet light -->

                                </div><!-- end col-md-12 -->

                            </div><!-- end row -->

                        </div><!-- end mt-bootstrap-tables -->

                    </div><!-- end page-content-inner -->

              

@stop

@section('custom-js')

    <script src="{{asset('js/custom/common.js')}}"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript">

    // DataTable
                    var table = $('#shengzhupaislots-table').DataTable({
                        "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]]
                    });

          $('#shengzhupaislots-table thead tr#filter th').each( function () {
                var title = $('#shengzhupaislots-table thead th').eq( $(this).index() ).text();
                $(this).html( '<input type="text" class="form-control" onclick="stopPropagation(event);" placeholder="" />' );
          });

                    // Apply the filter
                    $("#shengzhupaislots-table thead input").on( 'keyup change', function () {
                            table
                                    .column( $(this).parent().index()+':visible' )
                                    .search( this.value )
                                    .draw();
                    });

                    function stopPropagation(evt) {
            if (evt.stopPropagation !== undefined) {
              evt.stopPropagation();
            } else {
              evt.cancelBubble = true;
            }
          }




function sendValue(value)
{
var parentId = 'slotreturn';
window.opener.updateValue(parentId, value);
window.close();
}


</script>

@stop