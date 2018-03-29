<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 'On');

require_once("../../include/admin.php");
require_once '../../lib/QcloudApi/QcloudApi.php';
$config = include "../../include/config-live.php";

$api = QcloudApi::load(QcloudApi::MODULE_LIVE, $config);

$package = array(
    'SignatureMethod' => 'HmacSHA256'
);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <link href="../css/style.css" rel="stylesheet" type="text/css"/>
</head>

<body>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="../default.php">首页</a></li>
        <li><a href="#">直播管理</a></li>
    </ul>
</div>

<div class="formbody">
<?php
    $appID = "1254896179"; // 应用ID

    if ($_POST["tjbx-abc"] == 'h-chi-vgs-8-com') {
        list($formToken,$id,$title) = array_values($_POST);

        $sql = "update live set
            title='$title' where id='" . $id . "'";

        if (mysql_query($sql)) {
            echo "<script language=javascript>alert('设置成功！');window.location='liveUsers.php'</script>";
        } else {
            echo "<script language=javascript>alert('编辑失败！');window.location='liveUsers.php'</script>";
        }

        die();
    }

    if($_GET['edit'] == 'del'){
        $id = $_GET['id'];

        $rs = mysql_query("select * from  live where id=$id");
        $live = mysql_fetch_assoc($rs);

        if(empty($live)){
            echo "<script language=javascript>alert('记录不存在！');</script>";
        }

        $rsp = $api->DeleteLVBChannel(array_merge($package, array(
            "channelIds.1" => $live['channel_id']
        )));

        if($rsp['codeDesc'] != "Success"){
            echo "<script language=javascript>alert('接口删除失败！');</script>";
        }

        if (mysql_query("delete from live where id=$id")) {
            echo "<script language=javascript>alert('删除成功！');window.location='liveUsers.php'</script>";
        } else {
            echo "<script language=javascript>alert('删除失败！');window.location='liveUsers.php'</script>";
        }
    }

    $listSql = "select
    feedbackinfo.title as username, 
    live.*
    from live,feedbackinfo where live.user_id = feedbackinfo.id order by live.id";

    //to be refactored
    $rs = mysql_query($listSql);
    $pagesize=20;
    $pageno=$_GET["pageno"];

    $recordcount=mysql_num_rows($rs);
    $pagecount=($recordcount-1)/$pagesize+1;

    if(empty($pageno) || $pageno <1)
    {
        $pageno=1;
    }
    if($pageno>$pagecount)
    {
        $pageno=$pagecount;
    }
    $startno=($pageno-1)*$pagesize;
    $listSql .= " limit $startno,$pagesize";

    $livesResult = mysql_query($listSql);
?>

    <table class="tablelist" >
        <thead>
        <tr>
            <th>用户名</th>
            <th>标题</th>
            <th>推流地址</th>
            <th>频道ID</th>
            <th>操作</th>
        </tr>
        </thead>

        <tbody>
    <?php while($live = mysql_fetch_assoc($livesResult)){?>
        <form name="edit" method="post" action="">
            <tr>
                <td>
                    <input name="tjbx-abc" type="hidden" value="h-chi-vgs-8-com" />
                    <input name="id" type="hidden"value="<?=$live["id"]?>">
                    <?=$live['username']?>
                </td>
                <td>
                    <input name="title" style="width:100px;"
                           required class="dfinput" value="<?=$live['title']?>"/>
                </td>
                <td style="word-break: break-all;">
                    <?=$live['push_url']?>
                </td>
                <td>
                    <?=$live['channel_id']?>
                </td>
                <td style="text-align: center">
                    <input type="submit" value="修改" class="btn1">
                    <a href="?edit=del&id=<?php echo $live['id']?>">删除</a>
                </td>
            </tr>
        </form>
    <?php } ?>
        </tbody>
    </table>

    <div class="pagin">
        <?php require_once("../page.php");?>
    </div>
</div>

</body>

</html>
