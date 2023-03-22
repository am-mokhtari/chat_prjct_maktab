<?php

namespace src\Controller;

use Cassandra\Date;
use src\Application;
use src\helper\Auth;
use src\helper\Session;
use src\helper\Test;
use src\Repository\HomeRepository;
use src\Repository\UserRepository;
use src\Request;

class HomeController
{
    public function index(): void
    {
        $specialtyList = HomeRepository::getSpecialtyList();

        $name = $_GET['name'] ?? '';
        $specialty = $_GET['specialty'] ?? [];
        $doctorsList = HomeRepository::getDoctorsList($name, $specialty);

        Application::$app->router->renderView('home', compact("specialtyList", "doctorsList"));
    }

    public function contact(): void
    {
        Application::$app->router->renderView('contactUs');
    }

    public function show(): void
    {
        $id = $_GET['id'];
        $name = $_GET['doctorName'];
        $info = HomeRepository::getDetails($id);
        $info->department_id = UserRepository::findById($id, ["department_id"])->department_id;
        $times = HomeRepository::getTime($id);

        Application::$app->router->renderView('showDoctor', compact('name', 'info', 'times'));
    }

    public function store(): void
    {
        $path = Request::getReferer();

        if (Session::getSession("auth_id")) {
            $values = [
                "time_id" => $_POST["timeId"],
                "user_id" => Session::getSession("auth_id")
            ];

            $res = HomeRepository::store($values);

            if ($res === true) {
                Session::setFlash("success", "You're reserved a time successfully.");
            } elseif (is_string($res)) {
                Session::setFlash("info", "You have already reserved this time.");
            } else {
                Session::setFlash("danger", "Failed to reserve time.");
            }
        } else{
            Session::setFlash("warning", "please login for reserve.");
        }
        Auth::redirect($path);
    }

    public function delete()
    {
        $path = Request::getReferer();

        $values = [
            "time_id" => $_POST["timeId"],
            "user_id" => Session::getSession("auth_id")
        ];

        $res = HomeRepository::delete($values);

        if ($res === true) {
            Session::setFlash("success", "The reserved time is deleted successfully.");
        } elseif (is_string($res)) {
            Session::setFlash("warning", "You haven't the reserved time.");
        } else {
            Session::setFlash("danger", "Failed to delete the reserved time.");
        }

        Auth::redirect($path);
    }
}