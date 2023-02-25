<?php

namespace src\helper;

class Session
{
    public function __construct(){}

    public function setFlash($key , $message){
        $_SESSION["flash_messages"][$key] = [
//            'remove' => false,
            'value' => $message
        ];
    }

    public function setSession($key, $value)
    {
        $_SESSION["$key"] = $value;
    }

    public function checkLogin()
    {
        return isset($_SESSION['auth_id']);
    }

    public static function destroy(){
        session_destroy();
    }
}