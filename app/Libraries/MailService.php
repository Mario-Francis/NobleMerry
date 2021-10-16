<?php

namespace App\Libraries;

use App\Models\MailModel;
use CodeIgniter\View\View;

class MailService{

    protected $mail_model;
    protected $view;
    public function __construct(MailModel $mail_model, View $view)
    {
        $this->mail_model = $mail_model;
        $this->view = $view;
    }

    // schedule email veerification mail
    public function schedule_email_verification_mail($_email, $name, $link, $incoming_email)
    {
        $param = [
            'name' => $name,
            'url' => $link,
            'incoming_email' => $incoming_email
        ];

        $html_message = $this->view->setData($param)->render('shared/email_verification_template');
        $subject = 'Email Confirmation';

        // send mail
        $sent = $this->send_mail($_email, $subject, $html_message);
        $email_data=[
            'email'=>$_email,
            'subject'=>$subject,
            'body'=>$html_message,
            'is_sent'=>$sent
        ];
        if($sent){
            $email_data['sent_date'] = date('Y-m-d H:i:s');
        }
        $this->mail_model->insert($email_data);
    }

    // schedule mail to notify admin of pending single transfer payment confirmation

    private function send_mail($_email, $subject, $html_message)
    {
        $email = \Config\Services::email();

        $config['protocol'] = 'smtp';
        $config['SMTPHost'] = getenv('smpt.host');
        $config['SMTPUser'] = getenv('smtp.user');
        $config['SMTPPass'] = getenv('smtp.pass');
        $config['SMTPPort'] = getenv('smtp.port');
        $config['mailType'] = 'html';
        $config['charset'] = 'utf-8';
        $config['SMTPCrypto'] = getenv('smtp.crypto');
        $config['wordWrap'] = true;
        $config['newline'] = "\r\n";

        $email->initialize($config);

        $email->setFrom(getenv('smtp.from.email'), getenv('smtp.from.name'));
        $email->setTo($_email);

        $email->setSubject(getenv('smtp.from.name') . ' | ' . $subject);
        $email->setMessage($html_message);
        //$email->setAltMessage($alt_message);

        if(!$email->send(false)){
            log_message('error', $email->printDebugger());
            return false;
        }else{
            return true;
        }
    }


}
