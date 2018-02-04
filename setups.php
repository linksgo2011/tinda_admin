<?php    

header( "Access-Control-Allow-Origin:*");   
header('Access-Control-Allow-Methods:POST');     
// 响应头设置     
header('Access-Control-Allow-Headers:x-requested-with,content-type');     
header("Content-type: text/html; charset=utf-8");
ini();   
        
function ini(){
      require_once("include/global.php");   
        $us_name=$_POST["useraa"];
		$us_date=$_POST['userDate']; 
	  $sqlus="select * from  feedbackinfo where title='".$us_name."' and us_key='".$us_date."'";
	  $rsus=mysql_query($sqlus);
      $countus=mysql_fetch_assoc($rsus);
   if($countus["id"]<>""){
      echo 'yes';
   }else{
      echo 'no';
   }

echo 'no';
}
?>