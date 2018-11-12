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
    <script src="../js/jquery.js" ></script>
</head>

<body>
<header class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
    <h1 class="mui-title"><?echo $title;?></h1>
    <a class="mui-action-home mui-icon mui-icon-home mui-pull-right"></a>
</header>
<hr>

<div class="mui-content">
    <?if(@$error):?>
        <div class="alert"><?=$error?></div>
    <?endif;?>
    <form class="mui-input-group" id="compose-form" method="post">
        <div class="mui-input-row">
            <label>标题</label>
            <input type="hidden" id="id" value="<?=$product['id']?>">
            <input name="title" type="text" class="mui-input-clear" required placeholder="请输入标题" value="<?=$product['title']?>">
        </div>
        <div class="mui-input-row">
            <label>电话</label>
            <input name="phone" type="text" class="mui-input-clear" required placeholder="请输入电话" value="<?=$product['phone']?>">
        </div>
        <div class="mui-input-row">
            <label>价格</label>
            <input name="price" type="text" class="mui-input-clear" required placeholder="请输入价格" value="<?=$product['price']?>">
        </div>
        <div class="mui-input-row">
            <label>描述</label>
            <textarea name="description" id="description" cols="30" rows="5" required placeholder="请输入描述"><?=$product['description']?></textarea>
        </div>

        <div class="mui-input-row" style="padding-bottom: 10px;">
            <label>上传图片</label>
            <div class="image-uploader" id="image-uploader" >
                <? foreach ($pictures as $key => $picture): ?>
                    <div class="preview-item" data-id="<?=$picture['id']?>">
                        <img src="<?=$picture['image_path'] ?>" alt="">
                        <i class="mui-icon mui-icon-trash"></i>
                    </div>
                <? endforeach; ?>
                <input type="file" id="file-upload-btn" class="add-btn" onchange="fileSelected();">
            </div>
        </div>

        <div class="mui-button-row">
            <button class="mui-btn mui-btn-danger mui-btn-outlined" >提 交</button>
        </div>
    </form>
    <script src="<?echo $staticRootPath?>/js/mui.min.js"></script>
    <script type="text/javascript">
        var uploadUrl = "./imageUploadApi.php?dir=image&product_id="+<?=$product['id']?>;
        function fileSelected() {
            var file = document.getElementById('file-upload-btn').files[0];
            if (file) {
                var fd = new FormData();
                fd.append("imgFile", document.getElementById('file-upload-btn').files[0]);
                var xhr = new XMLHttpRequest();
                xhr.addEventListener("load", uploadComplete, false);
                xhr.addEventListener("error", uploadFailed, false);
                xhr.open("POST", uploadUrl);
                xhr.send(fd);
            }
        }

        function uploadComplete(result) {
            var rs = JSON.parse(result.target.response);
            var htmlTemplate = '        <div class="preview-item" data-id="{id}">  \n' +
            '            <img src="{url}" alt="">\n' +
            '     <i class="mui-icon mui-icon-trash"></i>       ' +
                '</div>'
            var html = htmlTemplate.replace("{url}",rs.url);
            html = html.replace("{id}",rs.id);
            $('#file-upload-btn').before(html);
        }

        function uploadFailed(evt) {
            alert("图片上传失败.");
        }

        $(function(){
            $(".preview-item").on('click',function(event){
                $id = $(this).attr("data-id");
                $item = $(this);
                if(confirm("删除此图片？")){
                    $.post("./imageUploadApi.php?action=del",{id:$id},function(rs){
                        var response = JSON.parse(rs);
                        if(response.status == 200){
                            $item.remove();
                        }else{
                            alert('删除失败!');
                        }
                    })
                }
            });
        })

        $("#compose-form").submit(function (event) {
            var data = $(this).serialize();

            event.preventDefault();
            mui.post(document.location.href,data,function(rs){
                var response = JSON.parse(rs);
                if(response.status == 200){
                    alert("操作成功!");
                    mui.fire(plus.webview.currentWebview().opener(), 'refresh');
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
</div>

</body>
</html>