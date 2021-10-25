<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class Investors extends BaseController
{
    // ========= for Admin ============
    public function index()
    {
        if(!$this->session->has('identity')){
            return redirect()->to('auth/login');
        }

        $data['title']='Investors';
        $this->view('investors', $data);
    }

    public function investor($id){
       if(empty($id) || $id ==0){
           throw PageNotFoundException::forPageNotFound('Investor not found');
       }else{
           $investor = $this->investor_model->find($id);
           if($investor == null){
            throw PageNotFoundException::forPageNotFound('Investor not found');
           }else{
            $data['investor'] = $investor;
            $data['nok'] = $this->investor_nok_model->where('investor_id', $id)->first();
            $data['bank_detail'] = $this->investor_bank_detail_model->where('investor_id', $id)->first();
            if($data['bank_detail'] != null){
                $data['bank_detail']['bank_name'] = $this->bank_model->find($data['bank_detail']['bank_id'])['name'];
            }
            $user = $this->user_model->find($investor['user_id']);
            $data['user'] = [
                'first_name'=>$user['first_name'],
                'other_name'=>$user['other_name'],
                'last_name'=>$user['last_name'],
                'email'=>$user['email'],
                'gender'=>$user['gender'],
                'phone_number'=>$user['phone_number']
            ];
            //$data['accounts'] = $this->account_model->where('investor_id', $id)->findAll();

            $data['title'] = 'Investor - ' . $user['first_name'] . ' ' . $user['last_name'];
        $this->view('investor', $data);
           }
       }
    }

    // ========= end for admin =========================

    // for investors
    public function profile()
    {
        if (!$this->session->has('identity')) {
            return redirect()->to('auth/login');
        }

        $identity = $this->session->get('identity');
        $user = $this->user_model->find($identity['id']);
        $data['investor'] = $this->investor_model->find($identity['investor_id']);
        $data['nok'] = $this->investor_nok_model->where('investor_id', $identity['investor_id'])->first();
        $data['bank_detail'] = $this->investor_bank_detail_model->where('investor_id', $identity['investor_id'])->first();
        $data['bank_detail']['bank_name'] = $this->bank_model->find($data['bank_detail']['bank_id'])['name'];
        $data['user'] = [
            'first_name'=>$user['first_name'],
            'other_name'=>$user['other_name'],
            'last_name'=>$user['last_name'],
            'gender'=>$user['gender'],
            'phone_number'=>$user['phone_number']
        ];
        $data['banks']=$this->bank_model->findAll();

        $data['title'] = 'Profile';
        $this->view('profile', $data);
    }

    // for investors
    public function complete_profile()
    {
        if (!$this->session->has('identity')) {
            return redirect()->to('auth/login');
        }
        $investor_id = $this->session->get('identity')['investor_id'];
        $nok_details = $this->investor_nok_model->where('investor_id', $investor_id)->first();
        $bank_details = $this->investor_bank_detail_model->where('investor_id', $investor_id)->first();
        if ($nok_details != null && $bank_details  != null) {
            return redirect()->to('investor/profile');
        }

        $data['title'] = 'Complete Profile';

        // get banks
        $data['banks'] = $this->bank_model->findAll();

        $this->view('complete_profile', $data);
    }



    //=================API Functions=====================

    public function api_complete_profile()
    {
        try {
            if (!$this->validate([
                'first_name' => 'required|min_length[2]|max_length[255]',
                'last_name'  => 'required|min_length[2]|max_length[255]',
                'other_name'  => 'max_length[255]',
                'gender'  => 'required',
                'address'  => 'required',
                'email'  => 'valid_email',
                'phone_number'  => 'required',
                'relationship'  => 'required',
                'bank_id'  => 'required',
                'account_type'  => 'required',
                'account_name'  => 'required',
                'account_number'  => 'required',
            ])) {
                return $this->response->setStatusCode(400)->setJSON(
                    [
                        'success' => false,
                        'message' => 'Validation failed',
                        'error_list' => $this->validator->getErrors()
                    ]
                );
            } else {
                $nok_data = [
                    'first_name' => $this->request->getJsonVar('first_name'),
                    'last_name'  => $this->request->getJsonVar('last_name'),
                    'other_name'  => $this->request->getJsonVar('other_name'),
                    'gender'  => $this->request->getJsonVar('gender'),
                    'address'  => $this->request->getJsonVar('address'),
                    'email'  => $this->request->getJsonVar('email'),
                    'phone_number'  => $this->request->getJsonVar('phone_number'),
                    'relationship'  => $this->request->getJsonVar('relationship')
                ];

                $bank_data = [
                    'bank_id'  => $this->request->getJsonVar('bank_id'),
                    'account_type'  => $this->request->getJsonVar('account_type'),
                    'account_name'  => $this->request->getJsonVar('account_name'),
                    'account_number'  => $this->request->getJsonVar('account_number'),
                ];
                $investor_id = $this->session->get('identity')['investor_id'];
                $user_id = $this->session->get('identity')['id'];
                $nok_data['investor_id'] = $investor_id;
                $nok_data['created_by_id'] = $user_id;
                $nok_data['updated_by_id'] = $user_id;

                $bank_data['investor_id'] = $investor_id;
                $bank_data['created_by_id'] = $user_id;
                $bank_data['updated_by_id'] = $user_id;

                $this->investor_nok_model->insert($nok_data); // insert nok data
                $this->investor_bank_detail_model->insert($bank_data); // insert bank data

                return $this->response->setStatusCode(200)->setJSON(
                    [
                        'success' => true,
                        'message' => 'Profile completed successfully'
                    ]
                );
            }
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

    public function api_update_profile()
    {
        $identity = $this->session->get('identity');
        try {
            if (!$this->validate([
                'first_name' => 'required|min_length[2]|max_length[255]',
                'last_name'  => 'required|min_length[2]|max_length[255]',
                'other_name'  => 'max_length[255]',
                'gender'  => 'required',
                'email'  => 'required|valid_email|is_unique[users.email,email,' . $identity['email'] . ']',
                'phone_number'  => 'required',
                'settlement'  => 'required'
            ], [
                'email' => [
                    'is_unique' => 'A user already exist with email ({value})'
                ]
            ])) {
                return $this->response->setStatusCode(400)->setJSON(
                    [
                        'success' => false,
                        'message' => 'Validation failed',
                        'error_list' => $this->validator->getErrors()
                    ]
                );
            } else {
                $user_data = [
                    'first_name' => $this->request->getJsonVar('first_name'),
                    'last_name'  => $this->request->getJsonVar('last_name'),
                    'other_name'  => $this->request->getJsonVar('other_name'),
                    'gender'  => $this->request->getJsonVar('gender'),
                    'email'  => $this->request->getJsonVar('email'),
                    'phone_number'  => $this->request->getJsonVar('phone_number'),
                    'updated_by_id' => $identity['id']
                ];

                $investor_data = [
                    'settlement_method' => $this->request->getJsonVar('settlement'),
                    'updated_by_id' => $identity['id']
                ];

                $this->user_model->update($identity['id'], $user_data); // update user data
                $this->investor_model->update($identity['id'], $investor_data); // update investor data

                // update session
                $_SESSION['identity']['email'] = $user_data['email'];
                $_SESSION['identity']['first_name'] = $user_data['first_name'];
                $_SESSION['identity']['last_name'] = $user_data['last_name'];
                $_SESSION['identity']['initial'] = $user_data['first_name'][0] . $user_data['last_name'][0];
                $_SESSION['identity']['name'] = $user_data['first_name'] . ' ' . $user_data['last_name'];


                return $this->response->setStatusCode(200)->setJSON(
                    [
                        'success' => true,
                        'message' => 'Profile updated successfully'
                    ]
                );
            }
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

    public function api_update_nok()
    {
        $identity = $this->session->get('identity');
        try {
            if (!$this->validate([
                'first_name' => 'required|min_length[2]|max_length[255]',
                'last_name'  => 'required|min_length[2]|max_length[255]',
                'other_name'  => 'max_length[255]',
                'gender'  => 'required',
                'address'  => 'required',
                'email'  => 'valid_email',
                'phone_number'  => 'required',
                'relationship'  => 'required',
            ])) {
                return $this->response->setStatusCode(400)->setJSON(
                    [
                        'success' => false,
                        'message' => 'Validation failed',
                        'error_list' => $this->validator->getErrors()
                    ]
                );
            } else {
                $nok_id = $this->investor_nok_model->where('investor_id', $identity['investor_id'])->first()['id'];
                $nok_data = [
                    'first_name' => $this->request->getJsonVar('first_name'),
                    'last_name'  => $this->request->getJsonVar('last_name'),
                    'other_name'  => $this->request->getJsonVar('other_name'),
                    'gender'  => $this->request->getJsonVar('gender'),
                    'address'  => $this->request->getJsonVar('address'),
                    'email'  => $this->request->getJsonVar('email'),
                    'phone_number'  => $this->request->getJsonVar('phone_number'),
                    'relationship'  => $this->request->getJsonVar('relationship'),
                    'updated_by_id' => $identity['id']
                ];

                $this->investor_nok_model->update($nok_id, $nok_data); // update nok data

                return $this->response->setStatusCode(200)->setJSON(
                    [
                        'success' => true,
                        'message' => 'Next of kin updated successfully'
                    ]
                );
            }
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

    public function api_update_bank_details()
    {
        $identity = $this->session->get('identity');
        try {
            if (!$this->validate([
                'bank_id'  => 'required',
                'account_type'  => 'required',
                'account_name'  => 'required',
                'account_number'  => 'required',
            ])) {
                return $this->response->setStatusCode(400)->setJSON(
                    [
                        'success' => false,
                        'message' => 'Validation failed',
                        'error_list' => $this->validator->getErrors()
                    ]
                );
            } else {
                $bank_detail_id = $this->investor_bank_detail_model->where('investor_id', $identity['investor_id'])->first()['id'];
                $bank_data = [
                    'bank_id'  => $this->request->getJsonVar('bank_id'),
                    'account_type'  => $this->request->getJsonVar('account_type'),
                    'account_name'  => $this->request->getJsonVar('account_name'),
                    'account_number'  => $this->request->getJsonVar('account_number'),
                    'updated_by_id' => $identity['id']
                ];

                $this->investor_bank_detail_model->update($bank_detail_id, $bank_data); // update bank data

                return $this->response->setStatusCode(200)->setJSON(
                    [
                        'success' => true,
                        'message' => 'Bank details updated successfully'
                    ]
                );
            }
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

    public function api_get_profile()
    {
        $identity = $this->session->get('identity');
        try {
            $user = $this->user_model->find($identity['id']);
            $data['investor'] = $this->investor_model->find($identity['investor_id']);
            // $data['nok'] = $this->investor_nok_model->where('investor_id', $identity['investor_id'])->first();
            // $data['bank_detail'] = $this->investor_bank_detail_model->where('investor_id', $identity['investor_id'])->first();

            $data['user'] = [
                'first_name'=>$user['first_name'],
                'other_name'=>$user['other_name'],
                'last_name'=>$user['last_name'],
                'gender'=>$user['gender'],
                'phone_number'=>$user['phone_number'],
                'email'=>$user['email']
            ];

            return $this->response->setStatusCode(200)->setJSON(
                [
                    'success' => true,
                    'message' => 'Success',
                    'data' => $data
                ]
            );
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

    public function api_get_bank_detail()
    {
        $identity = $this->session->get('identity');
        try {
            $data['bank_detail'] = $this->investor_bank_detail_model->where('investor_id', $identity['investor_id'])->first();

            return $this->response->setStatusCode(200)->setJSON(
                [
                    'success' => true,
                    'message' => 'Success',
                    'data' => $data
                ]
            );
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
    public function api_get_nok()
    {
        $identity = $this->session->get('identity');
        try {
            $data['nok'] = $this->investor_nok_model->where('investor_id', $identity['investor_id'])->first();

            return $this->response->setStatusCode(200)->setJSON(
                [
                    'success' => true,
                    'message' => 'Success',
                    'data' => $data
                ]
            );
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

    // ==================== for admin ===============================
    public function api_onboarding_dt()
    {
        return $this->response->setStatusCode(200)->setJSON($this->investor_model->get_dt(false));
    }

    public function api_onboarded_dt()
    {
        return $this->response->setStatusCode(200)->setJSON($this->investor_model->get_dt(true));
    }

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
