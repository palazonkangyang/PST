@extends('admin.layouts.app')

@section('main-content')

	<div class="page-container">

        <div class="page-content-wrapper">

            <div class="page-head">

                <div class="container">

                	<div class="page-title">
                        <h1>Setting 碑 列表</h1>

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
                            <span>Setting 碑 列表</span>
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
                                                <span class="caption-subject font-dark bold uppercase">Setting 碑 列表</span>
                                            </div><!-- end caption -->
                                        </div><!-- end portlet-title -->

                                        <div class="portlet-body">

                                            <table class="table table-bordered" id="all-otheroptions-table">
                                                <thead>
																									<tr id="filter">
																										    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
																										<th></th>
																									</tr>
                                                  <tr>
																											<th>Id</th>
																										<th>Type</th>
                                                    <th>Price</th>
                                                    <th>Slot</th>
                                                    <th>Actions</th>
                                                  </tr>
                                                </thead>

                                                <tbody>
                                                	@foreach($setting_beis as $setting_bei)

                                                	<tr>
																										<td>{{ $setting_bei-> id }}</td>
                                                		<td>
																										@if ($setting_bei-> type == 0)
																											四方埕

																										@elseif($setting_bei-> type == 1)
																											黄埕

																										@elseif($setting_bei-> type == 2)
																											云石埕（圆）

																										@elseif($setting_bei-> type == 3)
																											云石埕（方）
																										@elseif($setting_bei-> type == 4)
																											只做相片
																										@elseif($setting_bei-> type == 5)
																											碑
																										@elseif($setting_bei-> type == 6)
																											花岗石
																										@elseif($setting_bei-> type == 7)
																											新进位
																										@elseif($setting_bei-> type == 8)
																											青玉埕

																										@endif
																									</td>

                                                		<td>{{ $setting_bei-> price }}</td>
                                                		<td>{{ $setting_bei-> slot }}</td>
                                                		<td>
                                                			<a href="{{ URL::to('/admin/setting-bei/add/' . $setting_bei->id) }}" class="btn btn-outline btn-circle btn-sm purple">
                                                				<i class="fa fa-edit"></i> Update
                                                			</a>

                                                			
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
			var table = $('#all-otheroptions-table').DataTable({
				"lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]],
				"order": [[ 0, "asc" ]]
			});

			$('#all-otheroptions-table thead tr#filter th').each( function () {
						var title = $('#all-accounts-table thead th').eq( $(this).index() ).text();
						$(this).html( '<input type="text" class="form-control" onclick="stopPropagation(event);" placeholder="" />' );
			});

			// Apply the filter
			$("#all-otheroptions-table thead input").on( 'keyup change', function () {
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

			$("#all-otheroptions-table").on('click', '.delete-otheroption', function() {
        if (!confirm("Do you confirm you want to delete this record? Note that this process is irreversable.")){
          return false;
        }
      });

			$("#filter input[type=text]:last").css("display", "none");
		});
	</script>

@stop
