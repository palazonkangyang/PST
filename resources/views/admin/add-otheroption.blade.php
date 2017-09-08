@extends('admin.layouts.app')

@section('main-content')

	<div class="page-container">

        <div class="page-content-wrapper">

            <div class="page-head">

                <div class="container">

                	<div class="page-title">

                        <h1>Other Option</h1>

                    </div><!-- end page-title -->

                </div><!-- end container -->

            </div><!-- end page-head -->

            <div class="page-content">

                <div class="container">

                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="/admin/dashboard">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>Add New Other Option</span>
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
                                            <span class="caption-subject bold uppercase"> Add New Other Option</span>
                                        </div><!-- end caption font-red-sunglo -->

                                    </div><!-- end portlet-title -->


                                    <div class="portlet-body form">

                                        <form role="form" method="post" action="{{ URL::to('/admin/add-otheroption') }}">
                                            {!! csrf_field() !!}

                                            <div class="form-body">

                                                <div class="form-group">
                                                    <label>Name</label>

                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-word"></i>
                                                        </span>

                                                        <input type="text" class="form-control" placeholder="Name" name="name">
                                                    </div><!-- end input-group -->

                                                </div><!-- end form-group -->

                                                <div class="form-group">
                                                    <label>Description</label>

                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-word"></i>
                                                        </span>

                                                        <input type="text" class="form-control" placeholder="Description" name="description">
                                                    </div><!-- end input-group -->

                                                </div><!-- end form-group -->

                                                <div class="form-group">
                                                    <label>Price</label>

                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-money"></i>
                                                        </span>

                                                        <input type="text" class="form-control" placeholder="Price" name="price">
                                                    </div><!-- end input-group -->

                                                </div><!-- end form-group -->





                                                </div><!-- end form-group -->

                                            </div><!-- end form-body -->

                                            <div class="form-actions">
                                                <button type="submit" class="btn blue">Create</button>
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
