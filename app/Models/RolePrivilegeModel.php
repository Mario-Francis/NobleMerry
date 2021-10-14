<?php

namespace App\Models;

use CodeIgniter\Model;

class RolePrivilegeModel extends BaseModel
{
    public function initialize()
    {
        $this->table = 'role_privileges';
        $this->returnType = 'array';
        $this->allowedFields = [
            'role_id', 'privilege_id', 'created_by_id'
        ];
    }
}
