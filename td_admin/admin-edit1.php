<?php
require_once("../include/global.php");
$ad_name1234=$_SESSION["ad_name1234"];
$ad_id1234=$_SESSION["ad_id1234"];

if($_GET['tj'] == 'out'){
 session_destroy();
 echo "<script language=javascript>alert('退出成功！');window.top.location.href='index.php'</script>";
}
		$sql="select * from hchi_admin where ad_name='".$ad_name1234."' and id='".$ad_id1234."'";
		$rs=mysql_query($sql);
		if(mysql_num_rows($rs)<>1)
	{
 session_destroy();
 	echo "<script language=javascript>alert('未登录或登录超时！请返回，重新登录，谢谢!');window.top.location.href='index.php'</script>";
	die();
	}

	$Aid=$ad_id1234;
	$sql1="select * from hchi_admin where id=$Aid";
	$rs1=mysql_query($sql1);
	$rows1=mysql_fetch_assoc($rs1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
 
/**
* 实时动态强制更改用户录入
* arg1 inputObject
**/
function amount(th){
    var regStrs = [
        ['^0(\\d+)$', '$1'], //禁止录入整数部分两位以上，但首位为0
        ['[^\\d\\.]+$', ''], //禁止录入任何非数字和点
        ['\\.(\\d?)\\.+', '.$1'], //禁止录入两个以上的点
        ['^(\\d+\\.\\d{3}).+', '$1'] //禁止录入小数点后两位以上
    ];
    for(i=0; i<regStrs.length; i++){
        var reg = new RegExp(regStrs[i][0]);
        th.value = th.value.replace(reg, regStrs[i][1]);
    }
}
 
</script>
</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="default.php">首页</a></li>
    <li><a href="#">修改登录密码</a></li>
    </ul>
    </div>
    
    <div class="formbody">
<?php

	if($_POST["tjbx-abc"]=='h-chi-vgs-8-com')
	{
	    $Aid=$_POST["id"];
	    $ad_name=$_POST["ad_name"];
		if($_POST["ad_pass"]==""){
		$ad_pass=$_POST["ad_pass3"];
		}else{
		$ad_pass=md5($_POST["ad_pass"]);
		}
		$ad_pass1=md5($_POST["ad_pass1"]);

		if($_POST["ad_name"]==""){
		echo "<script language=javascript>alert('用户名不能为空！');window.location='admin-edit1.php?id=$Aid'</script>";
		exit();
		}

		if($_POST["ad_pass"]==""){
		echo "<script language=javascript>alert('密码不能为空！');window.location='admin-edit1.php?id=$Aid'</script>";
		exit();
		}

		if($_POST["ad_pass"]<>$_POST["ad_pass1"]){
		echo "<script language=javascript>alert('两次输入密码不一致！');window.location='admin-edit1.php?id=$Aid'</script>";
		exit();
		}

		$sql1="update hchi_admin set ad_name='$ad_name',ad_pass='$ad_pass' where id='".$Aid."'";
		if(mysql_query($sql1))
		{
		echo "<script language=javascript>alert('密码修改成功，请重新登录！');window.location='admin-edit1.php?tj=out'</script>";
		}
		else
		{
		echo "<script language=javascript>alert('编辑失败！');window.location='admin-edit1.php?id=$Aid'</script>";
		}
		die();
	}
?>
    
    
  	<form id="automateRule" name="automateRule" action="admin-edit1.php" method="post">
      <input name="tjbx-abc" type="hidden" id="tjbx-abc" value="h-chi-vgs-8-com" />
      <input name="id" type="hidden" id="id" value="<?php echo $rows1["id"]?>" />
      <ul class="forminfo">
    <li>
      <label>用户名</label><input name="ad_name" type="text" class="dfinput" id="ad_name" value="<?php echo $rows1["ad_name"]?>"/>
    </li>
    <li>
      <label>密码</label><input name="ad_pass" type="password" class="dfinput" id="ad_pass"/>
      <input name="ad_pass3" type="hidden" id="ad_pass3" value="<?php echo $rows1["ad_pass"]?>" />
    </li>
    <li>
      <label>再次输入</label><input name="ad_pass1" type="password" class="dfinput" id="ad_pass1"/>不修改请留空  
    </li>
    <li><label>&nbsp;</label><input type="submit" class="btn" value="提&nbsp;&nbsp;交"/>
    </li>
    </ul>
    </form>
    
</div>


</body>

</html>
