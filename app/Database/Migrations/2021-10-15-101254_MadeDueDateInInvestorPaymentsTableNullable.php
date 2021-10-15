<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MadeDueDateInInvestorPaymentsTableNullable extends Migration
{
    public function up()
    {
        $fields = [
            'due_date'       => [
                'type'           => 'TIMESTAMP',
                'null'=>true
            ],
        ];
        $this->forge->modifyColumn('investor_payments', $fields);
    }

    public function down()
    {
        $fields = [
            'due_date'       => [
                'type'           => 'TIMESTAMP',
                'null'=>false
            ],
        ];
        $this->forge->modifyColumn('investor_payments', $fields);
    }
}
