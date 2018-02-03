<?php
	require_once("include/global.php");

        $l_ID=$_POST["l_ID"];
        $l_pass=$_POST["l_pass"];
		if($l_ID!="" and $l_pass!=""){
		  $sqldate="update feedbackinfo set pass ='".$l_pass."' where id='".$l_ID."'";
		  mysql_query($sqldate);
		  echo 'yes'; 
		}else{
          echo 'no';
		}
 ?>