<?php
require_once("../../include/global.php");
$ad_name1234=$_SESSION["ad_name1234"];
$ad_id1234=$_SESSION["ad_id1234"];


// 过期VIP重置
mysql_query('update feedbackinfo set vip = 0,us_koner="" where unix_timestamp(end_date) < unix_timestamp(now()) and vip=1');


////////////////////////////
    if($_GET["pageno"]<>""){
	   $pageno=$_GET["pageno"];
	}else{
	   $pageno=$_POST["pageno"];
	}
	if($_POST["usname"]<>""){
	  $usname=$_POST["usname"];
	}else{
	  $usname=$_GET["usname"];
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
	if($_GET['edit'] == 'del'){
	$Aid=$_GET["Aid"];

	$sql="delete from feedbackinfo where id=$Aid";
	if(mysql_query($sql)){ 
        echo '<html>'; 
        echo '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>'; 
		echo "<script language=javascript>alert('删除成功！');window.location='usergl.php?pageno=".$pageno."&usname=".$usname."'</script>";
        echo '</html>'; 
		}
	}
	if($_GET['edit'] == 'xiaxian'){
	$Aid=$_GET["Aid"];
		$sqlA="select * from feedbackinfo where id=$Aid";
		$rsA=mysql_fetch_assoc(mysql_query($sqlA));
//	    $d = strtotime($rsA["dl_date"])-1;
		$sql1="update feedbackinfo set us_koner=us_koner"."1 where id=$Aid";
		if (mysql_query($sql1))
		{
		echo "<script language=javascript>alert('下线成功！');window.location='usergl.php?pageno=".$pageno."&usname=".$usname."'</script>";
		}
		die();
	}

	$sql="select * from hchi_websz";
	$rs=mysql_query($sql);
	$rows=mysql_fetch_assoc($rs);
////////////////////////////
	if($_POST["tjbx-abc"]=='h-chi-vgs-8-com')
	{
		$pass=$_POST["pass1"];
		$xg_id=$_POST["xg_id"];
		$xg_date=$_POST["xg_date"];
		$title1=$_POST["title1"];
		$name1=$_POST["name1"];
		$email1=$_POST["email1"];
		$comment1=$_POST["comment1"];
		$phone=$_POST["phone"];
		$vip = $_POST['vip'];

		if($pass=="" or xg_date=="" or title1=="" or name1=="" or email1=="" or comment1==""){
		echo "<script language=javascript>alert('请认真填写参数！');window.location='usergl.php?pageno=".$pageno."&usname=".$usname."'</script>";
		exit();
		}

		$sql1="update feedbackinfo set pass='$pass',end_date='$xg_date',title='$title1',name='$name1',email='$email1',comment='$comment1',phone='$phone',vip=$vip where id=$xg_id";
		if(mysql_query($sql1))
		{
		echo "<script language=javascript>alert('修改成功！');window.location='usergl.php?pageno=".$pageno."&usname=".$usname."'</script>";
		}
		die();
	}


	// VIP 用户统计
    $countSql = "SELECT COUNT( * ) as vipCount FROM feedbackinfo WHERE DATE( end_date ) >= NOW( )";
	$rs = mysql_query($countSql);
    $vipCountArr = mysql_fetch_assoc($rs);
    $vipCount = $vipCountArr['vipCount'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
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
    <li><a href="#">用户管理</a></li>
    </ul>
    </div>
    
    <div class="formbody" style="background:#ddd">
<form id="form1" name="form1" action="usergl.php" method="get">
      <label></label>
      <input name="usname" type="text" id="usname" value="<?php echo $usname?>" class="dfinput" placeholder="用户名/经销商/姓名/手机/提示" size="60">
      <input type="submit" class="btn" value="查找"/>
        <span style="display: inline"> VIP用户数：<?php echo $vipCount; ?></span>
</form>       
	</div> 
	</div> 
</div>
<!--------------------------------------->
    <div id="usual1" class="usual"> 
    
    
    <table class="tablelist">
    	<thead>
    	<tr>
        <th>用户名[点击查看详情]<i class="sort"><img src="../images/px.gif" /></i></th>
        <th>重复登陆</th>
        <th>注册方式</th>
        <th>姓名</th>
        <th>手机</th>

        <th>日期</th>
        <th>提示</th>
       <th>注册时间</th>
        <th>到期时间</th>
        <th>VIP</th>
        <th>积分</th>
        <th>操作</th>
        </tr>
        </thead>
        
        <tbody>
<?php
	$pagesize=20;
	if($usname==""){
	$sql="select * from feedbackinfo";
	}else{
	$sql="select * from feedbackinfo where title like '%".$usname."%' OR name like '%".$usname."%' OR email like '%".$usname."%' OR phone like '%".$usname."%' OR comment like '%".$usname."%'";
	}
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
	if($usname==""){
	$sql="select * from feedbackinfo order by id desc limit $startno,$pagesize";
	}else{
	$sql="select * from feedbackinfo where title like '%".$usname."%' OR name like '%".$usname."%' OR email like '%".$usname."%' OR phone like '%".$usname."%' OR comment like '%".$usname."%' order by id desc limit $startno,$pagesize";
	}
	$rs=mysql_query($sql);
	while($rows=mysql_fetch_assoc($rs))
	{
?>
<form name="form2" method="post" action="">
      <input name="tjbx-abc" type="hidden" id="tjbx-abc" value="h-chi-vgs-8-com" />
      <input name="pageno" type="hidden" id="pageno" value="<?php echo $pageno?>">
      <input name="usname" type="hidden" id="usname" value="<?php echo $usname?>">
        <tr>
        <td>
        <input name="title1" type="text" id="title1" value="<?php echo $rows["title"]?>" size="6" class="dfinput" style="width:120px;">
        <a href="#" onClick="javascript:window.open('viewdetail.php?info_id=<?php echo $rows["id"] ?>','InfoDetail','toolbar=no,scrollbars=yes,resizable=yes,top=0,left=0,width=460 height=360');">查看资料</a>
            <a href="#" onClick="javascript:window.open('viewlogs.php?username=<?php echo $rows["title"] ?>','InfoDetail','toolbar=no,scrollbars=yes,resizable=yes,top=0,left=0,width=460 height=360');">查看日志</a>
        </td>
        <td><?php echo $rows["qzxx"]?>次</td>
        <td><input name="name1" type="text" id="name1" value="<?php echo $rows["name"]?>" class="dfinput" style="width:120px;"></td>
        <td><input name="email1" type="text" id="email1" value="<?php echo $rows["email"]?>" class="dfinput" style="width:120px;"></td>
        <td><input name="phone" type="text" id="phone" value="<?php echo $rows["phone"]?>" class="dfinput" style="width:120px;"></td>

        <td>最后登录：<?php echo $rows["dl_date"]?><br/>&nbsp;&nbsp;<font color="#FF0000">当前密码：</font><input name="pass1" type="text" id="pass1" value="<?php echo $rows["pass"]?>" size="18" class="dfinput" style="width:auto;"></td>
        <td><input name="comment1" type="text" id="comment1" value="<?php echo $rows["comment"]?>" class="dfinput" style="width:180px;"></td>
        <td><?php echo $rows["mess_date"]?></td>
        <td>
      <input name="xg_id" type="hidden" id="xg_id" value="<?php echo $rows["id"]?>">
      <input name="xg_date" type="text" id="xg_date" value="<?php echo $rows["end_date"]?>" size="12" class="dfinput" style="width:auto;">
        </td>


        <td>
            <select name="vip" id="vip" class="uew-select">
                <option <?php echo $rows['vip']?'selected':'' ?> value="1">VIP</option>
                <option <?php echo $rows['vip']?'':'selected' ?> value="0" value="">普通用户</option>
            </select>
        </td>
            <td><?php echo $rows["point"]?></td>
        <td><input type="submit" name="xiugan" id="xiugan" value="修改" class="btn1"><br/>&nbsp;&nbsp;<a href="?Aid=<?php echo $rows["id"]?>&edit=xiaxian&pageno=<?php echo $pageno?>&usname=<?php echo $usname?>" class="tablelink">强制下线</a>&nbsp;&nbsp;<a href="?Aid=<?php echo $rows["id"]?>&edit=del&pageno=<?php echo $pageno?>&usname=<?php echo $usname?>" onClick="return confirm('确定删除吗?将不可恢复！');" class="tablelink"> 删除</a></td>
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
