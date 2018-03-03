<?php
require_once("include/global.php");
if ($_COOKIE["username"] <> "" and $_COOKIE["dl_date"] <> "") {
    echo "<script language=javascript>window.top.location.href='finls.php'</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>腾达APP</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="css/hcwh.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/app.css" type="text/css"/>
    <script src="js/TouchSlide.1.1.js"></script>
</head>
<body>
<header data-am-widget="header" class="am-header am-header-default am-no-layout ft-header">
    <div class="logo"><b>腾达云平台</b></div>
</header>
<div style="height: 60px;"></div>
<div style="background: #cfcfcf;height:40px;line-height:40px;text-align:center;"><span
            style="float: left;margin-left:10px;"><a href="javascript:history.back(-1)"><i class="am-icon-reply"></i>返回</a></span><b
            style="font-size:16px;margin-left:-12%;">腾达云平台 内部注册</b></div>
<div style="height: 10px;"></div>
<!----------user----------->
<form onSubmit="return indexzhuche();" method="POST">
    <ul class="onlin-text">
        <li><b class="red1">用户名</b><input name="title1" type="text" class="online-input" id="title1" value=""
                                          placeholder="填写手机号码"></li>
        <li><b class="red1">密&nbsp;码</b><input name="pass1" type="password" class="online-input" id="pass1" value=""
                                               placeholder="请输入6位以上的字符"></li>
        <li><b class="red1">确认密码</b><input name="pass2" type="password" class="online-input" id="pass2" value=""
                                           placeholder="请输入6位以上的字符"></li>
<li><b class="red1">姓&nbsp;名</b><input name="email" type="text" class="online-input" id="email" placeholder="真实名字">
        </li>
        <li><b class="red1">电&nbsp;话</b><input name="phome" type="text" class="online-input" id="phome" value=""
                                               placeholder="填写手机号码"></li>
        <li><b class="red1">提示问题</b><input name="comment" type="text" class="online-input" id="comment" value=""
                                          placeholder="找回密码使用"></li>
        <li><b class="red1">加密狗ID</b><input name="address" type="text" class="online-input" id="address" value=""
                                               placeholder="填写加密狗的ID号"></li>
    <div id="lyts11" style="width:100%;color:#FF0000;text-align:center;">&nbsp;</div>

    <button class="submit" type="submit">立即注册</button>
        <li><b class="red1">类&nbsp;型</b><select name="leixing" id="leixing" class="online-input">
                <option value="内部注册">苹果安卓双系统</option>
            </select></li>
               <li><b class="red1">方&nbsp;式</b><input name="name" type="text" class="online-input" id="name" value="内部注册"
                                          ></li>
               <li><b class="red1">3</b><input name="area" type="text" class="online-input" id="area" value="内部注册2"
                                          ></li>
       


    </ul>
</form>

<div style="height: 50px;"></div>
<!--底部导航-->
<?php require_once("zhujian/bot.php"); ?>
<script src="js/jquery.min.js"></script>
<script src="js/amazeui.min.js"></script>
</body>
</html>
