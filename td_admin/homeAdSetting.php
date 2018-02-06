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


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="default.php">首页</a></li>
        <li><a href="#">修改首页广告</a></li>
    </ul>
</div>

<div class="formbody">
    <?php

    // 处理POST逻辑

    if($_POST["tjbx-abc"]=='h-chi-vgs-8-com')
    {

        $homegg = $_POST['homegg'];
        $gomeurl = $_POST['gomeurl'];
        $sql = "update hchi_setup set homegg='$homegg',gomeurl='$gomeurl' where id=1";

        if(mysql_query($sql))
        {
            echo "<script language=javascript>alert('修改成功!');</script>";
        }
        else
        {
            echo "<script language=javascript>alert('编辑失败！');</script>";
        }
        $record = $_POST;

    }else{
        $results = mysql_query("select * from  hchi_setup");
        $record = mysql_fetch_assoc($results);
    }
    ?>

    <form method="post" action="homeAdSetting.php">
        <!--  TOKEN      -->
        <input name="tjbx-abc" type="hidden" id="tjbx-abc" value="h-chi-vgs-8-com" />

        <input name="id" type="hidden" id="id" value="<?php echo $record["id"]?>" />
        <ul class="forminfo">

            <li>
                <label>首页广告</label><input name="homegg" class="dfinput" required="required" value="<?php echo $record["homegg"]?>"/>
            </li>
            <li>
                <label>URL</label><input name="gomeurl" class="dfinput" required="required" value="<?php echo $record["gomeurl"]?>"/>
            </li>

            <li><label>&nbsp;</label><input type="submit" class="btn" value="提&nbsp;&nbsp;交"/>
            </li>
        </ul>
    </form>

</div>


</body>

</html>
