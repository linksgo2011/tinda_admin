<?php
require_once("include/global.php");
header("Access-Control-Allow-Origin:*");
header('Access-Control-Allow-Methods:POST');
// 响应头设置     
header('Access-Control-Allow-Headers:x-requested-with,content-type');
header("Content-type: text/html; charset=utf-8");

ini();

function ini()
{
$userszl = $_POST["userszl"];
	$sql="select * from hchi_passcx where pa_pin<>'' and yhm=$userszl";
	$rs=mysql_query($sql);
	while($rows=mysql_fetch_assoc($rs))
	{
 $arr = '<li class="mui-table-view-cell">车架号:'.$rows["pa_cjh"].'      PIN:'.$rows["pa_pin"].'</li>'.$arr;

}

   echo json_encode($arr);
}
?>