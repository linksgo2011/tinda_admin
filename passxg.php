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
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/TouchSlide.1.1.js"></script>
</head>
<body>
<header data-am-widget="header" class="am-header am-header-default am-no-layout ft-header">
  <div class="logo"><b>腾达云平台</b></div>
</header>
<div style="height: 60px;"></div>
<div style="background: #cfcfcf;height:40px;line-height:40px;text-align:center;"><span style="float: left;margin-left:10px;"><a href="javascript:history.back(-1)"><i class="am-icon-reply"></i>返回</a></span><b style="font-size:16px;margin-left:-12%;">修改密码</b></div>
<div style="height: 10px;"></div>
<!----------user----------->
 <form onSubmit="return indexLogin1();" method="POST">
 <input name="l_ID" type="hidden" id="l_ID" value="<?php echo $rowsT["id"]?>">
		<ul class="onlin-text">
		    <p>&nbsp;</p>
            <li><b class="red1">&nbsp;新&nbsp;密&nbsp;码</b><input name="l_pass"  type="password" class="online-input" id="l_pass" value="" placeholder="请输入6位以上的字符"></li>
			<li><b class="red1">确认密码</b><input name="l_pass1"  type="password" class="online-input" id="l_pass1" value="" placeholder="请输入6位以上的字符"></li>
		</ul>
            <div id="lyts11" style="width:100%;color:#FF0000;text-align:center;">&nbsp;</div>
<div style="height: 40px;">&nbsp;</div>
            <button class="submit" type="submit" id="showcard">提&nbsp;&nbsp;交</button>
</form>

<div style="height: 50px;"></div>
<!--底部导航-->
<?php require_once("zhujian/bot.php");?>
<script src="js/jquery.min.js"></script>
<script src="js/amazeui.min.js"></script>
</body>
</html>
