<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors','On');

require_once("../include/global.php");

list($title,$time,$ifNeedPoint,$point,$img,$username) = array_values($_POST);
$ifNeedPoint = $ifNeedPoint?1:0;
$point = min(0,$point);

$time = strtotime($time);

if(!$time || $time <= time()){
    echo json_encode(array("status"=>false,"message"=>'时间不能选择今天以前'));
    exit;
}

$userSql = "select * from feedbackinfo where title='$username'";
$rs = mysql_query($userSql);
$user = mysql_fetch_assoc($rs);

if(empty($user)){
    echo json_encode(array("status"=>false,"message"=>'用户找不到'));
    exit;
}

if($user['point'] < 100){
    echo json_encode(array("status"=>false,"message"=>'积分不足100'));
    exit;
}

$rs = mysql_query("select * from apply_live where status=0 and username='" . $username . "'");
$applyLive = mysql_fetch_assoc($rs);

if($applyLive){
    echo json_encode(array("status"=>false,"message"=>"不能重复申请！"));
    return ;
}

$createSql = "insert into apply_live (`title`,`username`,`time`,`if_need_point`,`point`,`img`) value(
          '$title','$username',$time,$ifNeedPoint,$point,'$img'
)";

if(mysql_query($createSql)){
    echo json_encode(array("status"=>true));
    exit;
}else{
    echo json_encode(array("status"=>false,"message"=>mysql_error()));
    exit;
}