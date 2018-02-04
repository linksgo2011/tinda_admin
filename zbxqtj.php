<?php

header("Access-Control-Allow-Origin:*");
header('Access-Control-Allow-Methods:POST');
// 响应头设置     
header('Access-Control-Allow-Headers:x-requested-with,content-type');
header("Content-type: text/html; charset=utf-8");
ini();

function ini()
{
    require_once("include/global.php");
    $zb_title = $_POST["zbtitle"];
    $zb_date = $_POST["zbdate"];
    $zb_hyname = $_POST["username"];

    $sql1 = "insert into hchi_zhubo (zb_title,zb_date,zb_hyname) values ('$zb_title','$zb_date','$zb_hyname')";
    if (mysql_query($sql1)) {
        echo '1';
    } else {
        echo '2';
    }
}

?>