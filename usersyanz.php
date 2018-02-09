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
    $username = $_POST["username1"];
    $usertoke = $_POST["usertoke1"];
    if ($username == "" or $usertoke == "") {
        echo '1';
        die();
    } else {
        $rs = mysql_query("select * from  feedbackinfo where title='" . $username . "'");
        $rows = mysql_fetch_assoc($rs);
        if ($rows["us_koner"] <> "" and $rows["us_koner"] <> $usertoke) {
            echo '2';
            die();
        }
        if ($rows["us_koner"] <> "" and strtotime($rows["end_date"]) < time()) {
            echo '3';
            die();
        } else {
            echo '1';
            die();
        }
    }
}

?>