<?php

namespace src\Controller;

use src\Application;
use src\helper\Auth;
use src\helper\Session;
use src\Repository\UserRepository;

class RegisterController
{

    public function __construct()
    {
    }

    public function index()
    {
        if (Session::getSession("auth_id")){
            Auth::redirect('home');
        }
        return Application::$app->router->renderView('register');
    }

    public function store()
    {
        $user = array(
            'full_name' => $_POST['name'],
            'user_name' => $_POST['username'],
            'password' => $_POST['password'],
            'role' => $_POST["role"]
        );
        if($_POST['role'] === 'patient'){
            $user['register_status' ] = 1;
        }
//     Session::setFlash("invalid_date", "value of role is invalid");

        UserRepository::add($user, "users");


        Session::setFlash("success", "Your are registered successfully!");
        return Auth::redirect(' login');
    }
}