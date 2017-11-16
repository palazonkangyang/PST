@extends('admin.layouts.app')

@section('main-content')

	<div class="page-container">

        <div class="page-content-wrapper">

            <div class="page-head">

                <div class="container">

                	<div class="page-title">

                        <h1>转让</h1>

                    </div><!-- end page-title -->

                </div><!-- end container -->

            </div><!-- end page-head -->

            <div class="page-content">

                <div class="container">

                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>转让</span>
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

                        <div class="row">

                            <div class="col-md-12">

                                <div class="portlet light">

                                    <div class="portlet-title">

                                        <div class="caption font-red-sunglo">
                                            <i class="icon-settings font-red-sunglo"></i>
                                            <span class="caption-subject bold uppercase"> 转让</span>
                                        </div><!-- end caption font-red-sunglo -->

                                    </div><!-- end portlet-title -->


                                    <div class="portlet-body form">

                                        <form method="post" action="{{ URL::to('/admin/change-lingwei') }}">
                                            {!! csrf_field() !!}

																						<div class="form-body">
																							<div class="form-group">
																									<input type="hidden" class="form-control" name="lingweislot_id"
																											value="{{ $lingwei->lingweislot_id }}">

																							</div><!-- end form-group -->
																							<div class="form-group">
																									<input type="hidden" class="form-control" id="devotee_from_id" name="devotee_from_id"
																										value="{{ $lingwei->devotee_id }}"	>
																							</div><!-- end form-group -->

																							<div class="form-group">
																									<input type="hidden" class="form-control" id="devotee_to_id" name="devotee_to_id"
																										value=""	>

																							</div>

																						</div><!-- end form-group -->
																								<div class="form-group">
																										<label>BLK - LEVEL - NO</label>

																										<div class="input-group">
																												<span class="input-group-addon">
																														<i class="fa fa-word"></i>
																												</span>

																												<input type="text" readonly class="form-control" placeholder="Name" name="ls_blk"
																												value="{{  $lingwei-> ls_blk.'-'.$lingwei-> ls_level.'-'.$lingwei-> ls_number }}">
																										</div><!-- end input-group -->

																								</div><!-- end form-group -->



																								<div class="form-group">
																										<label>Price</label>

																										<div class="input-group">
																												<span class="input-group-addon">
																														<i class="fa fa-money"></i>
																												</span>

																												<input type="text" readonly class="form-control" placeholder="Price" name="price"
																													value="${{ $lingwei->price }}">
																										</div><!-- end input-group -->

																								</div><!-- end form-group -->

																								<div class="form-group">
																										<label>Select Price</label>

																										<div class="input-group">
																												<span class="input-group-addon">
																														<i class="fa fa-money"></i>
																												</span>

																												<input type="text" readonly class="form-control" placeholder="Price" name="select_price"
																													value="${{ $lingwei->select_price }}">
																										</div><!-- end input-group -->

																								</div><!-- end form-group -->

																								<div class="form-group">
																										<label>NRIC</label>

																										<div class="input-group">
																												<span class="input-group-addon">
																														<i class="fa fa-word"></i>
																												</span>

																												<input type="text"  class="form-control" id="nric_autocomplete" name="nric"
																												value="{{  $lingwei-> nric }}">
																										</div><!-- end input-group -->

																								</div><!-- end form-group -->

																								<div class="form-group">
																										<label>Chinese Name</label>

																										<div class="input-group">
																												<span class="input-group-addon">
																														<i class="fa fa-word"></i>
																												</span>

																												<input type="text" readonly  class="form-control" id="chinese_name"  name="chinese_name"
																												value="{{  $lingwei-> chinese_name }}">
																										</div><!-- end input-group -->

																								</div><!-- end form-group -->

																								<div class="form-group">
																										<label>Contact</label>

																										<div class="input-group">
																												<span class="input-group-addon">
																														<i class="fa fa-word"></i>
																												</span>

																												<input type="text" readonly  class="form-control" id="contact"  name="contact"
																												value="{{  $lingwei-> contact }}">
																										</div><!-- end input-group -->

																								</div><!-- end form-group -->




                                            <div class="form-actions">
                                                <button type="submit" class="btn blue">Update</button>
                                                <button type="button" class="btn default">Cancel</button>
                                            </div><!-- end form-actions -->

                                        </form>

                                    </div><!-- end portlet-body form -->

                                </div><!-- end portlet light -->



                            </div><!-- end col-md-6 -->

                        </div><!-- end row -->

                    </div><!-- end page-content-inner -->

                </div><!-- end container -->

            </div><!-- end page-content -->

        </div><!-- end page-content-wrapper -->

    </div><!-- end page-container -->

@stop

@section('script-js')

<script src="{{asset('js/custom/common.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">

$("#nric_autocomplete").autocomplete({
	source: "/operator/search/devotee_nric",
	minLength: 1,
	select: function(event, ui) {
		$('#nric_autocomplete').val(ui.item.value);
	}
});

$("#nric_autocomplete").on('focusout', function() {
    var nric = $(this).val();

    var formData = {
        _token: $('meta[name="csrf-token"]').attr('content'),
        nric: nric
    };

    $.ajax({
        type: 'GET',
        url: "/operator/search/devotee_info",
        data: formData,
        dataType: 'json',
        success: function(response)
        {

          $("#chinese_name").val(response.devotee_info[0].chinese_name);
          $("#contact").val(response.devotee_info[0].contact);
						document.getElementById("devotee_to_id").value = response.devotee_info[0].devotee_id;
        },

        error: function (response) {
            console.log(response);
        }
    });
  });



</script>

@stop
