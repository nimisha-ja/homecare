<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use CodeIgniter\Email\Email;
use CodeIgniter\I18n\Time;

class ForgotPassword extends Controller
{
    public function index()
    {
        return view('auth/forgot_password');  // Display the forgot password form
    }

    public function sendResetLink()
    {
        helper(['form', 'url']);           // Validate the form input
        if (!$this->validate([
            'email' => 'required|valid_email',
        ])) {
            return redirect()->to('/auth/forgot_password')->withInput()->with('error', 'Please enter a valid email address.');
        }
        $email = $this->request->getVar('email');
        $userModel = new UserModel(); // Load the User model to search for the email
        $user = $userModel->where('email', $email)->first();
        if (!$user) {
            return redirect()->to('/auth/forgot_password')->with('error', 'No account found with that email.');
        }
        $token = bin2hex(random_bytes(50)); // Create a unique token // Generate a random token   
        $data = ['reset_token' => $token];        // Attempt to update the user's reset_token
        $updateStatus = $userModel->update($user['id'], $data); //Store the token in the database or cache for later use
        $emailService = \Config\Services::email();        // Send the reset password link to the user's email
        $emailService->setFrom('developernimisha212@gmail.com', 'Meesho Delivery Application');
        $emailService->setTo($email);
        $emailService->setSubject('Password Reset Request');        // Generate the password reset link
        $resetLink = base_url("auth/reset_password/$token");        // HTML email content
        $message = "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Password Reset Request</title>
            <style>
                body {
                    font-family: 'Arial', sans-serif;
                    color: #333;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    max-width: 600px;
                    margin: 20px auto;
                    padding: 30px;
                    background-color: #ffffff;
                    border-radius: 8px;
                    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                }
                .header {
                    text-align: center;
                    margin-bottom: 25px;
                }
                .header h2 {
                    color: #4CAF50;
                    font-size: 28px;
                    margin: 0;
                    padding: 0;
                }
                .content {
                    font-size: 16px;
                    line-height: 1.7;
                    margin-bottom: 20px;
                    color: #555;
                }
                .cta {
                    display: inline-block;
                    padding: 12px 25px; /* Larger button */
                    text-align: center;
                    background-color: #4CAF50;
                    color: white;
                    font-weight: bold;
                    font-size: 16px; /* Larger font size */
                    text-decoration: none;
                    border-radius: 5px;
                    margin-top: 25px;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    transition: background-color 0.3s, transform 0.2s;
                }
                .cta:hover {
                    background-color: #45a049;
                    transform: translateY(-2px); /* Slight lift on hover */
                }
                .footer {
                    text-align: center;
                    font-size: 14px;
                    color: #777;
                    margin-top: 30px;
                }
                .footer a {
                    color: #4CAF50;
                    text-decoration: none;
                    font-weight: bold;
                }
                .footer p {
                    margin: 5px 0;
                }
            </style>
        </head>
        <body>
        
            <div class='container'>
                <div class='header'>
                    <h2>Password Reset Request</h2>
                </div>
        
                <div class='content'>
                    <p>Hi,</p>
                    <p>We received a request to reset the password for your Meesho Delivery Application account.</p>
                    <p>If you made this request, click the button below to reset your password. If you didn’t, please ignore this email.</p>
                    <a href='$resetLink' class='cta'>Reset Password</a>
                </div>
        
                <div class='footer'>
                    <p>If you have any questions, feel free to <a href='mailto:support@meesho.com'>contact us</a>.</p>
                    <p>Thank you for using Meesho Delivery Application!</p>
                </div>
            </div>
        
        </body>
        </html>
        ";

        $emailService->setMessage($message);
        if ($emailService->send()) {
            session()->setFlashdata('success', 'Password reset link sent to your email.');
            return redirect()->to(base_url('auth/forgot_password'));
        } else {
            session()->setFlashdata('error', 'Failed to send email. Please try again later.');
            return redirect()->to(base_url('auth/forgot_password'));
        }
    }

    public function resetPassword($token)
    {
        $userModel = new UserModel();        // Check if the token exists in the database
        $user = $userModel->where('reset_token', $token)->first();
        if (!$user) {           // If no user is found for the given token, show an error
            session()->setFlashdata('error', 'Invalid or expired token.');
            return redirect()->to(base_url('auth/forgot_password'));
        } // Token is valid, allow user to reset their password  // You can show a form to reset the password or process the reset here
        return view('auth/reset_password', ['token' => $token]);
    }

    public function updatePassword()
    {
        $token = $this->request->getPost('token'); // Get the token and new password from the POST request
        $newPassword = $this->request->getPost('password');
        $passwordConfirm = $this->request->getPost('password_confirm');
        if ($newPassword !== $passwordConfirm) { // Validate password confirmation
            return redirect()->back()->with('error', 'Passwords do not match.');
        }
        $userModel = new UserModel();   // Check if token exists in the database
        $user = $userModel->where('reset_token', $token)->first();
        if (!$user) {
            session()->setFlashdata('error', 'Invalid or expired token.');
            return redirect()->to(base_url('auth/forgot_password'));
        }
        $userModel->update($user['id'], [
            'password' => $newPassword,
            'reset_token' => null // Optionally clear the reset token
        ]);  // Update the user's password
        // Optionally, you could send a success message or redirect to the login page
        session()->setFlashdata('success', 'Your password has been reset successfully.');
        return redirect()->to(base_url('admin/login'));
    }
}
