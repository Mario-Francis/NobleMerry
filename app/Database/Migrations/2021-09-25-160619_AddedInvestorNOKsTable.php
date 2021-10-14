<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddedInvestorNOKsTable extends Migration
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
            'investor_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>false
            ],
            'first_name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'=>false
            ],
            'last_name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'=>false
            ],
            'other_name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'=>true
            ],
            'gender'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'null'=>false
            ],
            'address'       => [
                'type'           => 'TEXT',
                'null'=>true
            ],
            'email'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'=>true
            ],
            'password'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'=>false
            ],
            'phone_number'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'null'=>false
            ],
            'relationship'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
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
        $this->forge->addKey('investor_id')->addUniqueKey('phone_number');
        $this->forge->createTable('investor_noks', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('investor_noks', true);
    }
}
