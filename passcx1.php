﻿<?php
header("Access-Control-Allow-Origin:*");
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
header("Content-type: text/html; charset=utf-8");
ini();

function ini()
{
/////////////////////
    require_once("include/global.php");
    require_once("include/log.php");
    require_once("include/points.php");
    require_once("include/utils.php");

    $l_date = date("Y-m-d h:i:s");
    $l_date1 = date("Y-m-d");
    $pa_pingp = $_POST["papingp"];
    $pa_chex = $_POST["pachex"];
    $pa_nianf = $_POST["panianf"];
    $pa_chex = $_POST["pachex"];
    if ($_POST['paxingqh'] == "") {
        $pa_xingqh = "12345678";
    } else {
        $pa_xingqh = $_POST['paxingqh'];
    }
    $pa_cjh = $_POST['pacjh'];
    $us_name = $_POST['username'];
    $sqlus = "select * from  feedbackinfo where title='" . $us_name . "'";
    $rsus = mysql_query($sqlus);
    $countus = mysql_fetch_assoc($rsus);

    $sqlzhanw = "select * from  hchi_cxfl where cx_title='" . $pa_pingp . "'";
    $rszhanw = mysql_query($sqlzhanw);
    $countzhanw = mysql_fetch_assoc($rszhanw);//品牌查询

    $sqlsetup = "select * from  hchi_pscxsz";
    $rssetup = mysql_query($sqlsetup);
    $countsetup = mysql_fetch_assoc($rssetup);//查询设置
    /*--------是否已查询-------*/
    $sqlus = "select * from  feedbackinfo where title='" . $us_name . "'";
    $rsus = mysql_query($sqlus);
    $countus = mysql_fetch_assoc($rsus);
    $usercxpass = $countus["cx_pass"] . ',' . $pa_cjh;//车架A
    $arr = array($countus["cx_pass"]);//编码数组
    $arrsl = explode(",",$countus["cx_shul"]);//品牌查询次数数组
/////////////////pdcxsz////////////////////////
    $arrnull = array();//空数组
    foreach ($arrsl as $key => $values) {//查询并写入新
        if (strstr($values, $pa_pingp) !== false) {
            array_push($arrnull, $values);
        }
    }
    if ($arrnull[0] == "" and $countus["cx_date"] == $l_date1) {//日期当前不存在就写入
        $arrsl[] = $pa_pingp . '1';//写入新查询
//  print_r($arrsl);
    } elseif ($countus["cx_date"] <> $l_date1) {//日期之前不存在就写入
        $arrsl = array($pa_pingp . '1');//写入新查询
    } elseif ($arrnull[0] <> "" and $countus["cx_date"] == $l_date1) {//存在就修改
        $czxincs = substr($arrnull[0], -1);//实已查
        $dqppkey = array_search($arrnull[0], $arrsl);//已查当前分健值
//  echo $czxincs.'<br />';
        $arrsl[$dqppkey] = $pa_pingp . ($czxincs + 1);//更新数组
    }
/////////////////pdcxsz end///////////////////////
    if ($l_date1 == $countus["cx_date"] and $countsetup["pz_shul"] <= $czxincs) {
        $cxpassA = "yes";
    }

    // 用户已经查询过得记录直接返回
    if(in_array($pa_cjh,explode(",",$countus['cx_pass']))){
        $logRs = mysql_query("SELECT * FROM rj where cjh = \"$pa_cjh\" and yhm = \"$us_name\" and apply_code = \"$pa_xingqh\" limit 1;");
        $log = mysql_fetch_assoc($logRs);
        if(!empty($log)){
            echo $log['pin'];
            exit;
        }
    }

    $logCountResult = mysql_query("select count(1) as queryTimes FROM `rj` = WHERE created > CURDATE( ) AND yhm = \"$us_name\"");
    $logCount = mysql_fetch_assoc($logCountResult);
//    define("MAX_DAY_QUERY_TIMES", 4);
    if($logCount['queryTimes'] > $countsetup['total_times_per_day']){
//        echo '超过当日最大查询次数';
//        exit;
        $cxpassA = "yes";
    }

    if($cxpassA == "yes"){

        $usePoints = true;
        if(!checkPoint($us_name)){
            echo "免费次数不足或积分不足，二次需要30积分，请充值";
            exit;
        }

        $cxpassA = "no";
    }

    /*--------是否已查询 end-------*/
    if ($cxpassA == "yes") {
        echo 5;
    } else {//查询数用完
        if ($countzhanw["cx_url"] <> "") {//站外查询
///////zwcx shop
            $url = $countzhanw["cx_url"] . '?type=' . $countzhanw["cx_type"] . '&vinm=' . $pa_cjh . '&CarType=' . $countzhanw["cx_cartype"] . '&sqm=' . $pa_xingqh . '&SN=' . $us_name;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $html = curl_exec($ch);
            curl_close($ch);
            if ($html == "no") {
                echo 3;
                die();
            } elseif ($html == "") {
                echo 2;
                die();
            }

            if(isAllChinese($html)){
                echo $html;
                exit;
            }

            $usedPoints = 0;
            if($usePoints){
                try{
                    $usedPoints = payWithPoint($us_name);

                }catch(Exception $e){
                    echo $e->getMessage();
                    exit;
                }
            }

            if ($l_date1 == $countus["cx_date"]) {
                $sqlA = "update feedbackinfo set cx_shul='" . implode(",", $arrsl) . "',cx_pass='" . $usercxpass . "' where title='" . $us_name . "'";
                if (mysql_query($sqlA)) {

                    $sql1 = "insert into rj (yhm,cjh,pin,chex,points,apply_code) values ('$us_name','$pa_cjh','$html','$pa_pingp','$usedPoints','$pa_xingqh')";
                    mysql_query($sql1);

                    echo $html;



                    die();
                }
            } elseif ($l_date1 <> $countus["cx_date"]) {
                $sqlA = "update feedbackinfo set cx_date='" . $l_date1 . "',cx_shul='" . implode(",", $arrsl) . "',cx_pass='" . $usercxpass . "' where title='" . $us_name . "'";
                if (mysql_query($sqlA)) {
                    $sql1 = "insert into rj (yhm,cjh,pin,chex,points,apply_code) values ('$us_name','$pa_cjh','$html','$pa_pingp','$usedPoints','$pa_xingqh')";
                    mysql_query($sql1);
                    echo $html;
                    die();
                }
            }

///////zwcx end
        } elseif ($countzhanw["cx_url"] == "" and $countsetup["pz_off"] == 1) {//站内开启
///////znkq shop
///
///
            // 如果站内有数据但是查不出来，TODO 怀疑这里 `pa_xingqh`='$pa_xingqh'
            $sqlAA = "select * from hchi_passcx where pa_pingp='" . $pa_pingp . "' and  pa_cjh='" . $pa_cjh . "' and `pa_xingqh`='$pa_xingqh'";
            $rsAA = mysql_query($sqlAA);
            $count = mysql_fetch_assoc($rsAA);
            if ($count["id"] <> "" and $count["pa_pin"] <> "") {
                // 找到站内数据

                if(isAllChinese($count["pa_pin"])){
                    echo $count["pa_pin"];
                    exit;
                }

                $usedPoints = 0;
                if($usePoints){
                    try{
                        $usedPoints = payWithPoint($us_name);

                    }catch(Exception $e){
                        echo $e->getMessage();
                        exit;
                    }
                }

                if ($l_date1 == $countus["cx_date"]) {
                    $sqlA = "update feedbackinfo set cx_shul='" . implode(",", $arrsl) . "',cx_pass='" . $usercxpass . "' where title='" . $us_name . "'";
                    if (mysql_query($sqlA)) {
                        echo $count["pa_pin"];
						$pin=$count["pa_pin"];
						$chex=$count['pa_chex'];
						$sql1 = "insert into rj (yhm,cjh,pin,chex,points,apply_code) values ('$us_name','$pa_cjh','$pin','$chex','$usedPoints','$pa_xingqh')";
					          mysql_query($sql1);


                        die();
                    }
                } elseif ($l_date1 <> $countus["cx_date"]) {
                    $sqlB = "update feedbackinfo set cx_date='" . $l_date1 . "',cx_shul='" . implode(",", $arrsl) . "',cx_pass='" . $usercxpass . "' where title='" . $us_name . "'";
                    if (mysql_query($sqlB)) {
                        echo $count["pa_pin"];
                        $pin=$count["pa_pin"];
                        $chex=$count['pa_chex'];
                        $sql1 = "insert into rj (yhm,cjh,pin,chex,points,apply_code) values ('$us_name','$pa_cjh','$pin','$chex','$usedPoints','$pa_xingqh')";
                        mysql_query($sql1);
                        die();
                    }
                }
            } elseif ($count["id"] <> "" and $count["pa_pin"] == "") {
                echo 1;
                die();
            } else {

                // 已经存在的查询就不允许再次提交
                $sqlForCheckExist = "select * from hchi_passcx where yhm='$us_name' and pa_pin=''";
                $existQueryResult = mysql_query($sqlForCheckExist);
                $existQuery = mysql_fetch_assoc($existQueryResult);
                if($existQuery["id"]){
                    echo 5;
                    exit;
                }

                $sql1 = "insert into hchi_passcx (yhm,pa_pingp,pa_chex,pa_nianf,pa_xingqh,pa_cjh,pa_date) values ('$us_name','$pa_pingp','$pa_chex','$pa_nianf','$pa_xingqh','$pa_cjh','$l_date')";
                if (mysql_query($sql1)) {
                    echo 1;
                    die();
                }
            }
///////zngb end
        } elseif ($countzhanw["cx_url"] == "" and $countsetup["pz_off"] == 2) {//站内关闭
///////zngb shop
            echo 4;
            die();
///////zngb shop
        }
//////////
    }
}//查询数用完
?>
