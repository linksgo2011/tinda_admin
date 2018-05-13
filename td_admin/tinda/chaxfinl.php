<?php
require_once("../../include/global.php");
$ad_name1234=$_SESSION["ad_name1234"];
$ad_id1234=$_SESSION["ad_id1234"];

if(!$_GET['module']){
    echo "<script language=javascript>window.top.location.href='?module=data'</script>";
    die();
}

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
	if($_POST["tjbx-abc"]=='h-chi-vgs-8-com')
	{
        $xg_id=$_POST["xg_id"];
	$name1=$_POST["name1"];
	$logoA=$_POST["img"];
	$url1=$_POST["url1"];
	$paix1=$_POST["paix1"];

		$sql1="update finl set name='$name1',url1='$url1',paix='$paix1' where id='".$xg_id."'";
		if (mysql_query($sql1))
		{
		echo "<script language=javascript>alert('修改成功！');window.location=window.location.href</script>";
		}
		die();
	}


	if($_POST["tjbx-abc1"]=='h-chi-vgs-8-com')
	{
	$fl1=$_POST["fl1"];
	$name1=$_POST["name1"];
	$logoA=$_POST["img"];
	$url1=$_POST["url2"];
	$module = $_GET['module'];
		$sql2="insert into finl (fl1,name,logoA,url1,`module`) values 
              ('$fl1','$name1','$logoA','$url1','$module')";
		if(mysql_query($sql2))
		{
		echo "<script language=javascript>alert('添加成功！');window.location=window.location.href</script>";
		}
		echo $sql2;exit;
		die();
	}
?>
<?php
	if($_GET['edit'] == 'del'){
	$Aid=$_GET["Aid"];
	$module = $_GET['module'];

	$sql="delete from finl where id=$Aid";
	if(mysql_query($sql)){
		echo "<script language=javascript>alert('删除成功！');window.location='chaxfinl.php?module=$module'</script>";
		 }else{
		echo "<script language=javascript>alert('操作错误！');window.location='chaxfinl.php?module=$module'</script>";
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/tabs.css" rel="stylesheet" type="text/css" />
<!--link href="../css/select.css" rel="stylesheet" type="text/css" /-->
<script type="text/javascript" src="../js/showdate.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.idTabs.min.js"></script>
<script type="text/javascript" src="../js/select-ui.min.js"></script>
	<link rel="stylesheet" href="/kindeditor/themes/default/default.css" />
	<link rel="stylesheet" href="/kindeditor/plugins/code/prettify.css" />
	<script charset="utf-8" src="/kindeditor/kindeditor-all.js"></script>
	<script charset="utf-8" src="/kindeditor/lang/zh-CN.js"></script>
	<script charset="utf-8" src="/kindeditor/plugins/code/prettify.js"></script>
	<script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="content"]', {
				cssPath : '/kindeditor/plugins/code/prettify.css',
				uploadJson : '/kindeditor/php/upload_json.php',
				fileManagerJson : '/kindeditor/php/file_manager_json.php',
				allowFileManager : true,
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
				}
			});
			prettyPrint();
		});
	</script>
		<script>
			KindEditor.ready(function(K) {
				var editor = K.editor({
					allowFileManager : true
				});
				K('#image1').click(function() {
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							imageUrl : K('#url1').val(),
							clickFn : function(url, title, width, height, border, align) {
								K('#url1').val(url);
								editor.hideDialog();
							}
						});
					});
				});
			});
		</script>
</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="default.php">首页</a></li>
    <li><a href="#">查询类目</a></li>
    </ul>
    </div>


<ul class="tabs">
    <li class="<?php echo $_GET['module']=='data'?'current':'';?>">
        <a href="?module=data" name="" >资料管理</a>
    </li>
    <li class="<?php echo $_GET['module']=='dashboard'?'current':'';?>">
        <a href="?module=dashboard" name="" >仪表资料</a>
    </li>
    <li class="<?php echo $_GET['module']=='maintain'?'current':'';?>">
        <a href="?module=maintain" name="" >维修资料</a>
    </li>
    <li class="<?php echo $_GET['module']=='aircell'?'current':'';?>">
        <a href="?module=aircell" name="" >气囊资料</a>
    </li>
</ul>

<div class="formbody" style="background:#ddd">
    <div id="usual1" class="usual"> 
    
  	<div class="tabson">
<form id="form1" name="form1"  method="post">
      <input name="tjbx-abc1" type="hidden" id="tjbx-abc1" value="h-chi-vgs-8-com" />
    <ul class="forminfo">
    <li>
      <label>分类</label>
      <select name="fl1" id="fl1"  class="dfinput">
      <option value="0" selected>+新建大类</option>
<?php
    $module = $_GET['module'];
	$sql="select * from finl where fl1=0 and `module`='$module'";
	$rs=mysql_query($sql);
	while($rows=mysql_fetch_assoc($rs))
	{
	  echo '<option value='.$rows["id"].'>'.$rows["name"].'</option>';
	    $flID=$rows["id"];
		$sql1="select * from finl where fl1='".$flID."'";
	    $rs1=mysql_query($sql1);
	    while($rows1=mysql_fetch_assoc($rs1))
	    {
	        echo '<option value='.$rows1["id"].'>&nbsp;&nbsp;---'.$rows1["name"].'</option>';
	    }
	}
