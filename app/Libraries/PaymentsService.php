<?php

namespace App\Libraries;

use App\Models\FeeModel;
use App\Models\InvestorModel;
use App\Models\InvestorPaymentModel;
use App\Models\PaymentLogModel;

class PaymentsService{
    protected $fee_model;
    protected $investor_model;
    protected $investor_payment_model;
    protected $payment_log_model;

    public function __construct(FeeModel $fee_model,
    InvestorModel $investor_model,
    InvestorPaymentModel $investor_payment_model, 
    PaymentLogModel $payment_log_model)
    {
        $this->fee_model = $fee_model;
        $this->investor_model=$investor_model;
        $this->investor_payment_model = $investor_payment_model;
        $this->payment_log_model = $payment_log_model;
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
    }
}