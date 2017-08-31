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

		@page { size: A5 landscape }
	</style>

</head>
<body class="A5 landscape">

	<section class="sheet padding-5mm">

	    <!-- Write HTML just like a web page -->

			<header>

			</header>

			<article>
			<div style='text-align:center;font-size:28px;letter-spacing: 6px;'> 廣惠肇碧山亭 </div>
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
							<div class="label-right">{{ $receipt[0]->address_street }}</div><!-- end label-right -->
						</div><!-- end label-wrapper -->

										</div>

					<div class="receipt-list">
					<div style='    border-style: solid;'>
					<div style='padding-left:12px;'><h4>神主牌: 12 - 12 - 144 </h4></div>
					</div>
						<br />

						<div class="receipt-info">
							
							<div class="label-wrapper">
								<div class="label">价格 : S$ 1000</div><!-- end label -->
							</div><!-- end label-wrapper -->
							<div class="label-wrapper">
								<div class="label">GST : S$ 70</div><!-- end label -->
							</div><!-- end label-wrapper -->
							<div class="label-wrapper">
								<div class="label">合计 : S$ 1070</div><!-- end label -->
							</div><!-- end label-wrapper -->
							<div class="label-wrapper">
								<div class="label">付款方式: {{ $generaldonation->mode_payment }}</div><!-- end label -->
							</div><!-- end label-wrapper -->

						</div><!-- end receipt-info -->

					</div><!-- end receipt-list -->

				</div><!-- end leftcontent -->

				<div id="rightcontent">
				<div class="label-wrapper" style='font-size:12px;'> 50.Kampong San Teng(Bishan Lane)<br> Singapore 576498 <br> Tel:6256 2426 Fax:6256 3826 <br> Website:www.kwspecksantheng.com <br>GST.REG NO: M9-0007586-P</div>
<div class="label-wrapper">
							<div class="label-left">Transaction No :</div><!-- end label-left -->
							<div class="label-right">{{ $receipt[0]->trans_no }}</div><!-- end label-right -->
						</div><!-- end label-wrapper -->

						<div class="label-wrapper">
							<div class="label-left">Receipt Date :</div><!-- end label-left -->
							<div class="label-right">{{ \Carbon\Carbon::parse($receipt[0]->trans_date)->format("d/m/Y") }}</div><!-- end label-right -->
						</div><!-- end label-wrapper -->
					

				</div><!-- end rightcontent -->
			</article>

	  </section>

</body>
</html>

<script type="text/javascript">

		window.print();

</script>
