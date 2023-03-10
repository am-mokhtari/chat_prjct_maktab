<?php

namespace src\Repository;

use src\database\QueryBuilder;
use src\helper\Session;
use src\helper\Test;

class AdminRepository
{
    public static function creat(array $values)
    {
        return QueryBuilder::table("departments")->create($values);
    }


    public static function find($id)
    {
        return QueryBuilder::table("departments")->select()->where('id', $id)->first();
    }


    public static function changeStatus($user_id, $status)
    {
        $status = (!$status);
        $value = ["register_status" => $status];
        return QueryBuilder::table('users')->where('id', $user_id)->update($value);
    }


    public static function update(array $values, $id): bool
    {
        return QueryBuilder::table("departments")->where('id', $id)->update($values);
    }


    public static function delete($id)
    {
        return QueryBuilder::table("departments")->where("id", $id)->delete();
    }
}