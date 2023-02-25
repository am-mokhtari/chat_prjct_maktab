<?php

namespace src\Controller;

use src\Application;
use src\helper\Session;
use src\Repository\MySqlUserRepository;

class RegisterController
{
    private MySqlUserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new MySqlUserRepository();
    }

    public function index(){

        return Application::$app->router->renderView('register' );
    }

    public function store(){
        $user = array(
            'full_name' => $_POST['name'],
            'user_name' => $_POST['username'],
            'password' => $_POST['password']
        );

        switch ($_POST['role']){
            case 'patient':
                $tableName = 'patients';
                break;
            case  'doctor':
                $tableName = 'doctors';
                break;
            case 'admin':
                $tableName = 'admins';
                break;
            default:
                (new Session)->setFlash("invalid_date", "value of role is invalid");
                break;
        }
        $this->userRepository->add($user , "$tableName");


        return header('Location: login');
    }
}