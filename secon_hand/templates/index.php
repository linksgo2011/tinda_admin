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
    <a class="mui-action-home mui-icon mui-icon-home mui-pull-right"></a>
</header>

<div class="mui-content" style="background-color:#fff" id="entry">
    <div class="search-box">
        <form method="GET" action="<?echo wrapQueryParameters([],"latest.php")?>">
            <input type="text" name="keyword" class="mui-input-clear" placeholder="关键字搜索">
            <button  class="mui-btn mui-btn-danger mui-btn-outlined">搜索</button>
        </form>
    </div>
    <div class="a_ad">
        <img src="<?echo $banner?>" width="100%" alt="">
    </div>

    <div class="operations mui-row">
        <a href="javascript:go('./latest.php') " class="action mui-col-sm-4">
            <img src="<?echo $staticRootPath?>/images/zuixin.png" alt="">
            <p>最新发布</p>
        </a>
        <a href="javascript:go('./compose.php')" class="action mui-col-sm-4">
            <img src="<?echo $staticRootPath?>/images/delivery.png" alt="">
           <p>我要发布</p>
        </a>
        <a href="javascript:go('./my_info.php')" class="action mui-col-sm-4">
            <img src="<?echo $staticRootPath?>/images/gerendingzhi.png" alt="">
            <p>我发布的</p>
        </a>
    </div>

    <h5 class="module-title">最新发布</h5>
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
</div>
<script type="application/html" id="item-template">
    <li class="mui-table-view-cell mui-media mui-col-xs-6">
            <a href="detail.php?id={id}" class="product-item">
                            <img class="mui-media-object" src="{image_path}">
                    </a>
        <div class="mui-media-body">{title}</div>
    </li>
</script>

<script src="<?echo $staticRootPath?>/js/mui.min.js"></script>
<script src="../js/jquery.js" ></script>

<script>
    mui.init({
        preloadPages:[
            {
                url:"./compose.php"
            },
            {
                url:"./latest.php"
            },{
                url:"./my_info.php"
            }
        ],
        preloadLimit:5
    });

    function go(url){
        mui.openWindow({
        url: url,
        id: url,
            createNew:true
    });
    }

    mui.plusReady(function () {
        $("a.auto-open").click(function(event){
            event.preventDefault();
            go($(this).attr("href"));
        });
        $("a.mui-action-home").click(function(event){
            event.preventDefault();
            window.plus && plus.webview.getWebviewById('main').show();
        });

        if(!window.localStorage.getItem("showSecondHandPolicy")){
            mui.alert("本平台只提供信息查询，所产生的一切交易和本平台无关，在交易期间请核对身份，各自协商交易方式，以免上当受骗","声明","我知道了");
            window.localStorage.setItem("showSecondHandPolicy",true);
        }

        window.addEventListener('refresh', function(){
            $.get(".",function(rs){
                $("#entry").html($(rs)[17].innerHTML);
            })
        });
    });


        // mui.get(".",function(rs){
        //     var data = JSON.parse(rs);
        //     data.products.forEach(function(item){
        //         var imagePath = "./templates/images/no_pic.png";
        //         var html = document.getElementById("item-template").innerHTML;
        //         html = html.replace("{id}",item.id);
        //         html = html.replace("{title}",item.title);
        //         if(item.picture){
        //             imagePath = item.picture.image_path;
        //         }
        //         html = html.replace("{image_path}",imagePath);
        //         $("#latest").append(html);
        //     })
        // })
</script>
</body>
</html>