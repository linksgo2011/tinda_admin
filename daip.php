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
    $finl = $_POST["sey"];
    $rs = mysql_query("select * from  hchi_daip where dp_finl='" . $finl . "'");
    $rows = mysql_fetch_assoc($rs);
    $arr[] = array('names' => $rows["dp_name"], 'bodys' => $rows["dp_body"]);
    echo json_encode($arr);
}

?>