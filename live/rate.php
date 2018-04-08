<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors','On');

require_once("../include/global.php");

list($liveId,$rate,$username) = array_values($_POST);

if($rate < 0 || $rate > 10){
    echo json_encode(array("status"=>false,"message"=>"$rate 必须为1-10"));
    exit;
}

$userSql = "select * from feedbackinfo where title='$username'";
$rs = mysql_query($userSql);
$user = mysql_fetch_assoc($rs);

if(empty($user)){
    echo json_encode(array("status"=>false,"message"=>'用户找不到'));
    exit;
}

$userId = $user['id'];
$rs = mysql_query("select * from live_rate where user_id=$userId and live_id='" . $liveId . "'");
$liveRate = mysql_fetch_assoc($rs);

if($liveRate){
    echo json_encode(array("status"=>false,"message"=>"不能重复投票！"));
    return ;
}

$createSql = "insert into live_rate (`user_id`,`live_id`,`rate`) value(
          '$userId','$liveId',$rate
)";

if(mysql_query($createSql)){
    echo json_encode(array("status"=>true));
    exit;
}else{
    echo json_encode(array("status"=>false,"message"=>mysql_error()));
    exit;
}