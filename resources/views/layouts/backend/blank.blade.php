<!DOCTYPE html>
<html>

@section('htmlheader')
    @include('layouts.partials.header')
@show

<body class="page-container-bg-solid">

    <div class="page-wrapper">

      

		<div class="page-wrapper-row full-height">

            <div class="page-wrapper-middle">

            	@yield('main-content')

            </div><!-- end page-wrapper-middle -->

        </div><!-- end page-wrapper-row full-height -->

		<div class="page-wrapper-row">

            <div class="page-wrapper-bottom">

                @include('layouts.partials.footer')

            </div><!-- end page-wrapper-bottom -->

        </div><!-- end page-wrapper-row -->

	</div><!-- end page-wrapper -->

	@section('scripts')

        @include('layouts.partials.scripts')

    @show

    <!-- <script>
        $(document).ready(function()
        {
            $('#clickmewow').click(function() {

                $('#radio1003').attr('checked', 'checked');
            });
        })
    </script> -->

    @yield('custom-js')


</body>
</html>
