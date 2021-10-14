<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends BaseModel
{
    public function initialize()
    {
        $this->table = 'users';
        $this->returnType = 'array';
        $this->allowedFields = [
            'role_id', 'first_name', 'last_name', 'other_name',
            'gender', 'email', 'password', 'phone_number', 'email_verification_token',
            'password_recovery_token', 'is_active', 'created_by_id', 'updated_by_id'
        ];
    }

    public function add($user){
        $user['password'] = password_hash($user['password'], PASSWORD_BCRYPT);
        $id = $this->insert($user);

        return $id;
    }

    public function find_via_login_credentials($email, $pswd)
    {
        $user = $this->where('email', $email)->first();
        if (!password_verify($pswd, $user['password'])) {
            return null;
        } else {
            return $user;
        }
    }
}
