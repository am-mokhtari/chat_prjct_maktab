<?php

namespace src\Repository;

use src\database\QueryBuilder;
use src\helper\Session;
use src\helper\Test;

class UserRepository{

    public static function getAll(string $table, array $options = ['*']) {
        return QueryBuilder::table($table)->select($options)
            ->get();
    }

    public static function add(array $values , string $table){
        return QueryBuilder::table($table)
            ->create($values);
    }

    public static function find(string $table , array $options = ['*']) {
        return QueryBuilder::table($table)->select($options)
            ->where('id', Session::getSession("auth_id"))->first();
    }

    public static function findByUserName(string $userName) {
        return QueryBuilder::table('users')
            ->select()
            ->where('user_name', $userName)
            ->first();
    }

    public static function findById(int $id, array $options = ['*'])
    {
        return QueryBuilder::table('users')
            ->select($options)
            ->where("id", $id)
            ->first();
    }


    public static function getReserves()
    {
        $reservesInfo = QueryBuilder::table("users_times")
            ->select()
            ->where("user_id", Session::getSession("auth_id"))
            ->get();

        $timeIds = array_column($reservesInfo, "time_id");

        return QueryBuilder::table("time_table")
            ->select(["time_table.*", "users.full_name", "doctors.specialty_name"])
            ->join("users", "user_id", "id")
            ->join("doctors", "user_id", "user_id")
            ->whereIn("time_table.id", $timeIds)
            ->get();
    }
    
}