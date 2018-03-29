<?php

error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors','On');

require_once("include/global.php");

const MAX_TIME = 6;

if(!empty($_POST)){
    list($username,$content,$channelID) = array_values($_POST);
    $now = time();
    $insertSql = "insert into `messages`(`username`,`content`,`created`,`channel_id`) 
                  values('$username','$content',$now,$channelID)";

    if(mysql_query($insertSql)){
        echo 0;
    }else{
        echo mysql_error();
    }

    exit;
}else{
    list($username,$time,$channelID) = array_values($_GET);

    $time = $time?$time:time();
    $i = 0;

    $output = [];
    while ($i< MAX_TIME){
        $selectSql = "select * from `messages` 
                      where `channel_id`=$channelID and `created` > $time and `username` != '$username'";
        $rs = mysql_query($selectSql);

        while ($row = mysql_fetch_assoc($rs)){
            array_push($output,$row);
        }
        if(sizeof($output) > 0){
            break;
        }
        sleep(1);
        $i++;
    }

    echo json_encode($output);
    exit;
}