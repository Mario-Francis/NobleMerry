<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddedUsersTable extends Migration
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
            'role_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>false
            ],
            'first_name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'=>false
            ],
            'last_name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'=>false
            ],
            'other_name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'=>true
            ],
            'gender'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '10',
                'null'=>false
            ],
            'email'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'unique'=>true,
                'null'=>false
            ],
            'password'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'=>false
            ],
            'phone_number'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
                'null'=>false
            ],
            'email_verification_token'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'=>true
            ],
            'password_recovery_token'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'=>true
            ],
            'is_active'       => [
                'type'           => 'BOOLEAN',
                'null'=>false,
                'default'=>1
            ],
            'created_by_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>false
            ],
            'updated_by_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>false
            ]
        ];
        $this->forge->addField($fields)->addPrimaryKey('id');
        $this->forge->addField('created_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
        $this->forge->addField('updated_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
        $this->forge->addKey('role_id')->addKey('first_name')->addKey('phone_number')
        ->addKey('last_name');
        $this->forge->createTable('users', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('users', true);
    }
}
