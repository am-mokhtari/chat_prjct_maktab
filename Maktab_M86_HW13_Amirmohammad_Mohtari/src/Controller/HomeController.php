<?php

namespace src\Controller;

use src\Application;
use src\helper\Auth;
use src\helper\Session;
use src\helper\Test;
use src\Repository\HomeRepository;

class HomeController
{
    public function index()
    {
        $specialtyList = HomeRepository::getSpecialtyList();
        $name = $_GET['name'] ?? '';
        $specialty = $_GET['specialty'] ?? [];
        $doctorsList = \src\Repository\HomeRepository::getDoctorsList($name, $specialty);

        Application::$app->router->renderView('home', compact("specialtyList", "doctorsList"));
    }

    public function contact()
    {
        Application::$app->router->renderView('contactUs');
    }

    public function show()
    {
        $id = $_GET['id'];
        $name = $_GET['doctorName'];
        $info = HomeRepository::getDetails($id);
        $time = HomeRepository::getTime($id);
        Application::$app->router->renderView('showDoctor', compact('name', 'info', 'time'));
    }
}