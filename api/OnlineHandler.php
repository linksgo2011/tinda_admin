<?php

require_once ("BaseHandler.php");
require_once ("../lib/ToroPHP/Toro.php");
require_once("../lib/Authenticator.php");

class OnlineHandler extends BaseHandler{

    public $requireAuthentication = true;

    /**
     * @api {post} /api/v1/online
     * @apiName check user is online
     * @apiGroup User
     *
     * @apiParam {String} token client token
     *
     * @apiSuccess {Json} {"status":200,"data":[],"message":""}
     * @apiSuccess {Json} {"status":401,"data":null,"message":"Client token is not same!"}
     */
    function post() {
        $uuid = $this->uuid;
        $token = $_POST['token'];

        $db = Db::getInstance();

        $user = $db->get("feedbackinfo", [
            "id",
            "us_koner",
            "end_date",
            "vip"
        ], [
            "id[=]" => $uuid
        ]);

        if(strtotime($user['end_date']) <= time() && $user['vip'] != 0){
            $db->update("feedbackinfo",
                array('vip'=> 0,'us_koner'=>''),
                array("id[=]"=>$user['id'])
            );
        }

        if(strtotime($user['end_date']) > time() && $user['vip'] != 1){
            $db->update("feedbackinfo",
                array('vip'=> 1,'us_koner'=>''),
                array("id[=]"=>$user['id'])
            );
        }

        if($user["us_koner"] != $token){
            $this->out(401,null,"Client token is not same!");
        }else{
            $this->out(200);
        }
    }
}