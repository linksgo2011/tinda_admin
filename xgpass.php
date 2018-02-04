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
    $rs = mysql_query("select * from  feedbackinfo where title='" . $zb_hyname . "' and pass='" . $zb_title . "'");
    $rows = mysql_fetch_assoc($rs);
    if ($rows["id"] == "") {
        echo '2';
        exit;
    }

    $sql1 = "update feedbackinfo set pass='$zb_date' where title='" . $zb_hyname . "'";
    if (mysql_query($sql1)) {
        echo '1';
    }
}

?>