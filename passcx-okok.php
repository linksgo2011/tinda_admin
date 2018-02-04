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
    $l_date = date("Y-m-d h:i:s");
    $l_date1 = date("Y-m-d");
    $pa_pingp = $_POST["papingp"];
    $pa_chex = $_POST["pachex"];
    $pa_nianf = $_POST["panianf"];
    $pa_xingqh = $_POST['paxingqh'];
    $pa_cjh = $_POST['pacjh'];
    $us_name = $_POST['username'];
    $sqlus = "select * from  feedbackinfo where title='" . $us_name . "'";
    $rsus = mysql_query($sqlus);
    $countus = mysql_fetch_assoc($rsus);
    if ($l_date1 == $countus["cx_date"]) {//今日是否已查
        echo '2';
    } elseif ($pa_pingp == '宝骏' or $pa_pingp == '名爵' or $pa_pingp == '传祺' or $pa_pingp == 'AX7') {//站外查询
        $url = 'http://112.74.177.235:8033/pin/Get?vin=' . $pa_cjh . '&CarType=' . $pa_pingp;
        $html = file_get_contents($url);
        if ($html == "") {
            echo '3';
        } else {
            $sqlA = "update feedbackinfo set cx_date='" . $l_date1 . "' where title='" . $us_name . "'";
            if (mysql_query($sqlA)) {
                echo $html;
            }
        }
    } else {
        $sql = "select * from hchi_passcx where pa_pingp='" . $pa_pingp . "' and  pa_cjh='" . $pa_cjh . "'";
        $rs = mysql_query($sql);
        $count = mysql_fetch_assoc($rs);
        if ($count["id"] <> "" and $count["pa_pin"] <> "") {
            $sqlA = "update feedbackinfo set cx_date='$l_date1' where title='" . $us_name . "'";
            if (mysql_query($sqlA)) {
                echo $count["pa_pin"];
            }
        } else if ($count["id"] <> "" and $count["pa_pin"] == "") {
            echo '1';
        } else {
            $sql1 = "insert into hchi_passcx (pa_pingp,pa_chex,pa_nianf,pa_xingqh,pa_cjh) values ('$pa_pingp','$pa_chex','$pa_nianf','$pa_xingqh','$pa_cjh')";
            if (mysql_query($sql1)) {
                echo '1';
            }
            die();
        }
    }
}

?>