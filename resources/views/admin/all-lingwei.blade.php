@extends('admin.layouts.app')

@section('main-content')

	<div class="page-container">

        <div class="page-content-wrapper">

            <div class="page-head">

                <div class="container">

                	<div class="page-title">
                        <h1>灵位</h1>

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
                            <span>灵位</span>
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
                                                <span class="caption-subject font-dark bold uppercase">All 灵位</span>
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
																												<th>Type</th>
																												<th>Price</th>
																												<th>Select Price</th>
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
																									@foreach($lingweis as $lingwei)

																									<tr>


																										<td>{{ $lingwei-> ls_blk }}</td>
																										<td>{{ $lingwei-> ls_level }}</td>
																										<td>{{ $lingwei-> ls_number }}</td>

																										<td>
																										@if($lingwei-> type == '0' )
																										个别式
																										@elseif($lingwei-> type == '1' )
																										豪华式
																										@elseif($lingwei-> type == '2' )
																									家庭式
																									@endif
																											</select>
																									 </td>
																										<td>S$ {{ $lingwei-> price }}</td>
																												<td>S$ {{ $lingwei-> select_price }}</td>
																												<td> {{ $lingwei-> chinese_name }}</td>
																												<td> {{ $lingwei-> nric }}</td>
																												<td> {{ $lingwei-> contact }}</td>
																												<td>
																													@if( $lingwei-> chinese_name )
																													<a href="{{ URL::to('/admin/lingwei/edit/' . $lingwei->id) }}" class="btn btn-outline btn-circle btn-sm purple">
		                                                				<i class="fa fa-edit"></i> 转让
		                                                			</a>

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
