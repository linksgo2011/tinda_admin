﻿<?php
require_once("../../include/global.php");
$ad_name1234=$_SESSION["ad_name1234"];
$ad_id1234=$_SESSION["ad_id1234"];

if($_GET['tj'] == 'out'){
 session_destroy();
 echo "<script language=javascript>alert('退出成功！');window.location='../index.php'</script>";
}
		$sql="select * from hchi_admin where ad_name='".$ad_name1234."' and id='".$ad_id1234."'";
		$rs=mysql_query($sql);
		if(mysql_num_rows($rs)<>1)
	{
 session_destroy();
 	echo "<script language=javascript>alert('未登录或登录超时！请返回，重新登录，谢谢!');window.top.location.href='../index.php'</script>";
	die();
	}
?>
<?php
	$Aid=$_GET["info_id"];
	$sql="select * from feedbackinfo where id='".$Aid."'";
	$rs=mysql_query($sql);
	$rows=mysql_fetch_assoc($rs);
?>
<html>
<title>腾达汽车资料查询系统 手机版登记信息</title>
<meta NAME="腾达汽车资料查询系统 手机版登记信息">
<meta NAME="腾达汽车资料查询系统 手机版登记信息">
<meta NAME="腾达汽车资料查询系统 手机版登记信息">
<meta NAME="腾达汽车资料查询系统 手机版登记信息">
<style type="text/css">
<!--
.p9 {  font-size: 9pt; line-height: 16pt}
-->
</style>

<body bgcolor="#FFFFFF" link="#FF0000" vlink="#FF0000" alink="#FF0000">


<table align="left" bordercolor="#000000" style="margin:auto 6.75pt;border:currentColor;width:50%;border-collapse:collapse;" border="1" cellspacing="0" cellpadding="0">


  <tr> 
    <td width="72" bgcolor="ffffec">用户名</td>
    <td width="348" bgcolor="ffffec"><font color=blue><?php echo $rows["title"]?>&nbsp;</font></td>
  </tr>
  <tr> 
    <td width="72" bgcolor="ffffec">注册方式</td>
    <td width="348" bgcolor="ffffec"><?php echo $rows["name"]?></td>
  </tr>
  <tr> 
    <td width="72" bgcolor="ffffec">登记姓名</td>
    <td width="348" bgcolor="ffffec"><?php echo $rows["email"]?></td>
  </tr>
  <tr> 
    <td width="72" bgcolor="ffffec">电 话</td>
    <td width="348" bgcolor="ffffec"><?php echo $rows["phone"]?></td>
  </tr>
  <tr> 
    <td width="72" bgcolor="ffffec">提示</td>
    <td width="348" bgcolor="ffffec"><font color=green><?php echo $rows["comment"]?>&nbsp;</font></td>
  </tr>
  <tr> 
    <td width="72" bgcolor="ffffec">加密狗ID</td>
    <td width="348" bgcolor="ffffec"><font color=green><?php echo $rows["address"]?>&nbsp;</font></td>
  </tr>
  <tr>
    <td width="72" bgcolor="ffffec">登记时间</td>
    <td width="348" bgcolor="ffffec"><?php echo $rows["mess_date"].'&nbsp;'.$rows["mess_time"]?></td>
  </tr>
  <tr>
    <td width="72" bgcolor="ffffec">重复登陆</td>
    <td width="348" bgcolor="ffffec"><font color=red><?php echo $rows["qzxx"]?>次 最后登陆：<?php echo $rows["dl_date"]?></font></td>
  </tr>
 <tr>
    <td width="72" bgcolor="ffffec">最后查询时间</td>
    <td width="348" bgcolor="ffffec"><font color=red><?php echo $rows["cx_date"]?></font></td>
  </tr>
</table>
<div align="right">　</div>

</body>
</html>