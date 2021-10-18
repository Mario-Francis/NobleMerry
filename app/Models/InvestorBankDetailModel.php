<?php

namespace App\Models;

use CodeIgniter\Model;

class InvestorBankDetailModel extends BaseModel
{
    public function initialize()
    {
        $this->table = 'investor_bank_details';
        $this->returnType = 'array';
        $this->allowedFields = [
            'investor_id', 'bank_id', 'account_type', 'account_name',
            'account_number', 'created_by_id', 'updated_by_id'
        ];
    }
}
