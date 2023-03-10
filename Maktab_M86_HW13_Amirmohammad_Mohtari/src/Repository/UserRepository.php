<?php

namespace src\Repository;

use src\database\QueryBuilder;
use src\helper\Session;

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

}