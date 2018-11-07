<?if(!defined("ACCESSIBLE")){ exit;} ?>
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
    <h1 class="mui-title"><?echo $title;?></h1>
</header>

<div class="mui-content" style="background-color:#fff">
    <div class="search-box">
        <form method="GET" action="<?echo wrapQueryParameters([],"latest.php")?>">
            <input type="text" name="keyword" class="mui-input-clear" placeholder="关键字搜索">
            <button  class="mui-btn mui-btn-danger mui-btn-outlined">搜索</button>
        </form>
    </div>
    <div class="a_ad">
        <img src="http://placehold.it/400x300?text=no%20picture" width="100%" alt="">
    </div>

    <div class="operations mui-row">
        <a href="./latest.php" class="action mui-col-sm-4">
            <img src="<?echo $staticRootPath?>/images/zuixin.png" alt="">
            <p>最新发布</p>
        </a>
        <a href="./compose.php" class="action mui-col-sm-4">
            <img src="<?echo $staticRootPath?>/images/delivery.png" alt="">
           <p>我要发布</p>
        </a>
        <a href="./my_info.php" class="action mui-col-sm-4">
            <img src="<?echo $staticRootPath?>/images/gerendingzhi.png" alt="">
            <p>我发布的</p>
        </a>
    </div>

    <h5 class="module-title">最新发布</h5>
    <ul class="mui-table-view mui-grid-view">
        <?foreach ($products as $key=>$product):?>
            <li class="mui-table-view-cell mui-media mui-col-xs-6">
                <a href="detail.php?id=<?=$product['id']?>" class="product-item">
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
</div>
<script src="<?echo $staticRootPath?>/js/mui.min.js"></script>
</body>
</html>