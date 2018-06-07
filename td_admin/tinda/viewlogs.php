<?php
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

    <?php
    $username = $_GET["username"];
    $sql="select * from rj where yhm='$username'";
    $rs=mysql_query($sql);
    while($rows=mysql_fetch_assoc($rs)) {
        echo  '<tr class="mui-table-view-cell"><td width="300" bgcolor="ffffec">车架号:' . $rows["cjh"] . '         PIN:' . $rows["pin"] .     '</td></tr>' . $arr;
    }

 ?>

</table>

<ul>


</ul>
<div align="right">　</div>

</body>
</html>