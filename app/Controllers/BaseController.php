<?php

namespace App\Controllers;

use App\Models\SettingsModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\UserModel;
use Config\Services;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['text'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        $this->account_model = Services::account_model();
        $this->account_ownership_change_model = Services::account_ownership_change_model();
        $this->bank_model = Services::bank_model();
        $this->fee_model = Services::fee_model();
        $this->investor_bank_detail_model = Services::investor_bank_detail_model();
        $this->investor_model = Services::investor_model();
        $this->investor_nok_model = Services::investor_nok_model();
        $this->investor_payment_model = Services::investor_payment_model();
        $this->mail_model = Services::mail_model();
        $this->payment_log_model = Services::payment_log_model();
        $this->privilege_model = Services::privilege_model();
        $this->role_model = Services::role_model();
        $this->role_privilege_model = Services::role_privilege_model();
        $this->settings_model = Services::settings_model();
        $this->user_model = Services::user_model();

        $this->session = session();
        // services
        $this->mail_service = Services::mail_service();
        $this->payments_service = Services::payments_service();
    }

    private function add_reg_status_to_session()
    {
        if ($this->session->has('identity')) {
            if (isset($this->session->get('identity')['investor_id'])) {
                $reg_fee = $this->fee_model->where('code', FEE_REG)->first();

                $reg_payment = $this->investor_payment_model->where([
                    'investor_id' => $this->session->get('identity')['investor_id'],
                    'fee_id' => $reg_fee['id']
                ])->first();
                $_SESSION['identity']['reg_completed'] = $reg_payment['status'] == PAY_STATUS_PAID;
            }
        }
    }

    public function generate_token($user_id)
    {
        $plain_text = random_string('alnum', 16) . '-' . $user_id . '-' . time() . '-' . random_string('alnum', 16);
        $encrypter = \Config\Services::encrypter();
        $token = bin2hex($encrypter->encrypt($plain_text));
        return $token;
    }

    public function token_valid($token)
    {
        // try {
        $encrypter = \Config\Services::encrypter();
        $plain_text = $encrypter->decrypt(hex2bin($token));
        $arr = explode('-', $plain_text);
        //echo $token;
        if (count($arr) != 4) {
            return false;
        } else {
            $gen_time = (int)$arr[2];
            $exp_time = (((int)getenv('TOKEN_EXPIRY_PERIOD')) * 24 * 60 * 60) + $gen_time;

            return time() < $exp_time;
        }
        // } catch (\Exception $ex) {
        //     return false;
        // }
    }

    public function get_token_user_id($token)
    {
        $encrypter = \Config\Services::encrypter();
        $plain_text = $encrypter->decrypt(hex2bin($token));
        $arr = explode($plain_text, '-');

        if (count($arr) != 4) {
            throw new \Exception('Token is invalid');
        } else {
            return (int)$arr[1];
        }
    }

    protected function send_mail($_email, $subject, $html_message, $alt_message)
    {
        $email = \Config\Services::email();



        $config['protocol'] = 'smtp';
        $config['SMTPHost'] = 'mail.mariofrancis.com.ng';
        $config['SMTPUser'] = 'no_reply@mariofrancis.com.ng';
        $config['SMTPPass'] = 'henriofrancis';
        $config['SMTPPort'] = 465;
        $config['mailType'] = 'html';
        $config['charset'] = 'utf-8';
        $config['SMTPCrypto'] = 'ssl';
        $config['wordWrap'] = true;
        $config['newline'] = "\r\n";

        $email->initialize($config);

        $email->setFrom('no_reply@mariofrancis.com.ng', 'Noble Merry');
        $email->setTo($_email);

        $email->setSubject('Noble Merry | ' . $subject);
        $email->setMessage($html_message);
        $email->setAltMessage($alt_message);

        $email->send();
        // if(!$this->email->send(false)){
        //     $this->email->print_debugger();
        // }else{
        //     echo 'Sent';
        // }
    }
}
