<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddedInvestorBankDetailsTable extends Migration
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
            'bank_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>false
            ],
            'account_type'       => [
                'type'           => 'ENUM',
                'constraint'     => ['CURRENT', 'SAVINGS'],
                'null'=>false
            ],
            'account_name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'=>false
            ],
            'account_number'       => [
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
        $this->forge->addKey('investor_id')->addKey('bank_id')->addKey('account_number')->addKey('account_name');
        $this->forge->createTable('investor_bank_details', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('investor_bank_details', true);
    }
}
