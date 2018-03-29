
<?php
// 本文件用于测试代码片段
require_once("include/global.php");

$orderNumber = "47525152224403139";
$querySql = "select * from `order` where order_number='$orderNumber'";

$rs = mysql_query($querySql);
$order = mysql_fetch_assoc($rs);

print_r($order);

if(!$order['is_dealed']){
    if($order['type'] == 1){
        // 充时间
        $userId = $order['user_id'];

        $querySql = "select * from `feedbackinfo` where id=$userId";
        $rs = mysql_query($querySql);
        $user = mysql_fetch_assoc($rs);

        $endDateTimeStamp = strtotime($user['end_date']);

        if($endDateTimeStamp < time()){
            $endDateTimeStamp = time() + $order['days']*24*60*60;
        }else{
            $endDateTimeStamp = $endDateTimeStamp + $order['days']*24*60*60;
        }
        $endDate = date("Y-m-d",$endDateTimeStamp);

        if($userId){
            mysql_query("update `feedbackinfo` set end_date='$endDate' where id=$userId");
        }

        mysql_query("update `order` set is_dealed=1 where order_number='$orderNumber'");
    }else{
        // 充积分
        $userId = $order['user_id'];
        $point = $order['point'];
        mysql_query("update `feedbackinfo` 
                    set point=point+$point where id=$userId"
        );
        mysql_query("update `order` set is_dealed=1 where order_number='$orderNumber'");
    }
}

echo 1;