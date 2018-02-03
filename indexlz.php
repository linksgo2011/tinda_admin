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
  $rs=mysql_query("select * from hchi_images order by id desc");
  while($rows=mysql_fetch_assoc($rs))
  {   
     $arr[]=array('id'=>$rows["id"],'imagesA'=>$rows["im_img"],'urlA'=>$rows["im_url"]);  
  }
  echo json_encode($arr);  
//end
}     
?>