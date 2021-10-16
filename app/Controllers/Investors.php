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

        $data['title'] = 'Profile';

        $this->view('profile', $data);
    }

    // for investors
    public function complete_profile()
    {
        if (!$this->session->has('identity')) {
            return redirect()->to('auth/login');
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
                    'updated_by_id'=>$identity['id']
                ];

                $investor_data = [
                    'settlement_method' => $this->request->getJsonVar('settlement'),
                    'updated_by_id'=>$identity['id']
                ];

                $this->user_model->update($identity['id'], $user_data); // update user data
                $this->investor_model->update($identity['id'], $investor_data); // update investor data

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
                    'updated_by_id'=>$identity['id']
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
                    'updated_by_id'=>$identity['id']
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
