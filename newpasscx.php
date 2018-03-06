<?php
require_once("../include/global.php");
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
//////////////////////////////////
	$sql="select * from hchi_passcx";
	$rs=mysql_query($sql);
	$recordcount=mysql_num_rows($rs);
echo $recordcount;
?>
