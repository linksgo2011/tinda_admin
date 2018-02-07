<?php
require_once("../../include/global.php");
$ad_name1234 = $_SESSION["ad_name1234"];
$ad_id1234 = $_SESSION["ad_id1234"];

if ($_GET['tj'] == 'out') {
    session_destroy();
    echo "<script language=javascript>alert('退出成功！');window.top.location.href='index.php'</script>";
}
$sql = "select * from hchi_admin where ad_name='" . $ad_name1234 . "' and id='" . $ad_id1234 . "'";
$rs = mysql_query($sql);
if (mysql_num_rows($rs) <> 1) {
    session_destroy();
    echo "<script language=javascript>alert('未登录或登录超时！请返回，重新登录，谢谢!');window.top.location.href='index.php'</script>";
    die();
}

$Aid = $ad_id1234;
$sql1 = "select * from hchi_pscxsz";
$rs1 = mysql_query($sql1);
$rows1 = mysql_fetch_assoc($rs1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <link href="../css/style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript">

        /**
         * 实时动态强制更改用户录入
         * arg1 inputObject
         **/
        function amount(th) {
            var regStrs = [
                ['^0(\\d+)$', '$1'], //禁止录入整数部分两位以上，但首位为0
                ['[^\\d\\.]+$', ''], //禁止录入任何非数字和点
                ['\\.(\\d?)\\.+', '.$1'], //禁止录入两个以上的点
                ['^(\\d+\\.\\d{3}).+', '$1'] //禁止录入小数点后两位以上
            ];
            for (i = 0; i < regStrs.length; i++) {
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
        <li><a href="#">PIN码查询设置</a></li>
    </ul>
</div>

<div class="formbody">
    <?php

    if ($_POST["tjbx-abc"] == 'h-chi-vgs-8-com') {
        $Aid = $_POST["id"];
        $pz_shul = $_POST["pz_shul"];
        $pz_off = $_POST["pz_off"];
        $closed_tip = $_POST['closed_tip'];

        $sql1 = "update hchi_pscxsz set pz_shul='$pz_shul',pz_off='$pz_off',closed_tip='$closed_tip' where id='" . $Aid . "'";
        if (mysql_query($sql1)) {
            echo "<script language=javascript>alert('设置成功！');window.location='chasetup.php'</script>";
        } else {
            echo "<script language=javascript>alert('编辑失败！');window.location='chasetup.php'</script>";
        }
        die();
    }
    ?>


    <form id="automateRule" name="automateRule" action="chasetup.php" method="post">
        <input name="tjbx-abc" type="hidden" id="tjbx-abc" value="h-chi-vgs-8-com"/>
        <input name="id" type="hidden" id="id" value="<?php echo $rows1["id"] ?>"/>
        <ul class="forminfo">
            <li>
                <label>查询每天</label><input name="pz_shul" type="text" class="dfinput" id="pz_shul"
                                          value="<?php echo $rows1["pz_shul"] ?>" style="width:80px;"/>&nbsp;次
            </li>
            <li>
                <label>密码</label>
                <select name="pz_off" id="pz_off" class="dfinput" style="width:80px;">
                    <option value="1" <?php if ($rows1["pz_off"] == 1) {
                        echo 'selected="selected"';
                    } ?>>开启
                    </option>
                    <option value="2" <?php if ($rows1["pz_off"] == 2) {
                        echo 'selected="selected"';
                    } ?>>关闭
                    </option>
                </select>
            </li>
            <li>
                <label>关闭后提示语</label>
                <textarea name="closed_tip" type="text" class="dfinput"
                          style="width:80px;"><?php echo $rows1["closed_tip"] ?></textarea>
            </li>
            <li><label>&nbsp;</label><input type="submit" class="btn" value="提&nbsp;&nbsp;交"/>
            </li>
        </ul>
    </form>

</div>

</body>

</html>
