<?php

namespace App\Models;

use CodeIgniter\Model;

class InvestorModel extends BaseModel
{
    public function initialize()
    {
        $this->table = 'investors';
        $this->returnType = 'array';
        $this->allowedFields = [
            'user_id', 'referral_id', 'reg_code', 'settlement_method', 'created_by_id', 'updated_by_id'
        ];
    }
}
