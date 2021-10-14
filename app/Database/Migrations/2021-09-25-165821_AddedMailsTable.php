<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddedMailsTable extends Migration
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
            'email'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'=>false
            ],
            'subject'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'=>false
            ],
            'body'       => [
                'type'           => 'TEXT',
                'null'=>false
            ],
            'is_sent'       => [
                'type'           => 'BOOLEAN',
                'default'=>0,
                'null'=>false
            ],
            'sent_date'       => [
                'type'           => 'TIMESTAMP',
                'null'=>true
            ],
            'created_by_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>true
            ]
        ];
        $this->forge->addField($fields)->addPrimaryKey('id');
        $this->forge->addField('created_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP');
        $this->forge->addKey('email')->addKey('is_sent');
        $this->forge->createTable('mails', true);
    }

    public function down()
    {
        //
        $this->forge->dropTable('mails', true);
    }
}
