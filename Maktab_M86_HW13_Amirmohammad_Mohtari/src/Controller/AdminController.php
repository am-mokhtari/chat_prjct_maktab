<?php

namespace src\Controller;

use src\Application;
use src\helper\Auth;
use src\helper\Session;
use src\Repository\AdminRepository;

class AdminController
{
    public function changeStatus(): void
    {
        $userId = $_POST['userId'];
        $status = $_POST['status'];

        if (AdminRepository::changeStatus($userId, $status)) {
            Session::setFlash("success", "User access changed.");
        } else {
            Session::setFlash("danger", "Failed to change user access.");
        }

        Auth::redirect("/panel");
    }

    public function indexUpdate(): void
    {
        $id = $_POST['prtId'];
        $partInfo = AdminRepository::find($id);
        Application::$app->router->renderView('update', ['prt' => $partInfo]);
    }

    public function update(): void
    {
        $id = $_POST['prtId'];
        $values = [
            "department_code" => $_POST['prtCode'],
            "title" => $_POST['prtName']
        ];

        $res = AdminRepository::update($values, $id);

        if ($res) {
            Session::setFlash("success", "Operation is successful.");
        } else {
            Session::setFlash("danger", "The information did not change.");
        }

        Auth::redirect("/panel");
    }

    public function delete(): void
    {
        $id = $_POST['prtId'];
        $res = AdminRepository::delete($id);

        if ($res) {
            Session::setFlash("success", "Department is deleted.");
        } else {
            Session::setFlash("danger", "Failed to delete department.");
        }

        Auth::redirect("/panel");
    }

    public function addPrt(): void
    {
        $values = [
            "department_code" => $_POST['prtCode'],
            "title" => $_POST['prtName']
        ];

        $res = AdminRepository::creat($values);

        if ($res) {
            Session::setFlash("success", "Department is deleted.");
        } else {
            Session::setFlash("danger", "Failed to delete department.");
        }

        Auth::redirect("/panel");
    }
}