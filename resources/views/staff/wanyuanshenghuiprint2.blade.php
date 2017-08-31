<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>

    <meta charset="utf-8" />
    <title>Metronic Admin Theme #1 | Blank Page Layout</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #1 for blank page layout" name="description" />
    <meta content="" name="author" />


    <link href="{{ asset('/css/LISU.css') }}" rel="stylesheet" type="text/css" />

</head>
<body style='margin:0px;'>
    @foreach($wanyuanshenghuis as $wanyuanshenghui)
  <div style='float:left;'>
   <div style='border-top:1px solid;border-right:1px solid;border-bottom:1px solid;line-height:1.2;margin:auto;width:263px;height:915.6px;text-align:center;font-family:LISU;font-weight:BOLD;font-size:64px;'>乙{{ $wanyuanshenghui->block_no }}
   <br>
     <div style='margin-top:12px;'>
         @if(count($wanyuanshenghui->lines) == 3 )
    <div style='float:right;width:88.33px;'><div style='width:88.33px;'>&emsp;</div><div style='width:88.33px;'>&emsp;</div>{{ preg_replace("/\\s+/iu","", $wanyuanshenghui->lines[0]) }}</div>
    <div style='float:right;width:88.33px;'>{{ preg_replace("/\\s+/iu","", $wanyuanshenghui->lines[1]) }}灵位</div>
   <div style='width:88.33px;'><div style='width:88.33px;'>&emsp;</div><div style='width:88.33px;'>&emsp;</div>{{ preg_replace("/\\s+/iu","", $wanyuanshenghui->lines[2]) }}</div>
   @elseif(count($wanyuanshenghui->lines) == 2 )
   @if (strpos($wanyuanshenghui->lines[1], '历代祖先') !== FALSE)
<div style='margin-right:44px;float:right;width:88.33px;'><div style='width:88.33px;'>&emsp;</div><div style='width:88.33px;'>&emsp;</div>{{ preg_replace("/\\s+/iu","", $wanyuanshenghui->lines[0]) }}</div>
@else
<div style='margin-right:44px;float:right;width:88.33px;'>{{ preg_replace("/\\s+/iu","", $wanyuanshenghui->lines[0]) }}</div>
@endif
@if (strpos($wanyuanshenghui->lines[0], '历代祖先') !== FALSE)
<div style='margin-left:44px;width:88.33px;'><div style='width:88.33px;'>&emsp;</div><div style='width:88.33px;'>&emsp;</div>{{ preg_replace("/\\s+/iu","", $wanyuanshenghui->lines[1]) }}</div>
@else
<div style='margin-left:44px;width:88.33px;'>{{ preg_replace("/\\s+/iu","", $wanyuanshenghui->lines[1]) }}</div>
@endif
   <div style='margin:auto;width:88.33px;'>灵位</div>
  @else
      <div style='float:right;width:88.33px;'><div style='width:88.33px;'>&emsp;</div><div style='width:88.33px;'>&emsp;</div></div>
      <div style='float:right;width:88.33px;'>{{ preg_replace("/\\s+/iu","", $wanyuanshenghui->lines[0]) }}灵位</div>
     <div style='width:88.33px;'><div style='width:88.33px;'>&emsp;</div><div style='width:87.33px;'>&emsp;</div></div>
    @endif
    </div>
    </div>
    <div style='width:263;height:125px;line-height:1.2;margin:auto;font-size:59px'><div style='width:88.33px;'>&emsp;</div></div>
  </div>
    @endforeach

</body>
<script type="text/javascript">
      window.onload = function() { window.print(); }
 </script>
