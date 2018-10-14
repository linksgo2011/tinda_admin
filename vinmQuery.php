<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://45.114.124.205:520/?type=524&vinm=".$_GET['vinm']."&CarType=30&sqm=12345678");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);

$html = curl_exec($ch);
$html=mb_convert_encoding($html, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');

curl_close($ch);

echo $html;