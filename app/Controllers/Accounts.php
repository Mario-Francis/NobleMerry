<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class Accounts extends BaseController
{
    // ============= for investor ===========
    public function index(){
        if (!$this->session->has('identity')) {
            return redirect()->to('auth/login');
        }

        $data['title'] = 'My Accounts';
        $this->view('accounts', $data);
    }


    
    //=================API Functions=====================
    // for investors

   public function api_accounts_dt()
    {
        $investor_id =  $this->session->get('identity')['investor_id'];
        return $this->response->setStatusCode(200)->setJSON($this->account_model->get_investor_accounts_dt($investor_id));
    }

    // ==================== for admin ===============================
    public function api_investor_accounts_dt($investor_id=0)
    {
        if($investor_id == 0){
            return $this->response->setStatusCode(400)->setJSON(['message'=>'invalid investor id']);
        }else{
            return $this->response->setStatusCode(200)->setJSON($this->account_model->get_investor_accounts_dt($investor_id));
        }
        
    }


    // ================private functions===========

    private function view($page = 'index', $data = [])
    {
        if (!is_file(APPPATH . '/Views/accounts/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $data['session'] = $this->session;
        echo view('accounts/' . $page, $data);
    }
}
