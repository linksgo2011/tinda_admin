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
    $sey = $_POST['sey'];
    $rs = mysql_query("select * from finl where fl1=0 order by id asc");
    while ($rows = mysql_fetch_assoc($rs)) {
        $arr[] = array('id' => $rows["id"], 'name' => $rows["name"], 'logoA' => $rows['logoA']);
    }
    echo json_encode($arr);
}

?>