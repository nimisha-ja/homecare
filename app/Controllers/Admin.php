<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\StaffModel;
use App\Models\ExpenseCategoryModel;
use App\Models\ExpenseModel;
use App\Models\DeliveryModel;
use App\Models\PaymentModel;
use App\Models\HubModel;
use App\Models\IncomeModel;
use App\Models\BasicPayModel;
use TCPDF;
use App\Models\IncomeCategoryModel;
use App\Models\InventoryModel;
use App\Models\ReturnPickupModel;
use App\Models\MenuModel;
use App\Models\MenuRoleModel;
use App\Models\SalaryHistoryModel;
use App\Models\SalaryCycleModel;
use App\Controllers\CustomPDF;


class Admin extends Controller
{
    protected $db;
    protected $menuModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->menuModel = new MenuModel();
    }
    protected function getMenus()
    {
        $role_id = session()->get('role_id');
        return $this->menuModel->getMenus($role_id);
    }
    public function index()
    {

        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }
        return redirect()->to(base_url('/dashboard'));
    }

    public function addPrivilages()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }
        $pager = \Config\Services::pager();
        $hubModel = new HubModel();
        $menuModel = new MenuModel();
        $menus = $this->getMenus();
        $all_menus = $menuModel->getAllMenus();
        $roleModel = new RoleModel();
        $userModel = new UserModel();
        $users = $userModel->getUsersWithRole();
        $roles = $roleModel->getAllRoles();
        return view('add_privilages', [
            'title' => 'Hubs List',
            'users' => $users,
            'roles' => $roles,
            'menus' => $menus,
            'all_menus' => $all_menus
        ]);
    }
    public function savePrivileges()
    {
        $role_id = $this->request->getPost('role_id');
        $menu_ids = $this->request->getPost('menu_ids');
        if (!$role_id || empty($menu_ids)) {
            session()->setFlashdata('error', 'Please select a user and assign at least one menu.');
            return redirect()->to(base_url('/listPrivileges'));
        }
        $userModel = new UserModel();
        $menuRoleModel = new MenuRoleModel();
        $menuRoleModel->deleteUserPrivileges($role_id);
        foreach ($menu_ids as $menu_id) {
            $data = [
                'role_id' => $role_id,
                'menu_id' => $menu_id
            ];
            if (!$menuRoleModel->save($data)) {
                echo 'Error: Failed to save menu role: ' . json_encode($data);
                echo '<br>';
                echo 'DB Error: ' . json_encode($this->db->error());
                exit;
            } else {
                // echo 'Successfully saved menu role: ' . json_encode($data);
            }
        }
        session()->setFlashdata('success', 'Privileges successfully assigned!');
        return redirect()->to(base_url('/listPrivileges'));
    }

    public function listPrivileges()
    {
        $menuModel = new MenuModel();
        $menuRoleModel = new MenuRoleModel();
        $menus = $this->getMenus();
        $limit = 100;
        $page = $this->request->getVar('page') ?: 1;
        $offset = ($page - 1) * $limit;
        $privileges = $menuRoleModel->getAllPrivileges($limit, $offset);
        $total = $menuRoleModel->countAllResults();
        $pager = \Config\Services::pager();
        return view('list_privileges', [
            'privileges' => $privileges,
            'menus' => $menus,
            'pager' => $pager,
            'total' => $total
        ]);
    }

    public function getHubs()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }
        $pager = \Config\Services::pager();
        $hubModel = new HubModel();
        $perPage = 10;
        $currentPage = $this->request->getVar('page') ?? 1;;
        $hubs = $hubModel->getHubslist($perPage, $currentPage);
        $menuModel = new MenuModel();
        $menus = $this->getMenus();
        return view('hubs_list', [
            'title' => 'Hubs List',
            'hubs' => $hubs,
            'pager' => $pager,
            'menus' => $menus
        ]);
    }
    public function addHub()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }
        $menus = $this->getMenus();
        return view('add_hub', ['menus' => $menus]);
    }
    public function createHub()
    {
        $hubModel = new HubModel();
        $data = [
            'hub_name' => $this->request->getVar('hub'),
        ];
        if ($hubModel->insert($data)) {
            session()->setFlashdata('success', 'User has been added successfully.');
            return redirect()->to(base_url('/hubslist'));
        } else {
            session()->setFlashdata('error', 'Something went wrong while adding the user.');
            return redirect()->to(base_url('/hubslist'));
        }
    }
    public function deleteHub($id)
    {
        $hubModel = new HubModel();
        $hub = $hubModel->find($id);
        if (!$hub) {
            session()->setFlashdata('error', 'Hub not found.');
            return redirect()->to(base_url('/hubslist'));
        }
        if ($hubModel->delete($id)) {
            session()->setFlashdata('success', 'Hub deleted successfully.');
        } else {
            session()->setFlashdata('error', 'There was a problem deleting the hub.');
        }
        return redirect()->to(base_url('/hubslist'));
    }

    public function editHub($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }
        $hubModel = new HubModel();
        $hub = $hubModel->find($id);
        if (!$hub) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Hub with hub_id $id not found.");
        }
        $hubs = $hubModel->findAll();
        $menus = $this->getMenus();
        return view('edit_hub', [
            'hubs' => $hubs,
            'chub' => $hub,
            'menus' => $menus,
        ]);
    }

    public function updateHub($id)
    {
        $hubModel = new HubModel();
        $hub = $hubModel->find($id);
        if (!$hub) {
            session()->setFlashdata('error', 'Hub not found.');
            return redirect()->to('/hubslist');
        }
        $data = [
            'hub_name' => $this->request->getVar('hub'),
        ];
        if ($hubModel->update($id, $data)) {
            session()->setFlashdata('success', 'Hub updated successfully.');
        } else {
            session()->setFlashdata('error', 'There was a problem updating the hub.');
        }
        return redirect()->to(base_url('/hubslist'));
    }
    public function getUsersWithRoles()
    {

        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }
        $pager = \Config\Services::pager();
        $userModel = new UserModel();
        $roleModel = new RoleModel();
        $perPage = 10;
        $currentPage = $this->request->getVar('page') ?? 1;;
        $users = $userModel->getUsersWithRolesnHubs($perPage, $currentPage);
        $menus = $this->getMenus();
        return view('users_list', [
            'title' => 'Users List',
            'menus' => $menus,
            'users' => $users,
            'pager' => $pager
        ]);
    }
    public function addUser()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }
        $roleModel = new RoleModel();
        $roles = $roleModel->findAll();
        $hubModel = new HubModel();
        $hubs = $hubModel->findAll();
        $menus = $this->getMenus();
        return view('add_user', ['roles' => $roles, 'hubs' => $hubs, 'menus' => $menus,]);
    }

    public function create()
    {
        $userModel = new UserModel();
        $roleModel = new RoleModel();
        $roles = $roleModel->findAll();
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'username' => [
                    'label' => 'Name',
                    'rules' => 'required|min_length[3]|max_length[255]', // Allow duplicate names
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email|is_unique[users.email]', // Ensure email is unique
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required', // Password must be at least 8 characters long
                ],
                'role_id' => [
                    'label' => 'Role',
                    'rules' => 'required|is_natural_no_zero', // Role must be selected
                ],

            ];
            if (!$this->validate($rules)) {
                $validationErrors = \Config\Services::validation()->getErrors();
                $error = isset($validationErrors['username']) ? $validationErrors['username'] : '';
                $error .= isset($validationErrors['email']) ? $validationErrors['email'] : '';
                $error .= isset($validationErrors['password']) ? $validationErrors['password'] : '';
                $error .= isset($validationErrors['role_id']) ? $validationErrors['role_id'] : '';
                session()->setFlashdata('error', $error);
                return redirect()->to(base_url('/useraccounts'));
            }
            $data = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'role_id' => $this->request->getPost('role_id'),
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            if ($userModel->insert($data)) {
                session()->setFlashdata('success', 'User has been added successfully.');
                return redirect()->to(base_url('/useraccounts'));
            } else {
                session()->setFlashdata('error', 'Something went wrong while adding the user.');
                return redirect()->to(base_url('/useraccounts'));
            }
        }
    }

    public function deleteuser($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);
        if (!$user) {
            session()->setFlashdata('error', 'User not found.');
            return redirect()->to(base_url('/useraccounts'));
        }
        if ($userModel->delete($id)) {
            session()->setFlashdata('success', 'User deleted successfully.');
        } else {
            session()->setFlashdata('error', 'There was a problem deleting the user.');
        }
        return redirect()->to(base_url('/useraccounts'));
    }

    public function editUser($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }
        $userModel = new UserModel();
        $user = $userModel->find($id);
        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("User with id $id not found.");
        }
        $roleModel = new RoleModel();
        $roles = $roleModel->findAll();
        $hubModel = new HubModel();
        $hubs = $hubModel->findAll();
        $menus = $this->getMenus();
        return view('edit_user', [
            'user' => $user,
            'roles' => $roles,
            'hubs' => $hubs,
            'menus' => $menus,
        ]);
    }
    public function updateUser($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);
        if (!$user) {
            session()->setFlashdata('error', 'User not found.');
            return redirect()->to('/useraccounts');
        }
        $rules = [
            'username' => 'required|min_length[3]|max_length[50]',
            'email' => 'required|valid_email|is_unique[users.email,id,' . $id . ']',  // Ensure email is unique, excluding current user
            'role_id' => 'required|is_natural_no_zero',
            'hub' => 'required|is_natural_no_zero',
        ];

        if (!$this->validate($rules)) {
            $validationErrors = \Config\Services::validation()->getErrors(); // print_r($validationErrors);exit;
            $error = isset($validationErrors['username']) ? $validationErrors['username'] : '';
            $error .= isset($validationErrors['email']) ? $validationErrors['email'] : '';
            $error .= isset($validationErrors['password']) ? $validationErrors['password'] : '';
            $error .= isset($validationErrors['role_id']) ? $validationErrors['role_id'] : '';
            $error .= isset($validationErrors['hub']) ? $validationErrors['hub'] : '';
            session()->setFlashdata('error', $error); // Set the error in session flashdata
            return redirect()->to(base_url('/useraccounts')); //
        }

        $data = [
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'role_id' => $this->request->getVar('role_id'),
            'hub' => $this->request->getVar('hub'),
        ];
        if ($this->request->getVar('password')) {
            $data['password'] = $this->request->getVar('password');
        }
        if ($userModel->update($id, $data)) {
            session()->setFlashdata('success', 'User updated successfully.');
        } else {
            session()->setFlashdata('error', 'There was a problem updating the user.');
        }
        return redirect()->to(base_url('/useraccounts'));
    }

    public function liststaff()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('admin/login'));
        }
        $staffModel = new StaffModel();
        $perPage = 50;
        $role = session()->get('role_id');
        if ($role == 1) {
            $staffData = $staffModel->getStaffWithHubQuery()->paginate($perPage); // Note: getStaffWithHubQuery returns query builder
        } else {
            $hub = session()->get('hub');
            $staffData = $staffModel->getStaffByHubQuery($hub)->paginate($perPage);
        }
        $currentPage = $staffModel->pager->getCurrentPage(); // Get current page number
        $startSerial = ($currentPage - 1) * $perPage + 1;     // Calculate starting serial number
        $data['staff'] = $staffData;
        $data['pager'] = $staffModel->pager;
        $data['menus'] = $this->getMenus();
        $data['startSerial'] = $startSerial;
        return view('staff_list', $data);
    }

    public function downloadStaffPdf()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('admin/login'));
        }
        $staffModel = new StaffModel();
        $role = session()->get('role_id');
        if ($role == 1) {
            $data['staff'] = $staffModel->getStaffWithHub(null, null);
        } else {
            $hub = session()->get('hub');
            $data['staff'] = $staffModel->getStaffbyHub(null, null, $hub);
        }
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator('CodeIgniter 4');
        $pdf->SetAuthor('Your Company Name');
        $pdf->SetTitle('Staff List Report');
        $pdf->SetSubject('List of Staff');
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->AddPage();
        $html = view('pdf/staff_list', $data);
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('staff_list_' . date('Ymd_His') . '.pdf', 'D');
        exit;
    }

    public function addstaff()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }
        $hubModel = new HubModel();
        $hubs = $hubModel->findAll();
        $db = \Config\Database::connect();
        $query = $db->query("SHOW COLUMNS FROM staff LIKE 'status'");
        $column = $query->getRowArray();
        preg_match('/enum\((.*)\)/', $column['Type'], $matches);
        $statusEnum = explode(',', $matches[1]);
        $statusOptions = array_map(function ($value) {
            return trim($value, "'");
        }, $statusEnum);
        $menus = $this->getMenus();
        return view('addstaff', [
            'title' => 'Staff Management',
            'statusOptions' => $statusOptions,
            'hubs' => $hubs,
            'menus' => $menus,
        ]);
    }

    public function staffAdd()
    {
        $image = $this->request->getFile('image');
        if ($image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/staff', $newName);

            if ($image->hasMoved()) {
                $imagePath = 'uploads/staff/' . $newName;
            } else {
                $imagePath = null;
                session()->setFlashdata('error', 'There was a problem adding the staff image.');
                return redirect()->to(base_url('/staffmanagement'));
            }
        } else {
            //$imagePath = 'uploads/staff/default.jpg';
            $imagePath = '';
        }
        $pancardImage = $this->request->getFile('pancard');
        $pancardPath = $this->handleFileUpload($pancardImage);
        $aadhaarImage = $this->request->getFile('aadhaarcard');
        $aadhaarPath = $this->handleFileUpload($aadhaarImage);
        $licenseImage = $this->request->getFile('licence');
        $licensePath = $this->handleFileUpload($licenseImage);
        $insuranceImage = $this->request->getFile('insurance');
        $insurancePath = $this->handleFileUpload($insuranceImage);
        $staffModel = new StaffModel();
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
        ];
        if (!$this->validate($rules)) {
            $validationErrors = \Config\Services::validation()->getErrors();
            $error = isset($validationErrors['name']) ? $validationErrors['name'] : '';
            session()->setFlashdata('error', $error);
            return redirect()->to(base_url('/staffmanagement'));
        }
        $role = session()->get('role_id');
        if ($role == 1) {
            $hub = $this->request->getPost('hub');
        } else {
            $hub = session()->get('hub');
        }
        $data = [
            'name' => $this->request->getVar('name'),
            'nickname' => $this->request->getVar('nickname'),
            'phone' => $this->request->getVar('phone'),
            'hub' => $hub,
            'image' => $imagePath,
            'bankname' => $this->request->getPost('bankname'),
            'bankaccountnumber' => $this->request->getPost('bankaccountnumber'),
            'ifsccode' => $this->request->getPost('ifsc'),
            'status' => $this->request->getVar('status'),
            'pancard' => $pancardPath,
            'aadhaarcard' => $aadhaarPath,
            'licence' => $licensePath,
            'insurance' => $insurancePath,
        ];
        if ($staffModel->insert($data)) {
            session()->setFlashdata('success', 'Staff added successfully.');
            return redirect()->to(base_url('/staffmanagement'));
        } else {
            session()->setFlashdata('error', 'There was a problem adding the staff.');
            return redirect()->to(base_url('/staffmanagement'));
        }
    }


    private function handleFileUpload($image, $defaultPath = '')
    {
        if ($image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();

            $image->move(FCPATH . 'uploads/staff', $newName);

            if ($image->hasMoved()) {
                return 'uploads/staff/' . $newName;
            } else {
                session()->setFlashdata('error', 'There was a problem adding the image.');
                return $defaultPath;
            }
        } else {
            return $defaultPath;
        }
    }


    public function deletestaff($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }

        $staffModel = new StaffModel();
        if ($staffModel->delete($id)) {
            session()->setFlashdata('success', 'Staff deleted successfully.');
        } else {
            session()->setFlashdata('error', 'There was a problem deleting the staff.');
        }
        return redirect()->to(base_url('/staffmanagement'));
    }

    public function editStaff($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }
        $staffModel = new StaffModel();
        $staff = $staffModel->find($id);
        $hubModel = new HubModel();
        $hubs = $hubModel->findAll();
        $db = \Config\Database::connect();
        $query = $db->query("SHOW COLUMNS FROM staff LIKE 'status'");
        $column = $query->getRowArray();
        preg_match('/enum\((.*)\)/', $column['Type'], $matches);
        $statusEnum = explode(',', $matches[1]);
        $statusOptions = array_map(function ($value) {
            return trim($value, "'");
        }, $statusEnum);
        if (!$staff) {
            session()->setFlashdata('error', 'Staff member not found.');
            return redirect()->to('/staffmanagement');
        }
        $menus = $this->getMenus();
        return view('edit_staff', ['staff' => $staff, 'hubs' => $hubs, 'statusOptions' => $statusOptions, 'menus' => $menus]);
    }
    public function updateStaff($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }
        $staffModel = new StaffModel();

        $rules = [
            'name' => 'required|min_length[3]|max_length[50]',
        ];
        if (!$this->validate($rules)) {
            $validationErrors = \Config\Services::validation()->getErrors();
            $error = '';
            $error .= isset($validationErrors['name']) ? $validationErrors['name'] : '';
            session()->setFlashdata('error', $error);
            return redirect()->to(base_url('/staffmanagement'));
        }
        $role = session()->get('role_id');
        if ($role == 1) {
            $hub = $this->request->getPost('hub');
        } else {
            $hub = session()->get('hub');
        }
        $imageFields = ['image', 'pancard', 'aadhaarcard', 'license', 'insurance'];
        $data = [];
        foreach ($imageFields as $field) {
            $image = $this->request->getFile($field);
            if ($image && $image->isValid() && !$image->hasMoved()) {
                $newName = $image->getRandomName();
                $image->move(FCPATH . 'uploads/staff', $newName);
                $data[$field] = 'uploads/staff/' . $newName;
            } else {
                $currentStaff = $staffModel->find($id);
                $data[$field] = $currentStaff[$field] ?? '';
            }
        }
        $data['name'] = $this->request->getVar('name');
        $data['nickname'] = $this->request->getVar('nickname');
        $data['phone'] = $this->request->getVar('phone');
        $data['hub'] = $hub;
        $data['bankname'] = $this->request->getPost('bankname');
        $data['bankaccountnumber'] = $this->request->getPost('bankaccountnumber');
        $data['ifsccode'] = $this->request->getPost('ifsc');
        $data['status'] = $this->request->getVar('status');
        $updateResult = $staffModel->update($id, $data);
        if ($updateResult) {
            session()->setFlashdata('success', 'Staff updated successfully.');
        } else {
            session()->setFlashdata('error', 'There was a problem updating the staff.');
        }
        return redirect()->to(base_url('/staffmanagement'));
    }

    public function viewStaff($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }
        $staffModel = new StaffModel();
        $staff = $staffModel->find($id);
        $roleModel = new RoleModel();
        $roles = $roleModel->findAll();
        $role = $roleModel->find($staff['role_id']);
        $data['staff'] = $staff;
        $staff['role'] = $role ? $role['role_name'] : 'Unknown';
        if (isset($staff['image']) && $staff['image']) {            // Image stored in public/uploads/staff/
        } else {            // Default image or placholder
            $staff['image'] = base_url('uploads/staff/default-image.jpg'); // Add your default image in public/uploads/staff/
        }
        if (!$staff) {
            session()->setFlashdata('error', 'Staff member not found.');
            return redirect()->to(base_url('/staffmanagement'));
        }
        $menus = $this->getMenus();
        return view('view_staff', ['staff' => $staff, 'roles' => $roles, 'menus' => $menus,]);
    }

   
}
