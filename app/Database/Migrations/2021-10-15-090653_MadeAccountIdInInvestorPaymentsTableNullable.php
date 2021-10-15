<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MadeAccountIdInInvestorPaymentsTableNullable extends Migration
{
    public function up()
    {
        $fields = [
            'account_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>true
            ],
        ];
        $this->forge->modifyColumn('investor_payments', $fields);
    }

    public function down()
    {
        $fields = [
            'account_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>false
            ],
        ];
        $this->forge->modifyColumn('investor_payments', $fields);
    }
}
