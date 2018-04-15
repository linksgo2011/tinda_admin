    	<div class="message">共<i class="blue">&nbsp;<?php echo $recordcount?>&nbsp;</i>条记录，当前显示第&nbsp;<i class="blue"><?php echo $pageno?>&nbsp;</i>页</div>
        <ul class="paginList">
        <?php if($_GET["pageno"]==""){$pageALL=1;}else{$pageALL=$_GET["pageno"];}?>
        <li class="paginItem"><?php if($pageALL>1){?><a href="?pageno=<?php echo $pageALL-1?>&tjrfl=<?php echo $tjrfl?>&usname=<?php echo $usname?>&usmod=<?php echo $usmod?>&zfbname=<?php echo $zfbname?>"><span class="pagepre"></span></a><?php }else{?><a><span class="pagepre1"></span></a><?php }?></li>

<?php 
if($pagecount<=9)//=>5P
{
    for($i = 1;$i <= $pagecount; $i++) {
 		 if($pageno==$i)
		 {
         echo "<li class='paginItem current'><a>$i</a></li>";
		 }else{
         echo "<li class='paginItem'><a href='?pageno=$i&tjrfl=$tjrfl&usname=$usname&usmod=$usmod&zfbname=$zfbname'>$i</a></li>";
		 }
     }
}
if($pagecount>9)//<5P
{
	if($pageno>9){
	echo "<li class='paginItem more'><a>...</a>";
	}	
  if(($pageALL-4)>0){	
    $i1=$pageALL-4;
  }else{
    $i1=1;
  }
	if(($pageALL+4)<$pagecount)
	{$i2=$pageALL+4;}else
	{$i2=$pagecount;}
    for($i = $i1;$i <= $i2; $i++) {
 		 if($pageno==$i)
		 {
         echo "<li class='paginItem current'><a>$i</a></li>";
		 }else{
         echo "<li class='paginItem'><a href='?pageno=$i&tjrfl=$tjrfl&usname=$usname&usmod=$usmod&zfbname=$zfbname&sousuo=$sousuo'>$i</a></li>";
		 }
     }
	echo "<li class='paginItem more'><a>...</a>";
}
?>

        <li class="paginItem"><?php if($pageALL<>$pagecount and $pagecount>1){?><a href="?pageno=<?php echo $pageALL+1?>&tjrfl=<?php echo $tjrfl?>&usname=<?php echo $usname?>&usmod=<?php echo $usmod?>&zfbname=<?php echo $zfbname?>&sousuo=<?php echo $sousuo?>"><span class="pagenxt"></span></a><?php }else{?><a><span class="pagenxt1"></span></a><?php }?></li>
     </ul>    <br />  
