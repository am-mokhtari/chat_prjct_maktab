<?php

namespace src\Controller;

use src\Application;

class HomeController
{
    public function index(){
        return Application::$app->router->renderView('home');
    }
}