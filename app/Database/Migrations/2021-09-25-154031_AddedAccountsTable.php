<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddedAccountsTable extends Migration
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
            'number'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'unique'=>true,
                'null'=>true
            ],
            'balance'       => [
                'type'           => 'DECIMAL',
                'constraint'     => '12, 2',
                'default'=>0,
                'null'=>false
            ],
            'total_interest'       => [
                'type'           => 'DECIMAL',
                'constraint'     => '12, 2',
                'default'=>0,
                'null'=>false
            ],
            'status'       => [
                'type'           => 'ENUM',
                'constraint'     => ['INACTIVE', 'ACTIVE', 'CLOSED', 'SUSPENDED', 'SETTLED'],
                'default'=>'INACTIVE',
                'null'=>false
            ],
            'is_cleared'       => [
                'type'           => 'BOOLEAN',
                'null'=>false,
                'default'=>0
            ],
            'is_settled'       => [
                'type'           => 'BOOLEAN',
                'null'=>false,
                'default'=>0
            ],
            'contribution_start_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'contribution_end_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP',
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
        $this->forge->addKey('investor_id');
        $this->forge->createTable('accounts', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('accounts', true);
    }
}
