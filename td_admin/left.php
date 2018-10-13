<?php
require_once("../include/global.php");
$ad_id1234=$_SESSION["ad_id1234"];
$adminqiux=$_SESSION["ad_qiux1234"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/jquery.js"></script>

<script type="text/javascript">
$(function(){	
	//导航切换
	$(".menuson li").click(function(){
		$(".menuson li.active").removeClass("active")
		$(this).addClass("active");
	});
	
	$('.title').click(function(){
		var $ul = $(this).next('ul');
		$('dd').find('ul').slideUp();
		if($ul.is(':visible')){
			$(this).next('ul').slideUp();
		}else{
			$(this).next('ul').slideDown();
		}
	});
})	
</script>


</head>

<body style="background:#f1f1f1;">
	<div class="lefttop"><span></span>导航目录</div>
    
    <dl class="leftmenu">
    <dd>
    <div class="title">
    <span><img src="images/leftico01.png" /></span>管理中心
    </div>
    	<ul class="menuson">
        <li class="active"><cite></cite><a href="default.php" target="rightFrame">后 台 首 页</a><i></i></li>
        <li><cite></cite><a href="tinda/indexlb.php" target="rightFrame">首页轮播</a><i></i></li>
        <li><cite></cite><a href="admin-edit1.php" target="rightFrame">修改密码</a><i></i></li>
        <li><cite></cite><a href="homeAdSetting.php" target="rightFrame">后台广告</a><i></i></li>
        <li><cite></cite><a href="xgbb.php" target="rightFrame">app设置</a><i></i></li>
        </ul>
    </dd>
    <dd>
    <div class="title">
    <span><img src="images/leftico01.png" /></span>帮助中心
    </div>
    	<ul class="menuson">
        <li class="active"><cite></cite><a href="tinda/danp.php?finl=about" target="rightFrame">关于我们</a><i></i></li>
        <li><cite></cite><a href="tinda/danp.php?finl=fwlx" target="rightFrame">客服热线</a><i></i></li>
        <li><cite></cite><a href="tinda/danp.php?finl=jxzc" target="rightFrame">技术支持</a><i></i></li>
        <li><cite></cite><a href="tinda/danp.php?finl=provideData" target="rightFrame">资料提供</a><i></i></li>
        </ul>
    </dd>
    <dd>
    <div class="title"><span><img src="images/leftico02.png" /></span>用户信息</div>
    <ul class="menuson">
        <li><cite></cite><a href="tinda/usergl.php" target="rightFrame">用户管理</a><i></i></li>
        <li><cite></cite><a href="../register.php" target="rightFrame">添加用户</a><i></i></li>
        <li><cite></cite><a href="tinda/chaxfinl.php?module=data" target="rightFrame">资料菜单</a><i></i></li>
        <li><cite></cite><a href="subBannerSetting.php" target="rightFrame">查询页广告设置</a><i></i></li>
    </ul>
    </dd> 
    
    <dd><div class="title"><span><img src="images/leftico05.png" /></span>密码查询</div>
    <ul class="menuson">
        <li><cite></cite><a href="tinda/chasetup.php" target="rightFrame">查询设置</a><i></i></li>
        <li><cite></cite><a href="tinda/glcxpass.php" target="rightFrame">管理查询</a><i></i></li>
        <li><cite></cite><a href="tinda/autoSearch.php" target="rightFrame">自动查询</a><i></i></li>
        <li><cite></cite><a href="tinda/newpass.php" target="rightFrame">最新申请</a><i></i></li>
        <li><cite></cite><a href="tinda/finlpass.php" target="rightFrame">分类管理</a><i></i></li>
    </ul>
    </dd>

    <dd><div class="title"><span><img src="images/leftico05.png" /></span>支付设置</div>
        <ul class="menuson">
            <li><cite></cite><a href="tinda/provisionSet.php" target="rightFrame">项目设置</a><i></i></li>
            <li><cite></cite><a href="tinda/provisionLog.php" target="rightFrame">充值记录</a><i></i></li>
            <li><cite></cite><a href="tinda/recharge.php" target="rightFrame">充积分</a><i></i></li>
        </ul>
    </dd>

    <dd><div class="title"><span><img src="images/leftico05.png" /></span>直播管理</div>
        <ul class="menuson">
            <li><cite></cite><a href="tinda/liveUsers.php" target="rightFrame">直播用户</a><i></i></li>
            <li><cite></cite><a href="tinda/addLveUser.php" target="rightFrame">直播开通</a><i></i></li>
            <li><cite></cite><a href="tinda/applyLives.php" target="rightFrame">申请审核</a><i></i></li>
        </ul>
    </dd>

    <dd><div class="title"><span><img src="images/leftico04.png" /></span>系统设置</div>
    <ul class="menuson">
        <li><cite></cite><a href="beifin.php" target="rightFrame">备份与恢复</a><i></i></li>
        <li><cite></cite><a href="Journal.php" target="rightFrame">系统日志</a><i></i></li>
   </ul>
    
    </dd>   
    
    </dl>
    
</body>
</html>
