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
            $res = $res->whereIn('specialty_name', $specialty);
        }

        return $res->get();
    }

    public static function getDetails($id)
    {
        return QueryBuilder::table("doctors")->select()->where("user_id", "$id")->first();
    }

    public static function getTime($id)
    {
        return QueryBuilder::table("time_table")->select()->where("user_id", "$id")->get();
    }

    public static function store(array $values): bool|string
    {
        $check = QueryBuilder::table("users_times")->select()
            ->where("user_id", $values['user_id'])
            ->where("time_id", $values['time_id'])
            ->first();

        if ($check){
            return "exists";
        }
        return QueryBuilder::table("users_times")->create($values);
    }

    public static function delete(array $values)
    {
        $check = QueryBuilder::table("users_times")->select()
            ->where("user_id", $values['user_id'])
            ->where("time_id", $values['time_id'])
            ->first();

        if (!$check){
            return "not exists";
        }
        return QueryBuilder::table("users_times")
            ->where("user_id", $values['user_id'])
            ->where("time_id", $values['time_id'])
            ->delete();
    }
}