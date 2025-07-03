<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\DeliveryModel;
use App\Models\StaffModel;
use App\Models\HubModel;
use App\Models\MenuModel;

class LoginController extends Controller
{
    protected $db;
    protected $menuModel;
    // Constructor to load the database service
    public function __construct()
    {
        $this->db = \Config\Database::connect(); // Connecting to the database
        $this->menuModel = new MenuModel();
    }
    protected function getMenus()
    {
        // Get menus based on the current session's role ID
        $role_id = session()->get('role_id');
        return $this->menuModel->getMenus($role_id);
    }
    public function index()
    {
        return view('login');
    }

    public function login()
    {
        helper(['form']);
        if ($this->request->getMethod() == 'POST') {
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
            $userModel = new UserModel();
            $user = $userModel->getUserByEmail($email); //1234,superadmin@capp.com              
            if ($user && ($password === $user['password'])) {
                session()->set([
                    'id'         => $user['id'],
                    'username'   => $user['username'],
                    'email'      => $user['email'],
                    'role_id'    => $user['role_id'],
                    'hub'    => $user['hub'],
                    'isLoggedIn' => true
                ]);
                return redirect()->to(base_url('/dashboard'));
            } else {
                session()->setFlashdata('error', 'Invalid username or password.');
                return redirect()->to(base_url('/login'));
            }
        } else {
            session()->setFlashdata('error', 'Invalid attempt.');
            return redirect()->to(base_url('/login'));
        }
    }


    public function dashboard()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }
        $menuModel = new MenuModel();
        $menus = $this->getMenus();
        $all_menus = $menuModel->getAllMenus();
        $menus = $this->getMenus();
        $loggedInEmail = session()->get('email'); // assuming you store email in session
        $familyModel = new \App\Models\FamilyModel();
        $family = $familyModel->where('family_email', $loggedInEmail)->first();
        if (!$family) {            // Optional: Handle if the email is not linked to any family
            $members = '';
        } else {
            session()->set([
                'family_id'    => $family['family_id'],
                'family_code'  => $family['family_code'],
                'family_name'  => $family['family_name'],
            ]);

            $memberModel = new \App\Models\FamilyMemberModel();
            $members = $memberModel->where('family_id', $family['family_id'])->findAll();
        }
        return view('admin_layout', [
            'menus' => $menus,
            'family' => $family,
            'members' => $members
        ]);
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/login'));
    }
}
