<?php

namespace App\Controllers;

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

    //=================API Functions=====================
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
