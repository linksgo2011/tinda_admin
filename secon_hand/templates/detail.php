<? if (!defined("ACCESSIBLE")) {
    exit;
} ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><? echo $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="<? echo $staticRootPath ?>/css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="<? echo $staticRootPath ?>/css/app.css"/>
</head>

<body>
<header class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
    <h1 class="mui-title"><? echo $title ?></h1>
    <a class="mui-action-home mui-icon mui-icon-home mui-pull-right"></a>
</header>

<div class="mui-content product-detail" style="background-color:#fff">

    <h5 class="module-title">基本信息</h5>
    <ul class="mui-table-view">
        <li class="mui-table-view-cell">
            卖家: <? echo $product['user']['title']; ?>
        </li>
        <li class="mui-table-view-cell">
            价格: <? echo $product['price']; ?></a>
        </li>
        <li class="mui-table-view-cell">
            联系方式: <a class="tel-link" href="tel:<? echo $product['phone']; ?>"><? echo $product['phone']; ?></a>
        </li>
        <li class="mui-table-view-cell">
            发布时间: <? echo $product['created_at']; ?></a>
        </li>
        <li class="mui-table-view-cell">
            <div class="description">
                <? echo $product['description']; ?>
            </div>
            <? foreach ($product['pictures'] as $key => $picture): ?>
                <p><img src="<?= $picture['image_path'] ?>"></p>
            <? endforeach; ?>
        </li>
    </ul>

    <h5 class="module-title">用户留言</h5>
    <ul class="mui-table-view">
        <?if(empty($product['comments'])):?>
            <li class="mui-table-view-cell">暂无留言</li>
        <?endif;?>
        <? foreach ($product['comments'] as $key => $comment): ?>
            <li class="mui-table-view-cell">
                <span class="message-owner"><?= $comment['user']['title'] ?> (<?= $comment['created_at'] ?>):</span>
                <?= $comment['comment'] ?>
            </li>
        <? endforeach; ?>
    </ul>

    <br>
    <form class="mui-input-group comment-form" method="post" id="comment-form">
        <div class="mui-input-row">
            <input type="text" name="comment" class="mui-input-clear" placeholder="请输入留言...">
        </div>
        <div class="mui-button-row">
            <button class="mui-btn mui-btn-danger mui-btn-outlined">提交留言</button>
        </div>
    </form>
</div>
<script src="<?echo $staticRootPath?>/js/mui.min.js"></script>
<script src="../js/jquery.js" ></script>

<script>
    $("#comment-form").submit(function (event) {
        var data = $(this).serialize();

        event.preventDefault();
        mui.post(document.location.href,data,function(rs){
            var response = JSON.parse(rs);
            if(response.status == 200){
                alert("操作成功!");
                document.location.reload();
            }else{
                alert(response.error);
            }
        })
    });

    $("a.mui-action-home").click(function(event){
        event.preventDefault();
        window.plus && plus.webview.getWebviewById('main').show();
    });
</script>
</body>
</html>