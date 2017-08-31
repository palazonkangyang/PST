@extends('layouts.backend.app')

@section('main-content')

    <div class="page-container-fluid">

        <div class="page-content-wrapper">

            <div class="page-head">

                <div class="container-fluid">

                    <div class="page-title">

                        <h1>灵塔</h1>

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
                            <span>灵塔</span>
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

                                                                <form method="post" action="{{ URL::to('/staff/lingwei') }}"
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
                                                          <h4>灵塔资料 </h4>
                                                         <br>
                                                           <h4>Slot Selection 选位</h4>
                                                           <br>
                                                              <h4>先人资料(A) </h4>
                                                         <br>
                                                          <!-- start of col-md-6 -->
                                                          <div class="col-md-6">
                                                            <label class="col-md-4">先人姓名:</label>
                                                             <div class="col-md-8"><input type="text" name="ancestor_name_a" value=""
                                                          class="form-control" id="ancestor_name_a"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                            <!-- start of col-md-6 -->
                                                          <div class="col-md-6">
                                                            <label class="col-md-4">关系:</label>
                                                             <div class="col-md-8"><input type="text" name="ancestor_relation_a" value=""
                                                          class="form-control" id="ancestor_relation_a"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                            <!-- start of col-md-6 -->
                                                              <div class="clearfix"></div>
                                                             <br>  
                                                          <div class="col-md-6">
                                                            <label class="col-md-4">火化证号码:</label>
                                                             <div class="col-md-8"><input type="text" name="ancestor_certno_a" value=""
                                                          class="form-control" id="ancestor_certno_a"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                             <!-- start of col-md-6 -->
                                                            <div class="col-md-6">
                                                            <label class="col-md-4">类型:</label>
                                                             <div class="col-md-8"><select class="form-control" name="ancestor_type_a" id="ancestor_type_a">
                                                                                <option value="0">个别式</option>
                                                                                <option value="1">豪华式</option>
                                                                                 <option value="2">家庭式</option>
                                                                            </select>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                            <div class="clearfix"></div>
                                                             <br>  
                                                           <!-- start of col-md-6 -->
                                                            <div class="col-md-6">
                                                            <label class="col-md-4">埕相:</label>
                                                             <div class="col-md-8"><select class="form-control" name="ancestor_stonetype_a" id="ancestor_stonetype_a">
                                                                                <option value="0"> 四方埕</option>
                                                                                <option value="1">黄埕</option>
                                                                                 <option value="2">云石埕（圆）</option>
                                                                                  <option value="3"> 云石埕（方）</option>
                                                                                <option value="4">只做相片</option>
                                                                                 <option value="5">碑</option>
                                                                                  <option value="6"> 花岗石</option>
                                                                                <option value="7">新进位</option>
                                                                                 <option value="8">青玉埕</option>
                                                                            </select>


                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                               <!-- start of col-md-6 -->
                                                              
                                                          <div class="col-md-6">
                                                            <label class="col-md-4">旧号:</label>
                                                             <div class="col-md-8"><input type="text" name="ancestor_oldno_a" value=""
                                                          class="form-control" id="ancestor_oldno_a"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                          <div class="clearfix"></div>
                                                             <br>  
                                                            <!-- start of col-md-6 -->
                                                            <div class="col-md-6">
                                                            <label class="col-md-4">使用情况:</label>
                                                             <div class="col-md-8"><select class="form-control" name="ancestor_usagecondition_a" id="ancestor_usagecondition_a">
                                                                                <option value="0">未用</option>
                                                                                <option value="1">寿用</option>
                                                                                 <option value="2">使用</option>
                                                                            </select>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                            <!-- start of col-md-6 -->
                                                            <div class="col-md-6">
                                                      
                                                             <div class="col-md-8"><input type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" name="ancestor_date_a" value=""
                                                          class="form-control" id="ancestor_date_a"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                            <div class="clearfix"></div>
                                                             <br>  
                                                              <h4>先人资料(B) </h4>
                                                                     <br>
                                                          <!-- start of col-md-6 -->
                                                          <div class="col-md-6">
                                                            <label class="col-md-4">先人姓名:</label>
                                                             <div class="col-md-8"><input type="text" name="ancestor_name_b" value=""
                                                          class="form-control" id="ancestor_name_b"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                            <!-- start of col-md-6 -->
                                                          <div class="col-md-6">
                                                            <label class="col-md-4">关系:</label>
                                                             <div class="col-md-8"><input type="text" name="ancestor_relation_b" value=""
                                                          class="form-control" id="ancestor_relation_b"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                            <!-- start of col-md-6 -->
                                                              <div class="clearfix"></div>
                                                             <br>  
                                                          <div class="col-md-6">
                                                            <label class="col-md-4">火化证号码:</label>
                                                             <div class="col-md-8"><input type="text" name="ancestor_certno_b" value=""
                                                          class="form-control" id="ancestor_certno_b"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                             <!-- start of col-md-6 -->
                                                            <div class="col-md-6">
                                                            <label class="col-md-4">类型:</label>
                                                             <div class="col-md-8"><select class="form-control" name="ancestor_type_b" id="ancestor_type_b">
                                                                                <option value="0">个别式</option>
                                                                                <option value="1">豪华式</option>
                                                                                 <option value="2">家庭式</option>
                                                                            </select>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                            <div class="clearfix"></div>
                                                             <br>  
                                                           <!-- start of col-md-6 -->
                                                            <div class="col-md-6">
                                                            <label class="col-md-4">埕相:</label>
                                                             <div class="col-md-8"><select class="form-control" name="ancestor_stonetype_b" id="ancestor_stonetype_b">
                                                                                <option value="0"> 四方埕</option>
                                                                                <option value="1">黄埕</option>
                                                                                 <option value="2">云石埕（圆）</option>
                                                                                  <option value="3"> 云石埕（方）</option>
                                                                                <option value="4">只做相片</option>
                                                                                 <option value="5">碑</option>
                                                                                  <option value="6"> 花岗石</option>
                                                                                <option value="7">新进位</option>
                                                                                 <option value="8">青玉埕</option>
                                                                            </select>


                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                               <!-- start of col-md-6 -->
                                                              
                                                          <div class="col-md-6">
                                                            <label class="col-md-4">旧号:</label>
                                                             <div class="col-md-8"><input type="text" name="ancestor_oldno_b" value=""
                                                          class="form-control" id="ancestor_oldno_b"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                          <div class="clearfix"></div>
                                                             <br>  
                                                            <!-- start of col-md-6 -->
                                                            <div class="col-md-6">
                                                            <label class="col-md-4">使用情况:</label>
                                                             <div class="col-md-8"><select class="form-control" name="ancestor_usagecondition_b" id="ancestor_usagecondition_b">
                                                                                <option value="0">未用</option>
                                                                                <option value="1">寿用</option>
                                                                                 <option value="2">使用</option>
                                                                            </select>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                            <!-- start of col-md-6 -->
                                                            <div class="col-md-6">
                                                      
                                                             <div class="col-md-8"><input type="text" data-provide="datepicker" data-date-format="dd/mm/yyyy" name="ancestor_date_b" value=""
                                                          class="form-control" id="ancestor_date_b"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                            <div class="clearfix"></div>
                                                             <br>  
                                                              <h4>石碑资料(A) </h4>
                                                         <br>
                                                          <!-- start of col-md-6 -->
                                                            <div class="col-md-4">
                                                            <label class="col-md-4">祖籍: 省:</label>
                                                             <div class="col-md-8"><select class="form-control" name="stone_district_a" id="stone_district_a">
                                                                                <option value="0">广东</option>
                                                                                <option value="1">福建</option>
                                                                                 <option value="2">海南</option>
                                                                            </select>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                              <!-- start of col-md-6 --> 
                                                          <div class="col-md-4">
                                                            <label class="col-md-4">市:</label>
                                                             <div class="col-md-8"><input type="text" name="stone_city_a" value=""
                                                          class="form-control" id="stone_city_a"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                           <!-- start of col-md-6 --> 
                                                          <div class="col-md-4">
                                                            <label class="col-md-4">年龄:</label>
                                                             <div class="col-md-8"><input type="text" name="stone_age_a" value=""
                                                          class="form-control" id="stone_age_a"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                              <!-- start of col-md-6 -->
                                                              <div class="clearfix"></div>
                                                             <br>
                                                               <div class="col-md-6">
                                                            <label class="col-md-4">姓名:</label>
                                                             <div class="col-md-8"><textarea    name="stone_name_a" value=""
                                                          class="form-control" id="stone_name_a"/>
                                                          </textarea>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                            <!-- start of col-md-6 -->
                                                                 <div class="col-md-6">
                                                            <label class="col-md-4">火化纸死日期:</label>
                                                             <div class="col-md-8"><input type="text"  data-provide="datepicker" data-date-format="dd/mm/yyyy" name="stone_cremationdate_a" value=""
                                                          class="form-control" id="stone_cremationdate_a"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                            <div class="clearfix"></div>
                                                             <br>
                                                               <!-- start of col-md-6 -->
                                                          <div class="col-md-6">
                                                            <label class="col-md-4">生于:</label>
                                                             <div class="col-md-8"><input type="text"  data-provide="datepicker" data-date-format="dd/mm/yyyy" name="stone_borndate_a" value=""
                                                          class="form-control" id="stone_borndate_a"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                         <!-- start of col-md-6 -->
                                                          <div class="col-md-6">
                                                            <label class="col-md-4">终于:</label>
                                                             <div class="col-md-8"><input type="text"  data-provide="datepicker" data-date-format="dd/mm/yyyy" name="stone_diedate_a" value=""
                                                          class="form-control" id="stone_diedate_a"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                          <div class="clearfix"></div>
                                                             <br>
                                                              <!-- start of col-md-6 --> 
                                                          <div class="col-md-6">
                                                            <label class="col-md-4">增加文字:</label>
                                                             <div class="col-md-8"><input type="text" name="stone_addword_a" value=""
                                                          class="form-control" id="stone_addword_a"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                              <div class="col-md-6">
                                                             <label class="col-md-4">文字选项 :</label>
                                                            <div class="col-md-6">
                                                             <div class="mt-radio-list">

                                                                                        <label class="mt-radio mt-radio-outline"> 字
                                                                                            <input type="radio" name="stone_photo_detail_a" value="0" checked>
                                                                                            <span></span>
                                                                                        </label>

                                                                                        <label class="mt-radio mt-radio-outline"> 未有照片
                                                                                            <input type="radio" name="stone_photo_detail_a" value="1">
                                                                                            <span></span>
                                                                                        </label>
                                                                                         <label class="mt-radio mt-radio-outline"> 拍照
                                                                                            <input type="radio" name="stone_photo_detail_a" value="2">
                                                                                            <span></span>
                                                                                        </label>
                                                                                        <label class="mt-radio mt-radio-outline"> 相片
                                                                                            <input type="radio" name="stone_photo_detail_a" value="3">
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </div><!-- end mt-radio-list -->

                                                                                </div><!-- end col-md-12 -->

                                                                            </div><!-- end form-group -->
                                                          <div class="clearfix"></div>
                                                             <br>
                                                         <!-- start of col-md-6 -->
                                                          <div class="col-md-6">
                                                            <label class="col-md-4">补交日期:</label>
                                                             <div class="col-md-8"><input type="text"  data-provide="datepicker" data-date-format="dd/mm/yyyy" name="stone_makeupdate_a" value=""
                                                          class="form-control" id="stone_makeupdate_a"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                       
                                                            <div class="col-md-6">
                                                             <label class="col-md-5">碑是否做好? :</label>
                                                            <div class="col-md-6">
                                                             <div class="mt-radio-list">

                                                                                        <label class="mt-radio mt-radio-outline"> Yes
                                                                                            <input type="radio" name="stone_done_a" value="yes" checked>
                                                                                            <span></span>
                                                                                        </label>

                                                                                        <label class="mt-radio mt-radio-outline"> No
                                                                                            <input type="radio" name="stone_done_a" value="no">
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </div><!-- end mt-radio-list -->

                                                                                </div><!-- end col-md-12 -->

                                                                            </div><!-- end form-group -->
                                                                             <div class="clearfix"></div>
                                                             <br>
                                                              <h4>石碑资料(B) </h4>
                                                        <br>
                                                          <!-- start of col-md-6 -->
                                                            <div class="col-md-4">
                                                            <label class="col-md-4">祖籍: 省:</label>
                                                             <div class="col-md-8"><select class="form-control" name="stone_district_b" id="stone_district_b">
                                                                                <option value="0">广东</option>
                                                                                <option value="1">福建</option>
                                                                                 <option value="2">海南</option>
                                                                            </select>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                              <!-- start of col-md-6 --> 
                                                          <div class="col-md-4">
                                                            <label class="col-md-4">市:</label>
                                                             <div class="col-md-8"><input type="text" name="stone_city_b" value=""
                                                          class="form-control" id="stone_city_b"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                           <!-- start of col-md-6 --> 
                                                          <div class="col-md-4">
                                                            <label class="col-md-4">年龄:</label>
                                                             <div class="col-md-8"><input type="text" name="stone_age_b" value=""
                                                          class="form-control" id="stone_age_b"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                              <!-- start of col-md-6 -->
                                                              <div class="clearfix"></div>
                                                             <br>
                                                               <div class="col-md-6">
                                                            <label class="col-md-4">姓名:</label>
                                                             <div class="col-md-8"><textarea    name="stone_name_b" value=""
                                                          class="form-control" id="stone_name_b"/>
                                                           </textarea>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                            <!-- start of col-md-6 -->
                                                                 <div class="col-md-6">
                                                            <label class="col-md-4">火化纸死日期:</label>
                                                             <div class="col-md-8"><input type="text"  data-provide="datepicker" data-date-format="dd/mm/yyyy" name="stone_cremationdate_b" value=""
                                                          class="form-control" id="stone_cremationdate_b"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                            <div class="clearfix"></div>
                                                             <br>
                                                               <!-- start of col-md-6 -->
                                                          <div class="col-md-6">
                                                            <label class="col-md-4">生于:</label>
                                                             <div class="col-md-8"><input type="text"  data-provide="datepicker" data-date-format="dd/mm/yyyy" name="stone_borndate_b" value=""
                                                          class="form-control" id="stone_borndate_b"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                         <!-- start of col-md-6 -->
                                                          <div class="col-md-6">
                                                            <label class="col-md-4">终于:</label>
                                                             <div class="col-md-8"><input type="text"  data-provide="datepicker" data-date-format="dd/mm/yyyy" name="stone_diedate_b" value=""
                                                          class="form-control" id="stone_diedate_b"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                          <div class="clearfix"></div>
                                                             <br>
                                                              <!-- start of col-md-6 --> 
                                                          <div class="col-md-6">
                                                            <label class="col-md-4">增加文字:</label>
                                                             <div class="col-md-8"><input type="text" name="stone_addword_b" value=""
                                                          class="form-control" id="stone_addword_b"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                              <div class="col-md-6">
                                                             <label class="col-md-4">文字选项 :</label>
                                                            <div class="col-md-6">
                                                             <div class="mt-radio-list">

                                                                                        <label class="mt-radio mt-radio-outline"> 字
                                                                                            <input type="radio" name="stone_photo_detail_b" value="0" checked>
                                                                                            <span></span>
                                                                                        </label>

                                                                                        <label class="mt-radio mt-radio-outline"> 未有照片
                                                                                            <input type="radio" name="stone_photo_detail_b" value="1">
                                                                                            <span></span>
                                                                                        </label>
                                                                                         <label class="mt-radio mt-radio-outline"> 拍照
                                                                                            <input type="radio" name="stone_photo_detail_b" value="2">
                                                                                            <span></span>
                                                                                        </label>
                                                                                        <label class="mt-radio mt-radio-outline"> 相片
                                                                                            <input type="radio" name="stone_photo_detail_b" value="3">
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </div><!-- end mt-radio-list -->

                                                                                </div><!-- end col-md-12 -->

                                                                            </div><!-- end form-group -->
                                                          <div class="clearfix"></div>
                                                             <br>
                                                         <!-- start of col-md-6 -->
                                                          <div class="col-md-6">
                                                            <label class="col-md-4">补交日期:</label>
                                                             <div class="col-md-8"><input type="text"  data-provide="datepicker" data-date-format="dd/mm/yyyy" name="stone_makeupdate_b" value=""
                                                          class="form-control" id="stone_makeupdate_b"/>
                                                          </div>
                                                          </div><!-- end col-md-6 -->
                                                       
                                                            <div class="col-md-6">
                                                             <label class="col-md-5">碑是否做好? :</label>
                                                            <div class="col-md-6">
                                                             <div class="mt-radio-list">

                                                                                        <label class="mt-radio mt-radio-outline"> Yes
                                                                                            <input type="radio" name="stone_done_b" value="yes" checked>
                                                                                            <span></span>
                                                                                        </label>

                                                                                        <label class="mt-radio mt-radio-outline"> No
                                                                                            <input type="radio" name="stone_done_b" value="no">
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </div><!-- end mt-radio-list -->

                                                                                </div><!-- end col-md-12 -->

                                                                            </div><!-- end form-group -->
                                                                            </div>
                                                                             <div class="clearfix"></div>
                                                             <br>

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
