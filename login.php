<?php
require_once("include/global.php");
if ($_COOKIE["username"] <> "" and $_COOKIE["dl_date"] <> "") {
    echo "<script language=javascript>window.top.location.href='index.php'</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>腾达汽车资料咨询平台</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="css/hcwh.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/app.css" type="text/css"/>
    <link rel="stylesheet" href="css/login.css" type="text/css"/>
    <script src="js/TouchSlide.1.1.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<div id="Layer1" style="position:absolute; left:0px; top:0px; width:100%; height:100%;z-index:-1;">
    <img src="images/login-bj.jpg" width="100%"/>
</div>
<div style="height: 40px;"></div>
<header data-am-widget="header" class="am-header am-header-default am-no-layout ft-header1">
    <!--header data-am-widget="header" class="am-header am-header-default am-no-layout ft-header"-->
    <div class="logo1"><img src="images/logo.png"/></div>
</header>
<div style="height: 200px;"></div>
<div style="height:40px;line-height:40px;text-align:center;color:#ffff00"><b style="font-size:16px;">用户登录</b></div>
<div style="height: 20px;"></div>
<!----------user----------->
<form onSubmit="return indexLogin();" method="POST">
    <div class="userName">
        <lable><i class="am-icon-user"></i>：</lable>
        <input type="text" name="l_name" id="l_name" placeholder="请输入用户名"/>
    </div>
    <div class="passWord">
        <lable><i class="am-icon-key"></i>：</lable>
        <input type="password" name="l_pass" id="l_pass" placeholder="请输入密码"/>
    </div>
    <div class="choose_box">
        <div>
            <a href="register.php">免费注册</a>
        </div>
        <!--a href="newPassword.php">忘记密码</a-->
    </div>
    <button class="login_btn" id="showcard" type="submit">登&nbsp;&nbsp;录</button>
    <div style="text-align:center;color:#FFFFFF" id="lyts11">&nbsp;</div>
</form>

<div style="height: 50px;"></div>
<!--底部导航-->
<!--?php require_once("zhujian/bot.php");?-->
<script src="js/jquery.min.js"></script>
<script src="js/amazeui.min.js"></script>
</body>
</html>
