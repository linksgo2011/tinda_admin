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
                window.editor = K.create('#editor_id');
        });
</script>
</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="default.php">首页</a></li>
    <li><a href="#">首页公告</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    
    <div id="usual1" class="usual"> 
    
  	<div class="tabson">
<?php
	$sql="select * from hchi_setup";
	$rs=mysql_query($sql);
	$rows=mysql_fetch_assoc($rs);

	if($_POST["tjbx-abc"]=='h-chi-vgs-8-com')
	{
	    $Aid=$_POST["id"];
		$homegg=$_POST["homegg"];
/*		$h_body=$_POST["content"];

		if($h_title==""){
		echo "<script language=javascript>alert('项目标题不能为空！');window.location='help-bj.php?id=".$Aid."'</script>";
		exit();
		}
*/
		$sql1="update hchi_setup set homegg='$homegg' where id='".$Aid."'";
		if(mysql_query($sql1))
		{
		echo "<script language=javascript>alert('编辑成功！');window.location='indexgg.php'</script>";
		}
		die();
	}
?>
<form id="form1" name="form1" action="indexgg.php" method="post">
      <input name="tjbx-abc" type="hidden" id="tjbx-abc" value="h-chi-vgs-8-com" />
      <input name="id" type="hidden" id="id" value="<?php echo $rows["id"]?>" />
    <ul class="forminfo">
    <li>
      <label>公告</label><input name="homegg" type="text" class="dfinput" id="homegg" value="<?php echo $rows["homegg"]?>" />
    </li>
    <li><label>&nbsp;</label><input type="submit" class="btn" value="确认修改"/>
    </li>
    </ul>
    </form>       
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
