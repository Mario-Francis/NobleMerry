<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\I18n\Time;
use DateTime;

class Payments extends BaseController
{
    // public function index()
    // {
    //     if(!$this->session->has('identity')){
    //         return redirect()->to('auth/login');
    //     }

    //     $data['title']='Dashboard';
    //     if($this->session->has('identity') && $this->session->get('identity')['role_id']==1){
    //         $this->admin_dashboard($data);
    //     }else{
    //         $this->investor_dashboard($data);
    //     }
    // }

    // ========= for investors =========
    public function account_payments($account_id = 0)
    {
        if ($account_id == 0) {
            return PageNotFoundException::forPageNotFound("Account not found");
        } else {
            $account = $this->account_model->find($account_id);
            if ($account == null) {
                return PageNotFoundException::forPageNotFound("Account not found");
            } else {
                $data['account'] = $account;

                $data['title'] = 'Account #' . $account['number'];
                $this->view('account_payments', $data);
            }
        }
    }

   



    // ======== for admin ============
    public function pending_confirmations()
    {
        $data['title'] = 'Pending Confirmations';

        $this->view('pending_confirmations', $data);
    }

    public function test()
    {
        $now = new Time('now');
        $now = Time::createFromDate();
        $start = Time::parse('next Sunday');
        $next = $start->addDays(7);
        echo $now;
        echo '<br />';
        echo $start;
        echo '<br />';
        echo $next;
        echo '<br />';
        echo $next->toLocalizedString('yyyy-MM-dd HH:mm:ss');

        $r = ['a', 'v'];
    }

    //=================API Functions=====================
     //========== for investors ============
     public function api_account_payments_dt($account_id = 0)
     {
         $investor_id = $this->session->get('identity')['investor_id'];
         if ($account_id == 0) {
             return $this->response->setStatusCode(400)->setJSON(['message' => 'invalid account id']);
         } else {
             return $this->response->setStatusCode(200)->setJSON($this->investor_payment_model->get_investor_payments_dt($investor_id, $account_id, true));
         }
     }

     public function api_get_payment($id=0){
        if ($id == 0) {
            return $this->response->setStatusCode(400)->setJSON([
                'success'=> false, 
                'message' => 'invalid payment id']);
        } else {
            $payment = $this->investor_payment_model->find($id);
            if($payment == null){
                return $this->response->setStatusCode(400)->setJSON([
                    'success'=> false, 
                    'message' => 'invalid payment id']);
            }else{
                $payment['fee'] = $this->fee_model->find($payment['fee_id'])['name'];
                return $this->response->setStatusCode(200)->setJSON([
                    'success'=> true, 
                    'message' => 'Success', 
                    'data'=>$payment]);
            }
        }
     }

    // for investor
    public function api_reg_payment_by_transfer()
    {
        $user_id = $this->session->get('identity')['id'];
        $investor_id = $this->session->get('identity')['investor_id'];
        try {
            $response = [
                'success' => false,
                'message' => null,
                'error_list' => null
            ];

            $this->payments_service->update_investor_reg_payment_by_transfer($user_id, $investor_id);
            $response['success'] = true;
            $response['message'] = 'Payment status updated successfully. Now pending confirmation.';

            // notify admin of pending transfer payment confirmation

            return $this->response->setStatusCode(
                $response['success'] ? 200 : 400
            )->setJSON($response);
        } catch (\Exception $ex) {
            $err = $ex->getMessage();
            log_message('error', $err);
            return $this->response->setStatusCode(500)->setJSON(
                [
                    'success' => false,
                    'message' => $err
                ]
            );
        }
    }

    // for investor
    public function api_payment_by_transfer($payment_id)
    {
        $user_id = $this->session->get('identity')['id'];
        try {
            $response = [
                'success' => false,
                'message' => null,
                'error_list' => null
            ];

            $this->payments_service->update_investor_payment_by_transfer($user_id, $payment_id);
            $response['success'] = true;
            $response['message'] = 'Payment status updated successfully. Now pending confirmation.';

            // notify admin of pending transfer payment confirmation

            return $this->response->setStatusCode(
                $response['success'] ? 200 : 400
            )->setJSON($response);
        } catch (\Exception $ex) {
            $err = $ex->getMessage();
            log_message('error', $err);
            return $this->response->setStatusCode(500)->setJSON(
                [
                    'success' => false,
                    'message' => $err
                ]
            );
        }
    }

    // for admin
    public function api_pending_single_dt()
    {
        return $this->response->setStatusCode(200)->setJSON($this->investor_payment_model->get_pending_single_payment_dt());
    }

    public function api_investor_payments_dt($investor_id = 0)
    {
        if ($investor_id == 0) {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'invalid investor id']);
        } else {
            return $this->response->setStatusCode(200)->setJSON($this->investor_payment_model->get_investor_payments_dt($investor_id));
        }
    }

    // for admin
    public function api_confirm_payment_by_transfer(int $payment_id = 0)
    {

        $action = $this->request->getVar('action');
        $c_user_id = $this->session->get('identity')['id'];
        try {
            $response = [
                'success' => false,
                'message' => null,
                'error_list' => null
            ];

            if ($payment_id == 0) {
                $response['message'] = 'Invalid payment id';
            } else if (empty($action)) {
                $response['message'] = 'Review action is required';
            } else if ($action != PAY_REVIEW_ACTION_CONFIRM && $action != PAY_REVIEW_ACTION_DECLINE) {
                $response['message'] = 'Invalid review action! Valid values are CONFIRM & DECLINE';
            } else {
                $payment = $this->investor_payment_model->find($payment_id);
                if ($payment == null) {
                    return $this->response->setStatusCode(404)->setJSON(
                        [
                            'success' => false,
                            'message' => 'Payment not found'
                        ]
                    );
                } else {
                    $fee_id = $payment['fee_id'];
                    $investor = $this->investor_model->find($payment['investor_id']);
                    switch ($fee_id) {
                        case FEE_REG_ID:
                            $this->payments_service->confirm_investor_reg_payment_by_transfer($c_user_id, $payment['investor_id'], $action);
                            break;
                        default:
                            $this->payments_service->confirm_investor_payment_by_transfer($c_user_id, $payment_id, $action);
                            break;
                    }
                    $response['success'] = true;
                    $response['message'] = 'Payment confirmation successful';
                }
            }
            return $this->response->setStatusCode(
                $response['success'] ? 200 : 400
            )->setJSON($response);
        } catch (\Exception $ex) {
            $err = $ex->getMessage();
            log_message('error', '[ERROR] {exception}', ['exception' => $ex]);
            return $this->response->setStatusCode(500)->setJSON(
                [
                    'success' => false,
                    'message' => $err
                ]
            );
        }
    }
    // ================private functions===========

    private function view($page = 'index', $data = [])
    {
        if (!is_file(APPPATH . '/Views/payments/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $data['session'] = $this->session;
        echo view('payments/' . $page, $data);
    }
}
