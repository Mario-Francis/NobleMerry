<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddedPaymentLogsTable extends Migration
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
            'investor_payment_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>false
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
            'transaction_ref'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'=>true
            ],
            'paid_date'       => [
                'type'           => 'TIMESTAMP',
                'null'=>false
            ],
            'status'       => [
                'type'           => 'ENUM',
                'constraint'     => ['PENDING', 'FAILED', 'SUCCESSFUL'],
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
        $this->forge->addKey('investor_payment_id')->addUniqueKey('transaction_ref');
        $this->forge->createTable('payment_logs', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('payment_logs', true);
    }
}
