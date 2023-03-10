<?php

namespace src\helper;

class Session
{
    public function __construct(){}

    public function checkLogin(): string | bool
    {
        return self::getSession('auth_id');
    }

    public static function setFlash(string $type , string $message){
        $_SESSION["flash_messages"][$type] = $message;
    }

    public static function setSession(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function getSession(string $key): string | bool
    {
        return $_SESSION[$key] ?? false;
    }

    public static function getFlash(): array | bool
    {
        return $_SESSION["flash_messages"] ?? false;
    }

    public static function deleteFlash()
    {
        unset($_SESSION["flash_messages"]);
    }

    public static function deleteSession(string $key)
    {
        unset($_SESSION[$key]);
    }

    public static function destroy(){
        session_destroy();
    }
}