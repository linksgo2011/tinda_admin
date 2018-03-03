<?php
	require_once("../include/global.php");
    $dateyx1=date("Y-m-d H:i:s");

	// 定义一个函数getIP()
function getIP(){
global $ip;
if (getenv("HTTP_CLIENT_IP"))
$ip = getenv("HTTP_CLIENT_IP");
else if(getenv("HTTP_X_FORWARDED_FOR"))
$ip = getenv("HTTP_X_FORWARDED_FOR");
else if(getenv("REMOTE_ADDR"))
$ip = getenv("REMOTE_ADDR");
else $ip = "Unknow";
return $ip;
}
$userip=getIP();

if($_POST["Submit"] and $_POST["yzm"]='9302608ab12cd34ef56')
	{
		$ad_name1=$_POST["ad_name"];
		$ad_pass1=md5($_POST["ad_pass"]);
		$code=$_POST["code"];
		if($ad_name1=="" or $_POST["ad_pass"]=="" or $_POST["ad_pass"]=="密码")
		{
		echo "<script language=javascript>alert('请输及用户名或密码！');window.location=''</script>";
			die();
		}
		if($code<>$_SESSION["auth"])
		{
		echo "<script language=javascript>alert('验证码不正确！');window.location=''</script>";
			die();
		}
		$sql="select * from hchi_admin where ad_name='$ad_name1' and ad_pass='$ad_pass1'";
		$rs=mysql_query($sql);
    	$userdl=mysql_fetch_assoc($rs);
		if(mysql_num_rows($rs)==1)
		{
			$_SESSION["ad_id1234"]=$userdl["id"];
			$_SESSION["ad_name1234"]=$userdl["ad_name"];
			$_SESSION["ad_qiux1234"]=$userdl["ad_qiux"];
		    $sql1="insert into hchi_Journal (jou_user,jou_ip,jou_date,jou_caoz) values ('$ad_name1','$userip','$dateyx1','登录成功')";
		    mysql_query($sql1);
		    $sql2="update hchi_admin set ad_scdldate=ad_dldate,ad_dldate='$dateyx1' where ad_name='$ad_name1' and ad_pass='$ad_pass1'";
		    mysql_query($sql2);
			echo "<SCRIPT LANGUAGE=javascript>;location.href='main.html'</script>";
		}
		else
		{
		echo "<script language=javascript>alert('用户名或密码错误！');window.location=''</script>";
		?>
		<?php
		die();
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="images/hchi_ico.ico" type="image/x-icon" />
<title>欢迎使用“腾达云平台”网站管理系统</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/jquery.js"></script>
<script src="js/cloud.js" type="text/javascript"></script>

<script language="javascript">
	$(function(){
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
	$(window).resize(function(){  
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
    })  
});  
</script> 

</head>

<body style="background-color:#1c77ac; background-image:url(images/light.png); background-repeat:no-repeat; background-position:center top; overflow:hidden;">



    <div id="mainBody">
      <div id="cloud1" class="cloud"></div>
      <div id="cloud2" class="cloud"></div>
    </div>  


<div class="logintop">    
    <span>欢迎使用“腾达云平台”网站管理系统</span>    
    <ul>
    <li><a href="/" target="_blank">前台首页</a></li>
  </ul>    
    </div>
    
    <div class="loginbody">
    
    <span class="systemlogo"></span> 
       
<form id="frm" name="frm" method="post" action="?yzm=9302608ab12cd34ef56" onSubmit="return check()">
    <div class="loginbox">
    <ul>
    <li><input name="ad_name" type="text" class="loginuser" value="" onclick="JavaScript:this.value=''"/></li>
    <li><input name="ad_pass" type="password" class="loginpwd" value="" onclick="JavaScript:this.value=''"/></li>
    <li>
    <label>验证码：<input name="code" type="text" id="code" style="width:40px; text-align:center; font-size:15px; line-height:17px;border:#ff0000 1px solid;" maxlength="8" /><img src="verify.php" style="vertical-align:middle" /></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="Submit" class="loginbtn" value="登陆"></li>
    </ul>
    </div>
</form>
    
    </div>
    
    
    
    <div class="loginbm">版权所有  2016-2020  <a href="http://www.tengdakey.com">腾达云平台</a> </div>
	
    
</body>

</html>