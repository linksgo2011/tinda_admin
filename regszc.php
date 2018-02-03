<?php    

header( "Access-Control-Allow-Origin:*");   
header('Access-Control-Allow-Methods:POST');     
// 响应头设置     
header('Access-Control-Allow-Headers:x-requested-with,content-type');     
header("Content-type: text/html; charset=utf-8");
ini();   
regtitleA:regtitle,:regpass1,:regname,:regemail,:regarea,:regaddress,:regphome,regcommentA:regcomment        
function ini(){
      require_once("include/global.php");   
        $regtitleA=$_POST["regtitleA"];
        $regpassA=$_POST["regpassA"];
        $regnameA=$_POST["regnameA"];
        $regemailA=$_POST["regemailA"];
        $regareaA=$_POST["regareaA"];
        $regaddressA=$_POST["regaddressA"];
        $regphomeA=$_POST["regphomeA"];
        $regcommentA=$_POST["regcommentA"];
          $rs=mysql_query("select * from  feedbackinfo where title='".$regtitleA."'");
          $rows=mysql_fetch_assoc($rs);
		  if($rows["id"]<>""){
		     echo '1';
			 exit;
		  }
          $rs1=mysql_query("select * from  feedbackinfo where phone='".$regphomeA."'");
          $rows1=mysql_fetch_assoc($rs);
		  if($rows1["id"]<>""){
		     echo '2';
			 exit;
		  }
		$sql2="insert into feedbackinfo (title,pass,name,email,area,address,phone,comment) values ('$regtitleA','$regpassA','$regnameA','$regemailA','$regareaA','$regaddressA','$regphomeA','$regcommentA')";
		if(mysql_query($sql2)){
		  echo '3'; 
		}}       
?>