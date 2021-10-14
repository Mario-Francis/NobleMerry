<?php

namespace App\Models;

use CodeIgniter\Model;

class BankModel extends BaseModel
{
    public function initialize()
    {
        $this->table = 'banks';
        $this->returnType = 'array';
        $this->allowedFields = [
            'code', 'name', 'created_by_id'
        ];
    }
}
