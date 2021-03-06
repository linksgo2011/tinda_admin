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

$userId = $order['user_id'];
$rs = mysql_query("select * from `feedbackinfo` where id='$userId'");
$user = mysql_fetch_assoc($rs);
$types = array("1"=>"时间","2"=>"积分");
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
            <p class="weui-cell">用户名：<?php echo $user['title']?></p>
        </div>
    </div>
    <div class="page__bd">
        <div class="weui-cells">
            <p class="weui-cell">类型：<?php echo $types[$order['type']]?></p>
        </div>
    </div>
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
            <p class="weui-cell">积分：<?php echo $order['point']?></p>
        </div>
    </div>
    <div class="page__bd">
        <div class="weui-cells">
            <p class="weui-cell">充值时长：<?php echo $order['days']?>天</p>
        </div>
    </div>
    <div class="page__bd">
        <div class="weui-cells">
            <p class="weui-cell">到期时间：<?php echo $user['end_date']?></p>
        </div>
    </div>
    <div class="weui-btn-area">
        <a href="javascript:void" onclick="directToHome()" class="weui-btn weui-btn_primary">返回</a>
    </div>

    <script>
        function directToHome(){
            var url =window.location.origin+window.location.pathname.replace("success.php","provision.php");
            window.location.href = url;
        }
    </script>
</body>

</html>