<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends BaseModel
{
    public function initialize()
    {
        $this->table = 'roles';
        $this->returnType = 'array';
        $this->allowedFields = [
            'name', 'created_by_id', 'updated_by_id'
        ];
    }
}
