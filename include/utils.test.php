<?php

require __DIR__."/../test/test.php";
require_once("utils.php");
require_once("global.php");

// test log error method
logError("test");
assertTrue(file_exists(__DIR__."/../log/error.txt"));

// test user vip
setUserToVIP(36);