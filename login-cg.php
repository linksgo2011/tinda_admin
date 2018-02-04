<!doctype html>
<html>
<head>
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>腾达汽车资料查询云平台</title>
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/TouchSlide.1.1.js"></script>
    <base target="_self">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

<div id="nav-over"></div>

<div id="warmp" class="warmp">

    <header class="header">

        <section class="fix navbar">

            <a class="ico-home" href="index.php"><span>返回首页</span></a>

            <h1 id="title">您的注册资料</h1>

        </section>
    </header>


    <!---------------------------------------------->
    <div class="bg team">
        <!--------->
        <div class="tab-news-con">
            <table width="95%" border="0" align="center" cellpadding="2" cellspacing="2">
                <tr>
                    <td height="35" align="right">用户名：</td>
                    <td><?php echo $_GET["title"] ?></td>
                </tr>
                <tr>
                    <td height="35" align="right">经销商：</td>
                    <td><?php echo $_GET["name"] ?></td>
                </tr>
                <tr>
                    <td height="35" align="right">登记姓名：</td>
                    <td><?php echo $_GET["email"] ?></td>
                </tr>
                <tr>
                    <td height="35" align="right">ＱＱ号码：</td>
                    <td><?php echo $_GET["area"] ?></td>
                </tr>
                <tr>
                    <td height="35" align="right">地址：</td>
                    <td><?php echo $_GET["address"] ?></td>
                </tr>
                <tr>
                    <td height="35" align="right">电话：</td>
                    <td><?php echo $_GET["phome"] ?></td>
                </tr>
                <tr>
                    <td height="35" align="right">序列号：</td>
                    <td><?php echo $_GET["comment"] ?></td>
                </tr>
            </table>

        </div>
    </div>
    <!---------->

    <div class="copyright">

        <p>
            Copyright © 2016 腾达汽车资料查询云平台<br>
        </p>

    </div>

</div>

<footer class="footer">

    <menu class="footer-con">

        <ul class="fix">

            <li class="zx"><a href="finls.php">查询中心</a></li>

            <li class="tel"><a href="user-zl.php">用户资料</a></li>

            <li class="yy"><a href="user-pass.php">修改密码</a></li>

            <li class="yy"><a href="?exid=exit">退出系统</a></li>

        </ul>

    </menu>

</footer>
<script src="js/foot.js"></script>

</body>

</html>