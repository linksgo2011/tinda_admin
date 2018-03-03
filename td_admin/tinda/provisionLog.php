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
</head>

<body>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="../default.php">首页</a></li>
        <li><a href="#">充值记录</a></li>
    </ul>
</div>

<div class="formbody">
    <table class="tablelist">
        <thead>
        <tr>
            <th>用户</th>
            <th>金额</th>
            <th>充值天数</th>
            <th>充值时间</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $rs = mysql_query("

select `order`.*,
`feedbackinfo`.* 
from `order`,`feedbackinfo` 
where is_dealed=1 and `order`.user_id=`feedbackinfo`.id 
order by created desc

");

        while ($product = mysql_fetch_assoc($rs)) {
            $user = $product['title'];
            $amount = $product['amount'];
            $days = $product['days'];
            $created = date("Y-m-d h:i:s",$product['created']);

            echo "<tr>
                <td>$user</td>
                <td>$amount</td>
                <td>$days</td>
                <td>$created</td>
            </tr>";
        }
        ?>
        </tbody>
    </table>

</div>

</body>

</html>
