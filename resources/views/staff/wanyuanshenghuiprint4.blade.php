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
    <?php
    define("MEDIAWIKI_PATH", __DIR__."/../../../public/mediawiki/mediawiki-1.23.9");
    require_once  __DIR__."/../../../public/mediawiki/mediawiki-zhconverter.inc.php";
    ?>
</head>
<body style='margin-right:0px;'>
  @foreach($wanyuanshenghuis as $wanyuanshenghui)
  <div style='float:left;'>
<div style='border-top:1px solid; border-right:1px solid;border-bottom:1px solid;line-height:1.1;margin:auto;width:155px;height:492.35px;text-align:center;font-family:LISU;font-weight:BOLD;font-size:36px;'> 丁<span style='font-size:30px'>{{ $wanyuanshenghui->block_no }}</span>
<br>
<div style='margin-top:12px;height:340px;'>
      @if(count($wanyuanshenghui->lines) == 3 )
 <div style='float:right;width:53px;'><div style='width:53px;'>&emsp;</div><div style='width:53px;'>&emsp;</div><?php echo MediaWikiZhConverter::convert(preg_replace("/\\s+/iu","", $wanyuanshenghui->lines[0]), "zh-hk"); ?></div>
 <div style='float:right;width:53px;'><?php echo MediaWikiZhConverter::convert(preg_replace("/\\s+/iu","", $wanyuanshenghui->lines[1]), "zh-hk"); ?></div>
<div style='width:53px;'><div style='width:53px;'>&emsp;</div><div style='width:53px;'>&emsp;</div><?php echo MediaWikiZhConverter::convert(preg_replace("/\\s+/iu","", $wanyuanshenghui->lines[2]), "zh-hk"); ?></div>
@elseif(count($wanyuanshenghui->lines) == 2 )
@if (strpos($wanyuanshenghui->lines[1], '历代祖先') !== FALSE)
<div style='margin-right:26.5px;float:right;width:53px;'><div style='width:53px;'>&emsp;</div><div style='width:53px;'>&emsp;</div><?php echo MediaWikiZhConverter::convert(preg_replace("/\\s+/iu","", $wanyuanshenghui->lines[0]), "zh-hk"); ?></div>
@else
<div style='margin-right:26.5px;float:right;width:53px;'><?php echo MediaWikiZhConverter::convert(preg_replace("/\\s+/iu","", $wanyuanshenghui->lines[0]), "zh-hk"); ?></div>
@endif
@if (strpos($wanyuanshenghui->lines[0], '历代祖先') !== FALSE)
<div style='margin-left:26.5px;width:53px;'><div style='width:53px;'>&emsp;</div><div style='width:53px;'>&emsp;</div><?php echo MediaWikiZhConverter::convert(reg_replace("/\\s+/iu","", $wanyuanshenghui->lines[1]), "zh-hk"); ?></div>
@else
<div style='margin-left:26.5px;width:53px;'><?php echo MediaWikiZhConverter::convert(preg_replace("/\\s+/iu","", $wanyuanshenghui->lines[1]), "zh-hk"); ?></div>
@endif
<div style='margin:auto;width:53px;'></div>
 @else
 <div style='float:right;width:53px;'><div style='width:53px;'>&emsp;</div><div style='width:53px;'>&emsp;</div></div>
 <div style='float:right;width:53px;'><?php echo MediaWikiZhConverter::convert(preg_replace("/\\s+/iu","", $wanyuanshenghui->lines[0]), "zh-hk"); ?></div>
<div style='width:53px;'><div style='width:53px;'>&emsp;</div><div style='width:53px;'>&emsp;</div></div>
@endif
 </div>
  <div style='text-align:center;margin:auto;width:53px;'>靈位</div>
 </div>
 <div style='width:155;height:40px;line-height:1.1;margin:auto;'><div style='width:53px;'>&emsp;</div></div>
</div>
 @endforeach


</body>
<script type="text/javascript">
      window.onload = function() { window.print(); }
 </script>
