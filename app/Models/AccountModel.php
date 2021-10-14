<?php

namespace App\Models;

use CodeIgniter\Model;

class AccountModel extends BaseModel
{
    public function initialize()
    {
        $this->table = 'accounts';
        $this->returnType = 'array';
        $this->allowedFields = [
            'investor_id', 'number', 'balance', 'total_interest','status', 'is_cleared', 
            'is_settled', 'contribution_start_date', 'contribution_end_date', 'created_by_id', 'updated_by_id'
        ];
    }
}
