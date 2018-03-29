<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors','On');

require_once("../include/global.php");
require_once("returnPointForHost.php");

$liveID = $_POST['live_id'];
$username = $_POST['username'];

$userSql = "select * from feedbackinfo where title='$username'";
$rs = mysql_query($userSql);
$user = mysql_fetch_assoc($rs);

if(empty($user)){
    echo json_encode(array("status"=>false,"message"=>'用户找不到'));
    exit;
}

$liveSql = "select * from live where id=$liveID";
$rs = mysql_query($liveSql);
$live = mysql_fetch_assoc($rs);

if(empty($live)){
    echo json_encode(array("status"=>false,"message"=>'直播找不到!'));
    exit;
}

// 检查是否已经开通

$userId = $user['id'];
$liveOrderSql = "select * from live_order where user_id=$userId and live_id=$liveID";
$rs = mysql_query($liveOrderSql);
$liveOrder = mysql_fetch_assoc($rs);

if(!empty($liveOrder)){
    echo json_encode(array("status"=>true,"message"=>"已经开通"));
    exit;
}

$balance = $user['point'];
if($balance < $live['point']){
    echo json_encode(array("status"=>false,"message"=>'积分不足!'));
    exit;
}

$remainBalance = $balance-$live['point'];
$updateUserSql = "update feedbackinfo set point=$remainBalance where id=$userId";
if(!mysql_query($updateUserSql)){
    echo json_encode(array("status"=>false,"message"=>'用户更新失败!'));
    exit;
}

// log TODO 以后使用事务重构此处
$now = time();
$point = $live['point'];
$liveOrderInsertSql = "insert into live_order(`user_id`,`live_id`,`created`,`point`)
                value($userId,$liveID,$now,$point)
";
if(mysql_query($liveOrderInsertSql)){
    echo json_encode(array("status"=>true,"message"=>'购买成功!'));
    exit;
}else{
    echo json_encode(array("status"=>false,"message"=>'用户更新失败!'));
    exit;
}



