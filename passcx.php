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
    $pa_pingp = $_POST["papingp"];//品牌
    $pa_nianf = $_POST["panianf"];//年份
    if ($_POST['paxingqh'] == "") {//申请码
        $pa_xingqh = "12345678";
    } else {
        $pa_xingqh = $_POST['paxingqh'];
    }
    $pa_cjh = $_POST['pacjh'];//车架码
    $us_name = $_POST['username']; //用户名
    /*--------是否已查询 end-------*/
    $sqlzhanw = "select * from  hchi_cxfl where cx_title='" . $pa_pingp . "'";
    $rszhanw = mysql_query($sqlzhanw);
    $countzhanw = mysql_fetch_assoc($rszhanw);//品牌查询
    if ($countzhanw["cx_url"] <> "") {//站外查询
//       $url='http://43.240.244.159:520/?type=520&vinm=LNBSCCAF6FR613445&CarType=0&sqm=12345678';
        $url = $countzhanw["cx_url"] . '?type=' . $countzhanw["cx_type"] . '&vinm=' . $pa_cjh . '&CarType=' . $countzhanw["cx_cartype"] . '&sqm=' . $pa_xingqh;
        $html = file_get_contents($url);
        $arr[] = array('names' => $html);
        echo json_encode($arr);
    } else {
        $sql = "select * from hchi_passcx where pa_pingp='" . $pa_pingp . "' and  pa_cjh='" . $pa_cjh . "'";
        $rs = mysql_query($sql);
        $count = mysql_fetch_assoc($rs);
        if ($count["id"] <> "" and $count["pa_pin"] <> "") {
            $arr[] = array('names' => $count["pa_pin"]);
            echo json_encode($arr);
        } elseif ($count["id"] <> "" and $count["pa_pin"] == "") {
            $arr[] = array('names' => 1);
            echo json_encode($arr);
        } else {
            $sql1 = "insert into hchi_passcx (pa_pingp,pa_chex,pa_nianf,pa_xingqh,pa_cjh) values ('$pa_pingp','$pa_chex','$pa_nianf','$pa_xingqh','$pa_cjh')";
            if (mysql_query($sql1)) {
                $arr[] = array('names' => 1);
                echo json_encode($arr);
            }
            die();
        }
    }
}

?>