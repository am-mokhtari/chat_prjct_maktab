<?php

namespace src\Repository;

use src\database\QueryBuilder;
use src\helper\Test;

class DoctorRepository
{
    public static function find($id)
    {
        return QueryBuilder::table("doctors")->select()->where('user_id', $id)->first();
    }

    public static function findTime($id , string $day)
    {
        return QueryBuilder::table("time_table")->select()->where('user_id', $id)
            ->where('day', $day)->first();
    }


    public static function getAll(string $table, array $options = ['*']): bool|array
    {
        return QueryBuilder::table($table)->select($options)->get();
    }

    /**
     * @throws \Exception
     */
    public static function getReserves(int $id): bool|array
    {
        return QueryBuilder::table("users_times")
            ->select(["time_table.*", "users.full_name"])
            ->join("time_table", "time_id", "id")
            ->join("users", "user_id", "id")
            ->where("time_table.user_id", $id, "ttui")
            ->orderedBy("day")
            ->get();
    }

    public static function store(string $table, array $values): bool
    {
        QueryBuilder::table("users")->where("id", $values["user_id"])
            ->update(["department_id" => $values["department_id"]]);
        unset($values["department_id"]);
        return QueryBuilder::table($table)->create($values);
    }


    public static function updateInfo(array $values, $id)
    {
        QueryBuilder::table("users")->where("id", $id)
            ->update(["department_id" => $values["department_id"]]);
        unset($values["department_id"]);
        return QueryBuilder::table("doctors")->where("user_id", $id)->update($values);
    }

    public static function updateTime(array $values, $id)
    {
        return QueryBuilder::table("time_table")->where("id", $id)->update($values);
    }
}