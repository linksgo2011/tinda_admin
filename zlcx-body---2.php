<?php
	require_once("include/global.php");
	$username=$_COOKIE["username"];
	$dl_date=$_COOKIE["dl_date"];
	
	if($username=="" or $dl_date==""){
          setcookie("username","" , time()-365*24*60*60); 
          setcookie("dl_date","" , time()-365*24*60*60); 
	 	echo "<script language=javascript>alert('未登录或登录超时！请返回，重新登录，谢谢!');window.top.location.href='index.php'</script>";
	    die();
	}
	$sql="select * from feedbackinfo where title='".$username."' and dl_date='".$dl_date."'";
	$rs=mysql_query($sql);
	$rowsT=mysql_fetch_assoc($rs);

	if($username<>"" and $dl_date<>"" and $rowsT["id"]==""){
          setcookie("username","" , time()-365*24*60*60); 
          setcookie("dl_date","" , time()-365*24*60*60); 
	 	echo "<script language=javascript>alert('您的帐号已在另处登录，被强制下线!');window.top.location.href='index.php'</script>";
	    die();
    }
    
	$l_date1=date("Y-m-d");
	if(strtotime($rowsT["end_date"])<strtotime($l_date1)){
          setcookie("username","" , time()-365*24*60*60); 
          setcookie("dl_date","" , time()-365*24*60*60); 
	 	echo "<script language=javascript>alert('您的帐号已过期，请联系您的服务商!');window.top.location.href='index.php'</script>";
	    die();
    }

if($_GET["exid"]=="exit"){
 setcookie("username", $count['title'], time()+365*24*60*60); 
 setcookie("dl_date", $l_date, time()+365*24*60*60); 
 echo "<script language=javascript>window.top.location.href='index.php'</script>";
}
$finlID=$_GET['Aid'];
	$sqlA="select * from finl where id='".$finlID."'";
	$rsA=mysql_query($sqlA);
	$rowsA=mysql_fetch_assoc($rsA);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>腾达APP</title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="css/hcwh.min.css" type="text/css" />
<link rel="stylesheet" href="css/app.css" type="text/css" />
<link rel=File-List href="sangtana.files/filelist.xml">
<link rel=Edit-Time-Data href="sangtana.files/editdata.mso">
<link rel=themeData href="sangtana.files/themedata.thmx">
<link rel=colorSchemeMapping href="sangtana.files/colorschememapping.xml">
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:宋体;
	panose-1:2 1 6 0 3 1 1 1 1 1;
	mso-font-alt:SimSun;
	mso-font-charset:134;
	mso-generic-font-family:auto;
	mso-font-pitch:variable;
	mso-font-signature:3 680460288 22 0 262145 0;}
@font-face
	{font-family:"Cambria Math";
	panose-1:0 0 0 0 0 0 0 0 0 0;
	mso-font-charset:1;
	mso-generic-font-family:roman;
	mso-font-format:other;
	mso-font-pitch:variable;
	mso-font-signature:0 0 0 0 0 0;}
@font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-536870145 1073786111 1 0 415 0;}
@font-face
	{font-family:"\@宋体";
	panose-1:2 1 6 0 3 1 1 1 1 1;
	mso-font-charset:134;
	mso-generic-font-family:auto;
	mso-font-pitch:variable;
	mso-font-signature:3 680460288 22 0 262145 0;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:"";
	margin:0cm;
	margin-bottom:.0001pt;
	text-align:justify;
	text-justify:inter-ideograph;
	mso-pagination:none;
	font-size:10.5pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Times New Roman","serif";
	mso-fareast-font-family:宋体;
	mso-font-kerning:1.0pt;}
p.MsoHeader, li.MsoHeader, div.MsoHeader
	{mso-style-unhide:no;
	mso-style-link:"页眉 Char";
	margin:0cm;
	margin-bottom:.0001pt;
	text-align:center;
	mso-pagination:none;
	tab-stops:center 207.65pt right 415.3pt;
	layout-grid-mode:char;
	border:none;
	mso-border-bottom-alt:solid windowtext .75pt;
	padding:0cm;
	mso-padding-alt:0cm 0cm 1.0pt 0cm;
	font-size:9.0pt;
	font-family:"Times New Roman","serif";
	mso-fareast-font-family:宋体;
	mso-font-kerning:1.0pt;}
p.MsoFooter, li.MsoFooter, div.MsoFooter
	{mso-style-unhide:no;
	mso-style-link:"页脚 Char";
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:none;
	tab-stops:center 207.65pt right 415.3pt;
	layout-grid-mode:char;
	font-size:9.0pt;
	font-family:"Times New Roman","serif";
	mso-fareast-font-family:宋体;
	mso-font-kerning:1.0pt;}
p.MsoAcetate, li.MsoAcetate, div.MsoAcetate
	{mso-style-unhide:no;
	mso-style-link:"批注框文本 Char";
	margin:0cm;
	margin-bottom:.0001pt;
	text-align:justify;
	text-justify:inter-ideograph;
	mso-pagination:none;
	font-size:9.0pt;
	font-family:"Times New Roman","serif";
	mso-fareast-font-family:宋体;
	mso-font-kerning:1.0pt;}
span.Char
	{mso-style-name:"页眉 Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:页眉;
	mso-ansi-font-size:9.0pt;
	mso-bidi-font-size:9.0pt;
	font-family:宋体;
	mso-ascii-font-family:宋体;
	mso-fareast-font-family:宋体;
	mso-hansi-font-family:宋体;
	mso-font-kerning:1.0pt;}
span.Char0
	{mso-style-name:"页脚 Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:页脚;
	mso-ansi-font-size:9.0pt;
	mso-bidi-font-size:9.0pt;
	font-family:宋体;
	mso-ascii-font-family:宋体;
	mso-fareast-font-family:宋体;
	mso-hansi-font-family:宋体;
	mso-font-kerning:1.0pt;}
span.Char1
	{mso-style-name:"批注框文本 Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:批注框文本;
	mso-ansi-font-size:9.0pt;
	mso-bidi-font-size:9.0pt;
	font-family:宋体;
	mso-ascii-font-family:宋体;
	mso-fareast-font-family:宋体;
	mso-hansi-font-family:宋体;
	mso-font-kerning:1.0pt;}
p.ListParagraph, li.ListParagraph, div.ListParagraph
	{mso-style-name:"List Paragraph";
	mso-style-unhide:no;
	margin:0cm;
	margin-bottom:.0001pt;
	text-align:justify;
	text-justify:inter-ideograph;
	text-indent:21.0pt;
	mso-char-indent-count:2.0;
	mso-pagination:none;
	font-size:10.5pt;
	mso-bidi-font-size:11.0pt;
	font-family:"Calibri","sans-serif";
	mso-fareast-font-family:宋体;
	mso-bidi-font-family:"Times New Roman";
	mso-font-kerning:1.0pt;}
