@extends('layouts.backend.app')

@section('main-content')

    <div class="page-container-fluid">

        <div class="page-content-wrapper">

            <div class="page-head">

                <div class="container-fluid">

                    <div class="page-title">

                        <h1>万缘胜会</h1>

                    </div><!-- end page-title -->

                </div><!-- end container-fluid -->

            </div><!-- end page-head -->

            <div class="page-content">

                <div class="container-fluid">

                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="/operator/index">Home</a>
                            <i class="fa fa-circle"></i>

                        </li>
                        <li>
                            <span>万缘胜会</span>
                        </li>
                    </ul>

                    <div class="page-content-inner">

                        <div class="inbox">

                             <div class="row">

                                @include('layouts.partials.focus-devotee-sidebar')

                                <div class="col-md-9">

                                    <div class="form-horizontal form-row-seperated">

                                        <div class="portlet">

                                <div class="validation-error">
                                </div><!-- end validation-error -->

                                            @if($errors->any())

                                <div class="alert alert-danger">

                                    @foreach($errors->all() as $error)
                                      <p>{{ $error }}</p>
                                    @endforeach

                                                                </div><!-- end alert -->

                                            @endif

                                            @if(Session::has('success'))
                                                <div class="alert alert-success"><em> {{ Session::get('success') }}</em></div>
                                            @endif

                                            @if(Session::has('error'))
                                                <div class="alert alert-danger"><em> {{ Session::get('error') }}</em></div>
                                            @endif

                                            <div class="portlet-body">

                                                <div class="tabbable-bordered">



                                                    <div class="tab-content">

                                                        <div class="tab-pane active" id="tab_xiangyou">

                                                            <div class="form-body">

                                                                <form method="post" action="{{ URL::to('/staff/wanyuanshenghui') }}"
                                                                    class="form-horizontal form-bordered" id="donationform">

                                                                    {!! csrf_field() !!}

                                                                <div class="form-group">

                                                                    <h4> 同址善信 主家</h4>

                                                                    <table class="table table-bordered" id="generaldonation_table">
                                                                        <thead>
                                                                            <tr>
                                                                            <th></th>
                                                                             <th>Title</th>
                                                                                <th>Chinese Name</th>
                                                                                 <th>English Name</th>
                                                                                    <th>NRIC</th>
                                                                                  <th>Contact</th>
                                                                                  <th>Dob</th>
                                                                                <th>Devotee#</th>
                                                                                <th>Block</th>
                                                                                <th>Address</th>
                                                                                <th>Unit</th>

                                                                            </tr>
                                                                        </thead>

                                                                        @if(Session::has('devotee_lists'))

                                                                            @php

                                                                                $devotee_lists = Session::get('devotee_lists');
                                                                                $focus_devotee = Session::get('focus_devotee');

                                                                            @endphp

                                                                        <tbody id="has_session">

                                                                            <tr>
                                                                            <td><i class='fa fa-minus-circle removeDevotee' aria-hidden='true'></i></td>
                                                                            <td>{{ $focus_devotee[0]->title }}</td>
                                                                            <td>{{ $focus_devotee[0]->chinese_name }}</td>
                                                                            <td>{{ $focus_devotee[0]->english_name }}</td>
                                                                            <td>{{ $focus_devotee[0]->nric }}</td>
                                                                             <td>{{ $focus_devotee[0]->contact }}</td>
                                                                                <td>{{ $focus_devotee[0]->dob }}</td>
                                                                                <td>
                                                                                    {{ $focus_devotee[0]->devotee_id }}
                                                                                    <input type="hidden" name="devotee_id[]"
                                                                                        value="{{ $focus_devotee[0]->devotee_id }}">
                                                                                </td>
                                                                                <td>{{ $focus_devotee[0]->address_building }}</td>
                                                                                <td>{{ $focus_devotee[0]->address_street }}</td>
                                                                                <td>
                                                                                    {{ $focus_devotee[0]->address_unit1 }}
                                                                                    {{ $focus_devotee[0]->address_unit2 }}
                                                                                </td>

                                                                            </tr>

                                                                            @foreach($devotee_lists as $devotee)

                                                                            <tr>
                                                                              <td><i class='fa fa-minus-circle removeDevotee' aria-hidden='true'></i></td>
                                                                                <td>{{ $devotee->title }}</td>
                                                                                <td>{{ $devotee->chinese_name }}</td>
                                                                                <td>{{ $devotee->english_name }}</td>
                                                                                <td>{{ $devotee->nric }}</td>
                                                                                   <td>{{ $devotee->contact }}</td>
                                                                                   <td>{{ $devotee->dob }}</td>
                                                                                <td>
                                                                                    {{ $devotee->devotee_id }}
                                                                                    <input type="hidden" name="devotee_id[]"
                                                                                    value="{{ $devotee->devotee_id }}">
                                                                                </td>
                                                                                <td>{{ $devotee->address_building }}</td>
                                                                                <td>{{ $devotee->address_street }}</td>
                                                                                <td>{{ $devotee->address_unit1 }} {{ $devotee->address_unit2 }}
                                                                                </td>

                                                                            </tr>

                                                                            @endforeach

                                                                        </tbody>

                                                                        @else

                                                                            <tbody id="no_session">
                                                                                <tr>
                                                                                    <td colspan="12">No Data</td>
                                                                                </tr>
                                                                            </tbody>

                                                                        @endif

                                                                    </table>

                                                                </div><!-- end form-group -->

                                                                <div class="form-group">

                                                                    <h4>新增其他主家</h4>

                                                                </div><!-- end form-group -->

                                                                <div class="form-group">

                                                                    <div class="col-md-12">

                                                                        <div class="col-md-6">
                                                                            <label class="col-md-2">Devotee ID</label>

                                                                            <div class="col-md-5">
                                                                                <input type="text" class="form-control" id="search_devotee">
                                                                            </div><!-- end col-md-5 -->

                                                                            <div class="col-md-3">
                                                                                <button type="button" class="btn default" id="search_devotee_btn">
                                                                                    Search Devotee 搜寻善信
                                                                                </button>
                                                                            </div><!-- end-com-md-3 -->
                                                                        </div><!-- end col-md-6 -->

                                                                        <div class="col-md-6"></div><!-- end col-md-6 -->

                                                                    </div><!-- end col-md-12 -->

                                                                </div><!-- end form-group -->

                                                                <div class="form-group">

                                                                    <table class="table table-bordered" id="generaldonation_table2">
                                                                        <thead>
                                                                            <tr>
                                                                             <th></th>
                                                                              <th>Title</th>
                                                                                <th>Chinese Name</th>
                                                                                 <th>English Name</th>
                                                                                    <th>NRIC</th>
                                                                                  <th>Contact</th>
                                                                                  <th>Dob</th>
                                                                                <th>Devotee#</th>
                                                                                <th>Block</th>
                                                                                <th>Address</th>
                                                                                <th>Unit</th>

                                                                            </tr>
                                                                        </thead>

                                                                                                                                                @if(Session::has('relative_friend_lists'))

                                                                                                                                                @php $relative_friend_lists = Session::get('relative_friend_lists'); @endphp

                                                                                                                                                <tbody id="appendDevoteeLists">

                                                                        @foreach($relative_friend_lists as $list)

                                                                            <tr>
                                                                                                                                                            <td></td>
                                                                                <td>{{ $list->chinese_name }}</td>
                                                                                                                                                            <td>{{ $list->relative_friend_devotee_id }}
                                                                                                                                                            <input type="hidden" name="other_devotee_id[]"
                                                                                                                                                            value="{{ $list->relative_friend_devotee_id }}"></td>
                                                                                                                                                            <td>{{ isset($list->address_building) ? $list->address_building : '-' }}</td>
                                                                                                                                                            <td>{{ $list->address_street }}</td>
                                                                                                                                                            <td>{{ $list->address_unit1 }} {{ $list->address_unit2 }}</td>
                                                                                                                                                            <td>{{ $list->guiyi_name }}</td>
                                                                                                                                                            <td class="amount-col">
                                                                                    <input type="text" class="form-control amount other_amount" name="other_amount[]">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" class="form-control paid_till other_paid_till"
                                                                                        name="other_paid_till[]" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-control" name="other_hjgr_arr[]">
                                                                                        <option value="hj">hj</option>
                                                                                        <option value="gr">gr</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-control" name="other_display[]">
                                                                                        <option value="Y">Y</option>
                                                                                        <option value="N">N</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td></td>
                                                                                <td></td>
                                                                            </tr>
                                                                                                                                                @endforeach

                                                                                                                                                </tbody>

                                                                                                                                                @else

                                                                                                                                                <tbody id="appendDevoteeLists">
                                                                                                                                                        <tr id="no_data">
                                                                                                                                                                <td colspan="12">No Data</td>
                                                                                                                                                        </tr>
                                                                                                                                                </tbody>

                                                                                                                                                @endif
                                                                    </table>

                                                                </div><!-- end form-group -->

                                                            </div><!-- end form-body -->



                                                            <hr>


                                                             <div class="form-group">
                                                          <h4>万缘胜会资料 </h4>
                                                         <br>


                                                           <!-- start of col-md-6 -->
                                                            <div class="col-md-6">
                                                            <label class="col-md-6">报名年份</label>
                                                             <div class="col-md-6"><select class="form-control" name="year_report" id="year_report">
                                                                                <option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>

                                                                            </select>
                                                          </div>
                                                          </div><!-- end col-md-6 -->

                                                           <div class="col-md-6">
                                                            <label class="col-md-4">龙牌类型 Type:</label>

                                                             <div class="col-md-8"><select class="form-control" name="type">
                                                                                <option value="0">甲种</option>
                                                                                <option value="1">乙种</option>
                                                                                  <option value="2">丙种</option>
                                                                                  <option value="3">丁种</option>
                                                                                   <option value="4">莲花座龙牌</option>
                                                                            </select>
                                                          </div>
                                                          </div><!-- end col-md-6 -->


                                                            <div class="clearfix"></div>
                                                             <br>


                                                            <div class="col-md-6">
                                                             <label class="col-md-6">有无安奉先人于碧山亭? :</label>
                                                            <div class="col-md-6">
                                                             <div class="mt-radio-list">

                                                                                        <label class="mt-radio mt-radio-outline"> Yes
                                                                                            <input type="radio" name="is_preancestor" value="1" checked>
                                                                                            <span></span>
                                                                                        </label>

                                                                                        <label class="mt-radio mt-radio-outline"> No
                                                                                            <input type="radio" name="is_preancestor" value="0">
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </div><!-- end mt-radio-list -->

                                                                                </div><!-- end col-md-12 -->

                                                                            </div><!-- end form-group -->
                                                                             <!-- start of col-md-6 -->
                                                          <div class="col-md-6">
                                                            <label class="col-md-4">临时收据号码:</label>
                                                             <div class="col-md-8"><input type="text" name="temp_receiptno" value=""
                                                          class="form-control" id="temp_receiptno"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                          <div class="clearfix"></div>
                                                           <br>
                                                                          <!-- start of col-md-6 -->
                                                          <div class="col-md-12">
                                                          <label class="col-md-3">字:</label>
                                                           <div class="col-md-9"><textarea rows="3"  name="word_print" value=""
                                                          class="form-control" id="word_print"/></textarea>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                            <div class="clearfix"></div>
                                                             <br>
                                                                            <!-- start of col-md-6 -->
                                                          <div class="col-md-12">
                                                            <label class="col-md-3">受荐人:</label>
                                                             <div class="col-md-9"><textarea  name="recommend_ppl" value=""
                                                          class="form-control" id="recommend_ppl"/></textarea>
                                                          </div>
                                                          </div><!-- end col-md-6 -->



 <br>




                                                            </div>

                                                            <hr>

                                                            <div class="form-body">

                                                                <div class="form-group">

                                                                    <div class="col-md-12">
                                                                        <h5><b>Total Amount 总额: S$ <span class="total"></span></b></h5>
                                                                    </div><!-- end col-md-12 -->

                                                                </div><!-- end form-group -->

                                                                 <br>
                                                           <div class="clearfix"></div>
                                                           <div class="col-md-6">
                                                            <label class="col-md-4">选择会馆 :</label>
                                                             <div class="col-md-8"><select class="form-control" id="association_dd" name="association_dd">
                                                                                <option value="0"> 请选择</option>
                                                                                <option value="1">增龙会馆</option>
                                                                                <option value="2">顺德会馆</option>
                                                                                   <option value="3">高要会馆</option>
                                                                                <option value="4">中山会馆</option>
                                                                                   <option value="5">三水会馆</option>
                                                                                <option value="6">恩平会馆</option>
                                                                                   <option value="7">番偶会馆</option>
                                                                                <option value="8">冈州会馆</option>
                                                                                   <option value="9">东安会馆</option>
                                                                                <option value="10">南顺会馆</option>
                                                                                 <option value="11">华县会馆</option>
                                                                                 <option value="12">庆会馆</option>
                                                                                  <option value="13">清远会馆</option>
                                                                            </select>
                                                          </div>
                                                          </div><!-- end col-md-6 -->

                                                            <div class="clearfix"></div>
                                                                 <br>  <br>
                                                           <div class="form-group">

                                                                    <div class="col-md-12">
                                                                        <h5><b>GST: S$ <span class="total_gst"></span></b></h5>
                                                                    </div><!-- end col-md-12 -->

                                                                     <div class="col-md-12">
                                                                        <h5><b>合计: S$ <span class="total_aftergst"></span></b></h5>
                                                                    </div><!-- end col-md-12 -->
                                                                      <div class="col-md-12">
                                                                        <h5><b>会馆折扣(10%): S$ <span class="total_afterdiscount"></span></b></h5>
                                                                    </div><!-- end col-md-12 -->
                                                                </div><!-- end form-group -->
                                                           <div class="clearfix"></div>

                                                            <br>  <br>
                                                                <div class="form-group">

                                                                    <div class="col-md-12">

                                                                        <div class="col-md-6">

                                                                            <div class="form-group">

                                                                                <label class="col-md-4">Transation No:</label>
                                                                                <div class="col-md-8"></div><!-- end col-md-8 -->

                                                                            </div><!-- end form-group -->

                                                                            <div class="form-group">

                                                                                <label class="col-md-12">Mode of Payment 付款方式</label>

                                                                            </div><!-- end form-group -->

                                                                            <div class="form-group">

                                                                                <div class="col-md-12">
                                                                                    <div class="mt-radio-list">

                                                                                        <div class="col-md-6">
                                                                                            <label class="mt-radio mt-radio-outline"> Cash 现金
                                                                                                <input type="radio" name="mode_payment"
                                                                                                    value="cash" checked>
                                                                                                <span></span>
                                                                                            </label>
                                                                                        </div><!-- end col-md-6 -->

                                                                                        <div class="col-md-6">
                                                                                        </div><!-- end col-md-6 -->

                                                                                        <div class="clearfix"></div>

                                                                                        <div class="col-md-6">
                                                                                            <label class="mt-radio mt-radio-outline"> Cheque 支票
                                                                                                <input type="radio" name="mode_payment"
                                                                                                    value="cheque" class="form-control">
                                                                                                <span></span>
                                                                                            </label>
                                                                                        </div><!-- end col-md-6 -->

                                                                                        <div class="col-md-6">
                                                                                            <input type="text" name="cheque_no" value=""
                                                                                                class="form-control input-small" id="cheque_no">
                                                                                        </div><!-- end col-md-6 -->

                                                                                        <div class="clearfix"></div>

                                                                                        <div class="col-md-6">
                                                                                            <label class="mt-radio mt-radio-outline"> NETS
                                                                                                <input type="radio" name="mode_payment"
                                                                                                    value="nets">
                                                                                                <span></span>
                                                                                            </label>
                                                                                        </div><!-- end col-md-6 -->

                                                                                        <div class="col-md-6">
                                                                                        </div><!-- end col-md-6 -->

                                                                                        <div class="clearfix"></div>

                                                                                        <div class="col-md-6">
                                                                                            <label class="mt-radio mt-radio-outline"> Manual Receipt 收据
                                                                                                <input type="radio" name="mode_payment"
                                                                                                    value="receipt">
                                                                                                <span></span>
                                                                                            </label>
                                                                                        </div><!-- end col-md-6 -->

                                                                                        <div class="col-md-6">
                                                                                            <input type="text" name="manualreceipt" value=""
                                                                                                class="form-control input-small"
                                                                                                id="manualreceipt">
                                                                                        </div><!-- end col-md-6 -->

                                                                                        <div class="clearfix"></div>

                                                                                        <div class="col-md-6">
                                                                                            <label class="mt-radio mt-radio-outline">
                                                                                                Date of Receipts 收据日期
                                                                                            </label>
                                                                                        </div><!-- end col-md-6 -->

                                                                                        <div class="col-md-6">
                                                                                            <input type="text" name="receipt_at" class="form-control input-small"
                                                                                                data-provide="datepicker" data-date-format="dd/mm/yyyy" id="receipt_at">
                                                                                        </div><!-- end col-md-6 -->

                                                                                    </div><!-- end mt-radio-list -->

                                                                                </div><!-- end col-md-12 -->

                                                                            </div><!-- end form-group -->

                                                                        </div><!-- end col-md-6 -->



                                                                    </div><!-- end col-md-12 -->

                                                                </div><!-- end form-group -->

                                                                @if(Session::has('focus_devotee'))
                                                                <div class="form-group">
                                                                    <input type="hidden" name="focusdevotee_id"
                                                                        value="{{ $focus_devotee[0]->devotee_id }}">
                                                                    <input type="hidden" name="total_amount" id="total_amount" value="">
                                                                </div>

                                                                @else

                                                                <div class="form-group">
                                                                    <input type="hidden" name="focusdevotee_id"
                                                                        value="">
                                                                    <input type="hidden" name="total_amount" id="total_amount" value="">
                                                                </div>

                                                                @endif

                                                                <div class="form-group">

                                                                    <div class="col-md-12">

                                                                        <div class="form-actions">
                                                                            <button type="submit" class="btn blue" id="confirm_donation_btn">Confirm
                                                                            </button>
                                                                            <button type="button" class="btn default">Cancel</button>
                                                                        </div><!-- end form-actions -->

                                                                    </div><!-- end col-md-12 -->

                                                                </div><!-- end form-group -->

                                                                </form>

                                                            </div><!-- end form-body -->

                                                            <hr>

                                                            <div class="form-body">

                                                                <div class="form-group portlet-body">

                                                                    <table class="table table-bordered order-column"
                                                                        id="receipt_history_table sample_1">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>XY Receipt</th>
                                                                                <th>Trans Date</th>
                                                                                <th>Transaction</th>
                                                                                <th>Description</th>
                                                                                <th>Paid By</th>
                                                                                <th>Devotee ID</th>
                                                                                <th>HJ/ GR</th>
                                                                                <th>Amount</th>
                                                                                <th>Manual Receipt</th>
                                                                                <th>Print</th>
                                                                                                                                                                <th>View Details</th>
                                                                            </tr>
                                                                        </thead>

                                                                        @if(Session::has('receipts'))

                                                                            @php

                                                                                $receipts = Session::get('receipts');

                                                                            @endphp

                                                                            <tbody>
                                                                                @foreach($receipts as $receipt)
                                                                                <tr>
                                                                                    <td>{{ $receipt->xy_receipt }}</td>
                                                                                    <td>{{ \Carbon\Carbon::parse($receipt->trans_date)->format("d/m/Y") }}</td>
                                                                                    <td>{{ $receipt->xy_receipt }}</td>
                                                                                    <td>{{ $receipt->description }}</td>
                                                                                    <td>{{ $receipt->chinese_name }}</td>
                                                                                    <td>{{ $receipt->devotee_id }}</td>
                                                                                    <td>{{ $receipt->generaldonation_hjgr }}</td>
                                                                                    <td>{{ $receipt->amount }}</td>
                                                                                    <td>{{ $receipt->manualreceipt }}</td>
                                                                                    <td><a href="{{ URL::to('/staff/receipt/' . $receipt->receipt_id) }}">Print</a></td>
                                                                                                                                                                        <td><a href="{{ URL::to('/staff/receiptdetail/' . $receipt->receipt_id) }}">Detail</a></td>
                                                                                </tr>
                                                                                @endforeach
                                                                            </tbody>

                                                                        @else



                                                                        @endif


                                                                    </table>

                                                                </div><!-- end form-group -->

                                                            </div><!-- end form-body -->

                                                        </div><!-- end tab-pane -->

                                                    </div><!-- end tab-content -->

                                                </div><!-- end tabbable-bordered -->

                                            </div><!-- end portlet-body -->

                                        </div><!-- end portlet -->

                                    </div><!-- end form-horizontal -->

                                </div><!-- end col-md-9 -->

                             </div><!-- end row -->

                        </div><!-- end inbox -->

                    </div><!-- end page-content-inner -->

                </div><!-- end container-fluid -->

            </div><!-- end page-content -->

        </div><!-- end page-content-wrapper -->

    </div><!-- end page-container-fluid -->

