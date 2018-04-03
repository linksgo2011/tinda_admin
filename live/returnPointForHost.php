<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors','On');
require_once '../lib/QcloudApi/QcloudApi.php';
require_once("../include/global.php");

$config = include "../include/config-live.php";
$api = QcloudApi::load(QcloudApi::MODULE_LIVE, $config);

$liveID = $_POST['live_id'];
$username = $_POST['username'];


$liveSql = "select * from live where id=$liveID";
$rs = mysql_query($liveSql);
$live = mysql_fetch_assoc($rs);

if(empty($live)){
    echo json_encode(array("status"=>false,"message"=>'直播找不到!'));
    exit;
}
if($live['time'] <= time()){
    return;
}
if($live['if_returned_point']){
    return;
}

// 获取直播详情,检查直播状态然后返还积分

$package = array(
    'SignatureMethod' => 'HmacSHA256',
    'channelId' => $live['channel_id']
);
$rsp = $api->DescribeLVBChannel($package);
if($rsp['codeDesc'] != "Success"){
    return;
}

if($rsp['channelInfo'][0]['channel_status'] != 1){
    return;
}

$user_id = $live['user_id'];
$returnPointSql = "update feedbackinfo set point=point+100 where id=$user_id";
$updateLiveStatusSql = "update live set if_returned_point=1 where id=$liveID";

mysql_query($returnPointSql);
mysql_query($updateLiveStatusSql);