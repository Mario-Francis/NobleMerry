<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentLogModel extends BaseModel
{
    public function initialize()
    {
        $this->table = 'payment_logs';
        $this->returnType = 'array';
        $this->allowedFields = [
            'investor_payment_id', 'amount', 'paid_by_id', 'transaction_ref ',
            'paid_date', 'status', 'created_by_id', 'updated_by_id'
        ];
    }
}
