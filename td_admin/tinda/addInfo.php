<?php
require_once("../../include/global.php");
$ad_name1234=$_SESSION["ad_name1234"];
$ad_id1234=$_SESSION["ad_id1234"];

if($_GET['tj'] == 'out'){
    session_destroy();
    echo "<script language=javascript>alert('退出成功！');window.location='../index.php'</script>";
}
$sql="select * from hchi_admin where ad_name='".$ad_name1234."' and id='".$ad_id1234."'";
$rs=mysql_query($sql);
if(mysql_num_rows($rs)<>1)
{
    session_destroy();
    echo "<script language=javascript>alert('未登录或登录超时！请返回，重新登录，谢谢!');window.top.location.href='../index.php'</script>";
    die();
}
?>
<?php

if($_POST["tjbx-abc1"]=='h-chi-vgs-8-com')
{
    $fl1=$_POST["fl1"];
    $name1=$_POST["name1"];
    $logoA=$_POST["img"];
    $url1=$_POST["url2"];
    $content = $_POST['content'];
    $sql2="insert into finl (fl1,name,logoA,url1,`bodys`) values 
    ('$fl1','$name1','$logoA','$url1','$content')";
    if(mysql_query($sql2))
    {
        echo "<script language=javascript>alert('添加成功！');window.location='chaxfinl.php'</script>";
    }
    die();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <!--link href="../css/select.css" rel="stylesheet" type="text/css" /-->
    <script type="text/javascript" src="../js/showdate.js"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery.idTabs.min.js"></script>
    <script type="text/javascript" src="../js/select-ui.min.js"></script>
    <link rel="stylesheet" href="/kindeditor/themes/default/default.css" />
    <link rel="stylesheet" href="/kindeditor/plugins/code/prettify.css" />
    <script charset="utf-8" src="/kindeditor/kindeditor-all.js"></script>
    <script charset="utf-8" src="/kindeditor/lang/zh-CN.js"></script>
    <script charset="utf-8" src="/kindeditor/plugins/code/prettify.js"></script>
    <script>
        KindEditor.ready(function(K) {
            var editor1 = K.create('textarea[name="content"]', {
                cssPath : '/kindeditor/plugins/code/prettify.css',
                uploadJson : '/kindeditor/php/upload_json.php',
                fileManagerJson : '/kindeditor/php/file_manager_json.php',
                allowFileManager : true,
                afterCreate : function() {
                    var self = this;
                    K.ctrl(document, 13, function() {
                        self.sync();
                        K('form[name=example]')[0].submit();
                    });
                    K.ctrl(self.edit.doc, 13, function() {
                        self.sync();
                        K('form[name=example]')[0].submit();
                    });
                }
            });
            prettyPrint();
        });
    </script>
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
        <li><a href="#">添加资料</a></li>
    </ul>
</div>

<div class="formbody" style="background:#ddd">
    <div id="usual1" class="usual">

        <div class="tabson">
            <form id="form1" name="form1" action="addInfo.php" method="post">
                <input name="tjbx-abc1" type="hidden" id="tjbx-abc1" value="h-chi-vgs-8-com" />
                <ul class="forminfo">
                    <li>
                        <label>分类</label>
                        <select name="fl1" id="fl1"  class="dfinput">
                            <option value="0" selected>+新建大类</option>
                            <?php
                            $sql="select * from finl where fl1=0";
                            $rs=mysql_query($sql);
                            while($rows=mysql_fetch_assoc($rs))
                            {
                                echo '<option value='.$rows["id"].'>'.$rows["name"].'</option>';
                                $flID=$rows["id"];
                                $sql1="select * from finl where fl1='".$flID."'";
                                $rs1=mysql_query($sql1);
                                while($rows1=mysql_fetch_assoc($rs1))
                                {
                                    echo '<option value='.$rows1["id"].'>&nbsp;&nbsp;---'.$rows1["name"].'</option>';
                                }
                            }
                            ?>
                        </select>
                    </li>
                    <li>
                        <label>名称</label>
                        <input name="name1" type="text" id="name1" value="" class="dfinput" size="60">
                    </li>
                    <li>
                        <label>标志</label>
                        <input name="img"type="text" class="dfinput" id="url1" value="" readonly="readonly" />
                        <input type="button" id="image1" class="btn1" value="选择图片" />&nbsp;&nbsp;大类不用上传
                    </li>
                    <li>
                        <label>网址</label>
                        <input name="url2" type="text" id="url2" value=""  class="dfinput" size="60">
                    </li>
                    <li>
                        <label>详&nbsp;&nbsp;情</label><textarea id="editor_id" name="content" style="width:800px;height:450px;"></textarea>
                    </li>
                    <li><label>&nbsp;</label><input type="submit" class="btn" value="确认添加"/></li>
                </ul>
            </form>
        </div>
    </div>
</div>

</body>

</html>
