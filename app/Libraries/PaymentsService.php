<?php

namespace App\Libraries;

use App\Models\AccountModel;
use App\Models\FeeModel;
use App\Models\InvestorModel;
use App\Models\InvestorPaymentModel;
use App\Models\PaymentLogModel;
use CodeIgniter\I18n\Time;

class PaymentsService{
    protected $fee_model;
    protected $investor_model;
    protected $investor_payment_model;
    protected $payment_log_model;
    protected $account_model;

    public function __construct(FeeModel $fee_model,
    InvestorModel $investor_model,
    InvestorPaymentModel $investor_payment_model, 
    PaymentLogModel $payment_log_model,
    AccountModel $account_model)
    {
        $this->fee_model = $fee_model;
        $this->investor_model=$investor_model;
        $this->investor_payment_model = $investor_payment_model;
        $this->payment_log_model = $payment_log_model;
        $this->account_model = $account_model;
    }

    // added during registration
    public function add_investor_reg_payment(int $user_id, int $investor_id){
        $reg_fee = $this->fee_model->where('code', FEE_REG)->first();
        $contr_fee = $this->fee_model->where('code', FEE_CONTR)->first();
        $total_fee = $reg_fee['amount'] +  ($contr_fee['amount']*2);

        $inv_payment_data=[
            'investor_id'=>$investor_id,
            'fee_id'=>$reg_fee['id'],
            'amount'=>$total_fee,
            'status'=>PAY_STATUS_UNPAID,
            'payment_mode'=>PAY_MODE_SINGLE,
            'created_by_id'=> $user_id,
            'updated_by_id'=>$user_id
        ];

        $this->investor_payment_model->insert($inv_payment_data);
    }
    // add investor reg payment by transfer
    public function update_investor_reg_payment_by_transfer(int $user_id, int $investor_id){
        // get reg fee
        $reg_fee = $this->fee_model->where('code', FEE_REG)->first();
        $reg_payment = $this->investor_payment_model->where(
            [
                'investor_id'=> $investor_id,
                'fee_id'=>$reg_fee['id']
            ])->first();
        
        $now = date("Y-m-d H:i:s");
        $update_data=[
            'paid_date'=>$now,
            'payment_method'=>PAY_METHOD_TRANSFER,
            'status'=>PAY_STATUS_PENDING_CONFIRMATION,
            'paid_date'=>$now,
            'updated_by_id'=>$user_id
        ];
        $this->investor_payment_model->update($reg_payment['id'], $update_data);

        $pay_log_data= [
            'investor_payment_id'=>$reg_payment['id'],
            'amount'=>$reg_payment['amount'],
            'paid_by_id'=>$user_id,
            'paid_date'=>$now,
            'status'=>PAY_LOG_PENDING,
            'created_by_id'=> $user_id,
            'updated_by_id'=>$user_id
        ];
        $this->payment_log_model->insert($pay_log_data);
    }

    // confirm payment reception by transfer -  CONFIRM | DECLINE
    public function confirm_investor_reg_payment_by_transfer(int $user_id, int $investor_id, $action = PAY_REVIEW_ACTION_CONFIRM){
        // get reg fee
        $reg_fee = $this->fee_model->where('code', FEE_REG)->first();
        $reg_payment = $this->investor_payment_model->where(
            [
                'investor_id'=> $investor_id,
                'fee_id'=>$reg_fee['id']
            ])->first();
        
        $now = date("Y-m-d H:i:s");
        $update_data=[
            'status'=>$action == PAY_REVIEW_ACTION_CONFIRM? PAY_STATUS_PAID:PAY_STATUS_NOT_RECEIVED,
            'updated_by_id'=>$user_id,
            'reviewed_by_id'=>$user_id,
            'review_date'=>$now,
        ];
        
        $this->investor_payment_model->update($reg_payment['id'], $update_data);
        $pay_log = $this->payment_log_model->where('investor_payment_id', $reg_payment['id'])->first();
        $pay_log_data= [
            'investor_payment_id'=>$reg_payment['id'],
            'amount'=>$reg_payment['amount'],
            'paid_by_id'=>$pay_log['paid_by_id'],
            'paid_date'=>$pay_log['paid_date'],
            'status'=> $action == PAY_REVIEW_ACTION_CONFIRM? PAY_LOG_SUCCESSFUL:PAY_LOG_FAILED,
            'created_by_id'=> $user_id,
            'updated_by_id'=>$user_id
        ];
        $this->payment_log_model->insert($pay_log_data);

        if($action == PAY_REVIEW_ACTION_CONFIRM){
            $this->create_account($user_id, $investor_id);
        }
    }

