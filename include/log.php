<?php

define("SEPARATOR"," | ");
define("BASE_FILE_NAME",__DIR__."/../log/log.txt");

file_put_contents(BASE_FILE_NAME,"\n".date("Y-m-d h:i:s").
    SEPARATOR.$_SERVER['PHP_SELF'].SEPARATOR.
    str_replace("\n","",json_encode($_POST) ),
    FILE_APPEND
);

// 转存日志文件
$currentDayFileName = __DIR__."/../log/".date("Y-m-d",time()-60*60*24)."_log.txt";

if(!file_exists($currentDayFileName)){
    file_put_contents($currentDayFileName,file_get_contents(BASE_FILE_NAME));
    file_put_contents(BASE_FILE_NAME,"");
}

