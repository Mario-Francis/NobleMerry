<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemovedPasswordFromInvestorNOKsTable extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('investor_noks', 'password');
    }

    public function down()
    {
        $fields = [
            'password'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'=>false
            ]
        ];
        $this->forge->addColumn('investor_noks', $fields);
    }
}
