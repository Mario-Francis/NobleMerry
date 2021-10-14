<?php

namespace App\Models;

use CodeIgniter\Model;

class AccountOwnershipChangeModel extends BaseModel
{
    public function initialize()
    {
        $this->table = 'account_ownership_changes';
        $this->returnType = 'array';
        $this->allowedFields = [
            'old_investor_id', 'new_investor_id', 'account_id', 'cleared_amount', 
            'comment','created_by_id', 'updated_by_id'
        ];
    }
}
