<?php

namespace App\Models;

use CodeIgniter\Model;

class MailModel extends BaseModel
{
    public function initialize()
    {
        $this->table = 'mails';
        $this->returnType = 'array';
        $this->allowedFields = [
            'email', 'subject', 'body', 'is_sent', 'sent_date', 'created_by_id'
        ];
    }
}
