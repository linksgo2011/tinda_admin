<?php
require_once("../../include/admin.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <link href="../css/style.css" rel="stylesheet" type="text/css"/>
    <style>
        .tablelist .dfinput{width:100px;}
    </style>
</head>

<body>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="../default.php">首页</a></li>
        <li><a href="#">用户充值</a></li>
    </ul>
</div>

<div class="formbody">
<?php

    if ($_POST["tjbx-abc"] == 'h-chi-vgs-8-com') {

        $username = $_POST['username'];
        $point = $_POST['point'];

        $userSql = "select * from feedbackinfo where title='$username'";
        $rs = mysql_query($userSql);
        $user = mysql_fetch_assoc($rs);

        if(!$user){
            echo "<script language=javascript>alert('用户找不到！');window.location='recharge.php'</script>";
            exit;
        }


        $now = time();
        $productId = 0;
        $userId = $user['id'];
        $price = 0;
        $days = 0;
        $type = 2; // 充积分

        $orderSql = "insert into `order` 
(product_id,user_id,order_number,amount,is_dealed,created,updated,days,`type`,`point`) value (
'$productId','$userId','','$price',1,$now,$now,$days,$type,$point)";

        $rs = mysql_query($orderSql);

        $userSql = "update `feedbackinfo` 
                    set point=point+$point where id=$userId";


        if (mysql_query($userSql)) {
            echo "<script language=javascript>alert('充值成功！');window.location='recharge.php'</script>";
        } else {
            echo "<script language=javascript>alert('充值失败！');window.location='recharge.php'</script>";
        }

        die();
    }
?>

    <form action="recharge.php" method="post">
        <input name="tjbx-abc" type="hidden" id="tjbx-abc" value="h-chi-vgs-8-com"/>
        <input name="id" type="hidden" id="id" value=""/>

        <ul class="forminfo">
            <li>
                <label>用户名</label>
                <input name="username" class="dfinput" required />
            </li>
            <li>
                <label>积分</label>
                <input name="point" type="number" required class="dfinput" />
            </li>
            <li>
                <label>&nbsp;</label>
                <input type="submit" class="btn" value="提&nbsp;&nbsp;交"/>
            </li>
        </ul>
    </form>

</div>

</body>

</html>
