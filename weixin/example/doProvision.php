<?php 
ini_set('date.timezone','Asia/Shanghai');

ini_set("display_errors", 1);
error_reporting(E_ERROR);

require_once("../../include/global.php");
$username=$_GET['username'];
$productId=$_GET['project'];

$rs = mysql_query("select * from  feedbackinfo where title='$username'");
$user = mysql_fetch_assoc($rs);

$userId=$user['id'];
$orderNumber=$userId.$productId.time();

$rs = mysql_query("select * from product where id=$productId");
$product = mysql_fetch_assoc($rs);
$price = $product['price'];
$days = $product['days'];

if(!$user){
    echo "<h1>该帐号尚未注册,请扫描二维码安装并注册后进行开通</h1>";
    exit;
}
if(!$product){
    echo "<h1>产品找不到！</h1>";
    exit;
}

// 创建内部订单
$now = time();

$orderSql = "insert into `order` 
(product_id,user_id,order_number,amount,is_dealed,created,updated,days) value (
'$productId','$userId','$orderNumber','$price',0,$now,$now,$days)";

$rs = mysql_query($orderSql);
if(!$rs){
    echo "<h1>订单创建失败！</h1>";
    exit;
}

//error_reporting(E_ERROR);
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require_once 'log.php';

//初始化日志
$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

//打印输出数组信息
function printf_info($data)
{
    foreach($data as $key=>$value){
        echo "<font color='#00ff55;'>$key</font> : $value <br/>";
    }
}

//①、获取用户openid
$tools = new JsApiPay();
$openId = $tools->GetOpenid();

//②、统一下单
$input = new WxPayUnifiedOrder();
$input->SetBody("腾达商品购买"+$product['name']);
$input->SetAttach("default");
$input->SetOut_trade_no($orderNumber);
$input->SetTotal_fee($price*100);// 单位为分需要转换
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag("test");
$input->SetNotify_url("http://admin.tengdakey.com/weixin/example/notify.php");
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openId);

$order = WxPayApi::unifiedOrder($input);
$jsApiParameters = $tools->GetJsApiParameters($order);
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>腾达云支付</title>
    <link rel="stylesheet" href="../../css/weui.css"/>

    <script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
			function(res){
                WeixinJSBridge.log(res.err_msg);

                if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                    alert("支付成功!");
                    window.location.href = window.location.href.replace("doProvision","success")
                        + "&order_number=<?php echo $orderNumber?>";
                }else{
                    alert("充值失败，请重试！");
                }
			}
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
	</script>
</head>
<body>
    <h1>确认支付</h1>
    <label for="weuiAgree" class="weui-agree">
        <span class="weui-agree__text" style="color:red;font-size: 14px;">
            支付金额：<?php echo $price?> 元
        </span>
    </label>

    <div class="weui-btn-area">
        <button class="weui-btn weui-btn_primary" onclick="callpay()">立即支付</button>
    </div>
</body>
</html>