    private function generate_payment_schedule(){
        $today = $now = Time::createFromDate();
        $start = null;
        $end = null;
        $deadlines=[];
        if($today->toLocalizedString('eee') == 'Sun'){
            $start = $today;
        }else{
            $start = Time::parse('next Sunday');
        }
        $addition = 0;
        for($i=1;$i <= 50;$i++){
            $addition+=7;
            $deadlines[] = $start->addDays($addition)->addHours(-1);
        }

        $end = $deadlines[count($deadlines) - 1];

        return [
            'today'=>$today,
            'start'=>$start,
            'end'=>$end,
            'deadlines'=> $deadlines
        ];
    }

    public function create_account($c_user_id, $investor_id){
        $fee = $this->fee_model->where('code', FEE_CONTR)->first();
        $investor = $this->investor_model->find($investor_id);
        $user_id = $investor['user_id'];

        $balance = $fee['amount'] * 2;
        $schedule = $this->generate_payment_schedule();

        $account_data = [
            'investor_id'=>$investor_id,
            'balance'=>$balance,
            'status'=> ACCOUNT_STATUS_ACTIVE,
            'contribution_start_date'=>$schedule['start']->toLocalizedString('yyyy-MM-dd HH:mm:ss'),
            'contribution_end_date'=>$schedule['end']->toLocalizedString('yyyy-MM-dd HH:mm:ss'),
            'created_by_id'=>$c_user_id,
            'updated_by_id'=>$c_user_id
        ];
        $account_id = $this->account_model->insert($account_data);
        $suffix = str_pad($investor_id, 2, '0', STR_PAD_LEFT) . str_pad($user_id, 2, '0', STR_PAD_LEFT);
        $number = str_pad($account_id, (10 - strlen($suffix)), '0', STR_PAD_RIGHT) . $suffix;
        $this->account_model->update($account_id, ['number'=>$number]);

        $this->populate_schedule($account_id, $investor_id, $schedule, $c_user_id);
    }

    private function populate_schedule($account_id, $investor_id, $schedule, $c_user_id){
        $reg_payment = $this->investor_payment_model->where('fee_id', FEE_REG_ID)->first();
        $fee = $this->fee_model->find(FEE_CONTR_ID);
        $investor_payments = [];
        
        foreach($schedule['deadlines'] as $i=>$d){
            $payment = [
                'investor_id'=> $investor_id,
                'account_id'=>$account_id,
                'fee_id'=>FEE_CONTR_ID,
                'week_sno'=>$i+1,
                'due_date'=>$d->toLocalizedString('yyyy-MM-dd HH:mm:ss'),
                'amount'=>$fee['amount'],
                'status'=>PAY_STATUS_UNPAID,
                'created_by_id'=>$c_user_id,
                'updated_by_id'=>$c_user_id,
                'paid_date'=>null,
                'payment_method'=>null,
                'reviewed_by_id'=>null,
                'review_date'=>null,
                'payment_mode'=>null,
                'transaction_ref'=>null,
            ];

            if($i == 0 || $i == 1){
                $payment['status'] = PAY_STATUS_PAID;
                $payment['paid_date'] = $reg_payment['paid_date'];
                $payment['payment_method'] = $reg_payment['payment_method'];
                $payment['reviewed_by_id'] = $reg_payment['reviewed_by_id'];
                $payment['review_date'] = $reg_payment['review_date'];
                $payment['payment_mode'] = $reg_payment['payment_mode'];
                $payment['transaction_ref'] = $reg_payment['transaction_ref'];
            }
            $investor_payments[] = $payment;
        }
        //print_r($investor_payments);
        $this->investor_payment_model->insertBatch($investor_payments);
    }
}