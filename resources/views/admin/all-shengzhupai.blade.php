@extends('admin.layouts.app')

@section('main-content')

	<div class="page-container">

        <div class="page-content-wrapper">

            <div class="page-head">

                <div class="container">

                	<div class="page-title">
                        <h1>神主牌</h1>

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
                            <span>神主牌</span>
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
                                                <span class="caption-subject font-dark bold uppercase">All 神主牌</span>
                                            </div><!-- end caption -->
                                        </div><!-- end portlet-title -->

																				<div class="portlet-body">

																						<table class="table table-bordered"  id="all-shengzhupais-table">
																								<thead>
																									<tr id="filter">


																												<th></th>
																												<th></th>
																												<th></th>
																												<th></th>
																												<th></th>
																												<th></th>
																													<th></th>
																														<th></th>
																															<th></th>
																																						</tr>
																										<tr>



																												<th>Blk</th>
																												<th>Level</th>
																												<th>Number</th>
																												<th>Price</th>
																												<th>Select Price</th>
																												<th>Type</th>
																														<th>Chinese name</th>
																															<th>NRIC</th>
																																<th>Contact</th>
																																	<th>Action</th>
																										</tr>
																								</thead>

																								@php

																									$count = 1;

																								@endphp

																								<tbody>
																									@foreach($shengzhupais as $shengzhupai)

																									<tr>


																										<td>{{ $shengzhupai-> ss_blk }}</td>
																										<td>{{ $shengzhupai-> ss_level }}</td>
																										<td>{{ $shengzhupai-> ss_number }}</td>
																										<td>S$ {{ $shengzhupai-> price }}</td>
																												<td>S$ {{ $shengzhupai-> select_price }}</td>
																												<td>
																												@if($shengzhupai-> type == '0' )
																												入主
																												@elseif($shengzhupai-> type == '1' )
																												全家
																											@endif
																													</select>
																											 </td>
																												<td> {{ $shengzhupai-> chinese_name }}</td>
																												<td> {{ $shengzhupai-> nric }}</td>
																												<td> {{ $shengzhupai-> contact }}</td>
																												<td>
																													@if( $shengzhupai-> chinese_name )
																												转让
																												@endif
																											</td>


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

                </div><!-- end container -->

            </div><!-- end page-content -->

        </div><!-- end page-content-wrapper -->

    </div><!-- end page-container -->

@stop

@section('script-js')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

	<script type="text/javascript">

		$(function() {
			// DataTable
			var table = $('#all-shengzhupais-table').DataTable({
				"lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]],
				"order": [[ 0, "desc" ]]
			});

			$('#all-shengzhupais-table thead tr#filter th').each( function () {
						var title = $('#all-shengzhupais-table thead th').eq( $(this).index() ).text();
						$(this).html( '<input type="text" class="form-control" onclick="stopPropagation(event);" placeholder="" />' );
			});

			// Apply the filter
			$("#all-shengzhupais-table thead input").on( 'keyup change', function () {
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



			//$("#filter input[type=text]:last").css("display", "none");
		});
	</script>

@stop
