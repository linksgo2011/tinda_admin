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
    require_once("include/utils.php");
    $username = $_GET["username"];

    $rs = mysql_query("select * from  feedbackinfo where title='" . $username . "'");
    $row = mysql_fetch_assoc($rs);
    $id = $row['id'];
    if (!$id) {
        out(403,null,"找不到该用户");
        exit;
    }

    $permissionForVip = array(
        'zlcx',
        'passcx'
    );

    if($row['vip']){
        out(200,$permissionForVip);
    }else{
        out(200,array());
    }
}

?>