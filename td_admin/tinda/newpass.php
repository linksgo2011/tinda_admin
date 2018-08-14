<?php
require_once("../../include/global.php");
$ad_name1234=$_SESSION["ad_name1234"];
$ad_id1234=$_SESSION["ad_id1234"];

if($_GET['tj'] == 'out'){
 session_destroy();
 echo "<script language=javascript>alert('退出成功！');window.location='../index.php'</script>";
}
		$sql="select * from hchi_admin where ad_name='".$ad_name1234."' and id='".$ad_id1234."'";
		$rs=mysql_query($sql);
		if(mysql_num_rows($rs)<>1)
	{
 session_destroy();
 	echo "<script language=javascript>alert('未登录或登录超时！请返回，重新登录，谢谢!');window.top.location.href='../index.php'</script>";
	die();
	}
?>
<?php
	if($_GET['edit'] == 'del'){
	$Aid=$_GET["Aid"];
	$papin=$_GET["pa_pin"];

	$sql="delete from hchi_passcx where id=$Aid";
	if(mysql_query($sql)){ 
        echo '<html>'; 
        echo '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>'; 
		echo "<script language=javascript>alert('删除成功！');window.location='newpass.php'</script>";
        echo '</html>'; 
		}
	}
	if($_POST["tjbx-abc"]=='h-chi-vgs-8-com'){
	$Aid=$_POST["pa_id"];
	$papin=$_POST["pa_pin"];
		$sql1="update hchi_passcx set pa_pin='".$papin."' where id=$Aid";
		if(mysql_query($sql1))
		{
		    // 写入日志
            $sql="select * from hchi_passcx where id=$Aid";
            $rs=mysql_query($sql);
            $row=mysql_fetch_array($rs);
            $yhm=$row["yhm"];
            $cjh=$row["pa_cjh"];
            $chex=$row['pa_chex'];
            $sql1 = "insert into rj (yhm,cjh,pin,chex) values ('$yhm','$cjh','$papin','$chex')";
            mysql_query($sql1);

		    echo "<script language=javascript>alert('提交成功！');window.location='newpass.php'</script>";
		}
		die();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/select.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/showdate.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.idTabs.min.js"></script>
<script type="text/javascript" src="../js/select-ui.min.js"></script>
<script type="text/javascript" src="../editor/kindeditor.js"></script>

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
<script src="../laydate/laydate.js"></script>
</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="default.php">首页</a></li>
    <li><a href="#">最新申请</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    <!--div class="tools">
    	<ul class="toolbar">
        <a href="help-tj.php"><li class="click"><span><img src="../images/t01.png" /></span>发布帮助</li></a>
        </ul>
    </div-->
    <div id="usual1" class="usual"> 
    
    
    <table class="tablelist">
    	<thead>
    	<tr>
        <th>品牌<i class="sort"><img src="../images/px.gif" /></i></th>
        <th>车型</th>
        <th>年份</th>
        <th>申请码</th>
		<th>申请时间</th>
        <th>车架号</th>
        <th>PIN</th>
        <th>用户</th>
        <th>操作</th>
        </tr>
        </thead>
        
        <tbody>
<?php
	$pagesize=20;
	$sql="select * from hchi_passcx where pa_pin=''";
	$rs=mysql_query($sql);
	$recordcount=mysql_num_rows($rs);
	$pagecount=($recordcount-1)/$pagesize+1;
	$pagecount=(int)$pagecount;
	$pageno=$_GET["pageno"];
	if($pageno=="")
	{
		$pageno=1;
	}
	if($pageno<1)
	{
		$pageno=1;
	}
	if($pageno>$pagecount)
	{
		$pageno=$pagecount;
	}
	$startno=($pageno-1)*$pagesize;
	$sql="select * from hchi_passcx where pa_pin='' order by id desc limit $startno,$pagesize";
	$rs=mysql_query($sql);
	while($rows=mysql_fetch_assoc($rs))
	{
?>
<form id="form1" name="form1" action="newpass.php" method="post">
      <input name="tjbx-abc" type="hidden" id="tjbx-abc" value="h-chi-vgs-8-com" />
        <tr>
        <td><?php echo $rows["pa_pingp"]?></td>
        <td><?php echo $rows["pa_chex"]?></td>
        <td><?php echo $rows["pa_nianf"]?></td>
        <td><?php echo $rows["pa_xingqh"]?></td>
		<td><?php echo $rows["pa_date"]?></td>
        <td><?php echo $rows["pa_cjh"]?></td>
        <td>
        <input name="pa_id" type="hidden" id="pa_id" value="<?php echo $rows["id"]?>">
        <input name="pa_pin" type="text" id="pa_pin" value="<?php echo $rows["pa_pin"]?>" size="50" class="dfinput" style="width:auto;">
        </td>
            <td><?php echo $rows["yhm"]?></td>
            <td><input type="submit" value="提交" class="btn1">&nbsp;&nbsp;<a href="?Aid=<?php echo $rows["id"]?>&edit=del" onClick="return confirm('确定删除吗?将不可恢复！');" class="tablelink"> 删除</a></td>
        </tr> 
</form>
<?php }?>
        </tbody>
        
    </table>
    <div class="pagin">
      <?php require_once("../page.php");?>
    </div>  
       
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
