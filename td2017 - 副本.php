<?php    

header( "Access-Control-Allow-Origin:*");   
header('Access-Control-Allow-Methods:POST');     
// 响应头设置     
header('Access-Control-Allow-Headers:x-requested-with,content-type');     
header("Content-type: text/html; charset=utf-8");
ini();   
        
function ini(){
      require_once("include/global.php");   
        $name=$_POST['name'];   
        $psw=$_POST['psw'];   
      $sql="select * from feedbackinfo where title='".$name."' and  pass='".$psw."'";
	  $rs=mysql_query($sql);
      $count=mysql_fetch_assoc($rs);   
      if($count[id]!="" and $count["title"]!=""){   
        echo "1";   
      }   
}       
?>