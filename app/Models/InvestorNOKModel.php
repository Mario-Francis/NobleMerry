<?php

namespace App\Models;

use CodeIgniter\Model;

class InvestorNOKModel extends BaseModel
{
    public function initialize()
    {
        $this->table = 'investor_noks';
        $this->returnType = 'array';
        $this->allowedFields = [
            'investor_id', 'first_name', 'last_name', 'other_name',
            'gender', 'address', 'email', 'phone_number', 'relationship', 'created_by_id', 'updated_by_id'
        ];
    }
}
