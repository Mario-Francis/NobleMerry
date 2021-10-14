<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddedFeesTable extends Migration
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
            'code'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'null'=>true
            ],
            'name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'=>false
            ],
            'is_fine'       => [
                'type'           => 'BOOLEAN',
                'default'=>0,
                'null'=>false
            ],
            'is_mandatory'       => [
                'type'           => 'BOOLEAN',
                'default'=>1,
                'null'=>false
            ],
            'created_by_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>true
            ],
            'updated_by_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>true
            ]
        ];
        $this->forge->addField($fields)->addPrimaryKey('id');
        $this->forge->addField('created_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
        $this->forge->addField('updated_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
        $this->forge->addKey('code')->addKey('name')->addKey('is_fine')->addKey('is_mandatory');
        $this->forge->createTable('fees', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('fees', true);
    }
}
