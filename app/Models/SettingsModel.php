<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends BaseModel
{
    protected function initialize()
    {
        $this->table = 'settings';
        $this->returnType = 'array';
        $this->allowedFields = [
            'key', 'value',  'created_by_id', 'updated_by_id'
        ];
    }


    public function get_value($key){
        return ($this->where('key', $key)->first())['value'];
        //return $this->first()['value'];
    }
}
