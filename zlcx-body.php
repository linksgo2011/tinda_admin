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
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes">
<link rel="stylesheet" href="css/hcwh.min.css" type="text/css" />
<link rel="stylesheet" href="css/app.css" type="text/css" />
<script src="js/jquery-1.5.1.js"></script>
<script src="js/jQuery.autoIMG.min.js"></script>
<script>
/* demo script */
jQuery(function ($) {
	$('#demo').autoIMG();
	$('#down').click(function () {
		window.open(this.getAttribute('data-href') || this.href);	
		return false;
	});
});
</script>
</head>
<body>
<header data-am-widget="header" class="am-header am-header-default am-no-layout ft-header">
  <div class="logo"><b>腾达云平台</b></div>
</header>
<div style="height: 60px;"></div>
<div style="background: #cfcfcf;height:40px;line-height:40px;text-align:center;"><span style="float: left;margin-left:10px;"><a href="javascript:history.back(-1)"><i class="am-icon-reply"></i>返回</a></span><b style="font-size:16px;margin-left:-12%;"><?php echo $rowsA["name"]?></b></div>
<div style="height: 20px;"></div>
<p style="height:25px;font-size:12px;margin-top:-10px;margin-left:10px;"><b><span style="color:#FF0000;">公告&nbsp;<i class="am-icon-volume-up"></i>：</span><a href="#" style="color:#ff0000;">现在正在直播宝马CAS4+全丢现场匹配，点击进入观看......</a></b></p>
<div class="jianju"></div>
<!----------body----------->
<div class="product-text" id="demo">
<?php if($rowsA["bodys"]==""){?>
<iframe src="<?php echo $rowsA["url1"]?>" width="100%" marginwidth="0" height="1000px" marginheight="0" align="top" scrolling="yes" frameborder="0"></iframe>
<?php }else{?>
<div class="imgabcd">
<?php echo $rowsA["bodys"];}?>
</div>            
</div>            
<div style="height: 50px;"></div>
<!--底部导航-->
<?php require_once("zhujian/bot.php");?>
<script src="js/jquery.min.js"></script>
<script src="js/amazeui.min.js"></script>
</body>
</html>
