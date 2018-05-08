<?php

require_once ("BaseHandler.php");
require_once ("../lib/ToroPHP/Toro.php");
require_once ("Authenticator.php");
require_once ("../lib/Db.php");

class LoginHandler extends BaseHandler{

    public $requireAuthentication = false;

    function post() {

        $db = Db::getInstance();

        $username = $_POST['username'];
        $password = $_POST['password'];
        $token = $_POST['token'];

        $user = $db->get("feedbackinfo", [
            "id",
            "vip"
        ], [
            "title[=]" => $username,
            "pass[=]" => $password,
        ]);

        $permission = array();
        if($user['vip']){
            $permission = array(
                'zlcx',
                'passcx'
            );
        }

        if($user['id']){

            // update token
            $db->update("feedbackinfo",
                array('us_koner'=>$token),
                array("id[=]"=>$user['id'])
            );

            $token = Authenticator::encode($user['id']);
            $this->out(200,array(
                "token"=>$token,
                "permission"=>$permission
            ));

        }else{
            $this->out(401);
        }
    }
}