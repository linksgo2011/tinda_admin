<?php    

header( "Access-Control-Allow-Origin:*");   
header('Access-Control-Allow-Methods:POST');     
// 响应头设置     
header('Access-Control-Allow-Headers:x-requested-with,content-type');     
header("Content-type: text/html; charset=utf-8");
ini();   
function ini(){
      require_once("include/global.php");   
        $regtitle=$_POST["regtitle"];
        $regpass1=$_POST["regpass1"];
        //$regleixing=$_POST["regleixing"];
        $regname=$_POST["regname"];
        $regemail=$_POST["regemail"];
        $regarea=$_POST["regarea"];
        $regaddress=$_POST["regaddress"];
        $regphome=$_POST["regphome"];
        $regcomment=$_POST["regcomment"];
          $rs=mysql_query("select * from  feedbackinfo where title='".$regtitle."'");
          $rows=mysql_fetch_assoc($rs);
		  if($rows["id"]<>""){
		     echo '1';
	    die();
		  }
          $rs2=mysql_query("select * from  feedbackinfo where comment='".$regcomment."'");
          $rows2=mysql_fetch_assoc($rs2);
		  if($rows2["id"]<>""){
		     echo '2';
	    die();
		  }
        $sqlA="insert into feedbackinfo (title,pass,name,email,area,address,phone,comment) values ('$regtitle','$regpass1','$regname','$regemail','$regarea','$regaddress','$regphome','$regcomment')";
		if(mysql_query($sqlA)){
		  echo '3'; 
	    die();
		}else{
          echo '4';
	    die();
		} 
}
?>