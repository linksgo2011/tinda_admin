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
<link rel="stylesheet" href="css/ui.css" type="text/css" />
</head>
<body>
<header data-am-widget="header" class="am-header am-header-default am-no-layout ft-header">
  <div class="logo"><b>腾达云平台</b></div>
</header>
<div style="height: 60px;"></div>
<div style="background: #cfcfcf;height:40px;line-height:40px;text-align:center;"><span style="float: left;margin-left:10px;"><a href="javascript:history.back(-1)"><i class="am-icon-reply"></i>返回</a></span><b style="font-size:16px;margin-left:-12%;"><?php echo $rowsA["name"]?></b></div>
<div style="height: 0px;"></div>
<!----------body----------->
			<div class="aui-text-top aui-l-content">
				<div class="aui-menu-list aui-menu-list-clear">
					<ul>
<?php
$rs=mysql_query("select * from finl where fl1='".$finlID."' order by id asc");
while($rows=mysql_fetch_assoc($rs))
{
if($rows["logoA"]==""){
 $pplogo='images/icon-read2.png';
}else{
 $pplogo=$rows["logoA"];
}
echo'
						<li class="b-line">
								<div class="aui-icon"><img src="'.$pplogo.'"></div>
						  <a href="zlcx2.php?Aid='.$rows["id"].'">
								<h3>'.$rows["name"].'</h3>
								<div class="aui-time"><i class="aui-jump"></i></div>
						  </a>
                        </li>
';
}
?>
				  </ul>
				</div>
			</div>
            
<div style="height: 50px;"></div>
<!--底部导航-->
<?php require_once("zhujian/bot.php");?>
<script src="js/jquery.min.js"></script>
<script src="js/amazeui.min.js"></script>
</body>
</html>
