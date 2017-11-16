@extends('layouts.backend.app')

@section('main-content')

	<div class="page-container-fluid">

		<div class="page-content-wrapper">

			<div class="page-head">

                <div class="container-fluid">

                	<div class="page-title">

                        <h1>神主牌</h1>

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
                            <span>神主牌</span>
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

                                                    			<form method="post" action="{{ URL::to('/staff/shengzhupai') }}"
                                                    				class="form-horizontal form-bordered" id="donationform">

                                                    				{!! csrf_field() !!}

                                                    			<div class="form-group">

                                                    				<h4> 同址主家</h4>

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
                                                                            <td><input type="radio" name="devotee_selected"  value="{{ $focus_devotee[0]->devotee_id }}" checked></td>
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
                                                                              <td><input type="radio" name="devotee_selected"  value="{{ $focus_devotee[0]->devotee_id }}"></td>
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






                                                    		</div><!-- end form-body -->



                                                    		<hr>


                                                             <div class="form-group">

                                                           <h4>Slot Selection 选位</h4>
                                                           <!-- start of col-md-4 -->
                                                           <div class="col-md-3">

                                                                            <div class="form-group">

                                                                                <label class="col-md-5">BLK:</label>
                                                                                  <div class="col-md-7"><input type="text" readonly name="ss_blk" value=""
                                                          class="form-control" id="ss_blk"/>
                                                          </div><!-- end col-md-7 -->
      <input type="hidden" name="slot_id" id="slot_id" value="">
                                                                            </div>
                                                           </div>
                                                            <!-- end of col-md-3 -->
                                                             <!-- start of col-md-4 -->
                                                           <div class="col-md-3">

                                                                            <div class="form-group">

                                                                                <label class="col-md-5">层次:</label>
                                                                              <div class="col-md-7"><input type="text" name="ss_level" value="" readonly
                                                          class="form-control" id="ss_level"/>
                                                          </div><!-- end col-md-7 -->

                                                                            </div>
                                                               </div>
                                                            <!-- end of col-md-3 -->
                                                             <!-- start of col-md-4 -->
                                                           <div class="col-md-3">

                                                                            <div class="form-group">

                                                                                <label class="col-md-5">号码:</label>
                                                                                <div class="col-md-7"><input type="text" name="ss_number" value="" readonly
                                                          class="form-control" id="ss_number"/>
                                                          </div><!-- end col-md-7 -->

                                                                            </div>
                                                               </div>
                                                                 <div class="col-md-3">
                                                                                <button type="button" class="btn default" onClick="selectValue('id')"  id="search_devotee_btn" value= "">
                                                                                   选位
                                                                                </button>

                                                                            </div><!-- end-com-md-3 -->
                                                            <!-- end of col-md-3 -->
                                                            <div class="clearfix"></div>
                                                           <br>

																													 <h4>其他选项资料 </h4>
																											 <br>


					<div class="col-md-12">
					  <label  class="col-md-2" for="select_otheroption">选择其他选项:</label>
						 <div class="col-md-8">  <input class="form-control select_otheroption" id="select_otheroption" name="select_otheroption" type="text">
							  <div class="otheroption-selected"></div>
								<br />
								<div class="otheroption-added">

										<h5 class="selecttitle">已选其他选项: </h5>
										<input type="hidden" id="otheroption_text" name="otheroption_text" value="">

									</div>
					</div>
					</div><!-- end col-md-6 -->
            <br />


                                                             <h4>神主牌资料 </h4>
                                                         <br>
                                                          <div class="col-md-12">
                                                            <label class="col-md-2">神主牌名称 Name:</label>
                                                             <div class="col-md-8"><textarea name="name" value=""
                                                          class="form-control" id="name"></textarea>
                                                          </div>
                                                          </div><!-- end col-md-6 -->

                                                           <div class="clearfix"></div>
                                                             <br>  <br>
                                                           <div class="col-md-6">
                                                            <label class="col-md-4">神主牌类型 Type:</label>
                                                             <div class="col-md-8"><select class="form-control" name="type">
                                                                                <option value="0">入主</option>
                                                                                <option value="1">全家</option>
                                                                            </select>
                                                          </div>
                                                          </div><!-- end col-md-6 -->



                                                            <div class="col-md-6">
                                                             <label class="col-md-4">入主选项 :</label>
                                                            <div class="col-md-6">
                                                             <div class="mt-radio-list">

                                                                                        <label class="mt-radio mt-radio-outline"> 字
                                                                                            <input type="radio" name="entermastertype" value="0" checked>
                                                                                            <span></span>
                                                                                        </label>

                                                                                        <label class="mt-radio mt-radio-outline"> 相片
                                                                                            <input type="radio" name="entermastertype" value="1">
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </div><!-- end mt-radio-list -->

                                                                                </div><!-- end col-md-12 -->

                                                                            </div><!-- end form-group -->




                                                            <div class="col-md-6">
                                                             <label class="col-md-5">神主牌是否做好? :</label>
                                                            <div class="col-md-6">
                                                             <div class="mt-radio-list">

                                                                                        <label class="mt-radio mt-radio-outline"> Yes
                                                                                            <input type="radio" name="done" value="yes" checked>
                                                                                            <span></span>
                                                                                        </label>

                                                                                        <label class="mt-radio mt-radio-outline"> No
                                                                                            <input type="radio" name="done" value="no">
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </div><!-- end mt-radio-list -->

                                                                                </div><!-- end col-md-12 -->

                                                                            </div><!-- end form-group -->



                                                            </div>

                                                            <hr>

                                                    		<div class="form-body">

                                                    			<div class="form-group">

	                                                    			<div class="col-md-12">
																															<h5><b>神主牌 价钱 : S$ <span class="szp_price">0</span></b></h5>
																															<input type="hidden" name="szp_price" id="szp_price" value="0">
																															<h5><b>神主牌 选位价钱 : S$ <span class="szp_ss_price">0</span></b></h5>
																															<input type="hidden" name="szp_ss_price" id="szp_ss_price" value="0">

																															<h5><b>其他选项 Amount : S$ <span class="oo_total">0</span></b></h5>
																															<input type="hidden" name="oo_total" id="oo_total" value="0">

	                                                    				<h5><b>Total Amount 总额: S$ <span class="total">0</span></b></h5>
																															<input type="hidden" name="total" id="total" value="0">

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
                                                                        <h5><b>GST: S$ <span class="total_gst"></span>0</b></h5>
                                                                            <input type="hidden" name="total_gst" id="total_gst" value="0">
                                                                    </div><!-- end col-md-12 -->

                                                                     <div class="col-md-12">
                                                                        <h5><b>合计: S$ <span class="total_aftergst"></span>0</b></h5>
                                                                        <input type="hidden" name="total_aftergst" id="total_aftergst" value="0">
                                                                    </div><!-- end col-md-12 -->
                                                                      <div class="col-md-12">
                                                                        <h5><b>会馆折扣(10%): S$ <span class="total_afterdiscount">0</span></b></h5>
                                                                        <input type="hidden" name="total_afterdiscount" id="total_afterdiscount" value="0">
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
                                                                                <th>Amount</th>
                                                                                <th>Print</th>
																				<th>View Details</th>
                                                                            </tr>
                                                                        </thead>

                                                                        @if(Session::has('shengzhupai_receipts'))

                                                                            @php

                                                                                $shengzhupai_receipts = Session::get('shengzhupai_receipts');

                                                                            @endphp

                                                                            <tbody>
                                                                                @foreach($shengzhupai_receipts as $shengzhupai_receipts)
                                                                                <tr>
                                                                                    <td>{{ $shengzhupai_receipts->xy_receipt }}</td>
                                                                                    <td>{{ \Carbon\Carbon::parse($shengzhupai_receipts->trans_date)->format("d/m/Y") }}</td>
                                                                                    <td>{{ $shengzhupai_receipts->xy_receipt }}</td>
                                                                                    <td>{{ $shengzhupai_receipts->description }}</td>
                                                                                    <td>{{ $shengzhupai_receipts->chinese_name }}</td>
                                                                                    <td>{{ $shengzhupai_receipts->devotee_id }}</td>
                                                                                    <td>{{ $shengzhupai_receipts->amount }}</td>
                                                                                    <td><a href="{{ URL::to('/staff/receipt/' . $shengzhupai_receipts->receipt_id) }}">Print</a></td>
																																										<td><a href="{{ URL::to('/staff/receiptdetail/' . $shengzhupai_receipts->receipt_id) }}">Detail</a></td>
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
    <script src="{{ asset('/js/jquery.autocomplete.js') }}" type="text/javascript"></script>
	<script src="{{asset('js/custom/common_nondialog.js')}}"></script>

	<script src="{{asset('js/custom/optional_selection.js')}}"></script>

	<script type="text/javascript">




