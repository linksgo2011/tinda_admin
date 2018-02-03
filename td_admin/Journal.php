<?php
require_once("../include/global.php");
$ad_name1234=$_SESSION["ad_name1234"];
$ad_id1234=$_SESSION["ad_id1234"];

if($_GET['tj'] == 'out'){
 session_destroy();
 echo "<script language=javascript>alert('退出成功！');window.location='index.php'</script>";
}
		$sql="select * from hchi_admin where ad_name='".$ad_name1234."' and id='".$ad_id1234."'";
		$rs=mysql_query($sql);
		if(mysql_num_rows($rs)<>1)
	{
 session_destroy();
 	echo "<script language=javascript>alert('未登录或登录超时！请返回，重新登录，谢谢!');window.top.location.href='index.php'</script>";
	die();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/select.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/showdate.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.idTabs.min.js"></script>
<script type="text/javascript" src="js/select-ui.min.js"></script>
<script type="text/javascript" src="editor/kindeditor.js"></script>

<script type="text/javascript">
    KE.show({
        id : 'content7',
        cssPath : './index.css'
    });
  </script>
  
<script type="text/javascript">
$(document).ready(function(e) {
    $(".select1").uedSelect({
		width : 345			  
	});
	$(".select2").uedSelect({
		width : 167  
	});
	$(".select3").uedSelect({
		width : 100
	});
});
</script>
</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="default.php">首页</a></li>
    <li><a href="#">系统日志</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    
    
  	<div id="tab1" class="tabson">
    <table class="tablelist">
    	<thead>
    	<tr>
        <th>ID<i class="sort"><img src="images/px.gif" /></i></th>
        <th>管理员</th>
        <th>IP</th>
        <th>日期</th>
        <th>操作项目</th>
        </tr>
        </thead>
        
        <tbody>
<?php
	$sql="select * from hchi_Journal order by id desc";
	$rs=mysql_query($sql);
	while($rows=mysql_fetch_assoc($rs))
	{
?>
        <tr>
        <td><?php echo $rows["id"]?></td>
        <td><?php echo $rows["jou_user"]?></td>
        <td><?php echo $rows["jou_ip"]?></td>
        <td><?php echo $rows["jou_date"]?></td>
        <td><?php echo $rows["jou_caoz"]?></td>
        </tr> 
<?php }?>
        </tbody>
        
    </table>

    </div> 
    
	<script type="text/javascript"> 
      $("#usual1 ul").idTabs(); 
    </script>
    
    <script type="text/javascript">
	$('.tablelist tbody tr:odd').addClass('odd');
	</script>
    
    </div>


</body>

</html>
