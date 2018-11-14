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
    <h1 class="mui-title">我的发布</h1>
    <a class="mui-action-home mui-icon mui-icon-home mui-pull-right"></a>
</header>

<div class="mui-content" style="background-color:#fff">

    <?foreach ($products as $key=>$product):?>
        <div class="mui-card" data-id="<?=$product['id']?>">
            <!--页眉，放置标题-->
            <div class="mui-card-header"><?=$product['title'];?></div>
            <!--内容区-->
            <div class="mui-card-content">
                <div class="image-box">
                    <?if($product['picture']):?>
                        <img width="100%" src="<?=$product['picture']['image_path']?>">
                    <?else:;?>
                        <img  width="100%" src="<?echo $staticRootPath?>/images/no_pic.png">
                    <?endif?>
                </div>
            </div>
            <!--页脚，放置补充信息或支持的操作-->
            <div class="mui-card-footer mui-row">
                <a href="./detail.php?id=<?=$product['id'];?>" class="txt-c mui-col-sm-4"> <i class="mui-icon mui-icon-chatbubble"></i></a>
                <a href="./compose.php?id=<?=$product['id'];?>" class="txt-c mui-col-sm-4"> <i class="mui-icon mui-icon-compose"></i></a>
                <a href="javascript:void(0);" class="del-btn" class="txt-c mui-col-sm-4"> <i class="mui-icon mui-icon-trash"></i></a>
            </div>
        </div>
    <?endforeach;?>

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

    mui.plusReady(function(){
        $(".del-btn").click(function (event) {
            if(!confirm("确认删除？")){
                return;
            }
            var $item = $(this).parents(".mui-card");
            var id = $item.attr("data-id");
            var url = './compose.php?action=del&id='+id;
            mui.get(url,function(rs){
                var response = JSON.parse(rs);
                if(response.status == 200){
                    alert("操作成功!");
                    $item.remove();
                }else{
                    alert(response.error);
                }
            })
        })

        $("a.mui-action-home").click(function(event){
            event.preventDefault();
            window.plus && plus.webview.getWebviewById('main').show();
        });
    })

</script>
</body>
</html>