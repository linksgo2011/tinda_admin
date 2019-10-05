<?php

require_once(dirname(__FILE__)."/php-jwt/JWT.php");
require_once (dirname(__FILE__)."/Db.php");

use \Firebase\JWT\JWT as JWT;


class Authenticator {
    const KEY = "tinda_example_key";

    function validate(){
        try{
            $jwtObject = JWT::decode($_GET['token'],self::KEY,array('HS256'));
        }catch (Exception $e){
            return false;
        }
        $uuid = $jwtObject->uuid;
        $exp = $jwtObject->exp;
        if(time() > $exp){
            return false;
        }
        // 数据库有效性验证
        $db = Db::getInstance();

        $user = $db->get("feedbackinfo", [
            "id",
            "end_date",
            "vip"
        ], [
            "id[=]" => $uuid
        ]);
        if(strtotime($user['end_date']) <= time() && $user['vip'] == 0){
            return false;
        }
        return $uuid;
    }

    static function encode($userId){
        return JWT::encode(array(
            "uuid" => $userId,
            "exp" => time() + 60*60*24*15
        ),self::KEY);
    }
}
