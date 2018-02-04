<?php
require_once("include/global.php");

$l_date = date("Y-m-d h:i:s");
$l_date1 = date("Y-m-d");
$l_name = $_POST["l_name"];
$l_pass = $_POST["l_pass"];

$sql = "select * from feedbackinfo where title='" . $l_name . "' and  pass='" . $l_pass . "'";
$rs = mysql_query($sql);
$count = mysql_fetch_assoc($rs);
$day = strtotime($count["end_date"]) - 24 * 60 * 60;
if ($count["title"] == "") {
    echo 'no';
    exit();
}
if ($count["title"] != "" and strtotime($count["end_date"]) > strtotime($l_date1)) {
    if ($count["dl_date"] == "") {
        setcookie("username", $count['title'], time() + 365 * 24 * 60 * 60);
        setcookie("dl_date", $l_date, time() + 365 * 24 * 60 * 60);
        $user_id = $count["id"];
        $sqldate = "update feedbackinfo set dl_date='" . $l_date . "' where id='" . $user_id . "'";
        mysql_query($sqldate);
        echo 'yes';
    } else {
        setcookie("username", $count['title'], time() + 365 * 24 * 60 * 60);
        setcookie("dl_date", $l_date, time() + 365 * 24 * 60 * 60);
        $user_id = $count["id"];
        $sqldate = "update feedbackinfo set end_date='" . date('Y-m-d', $day) . "',qzxx=qzxx+1,dl_date='" . $l_date . "' where id='" . $user_id . "'";
        mysql_query($sqldate);
        echo 'yes';
    }
} else {
    echo 'ndate';
}
?>