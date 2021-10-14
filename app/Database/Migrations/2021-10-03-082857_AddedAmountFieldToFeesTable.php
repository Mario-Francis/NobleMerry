<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddedAmountFieldToFeesTable extends Migration
{
    public function up()
    {
        $fields = [
            'amount'       => [
                'type'           => 'DECIMAL',
                'constraint'     => '12, 2',
                'default'=>0,
                'null'=>false
            ],
        ];
        $this->forge->addColumn('fees', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('fees', 'amount');
    }
}
