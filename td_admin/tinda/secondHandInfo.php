<?php
require_once("../../include/admin.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <link href="../css/style.css" rel="stylesheet" type="text/css"/>
</head>

<body>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="../default.php">首页</a></li>
        <li><a href="#">二手信息</a></li>
    </ul>
</div>

<div class="formbody">
    <form name="" method="GET">
        <label></label>
        <input name="usname" type="text" value="<?php echo $_GET['title']?>" class="dfinput" placeholder="标题" size="60">
        <input type="submit" class="btn" value="查找"/>
    </form>
    <br>
    <table class="tablelist">
        <thead>
        <tr>
            <th>用户</th>
            <th>金额</th>
            <th>标题</th>
            <th>电话</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $title = $_GET['usname'];
        $usname = $title;

        $sql = "
        select `feedbackinfo`.title as username,`info_product`.* 
from `order`,`info_product` 
where `status`='1' and `order`.user_id=`feedbackinfo`.id 
and `info_product`.title like '%$title%'
order by created desc
        ";
        $rs = mysql_query($sql);
        $pagesize=20;
        $pageno=$_GET["pageno"];

        $recordcount=mysql_num_rows($rs);
        $pagecount=($recordcount-1)/$pagesize+1;

        if(empty($pageno) || $pageno <1)
        {
            $pageno=1;
        }
        if($pageno>$pagecount)
        {
            $pageno=$pagecount;
        }
        $startno=($pageno-1)*$pagesize;

        $sql .= "limit $startno,$pagesize";
        $rs = mysql_query($sql);

        while ($product = mysql_fetch_assoc($rs)) {
            extract($product);

            echo "<tr>
                <td>$username</td>
                <td>$price</td>
                <td>$phone</td>
                <td>$created_at</td>
                <td></td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
    <div class="pagin">
        <?php require_once("../page.php");?>
    </div>
</div>

</body>

</html>
