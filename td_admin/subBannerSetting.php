<!-- 查询页面banner设置 -->

<?php
require_once("../include/global.php");

// 用户认证
$ad_name1234=$_SESSION["ad_name1234"];
$ad_id1234=$_SESSION["ad_id1234"];

if($_GET['tj'] == 'out'){
    session_destroy();
    echo "<script language=javascript>alert('退出成功！');window.top.location.href='index.php'</script>";
}
$sql="select * from hchi_admin where ad_name='".$ad_name1234."' and id='".$ad_id1234."'";
$rs=mysql_query($sql);
if(mysql_num_rows($rs)<>1)
{
    session_destroy();
    echo "<script language=javascript>alert('未登录或登录超时！请返回，重新登录，谢谢!');window.top.location.href='index.php'</script>";
    die();
}
?>

<?php

$meteKey = "subBanner";

$selectSql = "select * from meta where `key`='$meteKey'";
$results = mysql_query($selectSql);
$record = mysql_fetch_assoc($results);

if($_POST["tjbx-abc"]=='h-chi-vgs-8-com')
{
    $logoA=$_POST["img"];

    $sql1="update meta set value='$logoA' where `key`='$meteKey'";

    if (mysql_query($sql1))
    {
        echo "<script language=javascript>alert('修改成功！');</script>";
    }else{
        echo "<script language=javascript>alert('修改成功！');</script>";
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <link rel="stylesheet" href="../kindeditor/themes/default/default.css" />
    <link rel="stylesheet" href="../kindeditor/plugins/code/prettify.css" />
    <script charset="utf-8" src="../kindeditor/kindeditor-all.js"></script>
    <script charset="utf-8" src="../kindeditor/lang/zh-CN.js"></script>
    <script charset="utf-8" src="../kindeditor/plugins/code/prettify.js"></script>

    <script>
        KindEditor.ready(function(K) {
            var editor = K.editor({
                allowFileManager : true
            });
            K('#image1').click(function() {
                editor.loadPlugin('image', function() {
                    editor.plugin.imageDialog({
                        imageUrl : K('#url1').val(),
                        clickFn : function(url, title, width, height, border, align) {
                            K('#url1').val(url);
                            editor.hideDialog();
                        }
                    });
                });
            });
        });
    </script>
</head>

<body>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="default.php">首页</a></li>
        <li><a href="#">分类广告设置</a></li>
    </ul>
</div>

<div class="formbody" style="background:#ddd">
    <div id="usual1" class="usual">

        <div class="tabson">
            <form id="form1" name="form1" action="subBannerSetting.php" method="post">
                <input name="tjbx-abc" type="hidden" id="tjbx-abc" value="h-chi-vgs-8-com" />

                <ul class="forminfo">
                    <li>
                        <label>广告图片</label>
                        <input name="img"type="text" class="dfinput" id="url1" value="<?php echo $record["value"]?>" readonly="readonly" />
                        <input type="button" id="image1" class="btn1" value="选择图片" />&nbsp;&nbsp;640*180像素
                    </li>
                    <li><label>&nbsp;</label><input type="submit" class="btn" value="确 认"/></li>
                </ul>
            </form>
        </div>
    </div>
</div>

</body>

</html>

