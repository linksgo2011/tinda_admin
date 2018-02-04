<?php
require_once("include/global.php");

$mess_date = date("Y-m-d");
$mess_time = date("h:i:s");
$title1 = $_POST["title1"];
$name = $_POST["name"];
$email = $_POST["email"];
$area = $_POST["area"];
$address = $_POST["address"];
$phome = $_POST["phome"];
$comment = $_POST["comment"];
$pass1 = $_POST["pass1"];

$sql = "select * from feedbackinfo where title='" . $title1 . "'";
$rs = mysql_query($sql);
$count = mysql_fetch_assoc($rs);
if ($count["title"] != "") {
    echo 'ndate';
    exit();
}
$sql1 = "select * from feedbackinfo where comment='" . $comment . "'";
$rs1 = mysql_query($sql1);
$count1 = mysql_fetch_assoc($rs1);
if ($count1["title"] != "") {
    echo 'no';
    exit();
}
$sql2 = "insert into feedbackinfo (title,leixing,name,email,area,address,phone,comment,mess_date,mess_time,pass) values ('$title1','A1','$name','$email','$area','$address','$phome','$comment','$mess_date','$mess_time','$pass1')";
if (mysql_query($sql2)) {
    echo 'yes';
} else {
    echo 'no1';
}
?>