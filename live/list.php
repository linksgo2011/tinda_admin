<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors','On');

require_once '../lib/QcloudApi/QcloudApi.php';
require_once("../include/global.php");

$config = array(
    'SecretId'       => "AKIDJSO6brOhHdlfLlfsc6MN8euvgCS0RXUD",
    'SecretKey'      => "c0A6qMehW6TbWDgutc7NN7cr8E5i7HDv",
    'RequestMethod'  => 'GET',
    'DefaultRegion'  => 'ap-guangzhou');
$api = QcloudApi::load(QcloudApi::MODULE_LIVE, $config);
$package = array(
    'SignatureMethod' => 'HmacSHA256'
);
$rsp = $api->DescribeLVBChannelList($package);

if(!$rsp){
    echo 1;
}

$channels =[];
$ids = [];
foreach ($rsp['channelSet'] as $item) {
    $ids[] = "'".$item['channel_id']."'";
    $channels[$item['channel_id']] = $item;
}

$idString = join(",",$ids);
$keyword = $_GET['keyword'];
$wherePart = $keyword?"and `title` like '%$keyword%'":"";

$rs = mysql_query("select * from live where channel_id in ($idString) $wherePart");

$output = array();

while ($row = mysql_fetch_assoc($rs)){
    $row['status'] = $channels[$row['channel_id']]['channel_status'];
    $output[] = $row;
}

echo json_encode($output);
