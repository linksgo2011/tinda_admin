<?php    

header( "Access-Control-Allow-Origin:*");   
header('Access-Control-Allow-Methods:POST');     
// 响应头设置     
header('Access-Control-Allow-Headers:x-requested-with,content-type');     
header("Content-type: text/html; charset=utf-8");
ini();   
        
function ini(){
      require_once("include/global.php");   
//shop
  $rs=mysql_query("select * from hchi_zhubo where zb_bianh<>'' order by id desc");
  while($rows=mysql_fetch_assoc($rs))
  {   
     $arr[]=array('id'=>$rows["id"],'zbtitle'=>$rows["zb_title"],'zbdate'=>$rows['zb_date'],'zbbianh'=>$rows['zb_bianh']);  
  }
  echo json_encode($arr);  
//end
}     
?>