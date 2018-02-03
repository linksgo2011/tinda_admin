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

	$sql="delete from hchi_images where id=$Aid";
	if(mysql_query($sql)){ 
        echo '<html>'; 
        echo '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>'; 
		echo "<script language=javascript>alert('删除成功！');window.location='indexlb.php'</script>";
        echo '</html>'; 
		}
	}

	if($_POST["tjbx-abc1"]=='h-chi-vgs-8-com')
	{
	$im_img=$_POST["img"];
	$im_url=$_POST["url"];
		$sql2="insert into hchi_images (im_img,im_url) values ('$im_img','$im_url')";
		if(mysql_query($sql2))
		{
		echo "<script language=javascript>alert('添加成功！');window.location='indexlb.php'</script>";
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
    <li><a href="#">首页轮播</a></li>
    </ul>
    </div>
    
<div class="formbody" style="background:#ddd">
    <div id="usual1" class="usual"> 
    
  	<div class="tabson">
<form id="form1" name="form1" action="indexlb.php" method="post">
      <input name="tjbx-abc1" type="hidden" id="tjbx-abc1" value="h-chi-vgs-8-com" />
    <ul class="forminfo">
    <li>
      <label>图片</label>
      <input name="img"type="text" class="dfinput" id="url1" value="" readonly="readonly" /> 
      <input type="button" id="image1" class="btn1" value="选择图片" />&nbsp;&nbsp;注：640X280像素
    </li>
    <li><label>联接</label><input name="im_url" type="text" class="dfinput" id="im_url" value=""/></li>
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
	$sql="select * from hchi_images order by id desc";
	$rs=mysql_query($sql);
	while($rows=mysql_fetch_assoc($rs))
	{
?>
<form name="form2" method="post" action="">
      <input name="tjbx-abc" type="hidden" id="tjbx-abc" value="h-chi-vgs-8-com" />
    <ul class="forminfo">
    <li><div  style="height:120px;line-height:120px;float:left;"><img src="<?php echo $rows["im_img"]?>" height="100px;">
      <input name="id" type="hidden" id="id" value="<?php echo $rows["id"]?>"></div>
      <div  style="height:120px;line-height:120px;float:left;">&nbsp;&nbsp;<a href="?Aid=<?php echo $rows["id"]?>&edit=del" onClick="return confirm('确定删除吗?将不可恢复！');" class="tablelink" style="padding:3px 12px 3px 12px;background-color:#ff0000;color:#FFF;"> 删除</a></div>
    </li>
    </ul>
    </form> 
<!--------------------------------------------->
<?php }?>      
	</div> 
	</div> 
</div>

</body>

</html>
