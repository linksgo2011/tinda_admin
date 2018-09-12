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
    $us_name = $_POST["sey"];
    $rs = mysql_query("select * from  feedbackinfo where title='" . $us_name . "'");
    $rows = mysql_fetch_assoc($rs);
    $arr[] = array(
        'email' => $rows["email"],
        'tels' => $rows["phone"],
        'comment' => $rows['comment'],
        'weigs' => $rows['qzxx'],
        'daoqdate' => $rows['end_date'],
        'danqjf' => $rows['jifengs'],
        'area'=> $rows['area'],
        'point'=>$rows['point']
    );
    echo json_encode($arr);
}

?>