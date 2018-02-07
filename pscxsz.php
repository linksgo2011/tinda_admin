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

    $sql="select * from hchi_pscxsz";
    $rs=mysql_query($sql);
    $row=mysql_fetch_assoc($rs);

    echo json_encode($row);
    exit;
}

?>