
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
<body  style='margin:0px;'>
  @foreach($wanyuanshenghuis as $wanyuanshenghui)
 <div style='float:left;border-right:1px solid;line-height:1.1;margin:auto;width:395px;height:970px;text-align:center;font-family:LISU;font-weight:BOLD;font-size:72px;'>甲<span style='font-size:64px'>{{ $wanyuanshenghui->block_no }}</span>
 <br><br>
    <div style='height:670px;'>
  @if(count($wanyuanshenghui->lines) == 3 )
  <div style='float:right;width:131.67px;'><div style='width:131.67px;'>&emsp;</div><div style='width:131.67px;'>&emsp;</div>
  <?php echo MediaWikiZhConverter::convert(preg_replace("/\\s+/iu","", $wanyuanshenghui->lines[0]), "zh-hk"); ?></div>
  <div style='float:right;width:131.67px;'><?php echo MediaWikiZhConverter::convert(preg_replace("/\\s+/iu","", $wanyuanshenghui->lines[1]), "zh-hk"); ?></div>
 <div style='width:131.67px;'><div style='width:131.67px;'>&emsp;</div><div style='width:131.67px;'>&emsp;</div><?php echo MediaWikiZhConverter::convert(preg_replace("/\\s+/iu","", $wanyuanshenghui->lines[2]), "zh-hk"); ?></div>
 @elseif(count($wanyuanshenghui->lines) == 2 )
 @if (strpos($wanyuanshenghui->lines[1], '历代祖先') !== FALSE)
<div style='margin-right:65px;float:right;width:131.67px;'><div style='width:131.67px;'>&emsp;</div><div style='width:131.67px;'>&emsp;</div><?php echo MediaWikiZhConverter::convert(preg_replace("/\\s+/iu","", $wanyuanshenghui->lines[0]), "zh-hk"); ?></div>
@else
<div style='margin-right:65px;float:right;width:131.67px;'><?php echo MediaWikiZhConverter::convert(preg_replace("/\\s+/iu","", $wanyuanshenghui->lines[0]), "zh-hk"); ?></div>
@endif
@if (strpos($wanyuanshenghui->lines[0], '历代祖先') !== FALSE)
<div style='margin-left:65px;width:131.67px;'><div style='width:131.67px;'>&emsp;</div><div style='width:131.67px;'>&emsp;</div><?php echo MediaWikiZhConverter::convert(preg_replace("/\\s+/iu","", $wanyuanshenghui->lines[1]), "zh-hk"); ?></div>
@else
<div style='margin-left:65px;width:131.67px;'><?php echo MediaWikiZhConverter::convert(preg_replace("/\\s+/iu","", $wanyuanshenghui->lines[1]), "zh-hk"); ?></div>
@endif

@else
 <div style='float:right;width:131.67px;'><div style='width:131.67px;'>&emsp;</div><div style='width:131.67px;'>&emsp;</div></div>
 <div style='float:right;width:131.67px;'><?php echo MediaWikiZhConverter::convert(preg_replace("/\\s+/iu","", $wanyuanshenghui->lines[0]), "zh-hk"); ?></div>
 <div style='width:131.67px;'><div style='width:131.67px;'>&emsp;</div><div style='width:131.67px;'>&emsp;</div></div>

 @endif
 </div>
 <div style='margin:auto;width:131.67px;'>靈位</div>
  </div>
  @endforeach
</body>
<script type="text/javascript">
      window.onload = function() { window.print(); }
 </script>
