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

	$sql1="select * from hchi_setup";
	$rs1=mysql_query($sql1);
	$rows1=mysql_fetch_assoc($rs1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
 
/**
* 实时动态强制更改用户录入
* arg1 inputObject
**/
function amount(th){
    var regStrs = [
        ['^0(\\d+)$', '$1'], //禁止录入整数部分两位以上，但首位为0
        ['[^\\d\\.]+$', ''], //禁止录入任何非数字和点
        ['\\.(\\d?)\\.+', '.$1'], //禁止录入两个以上的点
        ['^(\\d+\\.\\d{3}).+', '$1'] //禁止录入小数点后两位以上
    ];
    for(i=0; i<regStrs.length; i++){
        var reg = new RegExp(regStrs[i][0]);
        th.value = th.value.replace(reg, regStrs[i][1]);
    }
}
 
</script>
</head>

<body>

	<div class="place">
    <span>位置：</span>
    <ul class="placeul">
    <li><a href="default.php">首页</a></li>
    <li><a href="#">数据库存备份与恢复</a></li>
    </ul>
    </div>
    
    <div class="formbody">
    
    
      <ul class="forminfo">
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
  	<form id="automateRule" name="automateRule" action="beif-sql.php" method="post">
      <input name="tjbx-abc" type="hidden" id="tjbx-abc" value="h-chi-vgs-8-scbf" />
    <li>
      <label>备份数据库</label><input type="submit" class="btn" onclick="javascript:return confirm('确认要重新备份吗？将替换原备份文件，不可还原！请小心操作。');" value="生成备份"/></li>
    </form>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p style="height:200px;">&nbsp;</p>
  	<form id="automateRule" name="automateRule" action="beif-sql.php" method="post">
      <input name="tjbx-abc" type="hidden" id="tjbx-abc" value="h-chi-vgs-8-fhsj" />
    <li>
      <label>恢复数据库</label><input type="submit" class="btn" onclick="javascript:return confirm('确认要恢复数据库吗？请小心操作。');" value="恢复数据"/>&nbsp;<?php
function listDir($dir)
{
    if(is_dir($dir))
    {
        if ($dh = opendir($dir))
        {
            while (($file = readdir($dh)) !== false)
            {
                if((is_dir($dir."/".$file)) && $file!="." && $file!="..")
                {
                    echo '<a>'.$file.'</a>';
                    listDir($dir."/".$file."/");
                }
                else
                {
                    if($file!="." && $file!="..")
                    {
                        echo $file.'&nbsp;<a href="beif-sql.php?zipxz=1a2b3c4d5e6f7g8h"  target="_blank" style="color:#ff0000">->下载备份</a>'.'<br>';
                    }
                }
            }
            closedir($dh);
        }
    }
}
//开始运行
listDir("hchi-db/");
?>
</li>
    </form>
    </ul>
</div>


</body>

</html>