.MsoChpDefault
	{mso-style-type:export-only;
	mso-default-props:yes;
	font-size:10.0pt;
	mso-ansi-font-size:10.0pt;
	mso-bidi-font-size:10.0pt;
	mso-ascii-font-family:"Times New Roman";
	mso-hansi-font-family:"Times New Roman";
	mso-font-kerning:0pt;}
 /* Page Definitions */
 @page
	{mso-page-border-surround-header:no;
	mso-page-border-surround-footer:no;
	mso-footnote-separator:url("sangtana.files/header.htm") fs;
	mso-footnote-continuation-separator:url("sangtana.files/header.htm") fcs;
	mso-endnote-separator:url("sangtana.files/header.htm") es;
	mso-endnote-continuation-separator:url("sangtana.files/header.htm") ecs;}
@page WordSection1
	{size:595.3pt 841.9pt;
	margin:72.0pt 262.5pt 72.0pt 89.85pt;
	mso-header-margin:42.55pt;
	mso-footer-margin:49.6pt;
	mso-paper-source:0;
	layout-grid:15.6pt;}
div.WordSection1
	{page:WordSection1;}
 /* List Definitions */
 @list l0
	{mso-list-id:2037386575;
	mso-list-type:hybrid;
	mso-list-template-ids:416994598 1014518412 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l0:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:18.0pt;
	text-indent:-18.0pt;
	mso-bidi-font-family:"Times New Roman";}
