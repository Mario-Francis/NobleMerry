<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddedInvestorPaymentsTable extends Migration
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
            'account_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>false
            ],
            'fee_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>false
            ],
            'week_sno'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>false
            ],
            'due_date'       => [
                'type'           => 'TIMESTAMP',
                'null'=>false
            ],
            'paid_date'       => [
                'type'           => 'TIMESTAMP',
                'null'=>true
            ],
            'amount'       => [
                'type'           => 'DECIMAL',
                'constraint'     => '12, 2',
                'default'=>0,
                'null'=>false
            ],
            'payment_method'       => [
                'type'           => 'ENUM',
                'constraint'     => ['TRANSFER', 'GATEWAY'],
                'null'=>true
            ],
            'status'       => [
                'type'           => 'ENUM',
                'constraint'     => ['UNPAID', 'PAID'],
                'default'=>'UNPAID',
                'null'=>false
            ],
            'reviewed_by_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>true
            ],
            'review_date'       => [
                'type'           => 'TIMESTAMP',
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
        $this->forge->addKey('investor_id')->addKey('account_id')->addKey('fee_id');
        $this->forge->createTable('investor_payments', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('investor_payments', true);
    }
}
