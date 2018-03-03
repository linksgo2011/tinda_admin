<?php
require_once("../../include/global.php");
?>

<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>腾达云支付</title>
    <link rel="stylesheet" href="../../css/weui.css"/>
    <style>
        h1{text-align: center;font-weight: lighter}
    </style>
</head>

<body>
<h1>腾达云支付</h1>
<form action="doProvision.php">
    <div class="weui-cells__title">用户名</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <input class="weui-input" required name="username" placeholder="请输入用户名">
            </div>
        </div>
    </div>

    <div class="weui-cells__title">项目</div>
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
            支付金额：<span id="price">-</span>元
        </span>
    </label>

    <div class="weui-btn-area">
        <button class="weui-btn weui-btn_primary">确认</button>
    </div>
</form>

<script>
    function btnChange(item) {
        price = item.getAttribute("price");
        document.getElementById("price").textContent = price;
    }
</script>

</body>
</html>