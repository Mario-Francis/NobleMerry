<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddedAccontOwnershipChangeRecordsTable extends Migration
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
            'old_investor_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>false
            ],
            'new_investor_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>false
            ],
            'account_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>false
            ],
            'cleared_amount'       => [
                'type'           => 'DECIMAL',
                'constraint'     => '12, 2',
                'default'=>0,
                'null'=>true
            ],
            'comment'       => [
                'type'           => 'TEXT',
                'null'=>true
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
        $this->forge->addKey('old_investor_id')->addKey('account_id')->addKey('new_investor_id');
        $this->forge->createTable('account_ownership_changes', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('account_ownership_changes', true);
    }
}
