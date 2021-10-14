<?php

namespace App\Models;

use CodeIgniter\Model;

class FeeModel extends BaseModel
{
    public function initialize()
    {
        $this->table = 'fees';
        $this->returnType = 'array';
        $this->allowedFields = [
            'code', 'name', 'is_fine', 'is_mandatory',
            'amount', 'created_by_id', 'updated_by_id'
        ];
    }
}
