<?php

error_reporting(E_ERROR);
ini_set("display_errors","On");

require_once ("../lib/ToroPHP/Toro.php");
require_once ("LoginHandler.php");
require_once("OnlineHandler.php");

Toro::serve(array(
    "/v1/online" => "OnlineHandler",
    "/v1/login" => "LoginHandler"
));