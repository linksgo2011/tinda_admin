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

function passLive($api,$package,$appID){
    $id = $_GET['id'];

    $rs = mysql_query("select * from apply_live where id=$id");
    $applyLive = mysql_fetch_assoc($rs);

    if(empty($applyLive)){
        echo "<script language=javascript>alert('记录不存在！');</script>";
    }
    $username = $applyLive['username'];
    $title = $applyLive['title'];
    $img = $applyLive['img']; // TODO 封面
    $time = $applyLive['time'];
    $ifNeedPoint = $applyLive['if_need_point'];
    $point = $applyLive['point'];

    $rs = mysql_query("select * from  feedbackinfo where title='" . $username . "'");
    $user = mysql_fetch_assoc($rs);

    if(empty($user)){
        echo "<script language=javascript>alert('用户不存在!');</script>";
        return ;
    }

    $userID = $user['id'];
    $rs = mysql_query("select * from live where user_id=$userID");
    $live = mysql_fetch_assoc($rs);

    if(!empty($live)){
        echo "<script language=javascript>alert('该用户已经开通直播!');</script>";
        return ;
    }

    $rsp = $api->CreateLVBChannel(array_merge($package, array(
        "channelName" => $title,
        "outputSourceType" => 3,
        "sourceList.1.name" => "video-1999",
        "sourceList.1.type" => 1,
    )));

    // create remote channel
    if($rsp['codeDesc'] != "Success"){
        echo "<script language=javascript>alert('添加失败,接口调用错误!');</script>";
        return;
    }

    $channelID = $rsp['channel_id'];
    $pushURL = $rsp['channelInfo']['upstream_address'];
    $now = time();

    $sql = "insert into 
            live(`user_id`,`title`,`push_url`,`channel_id`,`app_id`,`created`,`updated`,`img`,`if_need_point`,`point`,`time`) 
            VALUES(
              '$userID','$title','$pushURL','$channelID','$appID',$now,$now,'$img',$ifNeedPoint,$point,$time
            )";
    if (mysql_query($sql)) {

        $updateStatusSql = "update apply_live set status=1 where id=$id";
        mysql_query($updateStatusSql);

        echo "<script language=javascript>alert('添加成功!');window.location='applyLives.php'</script>";
    } else {
        echo "<script language=javascript>alert('添加失败!');</script>";
    }
}

    $appID = "1254896179"; // 应用ID

    if($_GET['edit'] == 'pass'){
        passLive($api,$package,$appID);
    }


    if($_GET['edit'] == 'deny'){
        $id = $_GET['id'];

        $rs = mysql_query("select * from apply_live where id=$id");
        $applyLive = mysql_fetch_assoc($rs);

        if(empty($applyLive)){
            echo "<script language=javascript>alert('记录不存在！');</script>";
        }

        $sql = "update apply_live set status=2 where id=$id";
        if (mysql_query($sql)) {
            echo "<script language=javascript>alert('更新成功!');window.location='applyLives.php'</script>";
        } else {
            echo "<script language=javascript>alert('更新失败!');</script>";
        }
    }

    $listSql = "select * from apply_live where 1 order by status";

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
            <th>开播时间</th>
            <th>是否需要积分</th>
            <th>观看积分</th>
            <th>状态</th>
            <th>封面</th>
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
                    <?=$live['title']?>
                </td>
                <td style="word-break: break-all;">
                    <?=date("Y-m-d H:i:s",$live['time'])?>
                </td>
                <td>
                    <?=array(0=>"否",1=>'是')[$live['if_need_point']]?>
                </td>
                <td>
                    <?=$live['point']?>
                </td>
                <td>
                    <?=array(0=>"申请中",1=>'已经处理',2=>'拒绝')[$live['status']]?>
                </td>
                <td>
                    <img src="<?=$live['img']?>" alt="">

                </td>
                <td style="text-align: center">
                    <?php if($live['status'] == 0):?>
                    <a href="?edit=pass&id=<?php echo $live['id']?>">通过</a>
                    <a href="?edit=deny&id=<?php echo $live['id']?>">拒绝</a>
                    <?php endif?>
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
