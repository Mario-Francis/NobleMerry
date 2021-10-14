<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddedRolePrivilegesTable extends Migration
{
    public function up()
    {
        //
        $fields = [
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
                'null'=>false
            ],
            'role_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>false
            ],
            'privilege_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>false
            ],
            'created_by_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>false
            ]
        ];
        $this->forge->addField($fields)->addPrimaryKey('id');
        $this->forge->addField('created_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
        $this->forge->addKey('role_id')->addKey('privilege_id')->addUniqueKey(['role_id', 'privilege_id']);
        $this->forge->createTable('role_privileges', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('role_privileges', true);
    }
}