?>
      </select>
    </li>
    <li>
      <label>名称</label>
      <input name="name1" type="text" id="name1" value="" class="dfinput" size="60">
    </li>
    <li>
      <label>标志</label>
      <input name="img"type="text" class="dfinput" id="url1" value="" readonly="readonly" /> 
      <input type="button" id="image1" class="btn1" value="选择图片" />&nbsp;&nbsp;大类不用上传
    </li>
    <li>
      <label>网址</label>
      <input name="url2" type="text" id="url2" value=""  class="dfinput" size="60">
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
    $module = $_GET['module'];
	$sql="select * from finl where fl1=0 and `module`='$module' order by id asc";
	$rs=mysql_query($sql);
	while($rows=mysql_fetch_assoc($rs))
	{
?>

<!--    车系    -->
<form name="form1" method="post" >
      <input name="tjbx-abc" type="hidden" id="tjbx-abc" value="h-chi-vgs-8-com" />
    <ul class="forminfo">
    <li>|:
      <input name="xg_id" type="hidden" id="xg_id" value="<?php echo $rows["id"]?>">
      <input name="name1" type="text" id="name1" value="<?php echo $rows["name"]?>" size="15" class="dfinput">
        <img src="<?php if($rows["logoA"]<>""){echo $rows["logoA"];}else{echo '/images/icon-read2.png';}?>" height="24px"/>
        &nbsp;&nbsp;<a href="sanqlogo.php?Aid=<?php echo $rows["id"]?>" class="tablelink" style="padding:5px 12px 5px 12px;background-color:#ff00ff;color:#FFF;"> 上传图标</a>
      &nbsp;&nbsp;<input type="submit" name="xiugan" id="xiugan" value="确认" class="btn1">&nbsp;&nbsp;<a href="?module=<?php echo $rows["module"]?>&Aid=<?php echo $rows["id"]?>&edit=del">删除</a>
    </li>
    </ul>
    </form> 
<!--------------------------------------------->
<?php
    $fl1ID=$rows["id"];
	$sql1="select * from finl where fl1='".$fl1ID."' order by id asc";
	$rs1=mysql_query($sql1);
	while($rows1=mysql_fetch_assoc($rs1))
	{
?>
<form name="form1" method="post" >
      <input name="tjbx-abc" type="hidden" id="tjbx-abc" value="h-chi-vgs-8-com" />
    <ul class="forminfo" >
    <li>||----品牌:
      <input name="xg_id" type="hidden" id="xg_id" value="<?php echo $rows1["id"]?>">
      <input name="name1" type="text" id="name1" value="<?php echo $rows1["name"]?>" size="15" class="dfinput" style="width:200px;">
      &nbsp;排序:<input name="paix1" type="text" id="paix1" value="<?php echo $rows1["paix"]?>" size="15" class="dfinput" style="width:60px;">
      <img src="<?php if($rows1["logoA"]<>""){echo $rows1["logoA"];}else{echo '/images/icon-read2.png';}?>" height="24px"/>
      &nbsp;&nbsp;<a href="sanqlogo.php?Aid=<?php echo $rows1["id"]?>" class="tablelink" style="padding:5px 12px 5px 12px;background-color:#ff00ff;color:#FFF;"> 上传图标</a>
      &nbsp;&nbsp;<input type="submit" name="xiugan" id="xiugan" value="确认" class="btn1">
      &nbsp;&nbsp;<a href="?Aid=<?php echo $rows1["id"]?>&edit=del" onClick="return confirm('确定删除吗?将不可恢复！');" class="tablelink" style="padding:5px 12px 5px 12px;background-color:#ff0000;color:#FFF;"> 删除</a> 
    </li>
      
    </ul>
    </form> 
<!--------------------------------------------->
<?php
    $fl1ID1=$rows1["id"];
	$sql2="select * from finl where fl1='".$fl1ID1."' order by id asc";
	$rs2=mysql_query($sql2);
	while($rows2=mysql_fetch_assoc($rs2))
	{
?>
<form name="form1" method="post" >
      <input name="tjbx-abc" type="hidden" id="tjbx-abc" value="h-chi-vgs-8-com" />
    <ul class="forminfo" >
    <li>|||----:
      <input name="xg_id" type="hidden" id="xg_id" value="<?php echo $rows2["id"]?>">
      名称：<input name="name1" type="text" id="name1" value="<?php echo $rows2["name"]?>" size="15" class="dfinput" style="width:200px;">
      &nbsp;&nbsp;网址：<input name="url1" type="text" id="url1" value="<?php echo $rows2["url1"]?>" size="35" class="dfinput">
      &nbsp;排序:<input name="paix1" type="text" id="paix1" value="<?php echo $rows2["paix"]?>" size="15" class="dfinput" style="width:60px;">
      <img src="<?php if($rows2["logoA"]<>""){echo $rows2["logoA"];}else{echo '/images/fl_1.jpg';}?>" height="24px"/>
      &nbsp;&nbsp;<a href="sanqlogo.php?Aid=<?php echo $rows2["id"]?>" class="tablelink" style="padding:5px 12px 5px 12px;background-color:#ff00ff;color:#FFF;"> 上传图标</a>
      &nbsp;&nbsp;<input type="submit" name="xiugan" id="xiugan" value="确认" class="btn1">&nbsp;&nbsp;<a href="chax-body.php?Aid=<?php echo $rows2["id"]?>"style="padding:5px 12px 5px 12px;background-color:#ff9900;color:#FFF;">录入祥情</a>&nbsp;&nbsp;<a href="?Aid=<?php echo $rows2["id"]?>&edit=del" onClick="return confirm('确定删除吗?将不可恢复！');" class="tablelink" style="padding:5px 12px 5px 12px;background-color:#ff0000;color:#FFF;"> 删除</a>
      </li>
    </ul>
    </form> 
<?php }}}?>      
	</div> 
	</div> 
</div>

</body>

</html>
