<!DOCTYPE html>
<html>

@section('htmlheader')
    @include('admin.layouts.partials.head')
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
                    
                @include('admin.layouts.partials.footer')
                    
            </div><!-- end page-wrapper-bottom -->

        </div><!-- end page-wrapper-row -->

	</div><!-- end page-wrapper -->

	@section('scripts')
    
        @include('admin.layouts.partials.scripts')

    @show

    <script>
        $(document).ready(function()
        {
            $('#clickmewow').click(function() {
                
                $('#radio1003').attr('checked', 'checked');
            });
        })
    </script>

	
</body>
</html>