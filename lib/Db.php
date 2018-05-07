<?php


require_once ("Medoo.php");
use \Medoo\Medoo;

class Db{
    static private $instance;

    static public function getInstance(){
        if (!self::$instance instanceof Medoo) {
            self::$instance = new Medoo([
                'database_type' => 'mysql',
                'database_name' => 'tinda',
                'server' => '127.0.0.1',
                'username' => 'root',
                'password' => 'chens0925CHENS7',

                'charset' => 'utf8'
            ]);
        }
        return self::$instance;
    }
}