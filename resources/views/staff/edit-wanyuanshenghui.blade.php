@extends('layouts.backend.app')

@section('main-content')

	<div class="page-container">

        <div class="page-content-wrapper">

            <div class="page-head">

                <div class="container">

                	<div class="page-title">

                        <h1>万缘胜会</h1>

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
                            <span>Edit 万缘胜会</span>
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
                                            <span class="caption-subject bold uppercase"> Edit 万缘胜会</span>
                                        </div><!-- end caption font-red-sunglo -->

                                    </div><!-- end portlet-title -->


                                    <div class="portlet-body form">

                                        <form method="post" action="{{ URL::to('/staff/change-wanyuanshenghui') }}">
                                            {!! csrf_field() !!}

                                            <div class="form-body">

                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="id"
                                                        value="{{ $wanyuanshenghui->id }}">

                                                </div><!-- end form-group -->
																								<div class="form-group">
																										<label>Type</label>:

																										<label>  @if($wanyuanshenghui->type =='0')
                                                  			甲
                                                        @elseif($wanyuanshenghui->type =='1')
                                                        乙
                                                        @elseif($wanyuanshenghui->type =='2')
                                                        丙
                                                        @elseif($wanyuanshenghui->type =='3')
                                                        丁
                                                       @endif</label>

																								</div><!-- end form-group -->
																								<div class="form-group">
																										<label>Block No</label>:

																										<label>{{ $wanyuanshenghui-> block_no }}</label>

																								</div><!-- end form-group -->
                                                <div class="form-group">
                                                    <label>Word Print</label>:

                                                    <textarea  class="form-control" rows=3 name="word_print"
                                                        >{!! $wanyuanshenghui->word_print !!}</textarea>

                                                </div><!-- end form-group -->








                                            </div><!-- end form-body -->

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
