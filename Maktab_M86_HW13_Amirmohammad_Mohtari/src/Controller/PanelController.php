<?php

namespace src\Controller;

use src\Application;
use src\helper\Auth;
use src\helper\Session;
use src\Repository\DoctorRepository;
use src\Repository\UserRepository;

class PanelController
{
    public function index(): void
    {
        $role = Session::getSession("auth_role");
        $values = $this->setValues($role);
        switch ($role) {
            case "doctor":
                $info = $values["info"];
                $departments = $values["departments"];

                Application::$app->router->renderView('doctorPanel', compact("info", "departments"));
                break;
            case "admin":
                $users = $values["users"];
                $departments = $values["departments"];
                Application::$app->router->renderView('adminPanel', compact("users", "departments"));
                break;
            default:
                Application::$app->router->renderView('404');
                break;
        }
    }

    private function setValues($role)
    {
        if ($role === 'admin') {
            return [
                "users" => UserRepository::getAll('users'),
                "departments" => UserRepository::getAll('departments')
            ];
        }

        if ($role === 'doctor') {
            $id = Session::getSession("auth_id");
            $info = DoctorRepository::find($id);

            $departments = DoctorRepository::getAll("departments");

            return [
                "info" => $info,
                "departments" => $departments
            ];
        }

        return false;
    }
}

