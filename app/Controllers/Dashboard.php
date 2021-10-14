<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if(!$this->session->has('identity')){
            return redirect()->to('auth/login');
        }

        $data['title']='Dashboard';
        if($this->session->has('identity') && $this->session->get('identity')['role_id']==1){
            $this->admin_dashboard($data);
        }else{
            $this->investor_dashboard($data);
        }
        
    }

    //=================API Functions=====================
    public function api_registration_payment_by_transfer()
    {
        $user_id = $this->session->get('identity')['id'];
        try {
            $response = [
                'success' => false,
                'message' => null,
                'error_list' => null
            ];

            // create entry for registration fee leeaving account_id null and reviewed_by_id null
            // once registration payment is confirmed by admin, create account and investor pending payments

            return $this->response->setStatusCode(
                $response['success']==true?200:400
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

    // private function create_account($user_id, $start_date, $end_date){
    //     $user_id = $this->session->get('identity')['id'];
    //     $investor_id = $this->session->get('identity')['investor_id'];

    //     $input_data=[
    //         'investor_id'=> $investor_id,
    //         'number'=>  $this->generate_account_number($investor_id),
    //         'balance'=>0,
    //         'total_interest'=>0,
    //         'status'=>'INACTIVE',
    //         'contribution_start_date'
    //     ];
    // }

    private function generate_account_number($investor_id){
        return  random_string('numeric', 7)  . str_pad($investor_id,  3, '0',  STR_PAD_LEFT); 
    }
    private function admin_dashboard($data){
        $this->view('admin', $data);
    }

    private function investor_dashboard($data){
        $this->view('investor', $data);
    }

    private function view($page = 'index', $data=[])
    {
        if (!is_file(APPPATH . '/Views/dashboard/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $data['session']=$this->session;
        echo view('dashboard/' . $page, $data);
    }


}
