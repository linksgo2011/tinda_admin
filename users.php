<?php
require_once("include/global.php");
$username = $_COOKIE["username"];
$dl_date = $_COOKIE["dl_date"];

if ($username == "" or $dl_date == "") {
    setcookie("username", "", time() - 365 * 24 * 60 * 60);
    setcookie("dl_date", "", time() - 365 * 24 * 60 * 60);
    echo "<script language=javascript>alert('未登录或登录超时！请返回，重新登录，谢谢!');window.top.location.href='index.php'</script>";
    die();
}
$sql = "select * from feedbackinfo where title='" . $username . "' and dl_date='" . $dl_date . "'";
$rs = mysql_query($sql);
$rowsT = mysql_fetch_assoc($rs);

if ($username <> "" and $dl_date <> "" and $rowsT["id"] == "") {
    setcookie("username", "", time() - 365 * 24 * 60 * 60);
    setcookie("dl_date", "", time() - 365 * 24 * 60 * 60);
    echo "<script language=javascript>alert('您的帐号已在另处登录，被强制下线!');window.top.location.href='index.php'</script>";
    die();
}

$l_date1 = date("Y-m-d");
if (strtotime($rowsT["end_date"]) < strtotime($l_date1)) {
    setcookie("username", "", time() - 365 * 24 * 60 * 60);
    setcookie("dl_date", "", time() - 365 * 24 * 60 * 60);
    echo "<script language=javascript>alert('您的帐号已过期，请联系您的服务商!');window.top.location.href='index.php'</script>";
    die();
}

if ($_GET["exid"] == "exit") {
    setcookie("username", $count['title'], time() + 365 * 24 * 60 * 60);
    setcookie("dl_date", $l_date, time() + 365 * 24 * 60 * 60);
    echo "<script language=javascript>window.top.location.href='index.php'</script>";
}
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>腾达APP</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="css/hcwh.min.css" type="text/css"/>
    <link rel="stylesheet" href="css/app.css" type="text/css"/>
    <link rel="stylesheet" href="css/ui.css" type="text/css"/>
</head>
<body>
<header data-am-widget="header" class="am-header am-header-default am-no-layout ft-header">
    <div class="logo"><b>腾达云平台</b></div>
</header>
<div style="height: 60px;"></div>
<div style="background: #cfcfcf;height:40px;line-height:40px;text-align:center;"><span
            style="float: left;margin-left:10px;"><a href="javascript:history.back(-1)"><i class="am-icon-reply"></i>返回</a></span><b
            style="font-size:16px;">个人信息</b><span style="float: right;margin-right:10px;"><a href="?exid=exit">注销<i
                    class="am-icon-mail-forward"></i></a></div>
<div style="height: 0px;"></div>
<!----------body----------->
<div class="aui-text-top aui-l-content">
    <div class="aui-menu-list aui-menu-list-clear">
        <li style="color:#000;font-size:16px;">
            <p>当前帐户：<?php echo $rowsT["title"] ?></p>
            <p>到期时间：<?php echo $rowsT["end_date"] ?></p>
            <p>当前积分：100</p>
        </li>
        <div class="online-btn">
            <a href="passxg.php" class="online-submit">修改密码</a>
            <!--a href="#" class="online-reset">绑定手机</a--->
        </div>
        <ul>
            <li class="b-line" style="background: #f3f3f3;">
                <h3><b>祥细信息：</b></h3>
            </li>
            <li class="b-line">
                <h3>姓名：<?php echo $rowsT["name"] ?></h3>
            </li>
            <li class="b-line">
                <h3>电话：<?php echo $rowsT["phone"] ?></h3>
            </li>
            <li class="b-line">
                <h3>QQ：</h3>
            </li>
            <li class="b-line">
                <h3>地址：<?php echo $rowsT["address"] ?></h3>
            </li>
            <li class="b-line">
                <h3>违规：<?php echo $rowsT["qzxx"] ?>次</h3>
            </li>

        </ul>
    </div>
</div>

<div style="height: 50px;"></div>
<!--底部导航-->
<?php require_once("zhujian/bot.php"); ?>
<script src="js/jquery.min.js"></script>
<script src="js/amazeui.min.js"></script>
</body>
</html>
