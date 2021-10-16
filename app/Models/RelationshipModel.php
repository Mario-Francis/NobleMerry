<?php

namespace App\Models;

use CodeIgniter\Model;

class RelationshipModel extends BaseModel
{
    public function initialize()
    {
        $this->table = 'relationships';
        $this->returnType = 'array';
        $this->allowedFields = [
            'name', 'created_by_id'
        ];
    }
}
