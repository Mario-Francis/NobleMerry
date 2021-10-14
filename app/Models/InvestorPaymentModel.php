<?php

namespace App\Models;

use CodeIgniter\Model;

class InvestorPaymentModel extends BaseModel
{
    public function initialize()
    {
        $this->table = 'investor_payments';
        $this->returnType = 'array';
        $this->allowedFields = [
            'investor_id', 'account_id', 'fee_id', 'week_sno', 'due_date', 
            'paid_date', 'amount', 'payment_method', 'status',  'reviewed_by_id', 
            'review_date', 'created_by_id', 'updated_by_id'
        ];
    }
        
}
