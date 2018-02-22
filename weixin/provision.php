<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>WeUI</title>
    <link rel="stylesheet" href="../css/weui.css"/>
    <style>
        h1{text-align: center;font-weight: lighter}
    </style>
</head>

<body>
<h1>腾达云支付</h1>
<form action="">
    <div class="weui-cells__title">用户名</div>
    <div class="weui-cells">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <input class="weui-input" type="text" placeholder="请输入用户名">
            </div>
        </div>
    </div>

    <div class="weui-cells__title">项目</div>
    <div class="weui-cell weui-cell_select">
        <div class="weui-cell__bd">
            <select class="weui-select" name="select1">
                <option selected="" value="1">1年</option>
                <option value="2">2年</option>
                <option value="3">3年</option>
            </select>
        </div>
    </div>
    <label for="weuiAgree" class="weui-agree">
        <span class="weui-agree__text">
            支付金额：100元
        </span>
    </label>

    <div class="weui-btn-area">
        <a class="weui-btn weui-btn_primary" href="javascript:">微信支付</a>
    </div>
</form>

</body>
</html>