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
	$sql="select * from hchi_yuyan where yy_hyid='$user_id' and yy_finl='做单' and yy_ppcs<>0";
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
	$sql="select * from hchi_yuyan where yy_hyid='$user_id' and yy_finl='做单' and yy_ppcs<>0 order by id desc limit $startno,$pagesize";
	$rs=mysql_query($sql);
?>
<?php
	$cid=$_GET["Aid"];
	$sql5="select * from hchi_yuyan where yy_zt=1 and id='".$cid."'";
	$rs5=mysql_query($sql5);
	$rows5=mysql_fetch_assoc($rs5);
	$xiadate=date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s"))-7200);
	if($_GET["zhuf"]=="yzhufu" and $cid<>""){
		$sql1="update hchi_yuyan set yy_zt=2,yy_pipeisj='".$xiadate."' where id='".$cid."'";
		if(mysql_query($sql1))
		{
		echo "<script language=javascript>window.location='mydind.php'</script>";
		}
		die();
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Cache-Control" content="no-store" />
<title>我的收币</title>
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
                                <li id="bankCardTab">我的收币</li>
                            </ul>
	                        <ul class="pb-tab-con">
	                            <!--资金明细 -->
	                            <li class="pb-tab-con-item first" id="fund">
<div class="query-condition">
</div>
<table class="table-list">
	<tr>
		<th class="pl10">订单号</th>
		<th style="width:190px;">售币会员</th>
		<th style="width:220px;">支付帐号</th>
		<th style="width:80px;" class="txt-r">交易额</th>
		<th style="width:80px;" class="txt-r">状态</th>
		<th style="width:80px;" class="txt-r">操作</th>
		<th style="width:10px;" class="txt-r"></th>
	</tr>
	
<?php
	while($rows=mysql_fetch_assoc($rs))
	{
	$yyid12=$rows["id"];
	$sqlshoub="select * from hchi_yuyan where yy_peideiid='$yyid12'";
	$rsshoub=mysql_query($sqlshoub);
  while($hchishoub=mysql_fetch_assoc($rsshoub)){
	$hyid1234=$hchishoub["yy_hyid"];
	$sqlhyzh="select * from hchi_user where id='$hyid1234'";
	$rshyzh=mysql_query($sqlhyzh);
	$hchihyzh=mysql_fetch_assoc($rshyzh);
	$sydateA=(strtotime($hchishoub["yy_pipeisj"])+7200);
	$sydateB=(strtotime($hchishoub["yy_pipeisj"])+50400);
	$sydateC=strtotime(date("Y-m-d H:i:s"));
?>
	<tr>
		<td class="pl10"><?php echo $hchishoub["yy_ddbh"]?></td>
		<td><?php echo '用户名：'.$hchihyzh["us_nic"].'<br />联系QQ：'.$hchihyzh["us_QQ"].'<br />联系电话：'.$hchihyzh["us_mod"]?></td>
		<td><?php echo '支付宝姓名：'.$hchihyzh["us_zfbname"].'<br />帐号：'.$hchishoub["yy_szzhangh"]?></td>
		<td class="txt-r">￥<b class="red"><?php echo $hchishoub["yy_mody"]?></b></td>
		<td class="txt-r"><div style="height:40px;overflow:hidden;"><?php if($hchishoub["yy_zt"]==3){echo '<p style="color:#FF0000;">未收到款</p><p>&nbsp;</p>';}?><?php if($hchishoub["yy_zt"]==4){echo '<p style="color:#FF0000;">举报假支付</p><p>&nbsp;</p>';}?><em id="timer<?php echo $hchishoub["id"]?>"></em></div></td>
		<td class="txt-r"><?php if($hchishoub["yy_zt"]==1 and strtotime($hchishoub["yy_pipeisj"])+7200 > strtotime(date("Y-m-d H:i:s")) ){?><a href="?Aid=<?php echo $hchishoub["id"]?>&zhuf=yzhufu" onClick='return confirm("请确认已支付，若查实为假支付系统将会封号处理！");' style="color:#FFF;"><span id="reg-zhangtan" style="background-color:#20c200;padding:2px 5px 2px 5px;border-radius:4px;color:#fff">我已支付</span></a><?php }?></td>
		<td class="txt-r"></td>
	</tr>
<?php }}?>
		
		
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
	$sql1="select * from hchi_yuyan where yy_hyid='$user_id' and yy_finl='做单' and yy_ppcs<>0";
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
	$sql1="select * from hchi_yuyan where yy_hyid='$user_id' and yy_finl='做单' and yy_ppcs<>0 order by id desc limit $startno,$pagesize";
	$rs1=mysql_query($sql1);
	while($rows1=mysql_fetch_assoc($rs1))
	{
	$yyid12=$rows1["id"];
	$sqlshoub1="select * from hchi_yuyan where yy_peideiid='$yyid12'";
	$rsshoub1=mysql_query($sqlshoub1);
  while($hchishoub1=mysql_fetch_assoc($rsshoub1)){
	$sydateA=(strtotime($hchishoub1["yy_pipeisj"])+7200);
	$sydateB=(strtotime($hchishoub1["yy_pipeisj"])+50400);
	$sydateC=strtotime(date("Y-m-d H:i:s"));
?>
      addTimer("timer<?php echo $hchishoub1["id"]?>", <?php $sydate=$sydateB-$sydateC; if($sydate<=0){echo 0;}else{echo $sydate;}?>);
<?php }}?>
</script>

</html>