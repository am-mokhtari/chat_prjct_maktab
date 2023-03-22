<?php

namespace src\Controller;

use src\Application;
use src\helper\Auth;
use src\helper\Session;
use src\helper\Test;
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
                $reserves = $values["reserves"];
                Application::$app->router->renderView('doctorPanel', compact("info", "departments", "reserves"));
                break;

            case "admin":
                $users = $values["users"];
                $departments = $values["departments"];
                Application::$app->router->renderView('adminPanel', compact("users", "departments"));
                break;

            case "patient":
                $info = $values["info"];
                $reserves = $values["reserves"];
                Application::$app->router->renderView('userProfile', compact("info", "reserves"));
                break;

            default:
                Application::$app->router->renderView('404');
                break;
        }
    }

    /**
     * @throws \Exception
     */
    private function setValues($role): bool|array
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
            $dprId = UserRepository::findById($id, ["department_id"])->department_id;
            if (!is_null($dprId)){
                $info->department_id = $dprId;
            }

            $departments = DoctorRepository::getAll("departments");

            $reserves = DoctorRepository::getReserves($id);

            return [
                "info" => $info,
                "departments" => $departments,
                "reserves" => $reserves
            ];
        }

        if ($role === 'patient'){
            $info = UserRepository::find("users", ["full_name", "user_name", "role"]);
            $reserves = UserRepository::getReserves();

            return [
                "info" => $info,
                "reserves" => $reserves
            ];
        }

        return false;
    }
}

