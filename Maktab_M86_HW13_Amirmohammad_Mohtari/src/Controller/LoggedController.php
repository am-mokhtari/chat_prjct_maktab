<?php

namespace src\Controller;

use src\Application;

class LoggedController
{
    public function logout(){
        Session::destroy();
        header('Location: login');
        exit();
    }

    public function checkLoggedIn()
    {
        if(!isset($_SESSION['auth_id'])){
            header("Location: login");
            exit();
        }
    }

//    public function checkAccess()
//    {
//
//    }
}