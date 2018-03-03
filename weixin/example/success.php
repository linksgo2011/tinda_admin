<?php 
ini_set('date.timezone','Asia/Shanghai');

ini_set("display_errors", 1);
error_reporting(E_ERROR);

require_once("../../include/global.php");
$orderNumber=$_GET['order_number'];

$rs = mysql_query("select * from `order` where order_number='$orderNumber'");
$order = mysql_fetch_assoc($rs);

if(!$order){
    echo "<h1>订单找不到！</h1>";
    exit;
}
?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>腾达云支付</title>
    <link rel="stylesheet" href="../../css/weui.css"/>
</head>
<body>
    <h1>查看订单</h1>

    <div class="page__bd">
        <div class="weui-cells">
            <p class="weui-cell">订单号：<?php echo $order['order_number']?></p>
        </div>
    </div>
    <div class="page__bd">
        <div class="weui-cells">
            <p class="weui-cell">金额：<?php echo $order['amount']?></p>
        </div>
    </div>
    <div class="page__bd">
        <div class="weui-cells">
            <p class="weui-cell">充值时长：<?php echo $order['days']?>天</p>
        </div>
    </div>
</body>

</html>