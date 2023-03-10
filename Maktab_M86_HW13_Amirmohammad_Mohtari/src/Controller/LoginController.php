<?php

namespace src\Controller;

use src\Application;
use src\helper\Session;
use src\helper\Auth;
use src\Repository\UserRepository;

class LoginController
{

    public function __construct(){}

    public function index(){
        if (Session::getSession("auth_id")){
            Auth::redirect('home');
        }
        return Application::$app->router->renderView('login');
    }

    public function store(){
        $userName = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

        $user = UserRepository::findByUserName($userName);

        if($user->password !== $password || empty($user)){
            Session::setFlash("danger", "username or password is wrong!");

            Auth::redirect('login');
        }

        if (!($user->register_status)){
            Session::setFlash("warning", "Your account has not been verified yet.");

            Auth::redirect('login');
        }
        Session::setSession("auth_id", $user->id);
        Session::setSession("auth_role", $user->role);

        Auth::redirect('home');
    }

}