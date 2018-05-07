<?php

require_once ("BaseHandler.php");
require_once ("../lib/ToroPHP/Toro.php");
require_once ("Authenticator.php");

class MainHandler extends BaseHandler{

    public $requireAuthentication = true;

    function get() {
        $this->out(200);
    }
}