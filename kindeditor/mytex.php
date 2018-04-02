<?php
	require_once("include/global.php");

	$sqlseo="select * from hchi_seo where id=1";
	$rsseo=mysql_query($sqlseo);
	$indexseo=mysql_fetch_assoc($rsseo);

	$sqlsetup="select * from hchi_setup where id=1";
	$rssetup=mysql_query($sqlsetup);
	$hchisetup=mysql_fetch_assoc($rssetup);
?>
<?php
	$user_id=$_SESSION["userid"];
	$jdrname=$hchiuser["us_mob"];

	$pagesize=20;
	$sql="select * from hchi_yuyan where yy_hyid='$user_id' and yy_finl='售币'";
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
	$sql="select * from hchi_yuyan where yy_hyid='$user_id' and yy_finl='售币' order by id desc limit $startno,$pagesize";
	$rs=mysql_query($sql);
?>
<?php
	$cid=$_GET["Aid"];
	if($_GET["zhuf"]=="weisdk" and $cid<>""){
		$sql1="update hchi_yuyan set yy_zt=3 where id='".$cid."'";
		if(mysql_query($sql1))
		{
		echo "<script language=javascript>window.location='mytex.php'</script>";
		}
		die();
	}
/////////
	if($_GET["zhuf"]=="jibaojzf" and $cid<>""){
		$sql1="update hchi_yuyan set yy_zt=4 where id='".$cid."'";
		if(mysql_query($sql1))
		{
		echo "<script language=javascript>window.location='mytex.php'</script>";
		}
		die();
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Cache-Control" content="no-store" />
<title>我的售币</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css/compatible.css">
<link rel="stylesheet" href="css/header.css">
<link href="css/css.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php require_once("zhujian/top.php")?>

<div id="container">
	<div class="main">
		<div class="cut2"></div>
		<div class="box pb30">
			<div class="clearfix">
				<div class="uc-l">
					
<?php require_once("zhujian/list.php")?>

				</div>
				<div class="uc-r">
					<div>
	                	<div id="tab1" class="pb-tab">
                            <ul class="pb-tab-title">
                                <li id="bankCardTab">我的售币</li>
                            </ul>
	                        <ul class="pb-tab-con">
	                            <!--资金明细 -->
	                            <li class="pb-tab-con-item first" id="fund">
<div class="query-condition">
</div>
<table class="table-list">
	<tr>
		<th class="pl10">订单号</th>
		<th style="width:180px;">收币会员</th>
		<th style="width:200px;">支付帐号</th>
		<th style="width:70px;" class="txt-r">交易额</th>
		<th style="width:80px;" class="txt-r">状态</th>
		<th style="width:120px;" class="txt-r">操作</th>
		<th style="width:10px;" class="txt-r"></th>
	</tr>
	
<?php
	while($rows=mysql_fetch_assoc($rs))
	{

	$yyid12=$rows["yy_peideiid"];
	$sqlyyzh="select * from hchi_yuyan where id='$yyid12'";
	$rsyyzh=mysql_query($sqlyyzh);
	$hchiyyzh=mysql_fetch_assoc($rsyyzh);
	$hyid1234=$hchiyyzh["yy_hyid"];
	$sqlhyzh="select * from hchi_user where id='$hyid1234'";
	$rshyzh=mysql_query($sqlhyzh);
	$hchihyzh=mysql_fetch_assoc($rshyzh);
	$zs_date=date("Y-m-d H:i:s");
    if($rows["yy_zt"]==0 and $rows["yy_gqdate"]>$zs_date){
		$zhangtan='<b>待匹配</b>';
    }if($rows["yy_zt"]==1 and $rows["yy_gqdate"]>$zs_date){
		$zhangtan='<b>待支付</b>';
    }if($rows["yy_zt"]==2 and $rows["yy_gqdate"]>$zs_date){
		$zhangtan='<b>已支付</b>';
    }if($rows["yy_zt"]<>3 and $rows["yy_gqdate"]<$zs_date){
		$zhangtan='<b>已过期</b>';
    }if($rows["yy_zt"]==3){
		$zhangtan='<b>已完成</b>';
	}
?>
	<tr>
		<td class="pl10"><?php echo $rows["yy_ddbh"]?></td>
		<td><?php echo '用户名：';if($hchihyzh["us_nic"]==""){echo '----';}else{echo $hchihyzh["us_nic"];}
				  echo '<br />联系QQ：';if($hchihyzh["us_QQ"]==""){echo '----';}else{echo $hchihyzh["us_QQ"];}
				  echo '<br />联系电话：';if($hchihyzh["us_mod"]==""){echo '----';}else{echo $hchihyzh["us_mod"];}?></td>
		<td><?php echo '支付宝姓名：';if($hchihyzh["us_zfbname"]==""){echo '----';}else{echo $hchihyzh["us_zfbname"];}
				  echo '<br />帐号：';if($hchiyyzh["yy_szzhangh"]==""){echo '----';}else{echo $hchiyyzh["yy_szzhangh"];}?></td>
		<td class="txt-r">￥<b class="red"><?php echo $rows["yy_mody"]?></b></td>
		<td class="txt-r"><div style="height:40px;overflow:hidden;"><?php if($rows["yy_zt"]==3){echo '<p style="color:#FF0000;">未收到款</p><p>&nbsp;</p>';}?><?php if($rows["yy_zt"]==4){echo '<p style="color:#FF0000;">举报假支付</p><p>&nbsp;</p>';}?><em id="timer<?php echo $rows["id"]?>"></em></div>
        </td>
		<td class="txt-r"><?php if($rows["yy_zt"]==2 or (strtotime($rows["yy_pipeisj"])+7200 < strtotime(date("Y-m-d H:i:s")) and strtotime($rows["yy_pipeisj"])+50400 > strtotime(date("Y-m-d H:i:s"))) ){?>
        <?php if($rows["yy_zt"]<>3 and $rows["yy_zt"]<>4){?>
        <p style="height:26px;"><a href="?Aid=<?php echo $rows["id"]?>&zhuf=weisdk" onClick='return confirm("请再次核查资金是否到账，并先联系对方打款，联系不上可再确认未收到款，等待系统重新匹配。");' style="color:#FFF;"><span id="reg-zhangtan" style="background-color:#20c200;padding:2px 5px 2px 5px;border-radius:4px;color:#fff">未&nbsp;收&nbsp;到&nbsp;款</span></a></p>
        <?php }if($rows["yy_zt"]<>4){?>
        <p style="height:26px;"><a href="?Aid=<?php echo $rows["id"]?>&zhuf=jibaojzf" onClick='return confirm("对方假支付需联系客服举报后才会重新匹配。虚假确认未收款，账号将会被冻结处理！
");' style="color:#FFF;"><span id="reg-zhangtan" style="background-color:#20c200;padding:2px 5px 2px 5px;border-radius:4px;color:#fff">举报假支付</span></a></p>
		<?php }}?></td>
		<td class="txt-r"></td>
	</tr>
<?php }?>
		
		
		<!--tr><td colspan="5" class="txt-c grey">暂无记录</td></tr-->
		
	
</table>

<div class="pagination clearfix">
	<ul class="clearfix fr">
		  <?php if($_GET["pageno"]>1){?>
          <a id="_pre_page" href="?pageno=<?php echo $_GET["pageno"]-1?>&finl=<?php echo $finl1?>" title="上一页" class="prev"><b></b>上一页</a>
          <?php }else{?>
		  <span class="prev"><b></b>上一页</span>
          <?php }?>
<?php 
if($pagecount<=5)//=>5P
{
    for($i = 1;$i <= $pagecount; $i++) {
        echo "<a id='_page_no' href='?pageno=$i&finl=$finl1' target='_self'";
 		 if($pageno==$i)
		 {
         echo "class='current'";
		 }
		 echo ">$i</a>";
     }
}
if($pagecount>5)//<5P
{
	echo '<span>...</span>';	
    $i1=$_GET["pageno"]-2;
	if(($_GET["pageno"]+2)<$pagecount)
	{$i2=$_GET["pageno"]+2;}else
	{$i2=$pagecount;}
    for($i = $i1;$i <= $i2; $i++) {
        echo "<a id='_page_no' href='?pageno=$i&finl=$finl1' target='_self'";
 		 if($pageno==$i)
		 {
         echo "class='current'";
		 }
		 echo ">$i</a>";
     }
	echo '<span>...</span>';	
}
?>
		  <?php if($_GET["pageno"]<>$pagecount and $pagecount>1){?>
          <a id="_next_page" href="?pageno=<?php echo $_GET["pageno"]+1?>&finl=<?php echo $finl1?>" title="下一页" class="next"><b></b>下一页</a>
          <?php }else{?>
		  <span class="next"><b></b>下一页</span>
          <?php }?>
		</ul>
	<input type="hidden" name="page" value="1"/>
	<input type="hidden" name="pages" value="0"/>
	<input type="hidden" name="items" value="0"/>
</div>
	                            </li>

	                        </ul>
	                   </div>
	                </div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once("zhujian/bot.php")?>
</body>
<script type="text/javascript">
    var addTimer = function () {
        var list = [],
            interval;
        return function (id, time) {
            if (!interval)
                interval = setInterval(go, 1000);
            list.push({ ele: document.getElementById(id), time: time });
        }
        function go() {
            for (var i = 0; i < list.length; i++) {
                list[i].ele.innerHTML = getTimerString(list[i].time ? list[i].time -= 1 : 0);
                if (!list[i].time)
                    list.splice(i--, 1);
            }
        }
        function getTimerString(time) {
		    if(time>43200){
			   zhengdu123="待支付";
            var not0 = !!time,
                h = Math.floor((time %= 86400) / 3600)-12,
                m = Math.floor((time %= 3600) / 60),
                s = time % 60;
			}else{
			   zhengdu123="已支付";
            var not0 = !!time,
                h = Math.floor((time %= 86400) / 3600),
                m = Math.floor((time %= 3600) / 60),
                s = time % 60;
			}
            if (not0)
                return zhengdu123 + "<p style='color:#ff0000'>" + h + ":" + m + ":" + s + "</p>";
            else return "完成交易";
        }
    } ();
<?php
	$pagesize1=20;
	$sql1="select * from hchi_yuyan where yy_hyid='$user_id' and yy_finl='售币'";
	$rs1=mysql_query($sql1);
	$recordcount1=mysql_num_rows($rs1);
	$pagecount1=($recordcount1-1)/$pagesize1+1;
	$pagecount1=(int)$pagecount1;
	$pageno=$_GET["pageno"];
	if($pageno=="")
	{
		$pageno=1;
	}
	if($pageno<1)
	{
		$pageno=1;
	}
	if($pageno>$pagecount1)
	{
		$pageno=$pagecount1;
	}
	$startno1=($pageno-1)*$pagesize1;
	$sql1="select * from hchi_yuyan where yy_hyid='$user_id' and yy_finl='售币' order by id desc limit $startno,$pagesize";
	$rs1=mysql_query($sql1);
	while($rows1=mysql_fetch_assoc($rs1))
	{
	$sydateA=(strtotime($rows1["yy_pipeisj"])+7200);
	$sydateB=(strtotime($rows1["yy_pipeisj"])+50400);
	$sydateC=strtotime(date("Y-m-d H:i:s"));
	if($rows1["yy_pipeisj"]<>0){
?>
      addTimer("timer<?php echo $rows1["id"]?>", <?php $sydate=$sydateB-$sydateC; if($sydate<=0){echo 0;}else{echo $sydate;}?>);
<?php }}?>
</script>

</html>