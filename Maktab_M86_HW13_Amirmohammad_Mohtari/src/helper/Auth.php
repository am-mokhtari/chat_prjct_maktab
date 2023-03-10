<?php

namespace src\helper;

use JetBrains\PhpStorm\NoReturn;
use src\helper\Session;
use src\Request;

class Auth
{

//    public static function checkLogin(): void
//    {
//        if (Session::getSession("auth_id")) {
//            self::redirect("home");
//        }
//        else{
//            self::redirect('login');
//        }
//    }

    public static function logout(): void
    {
        Session::destroy();
        self::redirect('login');
    }

    public static function redirect(string $path) : void
    {
        header("Location: $path");
        exit();
    }

//    public static function checkAccess()
//    {
//        $path = trim(Request::getPath(), '\\');
//
//        if (Session::getSession("auth_role") !== $path){
//            Session::setFlash("warning", "You dont have accessibility.");
//            self::redirect("home");
//        }
//    }
}