<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddedUpdateFieldsForRolesTable extends Migration
{
    public function up()
    {
        //
        $fields = [
            'updated_by_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'=>true
            ]
        ];
        $this->forge->addColumn('roles', 'updated_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
        $this->forge->addColumn('roles', $fields);
    }

    public function down()
    {
        //
        $this->forge->dropColumn('roles', 'updated_by_id');
        $this->forge->dropColumn('roles', 'updated_date');
    }
}
