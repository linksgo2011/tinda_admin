<?php

require_once("Authenticator.php");

class BaseHandler {

    public $requireAuthentication = true;
    public $uuid = null;

    function __construct() {
        ToroHook::add("before_handler", function() {
            $authenticator = new Authenticator();
            if(!$this->requireAuthentication){
                return;
            }
            $uuid = $authenticator->validate();
            $this->uuid = $uuid;
            if(!$uuid){
                $this->out(403);
            }
        });
    }

    const OK = 200;
    const INTERNAL_SERVER_ERROR = 500;

    public function out($status,$data = array(),$message = ""){
        echo json_encode(array(
            "status"=>$status,
            "data"=>$data,
            "message"=>$message
        ));
        exit;
    }
}