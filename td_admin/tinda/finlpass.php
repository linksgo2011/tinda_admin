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

	$sql="delete from hchi_cxfl where id=$Aid";
	if(mysql_query($sql)){ 
        echo '<html>'; 
        echo '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>'; 
		echo "<script language=javascript>alert('删除成功！');window.location='finlpass.php'</script>";
        echo '</html>'; 
		}
	}

	if($_POST["tjbx-abc1"]=='h-chi-vgs-8-com')
	{
	$cx_finl=$_POST["cx_finl"];
	$cx_title=$_POST["cx_title"];
	$cx_url=$_POST["cx_url"];
	$cx_type=$_POST["cx_type"];
	$cx_cartype=$_POST["cx_cartype"];
		$sql2="insert into hchi_cxfl (cx_finl,cx_title,cx_url,cx_type,cx_cartype) values ('$cx_finl','$cx_title','$cx_url','$cx_type','$cx_cartype')";
		if(mysql_query($sql2))
		{
		echo "<script language=javascript>alert('添加成功！');window.location='finlpass.php'</script>";
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
<!--link href="../css/select.css" rel="stylesheet" type="text/css" /-->
<script type="text/javascript" src="../js/showdate.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.idTabs.min.js"></script>
<script type="text/javascript" src="../js/select-ui.min.js"></script>
</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="default.php">首页</a></li>
    <li><a href="#">密码分类</a></li>
    </ul>
    </div>
    
<div class="formbody" style="background:#ddd">
    <div id="usual1" class="usual"> 
    
  	<div class="tabson">
<?php
	if($_POST["tjbx-abc"]=='h-chi-vgs-8-com')
	{
		$Aid=$_POST["id"];
		$cx_finl=$_POST["cx_finl1"];
		$cx_title=$_POST["cx_title1"];
	    $cx_url=$_POST["cx_url"];
	    $cx_type=$_POST["cx_type"];
	    $cx_cartype=$_POST["cx_cartype"];

		if($cx_title==""){
		echo "<script language=javascript>alert('请填写类名！');window.location='finlpass.php'</script>";
		exit();
		}

		$sql1="update hchi_cxfl set cx_finl='$cx_finl',cx_title='$cx_title',cx_url='$cx_url',cx_type='$cx_type',cx_cartype='$cx_cartype' where id=$Aid";
		if(mysql_query($sql1))
		{
		echo "<script language=javascript>alert('编辑成功！');window.location='finlpass.php'</script>";
		}
		die();
	}
?>
<form id="form1" name="form1" action="finlpass.php" method="post">
      <input name="tjbx-abc1" type="hidden" id="tjbx-abc1" value="h-chi-vgs-8-com" />
    <ul class="forminfo">
    <li>
      <label>添加分类</label>
      <select name="cx_finl" id="cx_finl"  class="dfinput">
      <option value="0" selected>大类</option>
<?php
	$sql1="select * from hchi_cxfl where cx_finl=0 order by id asc";
	$rs1=mysql_query($sql1);
	while($rows1=mysql_fetch_assoc($rs1))
	{
	echo '<option value="'.$rows1["id"].'">'.$rows1["cx_title"].'</option>';
	}
?>
      </select>
    </li>
    <li>
      <label>类名</label>
      <input name="cx_title" type="text" id="cx_title" value="" class="dfinput" size="60">
    </li>
    <li>
      <label>地址</label>
      <input name="cx_url" type="text" id="cx_url" value="" class="dfinput" size="120">
    </li>
    <li>
      <label>TYPE</label>
      <input name="cx_type" type="text" id="cx_type" value="" class="dfinput" size="60">
    </li>
    <li>
      <label>CarType</label>
      <input name="cx_cartype" type="text" id="cx_cartype" value="" class="dfinput" size="60">
    </li>
    <li><label>&nbsp;</label><input type="submit" class="btn" value="确认添加"/></li>
    </ul>
    </form>       
	</div> 
	</div> 
</div>
<!--------------------------------------->
<div class="formbody" style="background:#fff">
    <div id="usual1" class="usual"> 
    
  	<div class="tabson">
<?php
	$sql="select * from hchi_cxfl where cx_finl=0 order by id asc";
	$rs=mysql_query($sql);
	while($rows=mysql_fetch_assoc($rs))
	{
?>
<form name="form2" method="post" action="">
      <input name="tjbx-abc" type="hidden" id="tjbx-abc" value="h-chi-vgs-8-com" />
    <ul class="forminfo">
    <li>|:
      <input name="id" type="hidden" id="id" value="<?php echo $rows["id"]?>">
      <input name="cx_title1" type="text" id="cx_title1" value="<?php echo $rows["cx_title"]?>" size="15" class="dfinput" style="width:120px">
      &nbsp;&nbsp;
      <select name="cx_finl1" id="cx_finl1"  class="dfinput" style="width:120px">
      <option value="0" <?php if($rows["cx_finl"]==0){echo 'selected';}?>>大类</option>
<?php
	$sql2="select * from hchi_cxfl where cx_finl=0 order by id asc";
	$rs2=mysql_query($sql2);
	while($rows2=mysql_fetch_assoc($rs2))
	{
	echo '<option value="'.$rows2["id"].'">'.$rows2["cx_title"].'</option>';
	}
?>
      </select>
      &nbsp;&nbsp;地址&nbsp;<input name="cx_url" type="text" id="cx_url" value="<?php echo $rows["cx_url"]?>" size="15" class="dfinput">
      &nbsp;&nbsp;TYPE&nbsp;<input name="cx_type" type="text" id="cx_type" value="<?php echo $rows["cx_type"]?>" size="15" class="dfinput" style="width:60px">
      &nbsp;&nbsp;CarType&nbsp;<input name="cx_cartype" type="text" id="cx_cartype" value="<?php echo $rows["cx_cartype"]?>" size="15" class="dfinput" style="width:40px">
      &nbsp;&nbsp;<input type="submit" name="xiugan" id="xiugan" value="修改" class="btn1">&nbsp;&nbsp;<a href="?Aid=<?php echo $rows["id"]?>&edit=del" onClick="return confirm('确定删除吗?将不可恢复！');" class="tablelink" style="padding:5px 12px 5px 12px;background-color:#ff0000;color:#FFF;"> 删除</a>
    </li>
    </ul>
    </form> 
<!----------------------->
<?php
	$finlA=$rows["id"];
	$sqlA="select * from hchi_cxfl where cx_finl=".$finlA." order by id asc";
	$rsA=mysql_query($sqlA);
	while($rowsA=mysql_fetch_assoc($rsA))
	{
?>
<form name="form2" method="post" action="">
      <input name="tjbx-abc" type="hidden" id="tjbx-abc" value="h-chi-vgs-8-com" />
    <ul class="forminfo">
    <li>||------:
      <input name="id" type="hidden" id="id" value="<?php echo $rowsA["id"]?>">
      <input name="cx_title1" type="text" id="cx_title1" value="<?php echo $rowsA["cx_title"]?>" size="15" class="dfinput" style="width:120px">
      &nbsp;&nbsp;
      <select name="cx_finl1" id="cx_finl1"  class="dfinput" style="width:120px">
      <option value="0">大类</option>
<?php
	$sql2="select * from hchi_cxfl where cx_finl=0 order by id asc";
	$rs2=mysql_query($sql2);
	while($rows2=mysql_fetch_assoc($rs2))
	{
	if($rows2["id"]==$rowsA["cx_finl"]){$dangq='selected';}else{$dangq='';}
	echo '<option value="'.$rows2["id"].'" '.$dangq.'>'.$rows2["cx_title"].'</option>';
	}
?>
      </select>
      &nbsp;&nbsp;<input type="submit" name="xiugan" id="xiugan" value="修改" class="btn1">&nbsp;&nbsp;<a href="?Aid=<?php echo $rowsA["id"]?>&edit=del" onClick="return confirm('确定删除吗?将不可恢复！');" class="tablelink" style="padding:5px 12px 5px 12px;background-color:#ff0000;color:#FFF;"> 删除</a>
    </li>
    </ul>
    </form> 
<?php }?>      
<!--------------------------------------------->
<?php }?>      
	</div> 
	</div> 
</div>

</body>

</html>