@list l0:level2
	{mso-level-tab-stop:72.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l0:level3
	{mso-level-tab-stop:108.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l0:level4
	{mso-level-tab-stop:144.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l0:level5
	{mso-level-tab-stop:180.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l0:level6
	{mso-level-tab-stop:216.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l0:level7
	{mso-level-tab-stop:252.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l0:level8
	{mso-level-tab-stop:288.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
@list l0:level9
	{mso-level-tab-stop:324.0pt;
	mso-level-number-position:left;
	text-indent:-18.0pt;}
ol
	{margin-bottom:0cm;}
ul
	{margin-bottom:0cm;}
-->
</style>
</head>
<body>
<header data-am-widget="header" class="am-header am-header-default am-no-layout ft-header">
  <div class="logo"><b>腾达汽车资料咨询平台</b></div>
</header>
<div style="height: 60px;"></div>
<div style="background: #cfcfcf;height:40px;line-height:40px;text-align:center;"><span style="float: left;margin-left:10px;"><a href="javascript:history.back(-1)"><i class="am-icon-reply"></i>返回</a></span><b style="font-size:16px;margin-left:-12%;"><?php echo $rowsA["name"]?></b></div>
<div style="height: 20px;"></div>
<p style="height:25px;font-size:12px;margin-top:-10px;margin-left:10px;"><b><span style="color:#FF0000;">公告&nbsp;<i class="am-icon-volume-up"></i>：</span><a href="#" style="color:#ff0000;">现在正在直播宝马CAS4+全丢现场匹配，点击进入观看......</a></b></p>
<div class="jianju"></div>
<!----------body----------->

<div class=WordSection1 style='layout-grid:15.6pt'>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0 align=left
 width=1044 style='width:783.0pt;border-collapse:collapse;border:none;
 mso-border-alt:solid windowtext .5pt;mso-yfti-tbllook:480;mso-table-lspace:
 9.0pt;margin-left:6.75pt;mso-table-rspace:9.0pt;margin-right:6.75pt;
 mso-table-anchor-vertical:page;mso-table-anchor-horizontal:margin;mso-table-left:
 left;mso-table-top:.05pt;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:21.8pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;tab-stops:32.25pt;
  mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:around;
  mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:.05pt;mso-height-rule:exactly'><b style='mso-bidi-font-weight:
  normal'><span style='font-family:宋体;mso-ascii-font-family:"Times New Roman";
  mso-hansi-font-family:"Times New Roman"'>详细车型</span><span lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:blue'>桑塔纳</span><span lang=EN-US style='color:blue'>2000.3000</span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-family:宋体;mso-ascii-font-family:
  "Times New Roman";mso-hansi-font-family:"Times New Roman";color:blue'>型</span><span
  lang=EN-US style='color:blue'><o:p></o:p></span></b></p>
  </td>
  <td width=179 valign=top style='width:134.6pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:#FF6600'>桑塔纳志俊，新普桑</span><span lang=EN-US style='color:#FF6600'><o:p></o:p></span></b></p>
  </td>
  <td width=192 valign=top style='width:144.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:fuchsia'>新桑塔纳</span><span lang=EN-US style='color:fuchsia'><o:p></o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;height:22.75pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman"'>年份</span><span
  lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:blue'>09</span></b><b style='mso-bidi-font-weight:normal'><span
  style='font-family:宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:
  "Times New Roman";color:blue'>年前</span><span lang=EN-US style='color:blue'><o:p></o:p></span></b></p>
  </td>
  <td width=179 valign=top style='width:134.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#FF6600'>09</span></b><b style='mso-bidi-font-weight:normal'><span
  style='font-family:宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:
  "Times New Roman";color:#FF6600'>年后</span><span lang=EN-US style='color:#FF6600'><o:p></o:p></span></b></p>
  </td>
  <td width=192 valign=top style='width:144.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:fuchsia'>2013</span></b><b style='mso-bidi-font-weight:normal'><span
  style='font-family:宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:
  "Times New Roman";color:fuchsia'>年后</span><span lang=EN-US style='color:fuchsia'><o:p></o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;height:21.8pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman"'>芯片型号</span><span
  lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:blue'>48<o:p></o:p></span></b></p>
  </td>
  <td width=179 valign=top style='width:134.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#FF6600'>44</span></b><b style='mso-bidi-font-weight:normal'><span
  style='font-family:宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:
  "Times New Roman";color:#FF6600'>芯片</span><span lang=EN-US style='color:#FF6600'><o:p></o:p></span></b></p>
  </td>
  <td width=192 valign=top style='width:144.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:fuchsia'>48</span></b><b style='mso-bidi-font-weight:normal'><span
  style='font-family:宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:
  "Times New Roman";color:fuchsia'>芯片</span><span lang=EN-US style='color:fuchsia'><o:p></o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3;height:21.8pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman"'>芯片是否可拷贝</span><span
  lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:blue'>否</span><span lang=EN-US style='color:blue'><o:p></o:p></span></b></p>
  </td>
  <td width=179 valign=top style='width:134.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:#FF6600'>否</span><span lang=EN-US style='color:#FF6600'><o:p></o:p></span></b></p>
  </td>
  <td width=192 valign=top style='width:144.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:fuchsia'>否</span><span lang=EN-US style='color:fuchsia'><o:p></o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4;height:21.8pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman"'>芯片是否专用</span><span
  lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:blue'>否</span><span style='color:blue'> </span></b><b style='mso-bidi-font-weight:
  normal'><span style='font-family:宋体;mso-ascii-font-family:"Times New Roman";
  mso-hansi-font-family:"Times New Roman";color:blue'>普通</span><span
  lang=EN-US style='color:blue'>48</span></b><b style='mso-bidi-font-weight:
  normal'><span style='font-family:宋体;mso-ascii-font-family:"Times New Roman";
  mso-hansi-font-family:"Times New Roman";color:blue'>芯片</span><span
  lang=EN-US style='color:blue'><o:p></o:p></span></b></p>
  </td>
  <td width=179 valign=top style='width:134.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:#FF6600'>是</span><span style='color:#FF6600'> </span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-family:宋体;mso-ascii-font-family:
  "Times New Roman";mso-hansi-font-family:"Times New Roman";color:#FF6600'>专用（可生成）</span><span
  lang=EN-US style='color:#FF6600'><o:p></o:p></span></b></p>
  </td>
  <td width=192 valign=top style='width:144.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:fuchsia'>是</span><span style='color:fuchsia'> </span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-family:宋体;mso-ascii-font-family:
  "Times New Roman";mso-hansi-font-family:"Times New Roman";color:fuchsia'>专用（可生成）</span><span
  lang=EN-US style='color:fuchsia'><o:p></o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5;height:22.75pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman"'>是否需要密码</span><span
  lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:blue'>是</span><span style='color:blue'> </span></b><b style='mso-bidi-font-weight:
  normal'><span style='font-family:宋体;mso-ascii-font-family:"Times New Roman";
  mso-hansi-font-family:"Times New Roman";color:blue'>匹配需要密码</span><span
  lang=EN-US style='color:blue'><o:p></o:p></span></b></p>
  </td>
  <td width=179 valign=top style='width:134.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:#FF6600'>是</span><span style='color:#FF6600'> </span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-family:宋体;mso-ascii-font-family:
  "Times New Roman";mso-hansi-font-family:"Times New Roman";color:#FF6600'>匹配需要密码</span><span
  lang=EN-US style='color:#FF6600'><o:p></o:p></span></b></p>
  </td>
  <td width=192 valign=top style='width:144.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:fuchsia'>是</span><span style='color:fuchsia'> </span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-family:宋体;mso-ascii-font-family:
  "Times New Roman";mso-hansi-font-family:"Times New Roman";color:fuchsia'>匹配需要密码</span><span
  lang=EN-US style='color:fuchsia'><o:p></o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6;height:21.8pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman"'>代码获取方法</span><span
  lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:blue'>设备进防盗盒读取</span><span lang=EN-US style='color:blue'><o:p></o:p></span></b></p>
  </td>
  <td width=179 valign=top style='width:134.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:#FF6600'>设备进防盗盒读取或拆读</span><span lang=EN-US style='color:#FF6600'><o:p></o:p></span></b></p>
  </td>
  <td width=192 valign=top style='width:144.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:fuchsia'>大众四代</span><span lang=EN-US style='color:fuchsia'>35XXX</span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-family:宋体;mso-ascii-font-family:
  "Times New Roman";mso-hansi-font-family:"Times New Roman";color:fuchsia'>仪表</span><span
  lang=EN-US style='color:fuchsia'><o:p></o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7;height:21.8pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman"'>是否拆读</span><span
  lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:blue'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=179 valign=top style='width:134.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:#FF6600'>大部分车需要拆读</span><span lang=EN-US style='color:#FF6600'><o:p></o:p></span></b></p>
  </td>
  <td width=192 valign=top style='width:144.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:fuchsia'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8;height:21.8pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman"'>拆读器件</span><span
  lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><span lang=EN-US><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=179 valign=top style='width:134.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:#FF6600'>防盗盒</span><span lang=EN-US style='color:#FF6600'><o:p></o:p></span></b></p>
  </td>
  <td width=192 valign=top style='width:144.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:fuchsia'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9;height:22.75pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman"'>器件位置</span><span
  lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><span lang=EN-US><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=179 valign=top style='width:134.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:#FF6600'>方向盘下</span><span lang=EN-US style='color:#FF6600'><o:p></o:p></span></b></p>
  </td>
  <td width=192 valign=top style='width:144.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:fuchsia'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10;height:21.8pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman"'>码片型号</span><span
  lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><span lang=EN-US><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=179 valign=top style='width:134.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><st1:chmetcnv TCSC="0" NumberType="1" Negative="False" HasSpace="False" SourceValue="24" UnitName="C" w:st="on"><b
  style='mso-bidi-font-weight:normal'><span lang=EN-US style='color:#FF6600'>24C</st1:chmetcnv>04<o:p></o:p></span></b></p>
  </td>
  <td width=192 valign=top style='width:144.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:fuchsia'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:11;height:21.8pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman"'>匹配设备</span><span
  lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:blue'>调码王</span><span lang=EN-US style='color:blue'> 5053 i80 PAD</span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-family:宋体;mso-ascii-font-family:
  "Times New Roman";mso-hansi-font-family:"Times New Roman";color:blue'>等一些支持的设备</span><span
  lang=EN-US style='color:blue'><o:p></o:p></span></b></p>
  </td>
  <td width=179 valign=top style='width:134.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:#FF6600'>调码王</span><span lang=EN-US style='color:#FF6600'> 5053 i80 PAD</span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-family:宋体;mso-ascii-font-family:
  "Times New Roman";mso-hansi-font-family:"Times New Roman";color:#FF6600'>等一些支持的设备</span><span
  lang=EN-US style='color:#FF6600'><o:p></o:p></span></b></p>
  </td>
  <td width=192 valign=top style='width:144.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:fuchsia'>AP </span></b><b style='mso-bidi-font-weight:normal'><span
  style='font-family:宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:
  "Times New Roman";color:fuchsia'>双马</span><span style='color:fuchsia'> </span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-family:宋体;mso-ascii-font-family:
  "Times New Roman";mso-hansi-font-family:"Times New Roman";color:fuchsia'>阿福迪等一些支持的设备</span><span
  lang=EN-US style='color:fuchsia'><o:p></o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12;height:21.8pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman"'>推荐设备</span><span
  lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:blue'>无特殊要求</span><span lang=EN-US style='color:blue'><o:p></o:p></span></b></p>
  </td>
  <td width=179 valign=top style='width:134.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#FF6600'>5053<o:p></o:p></span></b></p>
  </td>
  <td width=192 valign=top style='width:144.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:fuchsia'>AP </span></b><b style='mso-bidi-font-weight:normal'><span
  style='font-family:宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:
  "Times New Roman";color:fuchsia'>比较稳定</span><span lang=EN-US
  style='color:fuchsia'><o:p></o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:13;height:21.8pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman"'>门锁与点火是否差片</span><span
  lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:blue'>否</span><span style='color:blue'> </span></b><b style='mso-bidi-font-weight:
  normal'><span style='font-family:宋体;mso-ascii-font-family:"Times New Roman";
  mso-hansi-font-family:"Times New Roman";color:blue'>门锁点火全部</span><span
  lang=EN-US style='color:blue'>10</span></b><b style='mso-bidi-font-weight:
  normal'><span style='font-family:宋体;mso-ascii-font-family:"Times New Roman";
  mso-hansi-font-family:"Times New Roman";color:blue'>个片</span><span
  lang=EN-US style='color:blue'><o:p></o:p></span></b></p>
  </td>
  <td width=179 valign=top style='width:134.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:#FF6600'>否</span><span style='color:#FF6600'> </span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-family:宋体;mso-ascii-font-family:
  "Times New Roman";mso-hansi-font-family:"Times New Roman";color:#FF6600'>门锁点火全部</span><span
  lang=EN-US style='color:#FF6600'>10</span></b><b style='mso-bidi-font-weight:
  normal'><span style='font-family:宋体;mso-ascii-font-family:"Times New Roman";
  mso-hansi-font-family:"Times New Roman";color:#FF6600'>个片</span><span
  lang=EN-US style='color:#FF6600'><o:p></o:p></span></b></p>
  </td>
  <td width=192 valign=top style='width:144.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:fuchsia'>否</span><span style='color:fuchsia'> </span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-family:宋体;mso-ascii-font-family:
  "Times New Roman";mso-hansi-font-family:"Times New Roman";color:fuchsia'>门锁点火全部</span><span
  lang=EN-US style='color:fuchsia'>8</span></b><b style='mso-bidi-font-weight:
  normal'><span style='font-family:宋体;mso-ascii-font-family:"Times New Roman";
  mso-hansi-font-family:"Times New Roman";color:fuchsia'>个片</span><span
  lang=EN-US style='color:fuchsia'><o:p></o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:14;height:22.75pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman"'>钥匙胚型号</span><span
  lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:blue'>01</span></b><b style='mso-bidi-font-weight:normal'><span
  style='font-family:宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:
  "Times New Roman";color:blue'>号</span><span lang=EN-US style='color:blue'><o:p></o:p></span></b></p>
  </td>
  <td width=179 valign=top style='width:134.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#FF6600'>01</span></b><b style='mso-bidi-font-weight:normal'><span
  style='font-family:宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:
  "Times New Roman";color:#FF6600'>号</span><span lang=EN-US style='color:#FF6600'><o:p></o:p></span></b></p>
  </td>
  <td width=192 valign=top style='width:144.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:fuchsia'>31</span></b><b style='mso-bidi-font-weight:normal'><span
  style='font-family:宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:
  "Times New Roman";color:fuchsia'>号</span><span lang=EN-US style='color:fuchsia'><o:p></o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:15;height:21.8pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman"'>方向</span><span
  lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:blue'>车头</span><span lang=EN-US style='color:blue'><o:p></o:p></span></b></p>
  </td>
  <td width=179 valign=top style='width:134.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:#FF6600'>车头</span><span lang=EN-US style='color:#FF6600'><o:p></o:p></span></b></p>
  </td>
  <td width=192 valign=top style='width:144.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:fuchsia'>车头</span><span lang=EN-US style='color:fuchsia'><o:p></o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:16;height:21.8pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman"'>工程</span><span
  lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:blue'>单勾</span><span lang=EN-US style='color:blue'> HU49 </span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-family:宋体;mso-ascii-font-family:
  "Times New Roman";mso-hansi-font-family:"Times New Roman";color:blue'>气囊</span><span
  lang=EN-US style='color:blue'><o:p></o:p></span></b></p>
  </td>
  <td width=179 valign=top style='width:134.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:#FF6600'>单勾</span><span lang=EN-US style='color:#FF6600'> HU49 </span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-family:宋体;mso-ascii-font-family:
  "Times New Roman";mso-hansi-font-family:"Times New Roman";color:#FF6600'>气囊</span><span
  lang=EN-US style='color:#FF6600'><o:p></o:p></span></b></p>
  </td>
  <td width=192 valign=top style='width:144.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:fuchsia'>单勾</span><span lang=EN-US style='color:fuchsia'> HU66<o:p></o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:17;height:21.8pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US>OBD</span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-family:宋体;mso-ascii-font-family:
  "Times New Roman";mso-hansi-font-family:"Times New Roman"'>接口位置</span><span
  lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:blue'>方向盘下或档位杆下</span><span lang=EN-US style='color:blue'><o:p></o:p></span></b></p>
  </td>
  <td width=179 valign=top style='width:134.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:#FF6600'>方向盘下</span><span lang=EN-US style='color:#FF6600'><o:p></o:p></span></b></p>
  </td>
  <td width=192 valign=top style='width:144.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:fuchsia'>方向盘下</span><span lang=EN-US style='color:fuchsia'><o:p></o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:21.8pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:18;height:22.75pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman"'>遥控钥匙类型</span><span
  lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:blue'>直板分体</span><span style='color:blue'> </span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-family:宋体;mso-ascii-font-family:
  "Times New Roman";mso-hansi-font-family:"Times New Roman";color:blue'>遥控器专用</span><span
  lang=EN-US style='color:blue'>315</span></b><b style='mso-bidi-font-weight:
  normal'><span style='font-family:宋体;mso-ascii-font-family:"Times New Roman";
  mso-hansi-font-family:"Times New Roman";color:blue'>频率</span><span
  lang=EN-US style='color:blue'> ASK</span></b><b style='mso-bidi-font-weight:
  normal'><span style='font-family:宋体;mso-ascii-font-family:"Times New Roman";
  mso-hansi-font-family:"Times New Roman";color:blue'>调频</span><span
  lang=EN-US style='color:blue'><o:p></o:p></span></b></p>
  </td>
  <td width=179 valign=top style='width:134.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:#FF6600'>直板分体</span><span style='color:#FF6600'> </span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-family:宋体;mso-ascii-font-family:
  "Times New Roman";mso-hansi-font-family:"Times New Roman";color:#FF6600'>遥控器专用</span><span
  lang=EN-US style='color:#FF6600'>315</span></b><b style='mso-bidi-font-weight:
  normal'><span style='font-family:宋体;mso-ascii-font-family:"Times New Roman";
  mso-hansi-font-family:"Times New Roman";color:#FF6600'>频率</span><span
  lang=EN-US style='color:#FF6600'> ASK</span></b><b style='mso-bidi-font-weight:
  normal'><span style='font-family:宋体;mso-ascii-font-family:"Times New Roman";
  mso-hansi-font-family:"Times New Roman";color:#FF6600'>调频</span><span
  lang=EN-US style='color:#FF6600'><o:p></o:p></span></b></p>
  </td>
  <td width=192 valign=top style='width:144.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:fuchsia'>折叠遥控</span><span lang=EN-US style='color:fuchsia'>202AD</span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-family:宋体;mso-ascii-font-family:
  "Times New Roman";mso-hansi-font-family:"Times New Roman";color:fuchsia'>型号</span><span
  lang=EN-US style='color:fuchsia'> 433</span></b><b style='mso-bidi-font-weight:
  normal'><span style='font-family:宋体;mso-ascii-font-family:"Times New Roman";
  mso-hansi-font-family:"Times New Roman";color:fuchsia'>频率</span><span
  lang=EN-US style='color:fuchsia'> ASK</span></b><b style='mso-bidi-font-weight:
  normal'><span style='font-family:宋体;mso-ascii-font-family:"Times New Roman";
  mso-hansi-font-family:"Times New Roman";color:fuchsia'>调频</span><span
  lang=EN-US style='color:fuchsia'><o:p></o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:19;height:22.75pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman"'>遥控是否可生成</span><span
  lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:blue'>是</span><span lang=EN-US style='color:blue'><o:p></o:p></span></b></p>
  </td>
  <td width=179 valign=top style='width:134.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:#FF6600'>是</span><span lang=EN-US style='color:#FF6600'><o:p></o:p></span></b></p>
  </td>
  <td width=192 valign=top style='width:144.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:fuchsia'>是</span><span lang=EN-US style='color:fuchsia'><o:p></o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:20;height:22.75pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman"'>遥控器匹配方法</span><span
  lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-wrap:auto;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-height-rule:exactly'><b style='mso-bidi-font-weight:normal'><span
  style='font-family:宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:
  "Times New Roman";color:blue'>手工匹配：车门关好上锁钥匙开关</span><span lang=EN-US
  style='color:blue'>3</span></b><b style='mso-bidi-font-weight:normal'><span
  style='font-family:宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:
  "Times New Roman";color:blue'>下按遥控即可</span><span lang=EN-US style='color:
  blue'><o:p></o:p></span></b></p>
  </td>
  <td width=179 valign=top style='width:134.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:#FF6600'>手工匹配：车门关好上锁钥匙开关</span><span lang=EN-US style='color:#FF6600'>3</span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-family:宋体;mso-ascii-font-family:
  "Times New Roman";mso-hansi-font-family:"Times New Roman";color:#FF6600'>下按遥控即可</span><span
  lang=EN-US style='color:#FF6600'><o:p></o:p></span></b></p>
  </td>
  <td width=192 valign=top style='width:144.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:fuchsia'>设备进</span><span lang=EN-US style='color:fuchsia'>09</span></b><b
  style='mso-bidi-font-weight:normal'><span style='font-family:宋体;mso-ascii-font-family:
  "Times New Roman";mso-hansi-font-family:"Times New Roman";color:fuchsia'>系统匹配</span><span
  lang=EN-US style='color:fuchsia'><o:p></o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:21;height:22.75pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;

  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman"'>市场参考价格</span><span
  lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:blue'>增加单把钥匙</span><span lang=EN-US style='color:blue'>200<o:p></o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:blue'>全丢配单把钥匙</span><span lang=EN-US style='color:blue'>500<o:p></o:p></span></b></p>
  </td>
  <td width=179 valign=top style='width:134.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:#FF6600'>增加单把钥匙</span><span lang=EN-US style='color:#FF6600'>300<o:p></o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:#FF6600'>全丢配单把钥匙</span><span lang=EN-US style='color:#FF6600'>600<o:p></o:p></span></b></p>
  </td>
  <td width=192 valign=top style='width:144.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:fuchsia'>增加单把钥匙</span><span lang=EN-US style='color:fuchsia'>500<o:p></o:p></span></b></p>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:fuchsia'>全丢配单把钥匙</span><span lang=EN-US style='color:fuchsia'>2000<o:p></o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:22;height:22.75pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman"'>注意事项</span><span
  lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:blue'>按照各类设备提示进行操作全丢和增加方法一样操作如遇到输入正确密码提示错误打开点火等</span><span lang=EN-US
  style='color:blue'>30</span></b><b style='mso-bidi-font-weight:normal'><span
  style='font-family:宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:
  "Times New Roman";color:blue'>分钟在配即可</span><span lang=EN-US style='color:
  blue'><o:p></o:p></span></b></p>
  </td>
  <td width=179 valign=top style='width:134.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:#FF6600'>按照各类设备提示进行操作全丢和增加方法一样操作如遇到输入正确密码提示错误打开点火等</span><span
  lang=EN-US style='color:#FF6600'>30</span></b><b style='mso-bidi-font-weight:
  normal'><span style='font-family:宋体;mso-ascii-font-family:"Times New Roman";
  mso-hansi-font-family:"Times New Roman";color:#FF6600'>分钟即可</span><span
  style='color:#FF6600'> </span></b><b style='mso-bidi-font-weight:normal'><span
  style='font-family:宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:
  "Times New Roman";color:#FF6600'>部分车型可以用阿福迪读取发动机电脑数据取消防盗，完事之后防盗盒拔掉即可</span><span
  lang=EN-US style='color:#FF6600'><o:p></o:p></span></b></p>
  </td>
  <td width=192 valign=top style='width:144.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:fuchsia'>大众四代防盗系统操作前先保存好数据严格按照各类设备提示操作</span><span style='color:fuchsia'>
  </span></b><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
  color:fuchsia'>增加与全丢方法不一样全丢比较复杂需要在线如遇匹配遥控进不去系统车内中控锁按一下即可</span><span
  lang=EN-US style='color:fuchsia'>.</span></b><b style='mso-bidi-font-weight:
  normal'><span style='font-family:宋体;mso-ascii-font-family:"Times New Roman";
  mso-hansi-font-family:"Times New Roman";color:fuchsia'>很多低配车型不带遥控建议安装腾达大众套装即可实现遥控功能</span><span
  lang=EN-US style='color:fuchsia'><o:p></o:p></span></b></p>
  </td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:23;mso-yfti-lastrow:yes;height:22.75pt'>
  <td width=155 valign=top style='width:116.6pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span style='font-family:
  宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman"'>数据下载</span><span
  lang=EN-US><o:p></o:p></span></b></p>
  </td>
  <td width=181 valign=top style='width:135.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'></td>
  <td width=179 valign=top style='width:134.6pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'></td>
  <td width=192 valign=top style='width:144.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'></td>
  <td width=168 valign=top style='width:126.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:#339966'><o:p>&nbsp;</o:p></span></b></p>
  </td>
  <td width=169 valign=top style='width:126.4pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:22.75pt'>
  <p class=MsoNormal align=center style='text-align:center;mso-element:frame;
  mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-top:.05pt;mso-height-rule:
  exactly'><b style='mso-bidi-font-weight:normal'><span lang=EN-US
  style='color:purple'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><span lang=EN-US><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal><span lang=EN-US><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span lang=EN-US
style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal><b style='mso-bidi-font-weight:normal'><span lang=EN-US
style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shapetype
 id="_x0000_t75" coordsize="21600,21600" o:spt="75" o:preferrelative="t"
 path="m@4@5l@4@11@9@11@9@5xe" filled="f" stroked="f">
 <v:stroke joinstyle="miter"/>
 <v:formulas>
  <v:f eqn="if lineDrawn pixelLineWidth 0"/>
  <v:f eqn="sum @0 1 0"/>
  <v:f eqn="sum 0 0 @1"/>
  <v:f eqn="prod @2 1 2"/>
  <v:f eqn="prod @3 21600 pixelWidth"/>
  <v:f eqn="prod @3 21600 pixelHeight"/>
  <v:f eqn="sum @0 0 1"/>
  <v:f eqn="prod @6 1 2"/>
  <v:f eqn="prod @7 21600 pixelWidth"/>
  <v:f eqn="sum @8 21600 0"/>
  <v:f eqn="prod @7 21600 pixelHeight"/>
  <v:f eqn="sum @10 21600 0"/>
 </v:formulas>
 <v:path o:extrusionok="f" gradientshapeok="t" o:connecttype="rect"/>
 <o:lock v:ext="edit" aspectratio="t"/>
</v:shapetype><v:shape id="_x0000_i1058" type="#_x0000_t75" alt="5-ID 48-314"
 style='width:612pt;height:459pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image001.jpg" o:title="5-ID 48-314"/>
</v:shape><![endif]--><![if !vml]><img width=816 height=612
src="sangtana.files/image001.jpg" alt="5-ID 48-314" v:shapes="_x0000_i1058"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="_x0000_i1057" type="#_x0000_t75" alt="1" style='width:479.25pt;height:5in;
 visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image002.jpg" o:title="1"/>
</v:shape><![endif]--><![if !vml]><img width=639 height=480
src="sangtana.files/image002.jpg" alt=1 v:shapes="_x0000_i1057"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="_x0000_i1056" type="#_x0000_t75" alt="3" style='width:480pt;height:5in;
 visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image003.jpg" o:title="3"/>
</v:shape><![endif]--><![if !vml]><img width=640 height=480
src="sangtana.files/image003.jpg" alt=3 v:shapes="_x0000_i1056"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="_x0000_i1055" type="#_x0000_t75" alt="桑塔纳330 953 253防盗盒引脚功能说明" style='width:633.75pt;
 height:475.5pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image004.jpg" o:title="桑塔纳330 953 253防盗盒引脚功能说明"/>
</v:shape><![endif]--><![if !vml]><img width=845 height=634
src="sangtana.files/image005.jpg" alt="桑塔纳330 953 253防盗盒引脚功能说明" v:shapes="_x0000_i1055"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_5" o:spid="_x0000_i1054" type="#_x0000_t75" alt="u据u" style='width:490.5pt;
 height:405.75pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image006.jpg" o:title="u据u"/>
</v:shape><![endif]--><![if !vml]><img width=654 height=541
src="sangtana.files/image006.jpg" alt=u据u v:shapes="图片_x0020_5"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="_x0000_i1053" type="#_x0000_t75" alt="桑塔纳防盗盒数据详解" style='width:646.5pt;
 height:390pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image007.jpg" o:title="桑塔纳防盗盒数据详解"/>
</v:shape><![endif]--><![if !vml]><img width=862 height=520
src="sangtana.files/image007.jpg" alt=桑塔纳防盗盒数据详解 v:shapes="_x0000_i1053"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="_x0000_i1052" type="#_x0000_t75" alt="上海大众-桑塔纳2000诊断座位置图" style='width:480.75pt;
 height:637.5pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image008.jpg" o:title="上海大众-桑塔纳2000诊断座位置图"/>
</v:shape><![endif]--><![if !vml]><img width=641 height=850
src="sangtana.files/image008.jpg" alt=上海大众-桑塔纳2000诊断座位置图 v:shapes="_x0000_i1052"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_8" o:spid="_x0000_i1051" type="#_x0000_t75" alt="上海大众-桑塔纳3000诊断座位置图"
 style='width:483pt;height:610.5pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image009.jpg" o:title="上海大众-桑塔纳3000诊断座位置图"/>
</v:shape><![endif]--><![if !vml]><img width=644 height=814
src="sangtana.files/image009.jpg" alt=上海大众-桑塔纳3000诊断座位置图 v:shapes="图片_x0020_8"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span style='font-size:22.0pt;font-family:宋体;mso-ascii-font-family:
"Times New Roman";mso-hansi-font-family:"Times New Roman";color:red'>点火锁头拆出方法</span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_35" o:spid="_x0000_i1050" type="#_x0000_t75" style='width:531pt;
 height:417pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image010.png" o:title=""/>
</v:shape><![endif]--><![if !vml]><img width=708 height=556
src="sangtana.files/image011.jpg" v:shapes="图片_x0020_35"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_32" o:spid="_x0000_i1049" type="#_x0000_t75" style='width:377.25pt;
 height:429.75pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image012.png" o:title=""/>
</v:shape><![endif]--><![if !vml]><img width=503 height=573
src="sangtana.files/image013.jpg" v:shapes="图片_x0020_32"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span style='font-size:22.0pt;font-family:宋体;mso-ascii-font-family:
"Times New Roman";mso-hansi-font-family:"Times New Roman";color:red'>老款桑塔纳钥匙匹配步骤</span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_6" o:spid="_x0000_i1048" type="#_x0000_t75" alt="1.jpg" style='width:8in;
 height:536.25pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image014.jpg" o:title="1"/>
</v:shape><![endif]--><![if !vml]><img width=768 height=715
src="sangtana.files/image015.jpg" alt=1.jpg v:shapes="图片_x0020_6"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_7" o:spid="_x0000_i1047" type="#_x0000_t75" alt="2.jpg" style='width:564pt;
 height:495.75pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image016.jpg" o:title="2"/>
</v:shape><![endif]--><![if !vml]><img width=752 height=661
src="sangtana.files/image017.jpg" alt=2.jpg v:shapes="图片_x0020_7"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_9" o:spid="_x0000_i1046" type="#_x0000_t75" alt="4.jpg" style='width:525.75pt;
 height:492.75pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image018.jpg" o:title="4"/>
</v:shape><![endif]--><![if !vml]><img width=701 height=657
src="sangtana.files/image019.jpg" alt=4.jpg v:shapes="图片_x0020_9"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_10" o:spid="_x0000_i1045" type="#_x0000_t75" alt="5.jpg" style='width:531pt;
 height:483pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image020.jpg" o:title="5"/>
</v:shape><![endif]--><![if !vml]><img width=708 height=644
src="sangtana.files/image021.jpg" alt=5.jpg v:shapes="图片_x0020_10"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_11" o:spid="_x0000_i1044" type="#_x0000_t75" alt="6.jpg" style='width:531pt;
 height:483pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image022.jpg" o:title="6"/>
</v:shape><![endif]--><![if !vml]><img width=708 height=644
src="sangtana.files/image023.jpg" alt=6.jpg v:shapes="图片_x0020_11"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_12" o:spid="_x0000_i1043" type="#_x0000_t75" alt="7.jpg" style='width:525pt;
 height:492.75pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image024.jpg" o:title="7"/>
</v:shape><![endif]--><![if !vml]><img width=700 height=657
src="sangtana.files/image025.jpg" alt=7.jpg v:shapes="图片_x0020_12"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_13" o:spid="_x0000_i1042" type="#_x0000_t75" alt="8.jpg" style='width:533.25pt;
 height:486pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image026.jpg" o:title="8"/>
</v:shape><![endif]--><![if !vml]><img width=711 height=648
src="sangtana.files/image027.jpg" alt=8.jpg v:shapes="图片_x0020_13"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_14" o:spid="_x0000_i1041" type="#_x0000_t75" alt="9.jpg" style='width:515.25pt;
 height:450.75pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image028.jpg" o:title="9"/>
</v:shape><![endif]--><![if !vml]><img width=687 height=601
src="sangtana.files/image029.jpg" alt=9.jpg v:shapes="图片_x0020_14"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_15" o:spid="_x0000_i1040" type="#_x0000_t75" alt="10.jpg"
 style='width:518.25pt;height:471pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image030.jpg" o:title="10"/>
</v:shape><![endif]--><![if !vml]><img width=691 height=628
src="sangtana.files/image031.jpg" alt=10.jpg v:shapes="图片_x0020_15"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_16" o:spid="_x0000_i1039" type="#_x0000_t75" alt="11.jpg"
 style='width:488.25pt;height:443.25pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image032.jpg" o:title="11"/>
</v:shape><![endif]--><![if !vml]><img width=651 height=591
src="sangtana.files/image033.jpg" alt=11.jpg v:shapes="图片_x0020_16"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_17" o:spid="_x0000_i1038" type="#_x0000_t75" alt="12.jpg"
 style='width:528pt;height:434.25pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image034.jpg" o:title="12"/>
</v:shape><![endif]--><![if !vml]><img width=704 height=579
src="sangtana.files/image035.jpg" alt=12.jpg v:shapes="图片_x0020_17"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_18" o:spid="_x0000_i1037" type="#_x0000_t75" alt="13.jpg"
 style='width:525.75pt;height:476.25pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image036.jpg" o:title="13"/>
</v:shape><![endif]--><![if !vml]><img width=701 height=635
src="sangtana.files/image037.jpg" alt=13.jpg v:shapes="图片_x0020_18"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_19" o:spid="_x0000_i1036" type="#_x0000_t75" alt="14.jpg"
 style='width:491.25pt;height:432.75pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image038.jpg" o:title="14"/>
</v:shape><![endif]--><![if !vml]><img width=655 height=577
src="sangtana.files/image039.jpg" alt=14.jpg v:shapes="图片_x0020_19"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_20" o:spid="_x0000_i1035" type="#_x0000_t75" alt="15.jpg"
 style='width:492.75pt;height:434.25pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image040.jpg" o:title="15"/>
</v:shape><![endif]--><![if !vml]><img width=657 height=579
src="sangtana.files/image041.jpg" alt=15.jpg v:shapes="图片_x0020_20"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_21" o:spid="_x0000_i1034" type="#_x0000_t75" alt="16.jpg"
 style='width:516pt;height:450pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image042.jpg" o:title="16"/>
</v:shape><![endif]--><![if !vml]><img width=688 height=600
src="sangtana.files/image043.jpg" alt=16.jpg v:shapes="图片_x0020_21"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'>35XX</span></b><b
style='mso-bidi-font-weight:normal'><span style='font-size:22.0pt;font-family:
宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
color:red'>新桑塔纳匹配步骤</span></b><b style='mso-bidi-font-weight:normal'><span
lang=EN-US style='font-size:22.0pt;color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_24" o:spid="_x0000_i1033" type="#_x0000_t75" alt="IMG_8584"
 style='width:570.75pt;height:427.5pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image044.jpg" o:title="IMG_8584"/>
</v:shape><![endif]--><![if !vml]><img width=761 height=570
src="sangtana.files/image044.jpg" alt="IMG_8584" v:shapes="图片_x0020_24"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_25" o:spid="_x0000_i1032" type="#_x0000_t75" alt="1.jpg" style='width:573.75pt;
 height:400.5pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image045.jpg" o:title="1"/>
</v:shape><![endif]--><![if !vml]><img width=765 height=534
src="sangtana.files/image045.jpg" alt=1.jpg v:shapes="图片_x0020_25"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_26" o:spid="_x0000_i1031" type="#_x0000_t75" alt="2.jpg" style='width:626.25pt;
 height:442.5pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image046.jpg" o:title="2"/>
</v:shape><![endif]--><![if !vml]><img width=835 height=590
src="sangtana.files/image047.jpg" alt=2.jpg v:shapes="图片_x0020_26"><![endif]></span></b><b
style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:22.0pt;
color:red'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_27" o:spid="_x0000_i1030" type="#_x0000_t75" alt="3.jpg" style='width:634.5pt;
 height:444pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image048.jpg" o:title="3"/>
</v:shape><![endif]--><![if !vml]><img width=846 height=592
src="sangtana.files/image049.jpg" alt=3.jpg v:shapes="图片_x0020_27"><![endif]><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><!--[if gte vml 1]><v:shape
 id="图片_x0020_34" o:spid="_x0000_i1029" type="#_x0000_t75" style='width:750pt;
 height:760.5pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image050.jpg" o:title="lb"/>
</v:shape><![endif]--><![if !vml]><img width=1000 height=1014
src="sangtana.files/image051.jpg" v:shapes="图片_x0020_34"><![endif]><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'>35XX</span></b><b
style='mso-bidi-font-weight:normal'><span style='font-size:22.0pt;font-family:
宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman";
color:red;mso-no-proof:yes'>仪表全丢匹配说明</span></b><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red;mso-no-proof:yes'><o:p></o:p></span></b></p>

<p class=MsoNormal align=center style='text-align:center'><span
style='font-family:宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:
"Times New Roman"'>准备一个</span><span lang=EN-US>POLO</span><span
style='font-family:宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:
"Times New Roman"'>的</span><span lang=EN-US>2<a name="_GoBack"></a>4c64</span><span
style='font-family:宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:
"Times New Roman"'>的仪表</span></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=EN-US>1.</span><span
style='font-family:宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:
"Times New Roman"'>接原车仪表和发动机电脑，用</span><span lang=EN-US>VVDI</span><span
style='font-family:宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:
"Times New Roman"'>进</span><span lang=EN-US>25</span><span style='font-family:
宋体;mso-ascii-font-family:"Times New Roman";mso-hansi-font-family:"Times New Roman"'>防盗获取钥匙</span><span
lang=EN-US>ID</span></p>

<p class=ListParagraph align=center style='margin-left:18.0pt;text-align:center;
text-indent:0cm;mso-char-indent-count:0'><span lang=EN-US style='mso-no-proof:
yes'><!--[if gte vml 1]><v:shape id="图片_x0020_1" o:spid="_x0000_i1028" type="#_x0000_t75"
 style='width:415.5pt;height:311.25pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image052.jpg" o:title=""/>
</v:shape><![endif]--><![if !vml]><img width=554 height=415
src="sangtana.files/image053.jpg" v:shapes="图片_x0020_1"><![endif]></span></p>

<p class=ListParagraph align=center style='margin-left:18.0pt;text-align:center;
text-indent:0cm;mso-char-indent-count:0'><span lang=EN-US style='mso-no-proof:
yes'><!--[if gte vml 1]><v:shape id="图片_x0020_2" o:spid="_x0000_i1027" type="#_x0000_t75"
 style='width:409.5pt;height:274.5pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image054.jpg" o:title=""/>
</v:shape><![endif]--><![if !vml]><img width=546 height=366
src="sangtana.files/image055.jpg" v:shapes="图片_x0020_2"><![endif]></span></p>

<p class=ListParagraph align=center style='margin-left:18.0pt;text-align:center;
text-indent:0cm;mso-char-indent-count:0'><span style='font-family:宋体;
mso-ascii-font-family:Calibri;mso-hansi-font-family:Calibri'>记录</span><span
lang=EN-US>ID</span><span style='font-family:宋体;mso-ascii-font-family:Calibri;
mso-hansi-font-family:Calibri'>为：</span><span lang=EN-US>F3D825F1<span
style='mso-spacerun:yes'>&nbsp;&nbsp; </span>F3E2C1D2</span><span
style='font-family:宋体;mso-ascii-font-family:Calibri;mso-hansi-font-family:Calibri'>共计</span><span
lang=EN-US>2</span><span style='font-family:宋体;mso-ascii-font-family:Calibri;
mso-hansi-font-family:Calibri'>把</span></p>

<p class=ListParagraph align=center style='margin-left:18.0pt;text-align:center;
text-indent:-18.0pt;mso-char-indent-count:0;mso-list:l0 level1 lfo2'><![if !supportLists]><span
lang=EN-US style='mso-fareast-font-family:Calibri;mso-bidi-font-family:Calibri'><span
style='mso-list:Ignore'>1.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-family:宋体;mso-ascii-font-family:
Calibri;mso-hansi-font-family:Calibri'>用副厂</span><span lang=EN-US>48</span><span
style='font-family:宋体;mso-ascii-font-family:Calibri;mso-hansi-font-family:Calibri'>把其中一个</span><span
lang=EN-US>ID</span><span style='font-family:宋体;mso-ascii-font-family:Calibri;
mso-hansi-font-family:Calibri'>写入芯片</span></p>

<p class=ListParagraph align=center style='margin-left:18.0pt;text-align:center;
text-indent:-18.0pt;mso-char-indent-count:0;mso-list:l0 level1 lfo2'><![if !supportLists]><span
lang=EN-US style='mso-fareast-font-family:Calibri;mso-bidi-font-family:Calibri'><span
style='mso-list:Ignore'>2.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-family:宋体;mso-ascii-font-family:
Calibri;mso-hansi-font-family:Calibri'>把</span><span lang=EN-US>POLO 24C64</span><span
style='font-family:宋体;mso-ascii-font-family:Calibri;mso-hansi-font-family:Calibri'>的仪表和原车发动机电脑接到一起</span>
<span style='font-family:宋体;mso-ascii-font-family:Calibri;mso-hansi-font-family:
Calibri'>用</span><span lang=EN-US>ODIS</span><span style='font-family:宋体;
mso-ascii-font-family:Calibri;mso-hansi-font-family:Calibri'>做一下仪表更换，</span></p>

<p class=ListParagraph align=center style='margin-left:18.0pt;text-align:center;
text-indent:-18.0pt;mso-char-indent-count:0;mso-list:l0 level1 lfo2'><![if !supportLists]><span
lang=EN-US style='mso-fareast-font-family:Calibri;mso-bidi-font-family:Calibri'><span
style='mso-list:Ignore'>3.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-family:宋体;mso-ascii-font-family:
Calibri;mso-hansi-font-family:Calibri'>更换仪表成功后，就用</span><span lang=EN-US>POLO
24C64</span><span style='font-family:宋体;mso-ascii-font-family:Calibri;
mso-hansi-font-family:Calibri'>的仪表</span> <span style='font-family:宋体;
mso-ascii-font-family:Calibri;mso-hansi-font-family:Calibri'>按全丢方法做，生成经销商钥匙时一定要用已经写好的</span><span
lang=EN-US>ID48</span><span style='font-family:宋体;mso-ascii-font-family:Calibri;
mso-hansi-font-family:Calibri'>芯片，经销商钥匙生成成功后。换原车仪表和发动机电脑操作。</span></p>

<p class=ListParagraph align=center style='margin-left:18.0pt;text-align:center;
text-indent:-18.0pt;mso-char-indent-count:0;mso-list:l0 level1 lfo2'><![if !supportLists]><span
lang=EN-US style='mso-fareast-font-family:Calibri;mso-bidi-font-family:Calibri'><span
style='mso-list:Ignore'>4.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='font-family:宋体;mso-ascii-font-family:
Calibri;mso-hansi-font-family:Calibri'>把原车仪表和发动机电脑接好，这是用已经生成好的芯片防盗线圈</span> <span
style='font-family:宋体;mso-ascii-font-family:Calibri;mso-hansi-font-family:Calibri'>可以读取</span><span
lang=EN-US>EEP</span><span style='font-family:宋体;mso-ascii-font-family:Calibri;
mso-hansi-font-family:Calibri'>数据保存，再读防盗数据保存，记录</span><span lang=EN-US>CS</span><span
style='font-family:宋体;mso-ascii-font-family:Calibri;mso-hansi-font-family:Calibri'>码和</span><span
lang=EN-US>PIN</span><span style='font-family:宋体;mso-ascii-font-family:Calibri;
mso-hansi-font-family:Calibri'>，记录后进</span><span lang=EN-US>VVDI</span><span
style='font-family:宋体;mso-ascii-font-family:Calibri;mso-hansi-font-family:Calibri'>的匹配控制单元</span>
<span style='font-family:宋体;mso-ascii-font-family:Calibri;mso-hansi-font-family:
Calibri'>匹配仪表，输入</span><span lang=EN-US>CS</span><span style='font-family:宋体;
mso-ascii-font-family:Calibri;mso-hansi-font-family:Calibri'>码和</span><span
lang=EN-US>PIN </span><span style='font-family:宋体;mso-ascii-font-family:Calibri;
mso-hansi-font-family:Calibri'>点击写入即可</span> <span style='font-family:宋体;
mso-ascii-font-family:Calibri;mso-hansi-font-family:Calibri'>到此结束</span></p>

<p class=ListParagraph align=center style='margin-left:18.0pt;text-align:center;
text-indent:0cm;mso-char-indent-count:0'><span lang=EN-US style='mso-no-proof:
yes'><!--[if gte vml 1]><v:shape id="图片_x0020_3" o:spid="_x0000_i1026" type="#_x0000_t75"
 style='width:411.75pt;height:293.25pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image056.jpg" o:title=""/>
</v:shape><![endif]--><![if !vml]><img width=549 height=391
src="sangtana.files/image057.jpg" v:shapes="图片_x0020_3"><![endif]></span></p>

<p class=ListParagraph align=center style='margin-left:18.0pt;text-align:center;
text-indent:0cm;mso-char-indent-count:0'><span lang=EN-US style='mso-no-proof:
yes'><!--[if gte vml 1]><v:shape id="图片_x0020_4" o:spid="_x0000_i1025" type="#_x0000_t75"
 style='width:474.75pt;height:348pt;visibility:visible;mso-wrap-style:square'>
 <v:imagedata src="sangtana.files/image058.jpg" o:title=""/>
</v:shape><![endif]--><![if !vml]><img width=633 height=464
src="sangtana.files/image059.jpg" v:shapes="图片_x0020_4"><![endif]></span></p>

<p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
normal'><span lang=EN-US style='font-size:22.0pt;color:red'><o:p>&nbsp;</o:p></span></b></p>

</div>

<!--?php include('http://www.tengdakey.com/scs/dazhong/sangtana.htm'); ?-->
<!--div class="product-text">
<iframe src="<?php echo $rowsA["url1"]?>" width="100%" marginwidth="0" height="1000px" marginheight="0" align="top" scrolling="yes" frameborder="0"></iframe>
</div-->            
<div style="height: 50px;"></div>
<!--底部导航-->
<?php require_once("zhujian/bot.php");?>
<script src="js/jquery.min.js"></script>
<script src="js/amazeui.min.js"></script>
</body>
</html>
