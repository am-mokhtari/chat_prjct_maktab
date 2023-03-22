<?php

namespace src\Controller;

use src\helper\Auth;
use src\helper\Session;
use src\Repository\DoctorRepository;

class DoctorController
{
    public function storeInfo(): void
    {
        $id = $_POST['userId'];

        $values = [
            "user_id" => $id,
            "medical_number" => $_POST['mdclNum'],
            "specialty_name" => $_POST['specialtyName'],
            "birthday" => $_POST['birthday'],
            "education" => $_POST['education'],
            "address" => $_POST['address'],
            "department_id" => $_POST['prtId'],
            "work_history" => $_POST['workHistory']
        ];

        if (DoctorRepository::find($id)){
            $res = DoctorRepository::updateInfo($values, $id);

            if ($res){
                Session::setFlash("success", "Information updated successfully.");
            }else{
                Session::setFlash("danger", "Failed to update information.");
            }

        }
        else{
            $res = DoctorRepository::store("doctors", $values);

            if ($res){
                Session::setFlash("success", "Information saved successfully.");
            }else{
                Session::setFlash("danger", "Failed to save information.");
            }
        }

        Auth::redirect("/panel");
    }

    public function storeTime()
    {
        $id = Session::getSession("auth_id");
        $day = $_POST['day'];

        $values = [
            "day" => $day,
            "start_time" => $_POST['startHour'] . ":" . $_POST['startMinutes'],
            "end_time" => $_POST['endHour'] . ":" . $_POST['endMinutes'],
            "user_id" => $id
        ];

        $existTime = DoctorRepository::findTime($id, $day);
        if ($existTime){
            $res = DoctorRepository::updateTime($values, $existTime->id);

            if ($res){
                Session::setFlash("success", "Time updated successfully.");
            }else{
                Session::setFlash("danger", "Failed to update time.");
            }

        }
        else{
            $res = DoctorRepository::store("time_table", $values);

            if ($res){
                Session::setFlash("success", "Time saved successfully.");
            }else{
                Session::setFlash("danger", "Failed to save time.");
            }
        }

        Auth::redirect("/panel");
    }

}