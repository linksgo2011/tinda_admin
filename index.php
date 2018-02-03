<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<!---------分割字符串为数组-------->
<?php 
$source = "hello1,hello2,hello3,hello4,hello5";//按逗号分离字符串 
$hello = explode(',',$source); 

for($index=0;$index<count($hello);$index++) 
{ 
echo $hello[$index];echo "</br>"; 
} 
?>
<?php
$arr = array('可以','如何','方法','知道','沒有','不要');
if(in_array("如何1",$arr)){
    echo "存在";
}else{
    echo "不存在";
}
?> 
<!--------------js倒计时----------------->
<SCRIPT LANGUAGE="JavaScript"> 
<!-- 
var maxtime = 2*60-1 //一个小时，按秒计算，自己调整! 
function CountDown(){ 
if(maxtime>=0){ 
minutes = Math.floor(maxtime/60); 
seconds = Math.floor(maxtime%60); 
msg = "距离结束还有"+minutes+"分"+seconds+"秒"; 
document.all["timer"].innerHTML=msg; 
//if(maxtime == 5*60) alert('注意，还有5分钟!'); 
--maxtime; 
}else{ 
clearInterval(timer); 
alert("时间到，结束!"); 
} 
} 
timer = setInterval("CountDown()",1000); 
//-->
</SCRIPT> 
<div id="timer" style="color:red"></div> 

</body>
</html>
