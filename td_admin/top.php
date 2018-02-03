<?php
require_once("../include/global.php");
$ad_name1234=$_SESSION["ad_name1234"];
$ad_id1234=$_SESSION["ad_id1234"];
$adminqiux=$_SESSION["ad_qiux1234"];

if($_GET['tj'] == 'out'){
 session_destroy();
 echo "<script language=javascript>alert('退出成功！');window.location='index.php'</script>";
}
		$sql="select * from hchi_admin where ad_name='".$ad_name1234."' and id='".$ad_id1234."'";
		$rs=mysql_query($sql);
		if(mysql_num_rows($rs)<>1)
	{
 session_destroy();
 	echo "<script language=javascript>alert('未登录或登录超时！请返回，重新登录，谢谢!');window.top.location.href='index.php'</script>";
	die();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/jquery.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/amazeui.min.js"></script>
<script type="text/javascript">
$(function(){	
	var scpasssl = $.trim($("#scpasssl").val());
	jQuery.ajax({
		type	:	"post",
		url		:	"newpasscx.php",
		data	:	{"scpasssl" : scpasssl},
		success	: 	function(data){
			if(data > scpasssl){
			var newssl=data - scpasssl;
			$("#lyts11").html('<embed autoplay="true" src="10.mp3"  width="0" height="0" />');
			$("#lyts12").html(newssl);
			$("#scpasssl").val(data);
			setTimeout("passA()",10000);//10秒后再次执行
			return false;
			}else{
			setTimeout("passA()",10000);//10秒后再次执行
			}
		}
	});
})	
function passA(){	
	var scpasssl = $.trim($("#scpasssl").val());
	jQuery.ajax({
		type	:	"post",
		url		:	"newpasscx.php",
		data	:	{"scpasssl" : scpasssl},
		success	: 	function(data){
			if(data > scpasssl){
			var newssl=data - scpasssl;
			$("#lyts11").html('<embed autoplay="true" src="10.mp3"  width="0" height="0" />');
			$("#lyts12").html(newssl);
			$("#scpasssl").val(data);
			setTimeout("passA()",10000);//10秒后再次执行
			return false;
			}else{
			setTimeout("passA()",10000);//10秒后再次执行
			}
		}
	});
}	
</script>
</head>

<body style="background:url(images/topbg.gif) repeat-x;">

    <div class="topleft">
    <a href="main.html" target="_parent"><img src="images/logo.png" title="系统首页" /></a>
    </div>
            
    <div class="topright">    
    <ul>
    <li><i><img src="images/exit.png" width="16" height="16"/></i><a href="?tj=out" target="_parent">&nbsp;安全退出</a></li>
    </ul>
     
    <div class="user">
    <span><?php echo $ad_name1234?>&nbsp;|&nbsp;<a href="admin-edit1.php" target="rightFrame" style="color:#FFF">&nbsp;修改密码</a>&nbsp;|&nbsp;<a href="tinda/newpass.php" target="rightFrame" style="color:#FFF">新查询：<b styel="color:#ff0000" id="lyts12">0</b></a></span>
    </div>    
    
    </div>
<?php
	$sql="select * from hchi_passcx";
	$rs=mysql_query($sql);
	$recordcount=mysql_num_rows($rs);
?>
    <div id="lyts11"></div>
    <input name="scpasssl" type="hidden" id="scpasssl" value="<?php echo $recordcount?>" />
</body>
</html>
