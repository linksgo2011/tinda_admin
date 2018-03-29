<?php

error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 'On');

require_once("../../include/admin.php");
require_once '../../lib/QcloudApi/QcloudApi.php';
$config = include "../../include/config-live.php";

$api = QcloudApi::load(QcloudApi::MODULE_LIVE, $config);
$appID="1254896179";

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
    <link rel="stylesheet" href="../../kindeditor/themes/default/default.css" />
    <link rel="stylesheet" href="../../kindeditor/plugins/code/prettify.css" />
    <script type="text/javascript" src="../../js/jquery.js"></script>
    <script charset="utf-8" src="../../kindeditor/kindeditor-all.js"></script>
    <script charset="utf-8" src="../../kindeditor/lang/zh-CN.js"></script>
    <script charset="utf-8" src="../../kindeditor/plugins/code/prettify.js"></script>

    <script>
        KindEditor.ready(function(K) {
            var editor = K.editor({
                allowFileManager : true
            });
            K('#image-button').click(function() {
                editor.loadPlugin('image', function() {
                    editor.plugin.imageDialog({
                        imageUrl : K('#img').val(),
                        clickFn : function(url, title, width, height, border, align) {
                            K('#img').val(url);
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
        <li><a href="../default.php">首页</a></li>
        <li><a href="#">项目设置</a></li>
    </ul>
</div>

<div class="formbody">
    <?php

    if ($_POST["tjbx-abc"] == 'h-chi-vgs-8-com') {

        function addLiveUser($api,$package,$appID){
            list($formToken, $id, $username, $title,$img) = array_values($_POST);

            // check user info and get user id
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
            live(`user_id`,`title`,`push_url`,`channel_id`,`app_id`,`created`,`updated`,`img`) 
            VALUES(
              '$userID','$title','$pushURL','$channelID','$appID',$now,$now,'$img'
            )";

            if (mysql_query($sql)) {
                echo "<script language=javascript>alert('添加成功!');window.location='liveUsers.php'</script>";
            } else {
                echo "<script language=javascript>alert('添加失败!');</script>";
            }
        }

        addLiveUser($api,$package,$appID);
    }
    ?>

    <form method="post">
        <input name="tjbx-abc" type="hidden" id="tjbx-abc" value="h-chi-vgs-8-com"/>
        <input name="id" type="hidden" id="id" value=""/>

        <ul class="forminfo">
            <li>
                <label>用户名</label>
                <input name="username" class="dfinput" required/>
            </li>
            <li>
                <label>直播标题</label>
                <input name="title" required class="dfinput"/>
            </li>
            <li>
                <label for="img">封面</label>
                <input name="img" type="text" class="dfinput" id="img" value="<?php echo $record["value"]?>" readonly="readonly" />
                <input type="button" id="image-button" class="btn1" value="选择图片" />&nbsp;&nbsp;640*180像素
            </li>
            <li>
                <label>&nbsp;</label>
                <input type="submit" class="btn" value="提&nbsp;&nbsp;交"/>
            </li>
        </ul>
    </form>
</div>

</body>

</html>
