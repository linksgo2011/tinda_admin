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
    $titlesA = $_POST["titlesA"];
    $telsA = $_POST["telsA"];
    $commentsA = $_POST["commentsA"];
    $passsA = $_POST["passsA"];
//          $rs=mysql_query("select * from  feedbackinfo where title='".$titlesA."' and phone='".$telsA."' and comment='".$commentsA."'");
    $rs = mysql_query("select * from  feedbackinfo where title='" . $titlesA . "' and phone='" . $telsA . "'");
    $rows = mysql_fetch_assoc($rs);
    if ($rows["id"] == "") {
        echo '1';
        exit;
    }
    $userID = $rows["id"];
    $sql1 = "update feedbackinfo set pass='$passsA' where id='" . $userID . "'";
    if (mysql_query($sql1)) {
        echo '2';
    }
}

?>