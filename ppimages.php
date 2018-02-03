<?php    

header( "Access-Control-Allow-Origin:*");   
header('Access-Control-Allow-Methods:POST');     
// 响应头设置     
header('Access-Control-Allow-Headers:x-requested-with,content-type');     
header("Content-type: text/html; charset=utf-8");
ini();   
        
function ini(){
      require_once("include/global.php");   
      $sey=$_POST['sey'];   
      $sey1=$_POST['sey1'];
//shop
	$sqlA="select * from finl where id='".$sey1."'";
	$rsA=mysql_query($sqlA);
	$rowsA=mysql_fetch_assoc($rsA);
	  if($rowsA["ggimg"]==""){
	    $arr = '<img src="images/gg1.jpg" width="100%">';
	  }else{
	    $arr = "<img src='".$rowsA["ggimg"]."' width='100%'>";
	  }
    echo json_encode($arr);  
//end
}     
?>