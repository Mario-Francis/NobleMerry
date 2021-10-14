<?php

namespace App\Models;

use CodeIgniter\Model;

class PrivilegeModel extends BaseModel
{
    public function initialize()
    {
        $this->table = 'privileges';
        $this->returnType = 'array';
        // $this->allowedFields = [
        //     'name'
        // ];
    }
}
