<!DOCTYPE html>
<html>
<head>
	<title>Receipt Print Preview</title>

	<link href="{{ asset('/css/normalize.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('/css/paper.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('/css/print.css') }}" rel="stylesheet" type="text/css" />

	<style type="text/css">
		.right{
			text-align: right;
		}

		@page { size: A4  }
	</style>

</head>
<body class="A4">

	<section class="sheet padding-5mm">

	    <!-- Write HTML just like a web page -->

			<header>

			</header>


			<div style='text-align:center;font-size:40px;letter-spacing: 10px;'> 廣惠肇碧山亭 </div>
<div style='text-align:center;padding-top:5px;'> SINGAPORE KWONG WAI SIEW PECK SAN THENG </div>
				<div id="leftcontent">

					<div class="receipt-info">
						<br><br>
					<div style='font-size:16px;'>	正式收据（OFFICIAL RECEIPT)</div>
					<br>
						Received From(兹收到):
						<br><br>
						<div class="label-wrapper">
							<div class="label-left">主家姓名(中文) :</div><!-- end label-left -->
							<div class="label-right">{{ $receipt[0]->chinese_name }} </div><!-- end label-right -->
						</div><!-- end label-wrapper -->
						<div class="label-wrapper">
							<div class="label-left">英文姓名(中文) :</div><!-- end label-left -->
							<div class="label-right">{{ $receipt[0]->english_name }}</div><!-- end label-right -->
						</div><!-- end label-wrapper -->
							<div class="label-wrapper">
							<div class="label-left">IC:</div><!-- end label-left -->
							<div class="label-right">{{ $receipt[0]->nric }}</div><!-- end label-right -->
						</div><!-- end label-wrapper -->
						<div class="label-wrapper">
							<div class="label-left">电话号码:</div><!-- end label-left -->
							<div class="label-right">{{ $receipt[0]->contact }}</div><!-- end label-right -->
						</div><!-- end label-wrapper -->
						<div class="label-wrapper">
							<div class="label-left">地址 :</div><!-- end label-left -->
							<div class="label-right">					{{ $receipt[0]->address_houseno }}, #{{ $receipt[0]->address_unit1 }}-{{ $receipt[0]->address_unit2 }}, {{ $receipt[0]->address_street }}, {{ $receipt[0]->address_postal }}</div><!-- end label-right -->
						</div><!-- end label-wrapper -->


										</div>



				</div><!-- end leftcontent -->

				<div id="rightcontent">
				<div class="label-wrapper" style='font-size:12px;'> 50.Kampong San Teng(Bishan Lane)<br> Singapore 576498 <br> Tel:6256 2426 Fax:6256 3826 <br> Website:www.kwspecksantheng.com <br>GST.REG NO: M9-0007586-P</div>
<div class="label-wrapper">
							<div class="label-left">Transaction No :</div><!-- end label-left -->
							<div class="label-right">{{ $receipt[0]->description }}</div><!-- end label-right -->
						</div><!-- end label-wrapper -->

						<div class="label-wrapper">
							<div class="label-left">Receipt Date :</div><!-- end label-left -->
							<div class="label-right">{{ \Carbon\Carbon::parse($receipt[0]->trans_date)->format("d/m/Y") }}</div><!-- end label-right -->
						</div><!-- end label-wrapper -->


				</div><!-- end rightcontent -->

				<div id="centrecontent" style='    border-style: solid;'>
				<div style='padding-left:12px;'><h4>{{ $receipt[0]->description }} </h4>
					<br><span>神主牌名称：{{ $receipt[0]->name }} </span>
						<br><span>神主牌类型: @if($receipt[0]->type == '0')
							入主
							@else
							全家
							@endif
						 </span>
							<br><span>入主选项 : @if($receipt[0]->entermastertype == '0')
								字
								@else
								相片
								@endif
							 </span>
								<br><span>神主牌是否做好? :  @if($receipt[0]->done == '0')
									字
									@else
									相片
									@endif</span>
					<br><span>{!! $receipt[0]->otheroption_text !!} </span></div>
				</div>
				<div class="receipt-list">

					<br />

					<div class="receipt-info">

						<div class="label-wrapper">
							<div class="label">价格 : S$ {{$receipt[0]->total }}</div><!-- end label -->
						</div><!-- end label-wrapper -->
						<div class="label-wrapper">
							<div class="label">GST : S$ {{$receipt[0]->total_gst }}</div><!-- end label -->
						</div><!-- end label-wrapper -->
						<div class="label-wrapper">
							<div class="label">合计 : S$ {{$receipt[0]->total_aftergst }}</div><!-- end label -->
						</div><!-- end label-wrapper -->
						@if($receipt[0]->total_afterdiscount > 0)
						<div class="label-wrapper">
							<div class="label">会馆折扣后 : S$ {{$receipt[0]->total_afterdiscount }}</div><!-- end label -->
						</div><!-- end label-wrapper -->
						@endif
						<div class="label-wrapper">
							<div class="label">付款方式: {{ $receipt[0]->mode_payment }}</div><!-- end label -->
						</div><!-- end label-wrapper -->

					</div><!-- end receipt-info -->
				</div><!-- end receipt-list -->
				<div id="bottomcontent">
				<div style='padding-left:12px;'>总务：曾守荣 &nbsp;  财政: 莫佐生  &nbsp; 经办人:{{ $receipt[0]->first_name }}{{ $receipt[0]->last_name }}</div>
				</div>


     <div>

		 </div>

	  </section>

</body>
</html>

<script type="text/javascript">

		window.print();

</script>
