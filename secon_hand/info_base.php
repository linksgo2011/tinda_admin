<?php

/**
 * 二手信息模块公共部分
 */

error_reporting(E_ERROR);
ini_set("display_errors", "On");
define("ACCESSIBLE", true);
session_start();

require_once("../lib/Authenticator.php");
$authenticator = new Authenticator();
$templateDir = "./templates";

/**
 * 包裹地址上存在的参数
 * @param $path
 */
function wrapQueryParameters($appendParameters = array(), $path = "?")
{
    if (strchr($path, "?")) {
        return $path . '&' . http_build_query(array_merge($_GET, $appendParameters));
    } else {
        return $path . '?' . http_build_query(array_merge($_GET, $appendParameters));
    }
}


$userId = $_SESSION['user_id'];
if(!$userId){
    $userId=  $authenticator->validate();
    if (!$userId) {
        echo "用户失效，请重新登录！";
        exit;
    }
    $_SESSION['user_id'] = $userId;
}


