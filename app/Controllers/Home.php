<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Home extends BaseController
{
    public function index()
    {
        $this->view('index');
    }

    public function about()
    {
        $this->view('about');
    }

    public function register()
    {
        $this->view('register');
    }

    public function verify_email()
    {
        $token = $this->request->getGet('token');
        if (empty($token)) {
            $this->session->setFlashdata('error', 'Invalid email verification link');
            return redirect()->to('auth/login');
        } else if (!$this->token_valid($token)) {
            $this->session->setFlashdata('error', 'Email verification link has expired');
            return redirect()->to('auth/login');
        } else {
            $user = $this->user_model->where(['email_verification_token' => $token])->first();
            if ($user == null) {
                $this->session->setFlashdata('error', 'Invalid email verification link' . $token);
                return redirect()->to('auth/login');
            } else {

                $this->user_model->update($user['id'], [
                    'email_verification_token' => null,
                ]);
                $this->session->setFlashdata('success', 'Email was verified successfully. Kindly login to get started.');
                return redirect()->to('auth/login');
            }
        }
    }

    public function login()
    {

        $this->view('login');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('auth/login');
    }

   


    //============== APIS =======================

    public function api_register()
    {
        try {
            if (!$this->validate([
                'first_name' => 'required|min_length[2]|max_length[255]',
                'last_name'  => 'required|min_length[2]|max_length[255]',
                'other_name'  => 'max_length[255]',
                'gender'  => 'required',
                'email'  => 'required|valid_email|is_unique[users.email]',
                'phone_number'  => 'required',
                'password'  => 'required|min_length[8]',
                'confirm_password'  => 'required|matches[password]',
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
                $input_data = [
                    'first_name' => $this->request->getJsonVar('first_name'),
                    'last_name'  => $this->request->getJsonVar('last_name'),
                    'other_name'  => $this->request->getJsonVar('other_name'),
                    'gender'  => $this->request->getJsonVar('gender'),
                    'email'  => $this->request->getJsonVar('email'),
                    'phone_number'  => $this->request->getJsonVar('phone_number'),
                    'password'  => $this->request->getJsonVar('password'),
                ];

                if (!$this->is_password_valid($input_data['password'])) {
                    $err = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
                    return $this->response->setStatusCode(400)->setJSON(
                        [
                            'success' => false,
                            'message' => $err,
                            'data' => $input_data
                        ]
                    );
                } else {
                    // generate email verification token

                    $input_data['role_id'] = 2;
                    $input_data['is_active'] = true;

                    $user_id = $this->user_model->add($input_data); //  insert user

                    $token = $this->generate_token($user_id); // generate email verification token

                    $update_data = [
                        'email_verification_token' => $token,
                        'created_by_id' => $user_id,
                        'updated_by_id' => $user_id
                    ];
                    $this->user_model->update($user_id, $update_data); // update user with token

                    $investor_data = [
                        'user_id' => $user_id,
                        'referral_id' => $this->generate_referral_code($user_id),
                        'reg_code' => $this->generate_reg_code($user_id),
                        'created_by_id' => $user_id,
                        'updated_by_id' => $user_id
                    ];
                    $investor_id = $this->investor_model->insert($investor_data);
                    // insert regisration payment info
                    $this->payments_service->add_investor_reg_payment($user_id, $investor_id);

                    // schedule email verification mail
                    $this->send_email_verification_mail(
                        $input_data['email'],
                        $input_data['first_name'],
                        base_url('/auth/verify-email?token=' . $token)
                    );

                    // $this->mail_service->schedule_email_verification_mail(
                    //     $input_data['email'],
                    //     $input_data['first_name'],
                    //     base_url('/auth/verify-email?token=' . $token),
                    //     $this->settings_model->get_value('incoming_email')
                    // );

                    return $this->response->setStatusCode(200)->setJSON(
                        [
                            'success' => true,
                            'message' => 'Registration was successful. An email verification link has been sent to your mail. Kindly verify your email address and proceed to login.'
                        ]
                    );
                }
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

    public function api_login()
    {
        try {
            $response = [
                'success' => false,
                'message' => null,
                'error_list' => null
            ];

            if (!$this->validate([
                'email' => 'required',
                'password'  => 'required'
            ])) {
                $response['message'] = 'Validation failed';
                $response['error_list'] = $this->validator->getErrors();

            } else {
                $input_data = [
                    'email' => $this->request->getJsonVar('email'),
                    'password' => $this->request->getJsonVar('password'),
                ];

                if ($this->user_model->where('email', $input_data['email'])->first() == null) {
                    $response['message'] = 'Invalid email/password';
                } else {

                    $user = $this->user_model->find_via_login_credentials($input_data['email'], $input_data['password']);
                    if ($user == null) {
                        $response['message'] = 'Invalid email/password';
                    } else {
                        if ($user['email_verification_token'] != null) {
                            $response['message'] = 'You email addresss is yet to be verified. Kindly confirm your email address using the link that was sent to you after registration.';
                        } else if (!$user['is_active']) {
                            $response['message'] = 'Your account is currently deactivated! Kinldy contact our support team to reactivate it.';
                        } else {
                            $investor_data = $this->investor_model->where(['user_id' => $user['id']])->first();
                            $this->session->set('identity', [
                                'id' => $user['id'],
                                'email' => $user['email'],
                                'last_name' => $user['last_name'],
                                'first_name' => $user['first_name'],
                                'initial'=>$user['first_name'][0] . $user['last_name'][0],
                                'name' => $user['first_name'] . ' ' . $user['last_name'],
                                'role_id' => $user['role_id'],
                                'role' => $this->role_model->find($user['role_id'])['name']
                            ]);

                            if($investor_data != null){
                                $_SESSION['identity']['investor_id']=$investor_data['id'];
                                $_SESSION['identity']['reg_code']=$investor_data['reg_code'];
                            }

                            $response['success'] = true;
                            $response['message'] = 'You\'ve logged in successfully.';
                        }
                    }
                }
            }
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
    //============== Private Methods =================

    private function is_password_valid($password)
    {
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            return false;
        }
        return true;
    }
    private function generate_referral_code($id)
    {
        $date = new Time('now');
        $text = $date->toLocalizedString('dMMMyyyy_') . $id;
        return str_replace('=', random_string('alpha', 2), base64_encode($text));
    }

    private function generate_reg_code($id)
    {
        $month_alphas = ['A', 'B', 'C', 'D', 'E', 'F', 'J', 'K', 'L', 'M', 'N', 'O'];
        $date = new Time('now');
        $year = $date->getYear();
        $month_alpha = $month_alphas[$date->getMonth()];
        return $year . '' . $month_alpha . '' . $id;
    }

    private function send_email_verification_mail($_email, $name, $link)
    {
        $param = [
            'name' => $name,
            'url' => $link,
            'incoming_email' => $this->settings_model->get_value('incoming_email')
        ];

        $html_message = view('shared/email_verification_template', $param);
        $subject = 'Email Confirmation';
        $alt_message = "Dear $name, \n\nYour registration on the Noble Merry application was successful.\n\nTo start benefiting from our services, kindly click on the below link to verify your email address. The link will be valid for 24hrs.\n\n$link\n\nYou received this mail because you or someone else registered on the Noble Merry application. If you are not the one, kindly disregard this mail.\n\nBest regards,\Noble Merry Team.";

        // send mail
        $this->send_mail($_email, $subject, $html_message, $alt_message);
    }

    private function view($page = 'index', $data = [])
    {
        if (!is_file(APPPATH . '/Views/home/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        //$data['title'] = ucfirst($page); // Capitalize the first letter
        $data['session'] = $this->session;
        //echo view('shared/header', $data);
        echo view('home/' . $page, $data);
        //echo view('shared/footer', $data);
    }
}