function selectValue(pid){
    // open popup window and pass field id
    window.open('/admin/all-shengzhupaislots','shengzhupai-slots-selection','height=800, width=800, status=yes, toolbar=no, menubar=no,  addressbar=no, top=100, left=260');
}

function updateValue(pid, value){
    // this gets called from the popup window and updates the field with a new value

    document.getElementById('slot_id').value = value;
    var slot_id  = value;
        var formData = {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        slot_id: slot_id,
                    };

    $.ajax({
                            type: 'GET',
                          url: "/admin/ajax-shengzhupaislots",
                          data: formData,
                          dataType: 'json',
                          success: function(response)
                          {

                                        document.getElementById('ss_blk').value = response.shengzhupaislots['ss_blk'];
                                            document.getElementById('ss_level').value = response.shengzhupaislots['ss_level'];
                                                document.getElementById('ss_number').value = response.shengzhupaislots['ss_number'];
																										$(".szp_price").text(response.shengzhupaislots['price']);
																										$("#szp_price").val(response.shengzhupaislots['price']);
																										$(".szp_ss_price").text(response.shengzhupaislots['select_price']);
																										$("#szp_ss_price").val(response.shengzhupaislots['select_price']);
																										  calTotal();

                          },

                          error: function (response) {
                            console.log(response);
                          }
                       });



}


		$(function() {


			$('.select_otheroption').autocomplete({

						serviceUrl: '/operator/getjsonotheroption',
						dataType: 'json',
						contentType: "application/json; charset=utf-8",
						type: 'GET',


						onSelect: function (suggestion) {
								getselector = $(this);

								if(suggestion.data.id != '') {

												$('.otheroption-selected').html('<div class="otheroption-selected-row"><b>You selected: </b>' +suggestion.value+ ' <a class="add-otheroption" id="add-otheroption">[ADD]</a></div>');
										loadAddPerson('.add-otheroption', '.otheroption-selected-row', '.otheroption-added', '.otheroption-selected', suggestion);

						}


						},
						onInvalidateSelection: function() {

											$('.otheroption-selected').html('<b>You selected: </b>none');


						},
						showNoSuggestionNotice: true,
						noSuggestionNotice: 'Sorry, no matching results'
				});





			// Disabled Edit Devotee Tab
			$(".nav-tabs > li").click(function(){
					if($(this).hasClass("disabled"))
							return false;
			});



 		});

            $('#association_dd').on('change', function(){

       if(this.value != 0 ) {

            $(".total_afterdiscount").text(((document.getElementById("total").value *1.07)*0.9).toFixed(2)) ;
              $("#total_afterdiscount").val(((document.getElementById("total").value *1.07)*0.9).toFixed(2)) ;

           } else {

           }

        });
	</script>

@stop
