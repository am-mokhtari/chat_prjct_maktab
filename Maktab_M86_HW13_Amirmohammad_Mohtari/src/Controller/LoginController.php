<?php

namespace src\Controller;

use src\Application;
use src\helper\Session;
use src\Repository\MySqlUserRepository;

class LoginController
{
    private MySqlUserRepository $userRepository;
    private Session $session;

    public function __construct()
    {
        $this->userRepository = new MySqlUserRepository();
    }

    public function index(){
        return Application::$app->router->renderView('login');
    }

    public function store(){
        $userName = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

        $user = $this->userRepository->findByUserName($userName);

        if($user->password != $password || empty($user)){
            (new Session)->setFlash("loginError", "username or password is wrong!");

            header('Location: login');
            exit();
        }

        (new Session)->setSession("auth_id", $user->id);
        (new Session)->setSession("authName", $user->full_name);

         header('Location: home');
        exit();
    }

    public function logout(){
        Session::destroy();
        header('Location: login');
        exit();
    }

}