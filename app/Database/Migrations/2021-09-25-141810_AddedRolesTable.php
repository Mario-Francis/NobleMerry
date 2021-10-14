<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddedRolesTable extends Migration
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
            'name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
                'unique'         => true,
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
        $this->forge->createTable('roles', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('roles', true);
    }
}
