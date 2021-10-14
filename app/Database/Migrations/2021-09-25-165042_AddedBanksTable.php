<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddedBanksTable extends Migration
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
                'constraint'     => '5',
                'null'=>true
            ],
            'name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'=>false
            ],
            'created_by_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>true
            ],
        ];
        $this->forge->addField($fields)->addPrimaryKey('id');
        $this->forge->addField('created_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
        $this->forge->addKey('code')->addKey('name');
        $this->forge->createTable('banks', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('banks', true);
    }
}
