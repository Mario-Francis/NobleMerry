<?php

namespace App\Controllers;

class Investors extends BaseController
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

    // for investors
    public function profile()
    {
        if (!$this->session->has('identity')) {
            return redirect()->to('auth/login');
        }

        $data['title']='Profile';

        $this->view('profile', $data);
    }

    // for investors
    public function complete_profile()
    {
        if (!$this->session->has('identity')) {
            return redirect()->to('auth/login');
        }

        $data['title']='Complete Profile';

        $this->view('complete_profile', $data);
    }

    //=================API Functions=====================



    // ================private functions===========

    private function view($page = 'index', $data = [])
    {
        if (!is_file(APPPATH . '/Views/investors/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $data['session'] = $this->session;
        echo view('investors/' . $page, $data);
    }
}
