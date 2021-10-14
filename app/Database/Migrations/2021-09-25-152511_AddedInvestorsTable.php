<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddedInvestorsTable extends Migration
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
            'user_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>false
            ],
            'referral_id'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'null'=>true
            ],
            'reg_code'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'null'=>true
            ],
            'settlement_method'       => [
                'type'           => 'ENUM',
                'constraint'     => ['FOODSTUFF', 'PROVISION', 'CASH'],
                'default'=>'FOODSTUFF',
                'null'=>false
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
        $this->forge->addKey('user_id')->addUniqueKey('referral_id')->addUniqueKey('reg_code')->addKey('settlement_method');
        $this->forge->createTable('investors', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('investors', true);
    }
}
