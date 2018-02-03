<?php    
header( "Access-Control-Allow-Origin:*");   
header('Access-Control-Allow-Methods:POST');     
// 响应头设置     
header('Access-Control-Allow-Headers:x-requested-with,content-type');     
header("Content-type: text/html; charset=utf-8");
ini();   
      
function ini(){
      require_once("include/global.php");   
        $finl=$_POST["sey"];
  $rs=mysql_query("select * from  hchi_setup");
  $rows=mysql_fetch_assoc($rs);
           $arr[]=array('homegg'=>$rows["homegg"],'homeurl'=>$rows["homeurl"]);  
	  echo json_encode($arr);
}
?>