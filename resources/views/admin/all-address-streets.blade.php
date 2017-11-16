@extends('admin.layouts.app')

@section('main-content')

  <div class="page-container">

    <div class="page-content-wrapper">

      <div class="page-head">

        <div class="container-fluid">

          <div class="page-title">
            <h1>All Address Street</h1>
          </div><!-- end page-title -->

        </div><!-- end container-fluid -->

      </div><!-- end page-head -->

      <div class="page-content">

        <div class="container-fluid">

          <ul class="page-breadcrumb breadcrumb">
            <li>
              <a href="/admin/dashboard">Home</a>
              <i class="fa fa-circle"></i>
            </li>
            <li>
              <span>All Address Street</span>
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
                          <span class="caption-subject bold uppercase"> Add New Address</span>
                      </div><!-- end caption font-red-sunglo -->

                  </div><!-- end portlet-title -->

                  <div class="portlet-body form">

                    <div class="form-group">
                      <a href="/admin/add-address" class="btn blue" style="margin: 0 25px 20px 10px;">Add New Address
                      </a>
                    </div><!-- end form-group -->

                    <div class="col-md-12" style="margin-bottom: 40px;">

                      <form action="{{ URL::to('/admin/search-address') }}" method="post">
                        {!! csrf_field() !!}

                        <div class="col-md-6">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label style="padding:0;">Chinese</label>
                              <input type="text" class="form-control" name="chinese" value="{{ old('chinese') }}" id="chinese">
                            </div><!-- end form-group -->
                          </div><!-- end col-md-6 -->

                          <div class="col-md-6">
                            <div class="form-group">
                              <label style="padding:0;">English</label>
                              <input type="text" class="form-control" name="english" value="{{ old('english') }}" id="english">
                            </div><!-- end form-group -->
                          </div><!-- end col-md-6 -->

                          <div class="col-md-6">
                            <div class="form-group">
                              <label style="padding:0;">Address Houseno</label>
                              <input type="text" class="form-control" name="address_houseno" value="{{ old('address_houseno') }}" id="address_houseno">
                            </div><!-- end form-group -->
                          </div><!-- end col-md-6 -->

                          <div class="col-md-6">
                            <div class="form-group">
                              <label style="padding:0;">Address Postal</label>
                              <input type="text" class="form-control" name="address_postal" value="{{ old('address_postal') }}" id="address_postal">
                            </div><!-- end form-group -->
                          </div><!-- end col-md-6 -->

                          <div class="col-md-6">
                            <div class="form-group">
                              <button type="submit" class="btn blue" id="report">Search</button>
                              <button type="button" class="btn default" onClick="window.location.reload('true')">Clear</button>
                            </div><!-- end form-group -->
                          </div><!-- end col-md-6 -->
                        </div><!-- end col-md-6 -->

                        <div class="col-md-6">

                        </div><!-- end col-md-6 -->
                      </form>
                    </div><!-- end col-md-12 -->

                    <div class="clearfix">

                    </div>

                  </div><!-- end portlet-body form -->

                </div><!-- end porlet light -->

              </div><!-- end col-md-12 -->

            </div><!-- end row -->

          </div><!-- end page-content-inner -->

        </div><!-- end container-fluid -->

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
      var table = $('#all-address-table').DataTable({
        "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]]
      });

      $('#all-address-table thead tr#filter th').each( function () {
        var title = $('#all-dialects-table thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" class="form-control" onclick="stopPropagation(event);" placeholder="" />' );
      });

      // Apply the filter
      $("#all-address-table thead input").on( 'keyup change', function () {
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

      $("#all-address-table").on('click', '.delete-address', function() {
        if (!confirm("Do you confirm you want to delete this record? Note that this process is irreversable.")){
          return false;
        }
      });

      $("#filter input[type=text]:last").css("display", "none");
    });


	</script>

@stop
