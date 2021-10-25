<?php

namespace App\Models;

use App\Libraries\SSPClass;
use CodeIgniter\Model;

class InvestorModel extends BaseModel
{
    public function initialize()
    {
        $this->table = 'investors';
        $this->returnType = 'array';
        $this->allowedFields = [
            'user_id', 'referral_id', 'reg_code', 'settlement_method', 'created_by_id', 'updated_by_id'
        ];
    }

    public function get_dt($onboarded=true)
    {
        $table = "(SELECT i.id, i.reg_code, CONCAT_WS(' ', u.first_name, u.last_name, u.other_name) as name, u.gender, u.email, u.phone_number, u.created_date, p.status
        FROM investors i 
        INNER JOIN users u ON i.user_id = u.id
        LEFT JOIN investor_payments p ON p.investor_id = i.id
        WHERE p.fee_id = 1 and p.status" . ($onboarded? " = '":" != '") . PAY_STATUS_PAID . "'
        ORDER BY u.created_date DESC) temp";

        // Table's primary key
        $primaryKey = 'id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'reg_code', 'dt' => 1),
            array('db' => 'name', 'dt' => 2),
            array('db' => 'gender', 'dt' => 3),
            array('db' => 'email', 'dt' => 4),
            array('db' => 'phone_number', 'dt' => 5),
            array(
                'db' => 'status',
                'dt' => 6,
                'formatter' => function ($d, $row) {
                    switch ($d) {
                        case PAY_STATUS_UNPAID:
                        case PAY_STATUS_NOT_RECEIVED:
                            return 'Unpaid';
                            break;
                        case PAY_STATUS_PENDING_CONFIRMATION:
                            return 'Pending Confirmation';
                            break;
                        default:
                            return 'Unknown';
                            break;
                    }
                },
            ),
            array(
                'db' => 'created_date',
                'dt' => 7,
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
