<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\SSPClass;

class InvestorPaymentModel extends BaseModel
{
    public function initialize()
    {
        $this->table = 'investor_payments';
        $this->returnType = 'array';
        $this->allowedFields = [
            'investor_id', 'account_id', 'fee_id', 'week_sno', 'due_date', 
            'paid_date', 'amount', 'payment_method', 'status',  'reviewed_by_id', 
            'review_date', 'created_by_id', 'updated_by_id', 'payment_mode', 'batch_payment_id', 'transaction_ref'
        ];
    }

    public function get_pending_single_payment_dt(){
        $table = "(SELECT p.id, p.investor_id, p.account_id, p.fee_id, p.week_sno as week, p.amount, p.paid_date, p.created_date, CONCAT_WS(' ', u.first_name, u.last_name) as investor, a.number as account, f.name as fee
        FROM investor_payments p
        INNER JOIN investors i ON p.investor_id = i.id
        LEFT JOIN accounts a ON p.account_id =  a.id
        INNER JOIN fees f ON p.fee_id = f.id
        INNER JOIN users u ON i.user_id = u.id
        WHERE p.payment_method = 'TRANSFER' and p.status = 'PENDING_CONFIRMATION' and p.payment_mode = 'SINGLE' 
        ORDER BY p.id DESC) temp";

        // Table's primary key
        $primaryKey = 'id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'investor_id', 'dt' => 1),
            array('db' => 'account_id', 'dt' => 2),
            array('db' => 'fee_id', 'dt' => 3),
            array('db' => 'week', 'dt' => 4),
            array('db' => 'amount',
                'dt' => 5,
                'formatter' => function ($d, $row) {
                    return NAIRA . number_format($d, 2);
                },
            ),
            array(
                'db' => 'paid_date',
                'dt' => 6,
                'formatter' => function ($d, $row) {
                    return date('jS M, Y', strtotime($d));
                },
            ),
            array('db' => 'investor', 'dt' => 7),
            array('db' => 'account', 'dt' => 8),
            array('db' => 'fee', 'dt' => 9),
            array(
                'db' => 'created_date',
                'dt' => 10,
                'formatter' => function ($d, $row) {
                    return date('jS M, Y', strtotime($d));
                },
            )
        );

        // SQL server connection information
        $sql_details = [
            'user'=> env('database.default.username'),
            'pass'=> env('database.default.password'),
            'db'=>env('database.default.database'),
            'host'=>env('database.default.hostname')
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
