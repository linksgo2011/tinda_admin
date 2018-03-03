<?php
      header("Content-type: text/html; charset=utf-8");
	  require_once("../include/globalA.php");   
	    $l_date=date("Y-m-d h:i:s");
	    $l_date1=date("Y-m-d");
        $password1=$_POST["pass1"];
		$password2=$_POST["pass2"];
        $pa_pingp=$_POST["cxpinp"];
		$pa_chex=$_POST["cxchoux"];
        $pa_nianf=$_POST["cxnianf"];
        $pa_cjh=$_POST['cxchoujm'];
if($password1=='8988' and $password2=='8988' and $pa_pingp<>"" and $pa_cjh<>""){
	  $sql="select * from hchi_passcx where pa_pingp='".$pa_pingp."' and  pa_cjh='".$pa_cjh."'";
	  $rs=mysql_query($sql);
      $count=mysql_fetch_assoc($rs);   
        if($count["id"]<>"" and $count["pa_pin"]<>""){//如果记录存在，已有密码
			echo $count["pa_pin"]; 
		}elseif($count["id"]<>"" and $count["pa_pin"]==""){
          echo 'no'.$count["pa_pin"];
		}elseif($count["id"]==""){
		$sql1="insert into hchi_passcx (pa_pingp,pa_chex,pa_nianf,pa_xingqh,pa_cjh) values ('$pa_pingp','$pa_chex','$pa_nianf','$pa_xingqh','$pa_cjh')";
		  if(mysql_query($sql1))
		  {
			echo 'no';
		  }
		die();
		}
}else{
echo '错误';
}
?>
