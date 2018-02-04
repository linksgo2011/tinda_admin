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
    $sey1 = $_POST['sey1'];
//shop
    if ($sey == "zlcx") {
        $rs = mysql_query("select * from finl where fl1=0 order by id asc");
        while ($rows = mysql_fetch_assoc($rs)) {
            $arr[] = array('id' => $rows["id"], 'name' => $rows["name"], 'logoA' => $rows['logoA']);
        }
        echo json_encode($arr);
    } elseif ($sey == "zlcx1") {
        $rs = mysql_query("select * from finl where fl1='" . $sey1 . "' order by id asc");
        while ($rows = mysql_fetch_assoc($rs)) {
            if ($rows["logoA"] == "") {
                $pplogo = 'images/icon-read2.png';
            } else {
                $pplogo = $rows["logoA"];
            }
            $arr[] = array('id' => $rows["id"], 'name' => $rows["name"], 'logoA' => $pplogo);
        }
        echo json_encode($arr);
    } elseif ($sey == "zlcx2") {
        $rs = mysql_query("select * from finl where fl1='" . $sey1 . "' order by id asc");
        while ($rows = mysql_fetch_assoc($rs)) {
            if ($rows["logoA"] == "") {
                $pplogo = 'images/fl_1.jpg';
            } else {
                $pplogo = $rows["logoA"];
            }
            $arr[] = array('id' => $rows["id"], 'name' => $rows["name"], 'logoA' => $pplogo);
        }
        echo json_encode($arr);
    } elseif ($sey == "zlcx3") {
        $sqlA = "select * from finl where id='" . $sey1 . "'";
        $rsA = mysql_query($sqlA);
        $rowsA = mysql_fetch_assoc($rsA);
        if ($rowsA["bodys"] == "") {
            $arr = '<iframe src="' . $rowsA["url1"] . '" width="100%" marginwidth="0" height="1000px" marginheight="0" align="top" scrolling="yes" frameborder="0"></iframe>';
        } else {
            $bodysrows = str_replace('class="mui-zoom"', 'class="file-pic" data-preview-src="" data-preview-group="1"', $rowsA["bodys"]);
            $arr = $bodysrows;
        }
        echo json_encode($arr);
    }
//end
}

?>