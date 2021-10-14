<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddedPrivilegesTable extends Migration
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
            ]
        ];

        $this->forge->addField($fields)->addPrimaryKey('id');
        $this->forge->createTable('privileges', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('privileges', true);
    }
}
