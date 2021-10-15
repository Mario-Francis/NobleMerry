<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddedBatchPaymentsTable extends Migration
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
            'transaction_ref'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'=>true
            ],
            'amount'       => [
                'type'           => 'DECIMAL',
                'constraint'     => '12, 2',
                'default'=>0,
                'null'=>true
            ],
            'paid_by_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>false
            ],
            'paid_date'       => [
                'type'           => 'TIMESTAMP',
                'null'=>true
            ],
            'payment_method'       => [
                'type'           => 'ENUM',
                'constraint'     => ['TRANSFER', 'GATEWAY'],
                'null'=>true
            ],
            'status'       => [
                'type'           => 'ENUM',
                'constraint'     => ['UNPAID', 'PENDING_CONFIRMATION', 'NOT_RECEIVED', 'PAID'],
                'null'=>true
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
        $this->forge->addKey('paid_by_id')->addKey('reviewed_by_id')->addUniqueKey('transaction_ref');
        $this->forge->createTable('batch_payments', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('batch_payments', true);
    }
}
