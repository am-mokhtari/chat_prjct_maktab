<?php

namespace src\Repository;

use src\database\QueryBuilder;
use src\helper\Test;

class HomeRepository
{
    public static function getSpecialtyList()
    {
        return QueryBuilder::table("doctors")->select(["specialty_name"])->get();
    }

    public static function getDoctorsList(string $name, array $specialty)
    {
        $res = QueryBuilder::table("doctors")->select(["users.id", "full_name", "specialty_name"])
            ->join('users', 'user_id', 'id')->where("role", "doctor");

        if (!empty($name)) {
            $res = $res->like("full_name", $name);
        }
        if (!empty($specialty)) {
            $res = $res->where('specialty_name', "$specialty[0]");
            unset($specialty[0]);
        }
        if (!empty($specialty)) {
            $counter = 1;
            foreach ($specialty as $value) {
                $res = $res->orWhere("specialty_name", $value, $counter);
                $counter++;
            }
        }
        return $res->get();
    }

    public static function getDetails($id)
    {
        return QueryBuilder::table("doctors")->select()->where("user_id", "$id")->first();
    }

    public static function getTime($id)
    {
        return QueryBuilder::table("doctor_time_table")->select()->where("doctor_id", "$id")->first();
    }
}