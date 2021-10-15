<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifiedPaymentLogsTable extends Migration
{
    public function up()
    {
        $fields = [
            'investor_payment_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>true
            ],
        ];
        $this->forge->modifyColumn('payment_logs', $fields);

        $_fields = [
            'batch_payment_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>true
            ],
        ];
        $this->forge->addColumn('payment_logs', $_fields);
    }

    public function down()
    {
        $fields = [
            'investor_payment_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>false
            ],
        ];
        $this->forge->modifyColumn('payment_logs', $fields);
        $this->forge->dropColumn('payment_logs', 'batch_payment_id');
    }
}
