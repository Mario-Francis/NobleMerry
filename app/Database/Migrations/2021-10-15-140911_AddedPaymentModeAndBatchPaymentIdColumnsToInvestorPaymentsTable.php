<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddedPaymentModeAndBatchPaymentIdColumnsToInvestorPaymentsTable extends Migration
{
    public function up()
    {
        $fields = [
            'payment_mode'       => [
                'type'           => 'ENUM',
                'constraint'     => ['SINGLE', 'BATCH'],
                'null'=>true
            ],
            'batch_payment_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>true
            ],
            'transaction_ref'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'=>true
            ],
        ];
        $this->forge->addColumn('investor_payments', $fields);
    }

    public function down()
    {   
        $this->forge->dropColumn('investor_payments', 'payment_mode');
        $this->forge->dropColumn('investor_payments', 'batch_payment_id');
        $this->forge->dropColumn('investor_payments', 'transaction_ref');
    }
}
