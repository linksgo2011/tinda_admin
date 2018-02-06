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

    $meteKey = "subBanner";

    $selectSql = "select * from meta where `key`='$meteKey'";
    $results = mysql_query($selectSql);
    $record = mysql_fetch_assoc($results);

    if ($record["value"] == "") {
        $arr = '<img src="images/gg1.jpg" width="100%">';
    } else {
        $arr = "<img src='" . $record["value"] . "' width='100%'>";
    }
    echo json_encode($arr);
//end
}

?>