<?if(!defined('ACCESSIBLE')){ exit;} ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?echo $title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="<?echo $staticRootPath?>/css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="<?echo $staticRootPath?>/css/app.css"/>
</head>

<body>
<header class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
    <h1 class="mui-title"><?echo $title?></h1>
    <a class="mui-action-home mui-icon mui-icon-home mui-pull-right"></a>
</header>

<div class="mui-content" style="background-color:#fff">
    <ul class="mui-table-view mui-grid-view">
        <?foreach ($products as $key=>$product):?>
            <li class="mui-table-view-cell mui-media mui-col-xs-6">
                <a href="detail.php?id=<?=$product['id']?>" class="product-item auto-open">
                    <?if($product['picture']):?>
                        <img class="mui-media-object" src="<?=$product['picture']['image_path']?>">
                    <?else:;?>
                        <img class="mui-media-object" src="<?echo $staticRootPath?>/images/no_pic.png">
                    <?endif?>
                </a>
                <div class="mui-media-body"><?=$product['title'];?></div>
            </li>
        <?endforeach;?>
    </ul>


    <?if($pagination):?>
        <div class="pagination mui-row">
            <?if($pagination['prePage']):?>
            <a style="float:left;" href="<?echo wrapQueryParameters(["page"=>$pagination['prePage']]);?>" class="action mui-col-sm-6">
                上一页
            </a>
            <?endif;?>
            <?if($pagination['nextPage']):?>
                <a style="float:right;" href="<?echo wrapQueryParameters(["page"=>$pagination['nextPage']]);?>" class="action mui-col-sm-6">
                    下一页
                </a>
            <?endif;?>
        </div>
    <?endif;?>
</div>
<script src="<?echo $staticRootPath?>/js/mui.min.js"></script>
<script src="../js/jquery.js" ></script>
<script>
    function go(url){
        mui.openWindow({
            url: url,
            id: url,
        });
    }

    mui.ready(function () {
        $("a.auto-open").click(function(event){
            event.preventDefault();
            go($(this).attr("href"));
        });

        $("a.mui-action-home").click(function(event){
            event.preventDefault();
            window.plus && plus.webview.getWebviewById('main').show();
        });
    });
</script>
</body>
</html>