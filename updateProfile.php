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
    $title = $_POST["title"];

    $email = $_POST["email"];
    $area = $_POST["area"];
    $phone = $_POST["phone"];
    $comment = $_POST["comment"];

    $rs = mysql_query("select * from  feedbackinfo where title='" . $title . "'");
    $rows = mysql_fetch_assoc($rs);
    $id = $rows['id'];
    if (!$id) {
        echo json_encode(array("error"=>"找不到该用户",status=>403));
        exit;
    }

    $sqlA = "update feedbackinfo set email='$email',area='$area',phone='$phone',comment='$comment' where id=$id";
    if (mysql_query($sqlA)) {
        echo json_encode(array(status=>200));
        exit;
    } else {
        echo json_encode(array("error"=>"系统错误",status=>"500"));
        exit;
    }
}

?>