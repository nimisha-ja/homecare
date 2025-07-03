<?php

namespace App\Controllers;

use CodeIgniter\Email\Email;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    public function test()
    {
        return view('test');
       // return 'This is a test route!';
    }
    public function sendEmail()
    {
        // Get email configuration
        $config = config('Email');

        $email = \Config\Services::email();
        $email->setFrom($config->fromEmail, $config->fromName);
        $email->setTo($config->recipients);
        $email->setSubject('Test Email');
        $email->setMessage('This is a test email sent from CodeIgniter 4!');

        // Try sending the email
        if ($email->send()) {
            echo 'Email sent successfully';
        } else {
            $data = $email->printDebugger(['headers']);
            echo 'Email failed to send. Debugger info: ' . $data;
        }
    }
}
