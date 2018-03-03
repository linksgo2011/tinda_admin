<?php
require_once("../../include/global.php");
?>

<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>腾达手机版自助开通</title>
    <link rel="stylesheet" href="../../css/weui.css"/>
    <style>
        h1{text-align: center;font-weight: lighter}
    </style>
</head>

<body>
<strong><h1>腾达手机版自助开通</h1></strong>
<form action="doProvision.php">
    <div class="weui-cells__title">用户名(必须是已经注册的帐号)</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <input class="weui-input" required name="username" placeholder="请输入用户名">
            </div>
        </div>
    </div>

    <div class="weui-cells__title">开通时间</div>
    <div class="weui-cell weui-cell_select">
        <div class="weui-cell__bd">
            <select class="weui-select" required name="project" id="productList" onchange='btnChange(this[selectedIndex]);'>
                <?php
                $rs = mysql_query("select * from product");
                while ($product = mysql_fetch_assoc($rs)) {
                    echo '<option value="'.$product['id'].'" price="'.$product['price'].'">'.$product['name'].'</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <label for="weuiAgree" class="weui-agree">
        <span class="weui-agree__text">
            支付金额：<font  color="#FF0000"  ><span id="price">-</span></font>元
        </span>
    </label>

    <div class="weui-btn-area">
        <button class="weui-btn weui-btn_primary">确认</button>
    </div>

</form>
<p style="text-align:center;">
	<span style="color:#E53333;font-size:18px;"><strong>扫二维码进行安装新版手机软件</strong></span>
</p>
<p style="text-align:center;">
	<img src="http://admin.tengdakey.com/weixin/zf.png" width="280" height="280" alt="" />
</p>



<script>
    function btnChange(item) {
        price = item.getAttribute("price");
        document.getElementById("price").textContent = price;
    }
</script>

</body>
</html>