@stop

@section('custom-js')

    <script src="{{asset('js/custom/common.js')}}"></script>
    <script src="{{asset('js/custom/search-devotee.js')}}"></script>

    <script type="text/javascript">
        $(function() {
            $(".total").text(1000);
            $("#total_amount").val(1000);
            // Disabled Edit Devotee Tab
            $(".nav-tabs > li").click(function(){
                    if($(this).hasClass("disabled"))
                            return false;
            });

            $('body').on('focus',".paid_till", function(){
                $(this).datepicker({ dateFormat: 'yy-mm-dd' });
        });

            $('body').on('keyup',".amount-col", function(){
            var sum = 0;

              $(".amount").each(function(){
                    sum += +$(this).val();
            });

                $(".total").text(sum);
                $("#total_amount").val(sum);

            });

        });

            $('#association_dd').on('change', function(){

       if(this.value != 0 ) {
         $(".total_gst").text(document.getElementById("total_amount").value *0.07) ;
           $(".total_aftergst").text(document.getElementById("total_amount").value *1.07) ;
            $(".total_afterdiscount").text((document.getElementById("total_amount").value *1.07)*0.9) ;

           } else {
           $(".total_gst").text(document.getElementById("total_amount").value *0.07) ;
           $(".total_aftergst").text(document.getElementById("total_amount").value *1.07) ;

           }

        });
    </script>

@stop
