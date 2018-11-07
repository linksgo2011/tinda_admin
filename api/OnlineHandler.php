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
            "us_koner"
        ], [
            "id[=]" => $uuid
        ]);

        if($user["us_koner"] != $token){
            $this->out(401,null,"Client token is not same!");
        }else{
            $this->out(200);
        }
    }
}