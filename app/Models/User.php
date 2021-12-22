<?php

namespace App\Models;

use CodeIgniter\Model;


class User extends Model
{

    protected $table = 'tbl_users';

    protected $allowedFields = [
        # 'user_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'gender',
        'role'
    ];

    public function getUsers(/* $id = false, */int $role = null)
    {
        // if ($id === false) {
        // }

        if ($role === null || $role == 0) {
            return $this->select('user_id, first_name, last_name, email')->findAll();
        }

        return $this->select('user_id, first_name, last_name, email')
            ->where(['role' => $role])
            ->get()->getResultArray();


        // return $this->asArray()
        //     ->where(['user_id' => $id])
        //     ->first();
    }

    public function createUser(array $newUser)
    {

        if ($this->insert($newUser, true) == true)
            return $this->getInsertID();
        else
            return false;
    }

    public function deleteUser(int $id)
    {

        if ($this->delete(['user_id' => $id]) == true)
            return true;
        else
            return false;
    }
}
