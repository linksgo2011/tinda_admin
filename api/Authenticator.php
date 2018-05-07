<?php

require_once ("../lib/php-jwt/JWT.php");
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
        return $uuid;
    }

    static function encode($userId){
        return JWT::encode(array(
            "uuid" => $userId,
            "exp" => time() + 60*60*24*15
        ),self::KEY);
    }
}