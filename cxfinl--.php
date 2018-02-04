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
    $finlA = $_POST['limit'];
    $rsaa = mysql_query("select * from hchi_cxfl where cx_title='" . $finlA . "' order by id asc");
    $rowsaa = mysql_fetch_assoc($rsaa);
    if ($finlA == "") {
        $finlB = 1;
    } else {
        $finlB = $rowsaa["id"];
    }
//shop
    if ($sey == "pinpan") {
        $rs = mysql_query("select * from hchi_cxfl where cx_finl='pp' order by id asc");
        while ($rows = mysql_fetch_assoc($rs)) {
            $arr[] = array('title' => $rows["cx_title"]);
        }
        echo json_encode($arr);
    }
//end
    if ($sey == "chexin") {
        $rs = mysql_query("select * from hchi_cxfl where cx_finl='" . $finlB . "' order by id asc");
        while ($rows = mysql_fetch_assoc($rs)) {
            $arr[] = array('title1' => $rows["cx_title"]);
        }
        echo json_encode($arr);
    }
//end
    if ($sey == "chexina") {
        $rs = mysql_query("select * from hchi_cxfl where cx_finl=2 order by id asc");
        while ($rows = mysql_fetch_assoc($rs)) {
            $arr[] = array('title1' => $rows["cx_title"]);
        }
        echo json_encode($arr);
    }
//end
}

?>