<?php

namespace App\Models;

use App\Libraries\SSPClass;
use CodeIgniter\Model;

class AccountModel extends BaseModel
{
    public function initialize()
    {
        $this->table = 'accounts';
        $this->returnType = 'array';
        $this->allowedFields = [
            'investor_id', 'number', 'balance', 'total_interest','status', 'is_cleared', 
            'is_settled', 'contribution_start_date', 'contribution_end_date', 'created_by_id', 'updated_by_id'
        ];
    }

    public function get_investor_accounts_dt($investor_id)
    {
        $table = "(SELECT a.id, a.number, a.balance, a.total_interest, a.status, a.is_cleared, a.is_settled, a.contribution_start_date as start_date, a.contribution_end_date as end_date, a.created_date FROM `accounts` a
        WHERE investor_id = $investor_id) temp";

        // Table's primary key
        $primaryKey = 'id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'number', 'dt' => 1),
            array('db' => 'balance',
                'dt' => 2,
                'formatter' => function ($d, $row) {
                    return NAIRA . number_format($d, 2);
                },
            ),
            array('db' => 'total_interest',
                'dt' => 3,
                'formatter' => function ($d, $row) {
                    return NAIRA . number_format($d, 2);
                },
            ),
            array('db' => 'status', 'dt' => 4),
            array('db' => 'is_cleared', 'dt' => 5),
            array('db' => 'is_settled', 'dt' => 6),
            array(
                'db' => 'start_date',
                'dt' => 7,
                'formatter' => function ($d, $row) {
                    return date('jS M, Y', strtotime($d));
                },
            ),
            array(
                'db' => 'end_date',
                'dt' => 8,
                'formatter' => function ($d, $row) {
                    return date('jS M, Y', strtotime($d));
                },
            ),
            array(
                'db' => 'created_date',
                'dt' => 9,
                'formatter' => function ($d, $row) {
                    return date('jS M, Y', strtotime($d));
                },
            )
        );

        // SQL server connection information
        $sql_details = [
            'user' => env('database.default.username'),
            'pass' => env('database.default.password'),
            'db' => env('database.default.database'),
            'host' => env('database.default.hostname')
        ];
        //print_r($sql_details);

        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP
         * server-side, there is no need to edit below this line.
         */

        // require 'ssp.class.php';

        return SSPClass::simple($_GET, $sql_details, $table, $primaryKey, $columns);
    }
}
