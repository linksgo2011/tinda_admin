<?php    
header( "Access-Control-Allow-Origin:*");   
header('Access-Control-Allow-Methods:POST');     
// 响应头设置     
header('Access-Control-Allow-Headers:x-requested-with,content-type');     
header("Content-type: text/html; charset=utf-8");
ini();   
        
function ini(){
/////////////////////
      require_once("include/global.php");   
	    $l_date=date("Y-m-d h:i:s");
	    $l_date1=date("Y-m-d");
        $pa_pingp=$_POST["papingp"];
		$pa_chex=$_POST["pachex"];
        $pa_nianf=$_POST["panianf"];
	if($_POST['paxingqh']==""){
	    $pa_xingqh="12345678";
	}else{
        $pa_xingqh=$_POST['paxingqh']; 
	}  
        $pa_cjh=$_POST['pacjh'];
		$us_name=$_POST['username']; 
	  $sqlus="select * from  feedbackinfo where title='".$us_name."'";
	  $rsus=mysql_query($sqlus);
      $countus=mysql_fetch_assoc($rsus);

	  $sqlzhanw="select * from  hchi_cxfl where cx_title='".$pa_pingp."'";
	  $rszhanw=mysql_query($sqlzhanw);
      $countzhanw=mysql_fetch_assoc($rszhanw);//品牌查询
  if($countzhanw["cx_url"]<>""){//站外查询
       $url=$countzhanw["cx_url"].'?type='.$countzhanw["cx_type"].'&vinm='.$pa_cjh.'&CarType='.$countzhanw["cx_cartype"].'&sqm='.$pa_xingqh;
       $html = file_get_contents($url,'r');
	  if($html=="no"){
         $arr[]=array('names'=>'3');  
	     echo json_encode($arr);
		die();
	  }elseif($html==""){
         $arr[]=array('names'=>'2');  
	     echo json_encode($arr);
		die();
	  }else{
         $arr[]=array('names'=>$html);  
	     echo json_encode($arr);
		die();
	  }
   }else{
      $sql="select * from hchi_passcx where pa_pingp='".$pa_pingp."' and  pa_cjh='".$pa_cjh."'";
	  $rs=mysql_query($sql);
      $count=mysql_fetch_assoc($rs);   
        if($count["id"]<>"" and $count["pa_pin"]<>""){
         $arr[]=array('names'=>$count["pa_pin"]);  
	     echo json_encode($arr);
		 die();
		}elseif($count["id"]<>"" and $count["pa_pin"]==""){
         $arr[]=array('names'=>1);  
	     echo json_encode($arr);
		 die();
		}else{
		$sql1="insert into hchi_passcx (pa_pingp,pa_chex,pa_nianf,pa_xingqh,pa_cjh) values ('$pa_pingp','$pa_chex','$pa_nianf','$pa_xingqh','$pa_cjh')";
		  if(mysql_query($sql1))
		  {
            $arr[]=array('names'=>1);  
	        echo json_encode($arr);
		    die();
		  }
		die();
		}
   }
//////////
}
?>