<?php
	session_start();

//    ini_set("display_errors", "On");
//    error_reporting(E_ALL^E_NOTICE^E_WARNING^E_DEPRECATED);
    error_reporting(0);
	header("content-type:text/html; charset=utf8");
	define('XXCMS_ROOT', str_replace("\\", '/', substr(dirname(__FILE__), 0, -7)));
	$http_ref=isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
	set_include_path(XXCMS_ROOT.'lib/');
    date_default_timezone_set('PRC');

    require_once(XXCMS_ROOT."include/config.php");
	require_once(XXCMS_ROOT."include/sql-zl.php");
	require_once("Mysql.Class.php");

    // require_once(XXCMS_ROOT."include/log.php"); stop this temporarily due to the performance issue

	//ʵ�����ݿ����
	$db=new mysql($mydbhost,$mydbuser,$mydbpw,$mydbname,$conn,$mydbcharset);

?>