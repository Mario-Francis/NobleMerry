<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddedUpdateRolePrivilegesTable extends Migration
{
    public function up()
    {
        $fields = [
            'created_by_id' => [
                'name'=>'created_by_id',
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>true
            ],
        ];
        $this->forge->modifyColumn('role_privileges', $fields);
    }

    public function down()
    {
        $fields = [
            'created_by_id' => [
                'name'=>'created_by_id',
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>false
            ],
        ];
        $this->forge->modifyColumn('role_privileges', $fields);
    }
}
