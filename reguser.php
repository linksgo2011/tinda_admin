<?php

header("Access-Control-Allow-Origin:*");
header('Access-Control-Allow-Methods:POST');
// ÏìÓ¦Í·ÉèÖÃ     
header('Access-Control-Allow-Headers:x-requested-with,content-type');
header("Content-type: text/html; charset=utf-8");
ini();
function ini()
{
    require_once("include/global.php");
    $regtitle = $_POST["regtitle"];
    $regpass1 = $_POST["regpass1"];
    $regemail = $_POST["regemail"];
    $regarea = $_POST["regarea"];
    $regphome = $_POST["regphome"];
    $regcomment = $_POST["regcomment"];
    $regMessDate = date("Y-m-d");
    $regMessTime = date("h:i:s");
    $nowDate = date("Y-m-d");

    $rs = mysql_query("select * from  feedbackinfo where title='" . $regtitle . "'");
    $rows = mysql_fetch_assoc($rs);
    if ($rows["id"] <> "") {
        echo '1';
        die();
    }
    $rs2 = mysql_query("select * from  feedbackinfo where comment='" . $regcomment . "'");
    $rows2 = mysql_fetch_assoc($rs2);
    if ($rows2["id"] <> "") {
        echo '2';
        die();
    }
    $sqlA = "insert into feedbackinfo (
      title,
      leixing,
      pass,
      name,
      email,
      area,
      address,
      phone,
      comment,
      mess_date,
      mess_time,
      Dl_date,
      End_date,
      Qzxx,
      Cx_date,
      Cx_pass,
      Cx_shul,
      Jifengs,
      Us_koner
      ) values (
      '$regtitle',
      'APP',
      '$regpass1',
      'APP',
      '$regemail',
      '$regarea',
      '',
      '$regphome',
      '$regcomment',
      '$regMessDate',
      '$regMessTime',
      '$nowDate',
      '2018-1-1',
      0,
      '$nowDate',
      '',
      0,
      0,
      ''
    )";
    if (mysql_query($sqlA)) {
        echo '3';
        die();
    } else {
        echo '4';
        die();
    }
}

?>