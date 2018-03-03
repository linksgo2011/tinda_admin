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
        <li><a href="#">项目设置</a></li>
    </ul>
</div>

<div class="formbody">
<?php

    if ($_POST["tjbx-abc"] == 'h-chi-vgs-8-com') {
        list($formToken,$id,$name,$days,$price) = array_values($_POST);

        if(!$id){
            $sql = "insert into 
            product(`name`,`days`,`price`) 
            VALUES(
              $name,$days,$price
            )";
        }else{
            $sql = "update product set 
            name='$name',
            days='$days',
            price='$price'
            where id='" . $id . "'";
        }

        if (mysql_query($sql)) {
            echo "<script language=javascript>alert('设置成功！');window.location='provisionSet.php'</script>";
        } else {
            echo "<script language=javascript>alert('编辑失败！');window.location='provisionSet.php'</script>";
        }

        die();
    }

    if($_GET['edit'] == 'del'){
        $id = $_GET['id'];
        mysql_query("delete from product where id=$id");
    }

    $listSql = "select * from product order by id";
    $productsResult = mysql_query($listSql);
?>

    <form action="provisionSet.php" method="post">
        <input name="tjbx-abc" type="hidden" id="tjbx-abc" value="h-chi-vgs-8-com"/>
        <input name="id" type="hidden" id="id" value=""/>

        <ul class="forminfo">
            <li>
                <label>项目名称</label>
                <input name="name" class="dfinput" required />
            </li>
            <li>
                <label>时间</label>
                <input name="days" type="number" min="1" required class="dfinput" />
            </li>
            <li>
                <label>金额</label>
                <input name="price" type="number" min="0" required class="dfinput" />
            </li>

            <li>
                <label>&nbsp;</label>
                <input type="submit" class="btn" value="提&nbsp;&nbsp;交"/>
            </li>
        </ul>
    </form>
    <table class="tablelist" style="width:300px;">
        <thead>
        <tr>
            <th>项目名称</th>
            <th>时间</th>
            <th>金额</th>
            <th>操作</th>
        </tr>
        </thead>

        <tbody>
    <?php while($product = mysql_fetch_assoc($productsResult)){?>
        <form name="edit" method="post" action="">
            <tr>
                <td>
                    <input name="tjbx-abc" type="hidden" value="h-chi-vgs-8-com" />
                    <input name="id" type="hidden"value="<?=$product["id"]?>">
                    <input name="name" class="dfinput" required value="<?=$product['name']?>"/>
                </td>
                <td>
                    <input name="days" type="number" min="1" required class="dfinput" value="<?=$product['days']?>"/>
                </td>
                <td>
                    <input name="price" type="number" min="1" required class="dfinput" value="<?=$product['price']?>"/>
                </td>
                <td style="text-align: center">
                    <input type="submit" value="修改" class="btn1">
                    <a href="?edit=del&id=<?php echo $product['id']?>">删除</a>
                </td>
            </tr>
        </form>
    <?php } ?>
        </tbody>
    </table>
</div>

</body>

</html>
