<?php

namespace src\Repository;

use src\database\QueryBuilder;

class DoctorRepository
{
    public static function find($id)
    {
        return QueryBuilder::table("doctors")->select()->where('user_id', $id)->first();
    }

    public static function findTime($id , string $day)
    {
        return QueryBuilder::table("doctor_time_table")->select()->where('doctor_id', $id)
            ->where('day', $day)->first();
    }


    public static function getAll(string $table, array $options = ['*'])
    {
        return QueryBuilder::table($table)->select($options)->get();
    }


    public static function store(string $table, array $values)
    {
        return QueryBuilder::table($table)->create($values);
    }


    public static function updateInfo(array $values, $id)
    {
        return QueryBuilder::table("doctors")->where("user_id", $id)->update($values);
    }

    public static function updateTime(array $values, $id)
    {
        return QueryBuilder::table("doctor_time_table")->where("id", $id)->update($values);
    }
}