<?php

namespace src\Repository;

use src\database\QueryBuilder;
use src\Repository\Contracts\RepositoryInterface;

class MySqlUserRepository implements RepositoryInterface {

    public function get() {

    }

    public function add(array $values , string $table){
        return QueryBuilder::table("$table")
            ->create($values);
    }


    public function find(int $id) {

    }

    public function findByUserName(string $userName) {

        return QueryBuilder::table('users')
            ->select()
            ->where('user_name', $userName)
            ->first();
    }

}