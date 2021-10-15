<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifiedStatusColumnInInvestorPaymentsTable extends Migration
{
    public function up()
    {
        $fields = [
            'status'       => [
                'type'           => 'ENUM',
                'constraint'     => ['UNPAID', 'PENDING_CONFIRMATION', 'NOT_RECEIVED', 'PAID'],
                'default'=>'UNPAID',
                'null'=>false
            ],
        ];
        $this->forge->modifyColumn('investor_payments', $fields);
    }

    public function down()
    {
        $fields = [
            'status'       => [
                'type'           => 'ENUM',
                'constraint'     => ['UNPAID', 'PAID'],
                'default'=>'UNPAID',
                'null'=>false
            ],
        ];
        $this->forge->modifyColumn('investor_payments', $fields);
    }
}
