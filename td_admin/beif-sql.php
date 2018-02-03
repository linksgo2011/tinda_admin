<?php
if($_POST["tjbx-abc"]<>""){
$tjbxabc=$_POST["tjbx-abc"];
}else{
$tjbxabc=$_GET["zipxz"];
}

if($tjbxabc==""){
		echo "<script language=javascript>alert('访问错误！');window.location='beifin.php'</script>";
}else{
include("beifin/Dbbak.class.php");
include("beifin/Http.class.php");
include("beifin/Zip.class.php");
$db = new Dbbak('localhost','tinda','tinda654321','tinda','utf8','hchi-db/'); 
//备份数据
	if($_POST["tjbx-abc"]=='h-chi-vgs-8-scbf')
	{
//查找数据库内所有数据表
$tableArry = $db->getTables();

//备份并生成sql文件
if(!$db->exportSql($tableArry)){
		echo "<script language=javascript>alert('备份失败！');window.location='beifin.php'</script>";
		}else{
		echo "<script language=javascript>alert('备份成功！');window.location='beifin.php'</script>";
		}die();
	}
//恢复数据
	if($_POST["tjbx-abc"]=='h-chi-vgs-8-fhsj')
	{
//恢复导入sql文件夹
if($db->importSql()){
		echo "<script language=javascript>alert('恢复成功！');window.location='beifin.php'</script>";
		}else{
		echo "<script language=javascript>alert('恢复失败！');window.location='beifin.php'</script>";
		}die();
	}

//打包下载备份
	if($_GET["zipxz"]=='1a2b3c4d5e6f7g8h')
	{
	$showname=date("Y-m-d").'-bf.zip';
//	$showname=auto_charset($showname,'utf-8','gbk');
    $zip=new Zip();
	$zip->compress('hchi-db/template.zip','hchi-db/');

//	$showname='kajdbf.zip';
//	Http::download('beifin/template.zip',$showname); 
	echo "<script language=javascript>window.open('beifin/template.zip', '_self');window.close();</script>";
	}
}
?>
