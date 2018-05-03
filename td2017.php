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
    $l_name = $_POST["l_name"];
    $l_pass = $_POST["l_pass"];
    $us_koner = $_POST["ustoke"];

    $name = $_POST['name'];
    $psw = $_POST['psw'];
	
	
	 $search = "select `title` from feedbackinfo where title='$name'";  
	 $res=mysql_query($search);  
    if(mysql_num_rows($res)>0){

    $sql = "select * from feedbackinfo where title='" . $name . "' and  pass='" . $psw . "'";
    $rs = mysql_query($sql);
    $count = mysql_fetch_assoc($rs);
    $day = strtotime($count["end_date"]);
    if ($count["title"] == "") {
        echo '3';
        exit();
    }
    //////
    if ($count["title"] != "" and strtotime($count["end_date"]) > strtotime($l_date1)) {
        if ($count["us_koner"] == "" || ($count["us_koner"] == $us_koner)) {
            $user_id = $count["id"];
            $sqldate = "update feedbackinfo set dl_date='" . $l_date . "',us_koner='" . $us_koner . "' where id='" . $user_id . "'";
            mysql_query($sqldate);
            echo '1';
        } else {
            $user_id = $count["id"];
            $sqldate = "update feedbackinfo set end_date='" . date('Y-m-d', $day) . "',qzxx=qzxx+1,dl_date='" . $l_date . "',us_koner='" . $us_koner . "' where id='" . $user_id . "'";
            mysql_query($sqldate);
            echo '1';
        }
    } else {
        echo '2';
    }
}else{
 echo '0';
}
}
?>