<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MadeWeeekSnoInInvestorPaymentsTableNullable extends Migration
{
    public function up()
    {
        $fields = [
            'week_sno'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true
            ],
        ];
        $this->forge->modifyColumn('investor_payments', $fields);
    }

    public function down()
    {
        $fields = [
            'week_sno'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => false
            ],
        ];
        $this->forge->modifyColumn('investor_payments', $fields);
    }
}
