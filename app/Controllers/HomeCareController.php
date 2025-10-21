<?php

namespace App\Controllers;

use App\Models\FamilyModel;
use App\Models\FamilyMemberModel;
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\RoleModel;
use TCPDF;
use App\Models\MenuModel;
use App\Models\MenuRoleModel;
use App\Controllers\CustomPDF;
use App\Models\CertificateRequestModel;
use App\Models\AnnouncementModel;
use App\Models\DonationPurposeModel;
use App\Models\DonationModel;
use App\Models\ClientModel;
use App\Models\StaffModel;
use App\Models\ClientStaffAssignmentModel;

class HomeCareController extends Controller
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
        $model = new ClientModel();
        $clients = $model->findAll();
        $clientModel = new \App\Models\ClientModel();
        $data['clients'] = $clientModel->paginate(10);
        $data['pager'] = $clientModel->pager;
        $menus = $this->getMenus();
        $data['menus'] = $menus;
        return view('homecare/index', $data);
    }


    public function create()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }
        $familyModel = new FamilyModel();
        $families = $familyModel->findAll();
        $menus = $this->getMenus();
        return view('homecare/create', ['menus' => $menus]);
    }
    public function store()
    {
        helper(['form', 'url']);

        $validationRules = [
            'care_home_name'         => 'required|string|max_length[255]',
            'email'                  => 'permit_empty|valid_email',
            'accounts_email'         => 'permit_empty|valid_email',
            'contract_file'          => 'permit_empty|uploaded[contract_file]|max_size[contract_file,5120]|ext_in[contract_file,pdf,doc,docx]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Validation failed: ' . implode(' ', $this->validator->getErrors()));
        }

        $model = new ClientModel();

        // Handle file upload
        $file = $this->request->getFile('contract_file');
        $contractFileName = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $uploadPath = FCPATH . 'uploads/contracts';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $file->move($uploadPath, $newName);
            $contractFileName = $newName;
        } elseif ($file && !$file->isValid()) {
            return redirect()->back()->with('error', 'Please upload a valid contract file.');
        }

        // Prepare data
        $data = [
            'care_home_name'          => $this->request->getPost('care_home_name'),
            'provider_name'           => $this->request->getPost('provider_name'),
            'address'                 => $this->request->getPost('address'),
            'post_code'               => $this->request->getPost('post_code'),
            'manager_name'            => $this->request->getPost('manager_name'),
            'phone_number'            => $this->request->getPost('phone_number'),
            'email'                   => $this->request->getPost('email'),
            'accounts_email'          => $this->request->getPost('accounts_email'),

            // HCA Rates
            'hca_weekday_day'         => $this->request->getPost('hca_weekday_day'),
            'hca_weekday_night'       => $this->request->getPost('hca_weekday_night'),
            'hca_weekend_day'         => $this->request->getPost('hca_weekend_day'),
            'hca_weekend_night'       => $this->request->getPost('hca_weekend_night'),
            'hca_bank_holiday'        => $this->request->getPost('hca_bank_holiday'),

            // Nurse Rates
            'nurse_weekday_day'       => $this->request->getPost('nurse_weekday_day'),
            'nurse_weekday_night'     => $this->request->getPost('nurse_weekday_night'),
            'nurse_weekend_day'       => $this->request->getPost('nurse_weekend_day'),
            'nurse_weekend_night'     => $this->request->getPost('nurse_weekend_night'),
            'nurse_bank_holiday'      => $this->request->getPost('nurse_bank_holiday'),

            // Special Rates
            'special_rate_below_8hrs' => $this->request->getPost('special_rate_below_8hrs'),
            'special_rate_above_8hrs' => $this->request->getPost('special_rate_above_8hrs'),
            'special_weekday_day' => $this->request->getPost('special_weekday_day'),
            'special_weekday_night' => $this->request->getPost('special_weekday_night'),
            'special_weekend_day' => $this->request->getPost('special_weekend_day'),
            'special_weekend_night' => $this->request->getPost('special_weekend_night'),
            'special_bank_holiday' => $this->request->getPost('special_bank_holiday'),
            'special_early_shift' => $this->request->getPost('special_early_shift'),
            'special_late_shift' => $this->request->getPost('special_late_shift'),
            // Uploaded file
            'contract_file' => $contractFileName
        ];

        try {
            $model->insert($data);
            return redirect()->to('/clients')->with('success', 'Client added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error saving client: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $clientModel = new \App\Models\ClientModel();
        $client = $clientModel->find($id);

        if (!$client) {
            return redirect()->to('/clients')->with('error', 'Client not found');
        }

        $data['client'] = $client;
        $data['menus'] = $this->getMenus();

        return view('homecare/edit', $data);
    }

    // public function update($id)
    // {
    //     $clientModel = new \App\Models\ClientModel();
    //     $client = $clientModel->find($id);

    //     if (!$client) {
    //         return redirect()->to('/clients')->with('error', 'Client not found');
    //     }

    //     $validation = \Config\Services::validation();

    //     $rules = [
    //         'care_home_name' => 'required',
    //         'provider_name' => 'required',
    //         'manager_name' => 'required',
    //         'phone_number' => 'required',
    //         'email' => 'required|valid_email',
    //         'post_code' => 'required',
    //     ];

    //     if (!$this->validate($rules)) {
    //         return redirect()->back()->withInput()->with('error', $validation->listErrors());
    //     }

    //     $data = [
    //         'care_home_name' => $this->request->getPost('care_home_name'),
    //         'provider_name' => $this->request->getPost('provider_name'),
    //         'manager_name' => $this->request->getPost('manager_name'),
    //         'phone_number' => $this->request->getPost('phone_number'),
    //         'email' => $this->request->getPost('email'),
    //         'post_code' => $this->request->getPost('post_code'),
    //         'accounts_email' => $this->request->getPost('accounts_email'),
    //     ];

    //     // Handle contract upload
    //     $file = $this->request->getFile('contract_file');
    //     if ($file && $file->isValid() && !$file->hasMoved()) {
    //         $newName = $file->getRandomName();
    //         $file->move(FCPATH . 'uploads/contracts', $newName);
    //         $data['contract_file'] = $newName;
    //     }

    //     $clientModel->update($id, $data);

    //     return redirect()->to('/clients')->with('success', 'Client updated successfully.');
    // }
    public function update($id = null)

    {



        $clientModel = new \App\Models\ClientModel();
        $client = $clientModel->find($id);

        if (!$client) {
            return redirect()->to('/clients')->with('error', 'Client not found');
        }

        $validation = \Config\Services::validation();

        $rules = [
            'care_home_name' => 'required',
            'provider_name' => 'required',
            'manager_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|valid_email',
            'post_code' => 'required',
            // Add validation rules for the new fields if needed
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        $data = [
            'care_home_name' => $this->request->getPost('care_home_name'),
            'provider_name' => $this->request->getPost('provider_name'),
            'manager_name' => $this->request->getPost('manager_name'),
            'phone_number' => $this->request->getPost('phone_number'),
            'email' => $this->request->getPost('email'),
            'post_code' => $this->request->getPost('post_code'),
            'accounts_email' => $this->request->getPost('accounts_email'),

            // Special Rates fields
            'special_weekday_day' => $this->request->getPost('special_weekday_day'),
            'special_weekday_night' => $this->request->getPost('special_weekday_night'),
            'special_weekend_day' => $this->request->getPost('special_weekend_day'),
            'special_weekend_night' => $this->request->getPost('special_weekend_night'),
            'special_bank_holiday' => $this->request->getPost('special_bank_holiday'),
            'special_early_shift' => $this->request->getPost('special_early_shift'),
            'special_late_shift' => $this->request->getPost('special_late_shift'),
            'special_rate_below_8hrs' => $this->request->getPost('special_rate_below_8hrs'),
            'special_rate_above_8hrs' => $this->request->getPost('special_rate_above_8hrs'),
        ];

        // Handle contract upload
        $file = $this->request->getFile('contract_file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/contracts', $newName);
            $data['contract_file'] = $newName;
        }

        $clientModel->update($id, $data);
        return redirect()->to('/clients')->with('success', 'Client updated successfully.');

        return redirect()->to('/clients')->with('success', 'Client updated successfully.');
    }

    public function delete($id)
    {
        $clientModel = new \App\Models\ClientModel();
        $client = $clientModel->find($id);

        if (!$client) {
            return redirect()->to('/clients')->with('error', 'Client not found');
        }
        if (!empty($client['contract_file'])) {
            $filePath = FCPATH . 'uploads/contracts/' . $client['contract_file'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $clientModel->delete($id);

        return redirect()->to('/clients')->with('success', 'Client deleted successfully.');
    }
    public function staff()
    {
        $staffModel = new StaffModel();
        $data['staffs'] = $staffModel->findAll();  // get all staff

        return view('staffs/index', $data);
    }

    // Show form to add new staff
    public function createStaff()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }
        $menus = $this->getMenus();
        return view('homecare/createstaff', ['menus' => $menus]);
    }

    // Save new staff data from the form
    public function storeStaff()
    {
        $staffModel = new \App\Models\StaffModel();

        // Validate form fields
        if (!$this->validate([
            'full_name'         => 'required',
            'current_address'   => 'required',
            'permanent_address' => 'required',
            'phone_number'      => 'required',
            'email' => 'required|valid_email|is_unique[clients.email,id,{id}]',
            'salary'            => 'required|numeric',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // File upload helper (can later move to private method)
        $uploadFile = function (string $field, string $folder): ?string {
            $file = $this->request->getFile($field);

            if ($file && $file->isValid() && !$file->hasMoved()) {
                $fileName = $file->getRandomName();
                $uploadPath = FCPATH . 'uploads/' . $folder;

                // Ensure folder exists
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                $file->move($uploadPath, $fileName);
                return $fileName;
            }

            return null;
        };

        // Handle file uploads
        $passportFile             = $uploadFile('passport_file', 'passports');
        $dbsFile                  = $uploadFile('dbs_file', 'dbs');
        $brpFile                  = $uploadFile('brp_file', 'brps');
        $applicationFormFile      = $uploadFile('application_form_file', 'application_forms');
        $checklistFile            = $uploadFile('checklist_file', 'checklists');
        $trainingCertificateFile  = $uploadFile('training_certificate_file', 'training_certificates');
        $reference1File           = $uploadFile('reference_1_file', 'references');
        $reference2File           = $uploadFile('reference_2_file', 'references');
        $passportPhotoFile        = $uploadFile('passport_photo_file', 'passport_photos');
        $bankStatementFile        = $uploadFile('bank_statement_file', 'bank_statements');

        // Prepare data
        $data = [
            'full_name'                 => $this->request->getPost('full_name'),
            'current_address'           => $this->request->getPost('current_address'),
            'permanent_address'         => $this->request->getPost('permanent_address'),
            'phone_number'              => $this->request->getPost('phone_number'),
            'email'                     => $this->request->getPost('email'),
            'salary'                    => $this->request->getPost('salary'),
            'visa_type'                 => $this->request->getPost('visa_type'),
            'passport_no'               => $this->request->getPost('passport_no'),
            'passport_file'             => $passportFile,
            'dbs_file'                  => $dbsFile,
            'brp_file'                  => $brpFile,
            'application_form_file'     => $applicationFormFile,
            'checklist_file'            => $checklistFile,
            'training_certificate_file' => $trainingCertificateFile,
            'reference_1_file'          => $reference1File,
            'reference_2_file'          => $reference2File,
            'passport_photo_file'       => $passportPhotoFile,
            'bank_statement_file'       => $bankStatementFile,
            'passport_expiry'           => $this->request->getPost('passport_expiry'),
            'dbs_expiry'                => $this->request->getPost('dbs_expiry'),
            'training_expiry'           => $this->request->getPost('training_expiry'),
        ];

        // Save to database
        if (!$staffModel->insert($data)) {
            return redirect()->back()->withInput()->with('error', 'Failed to save staff data.');
        }

        return redirect()->to('/staffs')->with('success', 'Staff added successfully!');
    }

    public function stafflist()
    {
        $staffModel = new \App\Models\StaffModel();
        $data['staffs'] = $staffModel->orderBy('id', 'DESC')->findAll(); // optional sorting
        $menus = $this->getMenus();
        $data['menus'] = $menus;
        return view('homecare/stafflist', $data);
    }

    public function editStaff($id)
    {
        $staffModel = new \App\Models\StaffModel();
        $staff = $staffModel->find($id);

        if (!$staff) {
            return redirect()->to('/staffs')->with('error', 'Staff not found');
        }
        $menus = $this->getMenus();
        return view('homecare/staffedit', ['staff' => $staff, 'menus' => $menus]);
    }



    public function updateStaff($id)
    {
        $staffModel = new \App\Models\StaffModel();

        // Validate form inputs
        if (!$this->validate([
            'full_name'         => 'required',
            'current_address'   => 'required',
            'permanent_address' => 'required',
            'phone_number'      => 'required',
            'email' => 'required|valid_email|is_unique[clients.email,id,{id}]',
            'salary'            => 'required|numeric',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Get existing staff record
        $staff = $staffModel->find($id);
        if (!$staff) {
            return redirect()->to('/staffs')->with('error', 'Staff not found.');
        }

        // Upload helper (should be moved to private method ideally)
        $uploadFile = function (string $field, string $folder, $existingFile = null): ?string {
            $file = $this->request->getFile($field);

            if ($file && $file->isValid() && !$file->hasMoved()) {
                $fileName = $file->getRandomName();
                $uploadPath = FCPATH . 'uploads/' . $folder;

                // Ensure folder exists
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                $file->move($uploadPath, $fileName);
                return $fileName;
            } elseif ($file && !$file->isValid()) {
            }

            // No new upload, keep old
            return $existingFile;
        };

        // Process file uploads
        $passportFile             = $uploadFile('passport_file', 'passports', $staff['passport_file']);
        $dbsFile                  = $uploadFile('dbs_file', 'dbs', $staff['dbs_file']);
        $brpFile                  = $uploadFile('brp_file', 'brps', $staff['brp_file']);
        $applicationFormFile      = $uploadFile('application_form_file', 'application_forms', $staff['application_form_file']);
        $checklistFile            = $uploadFile('checklist_file', 'checklists', $staff['checklist_file']);
        $trainingCertificateFile  = $uploadFile('training_certificate_file', 'training_certificates', $staff['training_certificate_file']);
        $reference1File           = $uploadFile('reference_1_file', 'references', $staff['reference_1_file']);
        $reference2File           = $uploadFile('reference_2_file', 'references', $staff['reference_2_file']);
        $passportPhotoFile        = $uploadFile('passport_photo_file', 'passport_photos', $staff['passport_photo_file']);
        $bankStatementFile        = $uploadFile('bank_statement_file', 'bank_statements', $staff['bank_statement_file']);

        // Prepare update data
        $data = [
            'full_name'                 => $this->request->getPost('full_name'),
            'current_address'           => $this->request->getPost('current_address'),
            'permanent_address'         => $this->request->getPost('permanent_address'),
            'phone_number'              => $this->request->getPost('phone_number'),
            'email'                     => $this->request->getPost('email'),
            'salary'                    => $this->request->getPost('salary'),
            'visa_type'                 => $this->request->getPost('visa_type'),
            'passport_no'               => $this->request->getPost('passport_no'),
            'passport_file'             => $passportFile,
            'dbs_file'                  => $dbsFile,
            'brp_file'                  => $brpFile,
            'application_form_file'     => $applicationFormFile,
            'checklist_file'            => $checklistFile,
            'training_certificate_file' => $trainingCertificateFile,
            'reference_1_file'          => $reference1File,
            'reference_2_file'          => $reference2File,
            'passport_photo_file'       => $passportPhotoFile,
            'bank_statement_file'       => $bankStatementFile,
            'passport_expiry'           => $this->request->getPost('passport_expiry'),
            'dbs_expiry'                => $this->request->getPost('dbs_expiry'),
            'training_expiry'           => $this->request->getPost('training_expiry'),
        ];

        // Update the staff record
        if (!$staffModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('error', 'Failed to update staff details.');
        }

        return redirect()->to('/staffs')->with('success', 'Staff updated successfully!');
    }

    public function deleteStaff($id)
    {
        $staffModel = new \App\Models\StaffModel();
        $staff = $staffModel->find($id);

        if (!$staff) {
            return redirect()->to('/staffs')->with('error', 'Staff not found');
        }

        $staffModel->delete($id);

        return redirect()->to('/staffs')->with('success', 'Staff deleted successfully!');
    }

    public function assign()
    {
        $clientModel = new ClientModel();
        $staffModel = new StaffModel();
        $data['clients'] = $clientModel->findAll();
        $data['staff'] = $staffModel->findAll();        // Get menus properly
        $data['menus'] = $this->getMenus();
        return view('homecare/assignments_create', $data);
    }

    public function saveAssignment()
    {
        $assignmentModel = new ClientStaffAssignmentModel();

        $staffId = $this->request->getPost('staff_id');
        $clientId = $this->request->getPost('client_id');
        $shiftDate = $this->request->getPost('shift_date');
        $startTime = $this->request->getPost('start_time');
        $endTime = $this->request->getPost('end_time');

        // Check availability
        if (!$assignmentModel->isStaffAvailable($staffId, $shiftDate, $startTime, $endTime)) {
            return redirect()->back()->withInput()->with('error', 'Staff is already assigned to another shift at that time.');
        }

        // Proceed to save
        $assignmentModel->save([
            'client_id' => $clientId,
            'staff_id' => $staffId,
            'shift_date' => $shiftDate,
            'shift_type' => $this->request->getPost('shift_type'),
            'start_time' => $startTime,
            'end_time' => $endTime
        ]);

        return redirect()->to('/listassignments')->with('success', 'Staff assigned successfully.');
    }

    // public function saveAssignment()
    // {
    //     $assignmentModel = new ClientStaffAssignmentModel();
    //     $assignmentModel->save([
    //         'client_id' => $this->request->getPost('client_id'),
    //         'staff_id' => $this->request->getPost('staff_id'),
    //         'shift_date' => $this->request->getPost('shift_date'),
    //         'shift_type' => $this->request->getPost('shift_type'),
    //         'start_time' => $this->request->getPost('start_time'),
    //         'end_time' => $this->request->getPost('end_time'),
    //     ]);
    //     return redirect()->to('/listassignments')->with('success', 'Assignment added successfully.');
    // }
    public function listAssignments()
    {
        $assignmentModel = new ClientStaffAssignmentModel();

        $perPage = 10;
        $data['assignments'] = $assignmentModel->getAssignmentsWithDetailsPaginated($perPage);
        $data['pager'] = $assignmentModel->pager;
        $data['menus'] = $this->getMenus();

        return view('homecare/assignments_list', $data);
    }
    public function deleteAssignments($id)
    {
        $assignmentModel = new ClientStaffAssignmentModel();

        if ($assignmentModel->delete($id)) {
            return redirect()->to(site_url('listassignments'))->with('success', 'Assignment deleted successfully.');
        } else {
            return redirect()->to(site_url('listassignments'))->with('error', 'Failed to delete assignment.');
        }
    }
    public function editAssignments($id)
    {
        $assignmentModel = new ClientStaffAssignmentModel();
        $clientModel = new ClientModel();
        $staffModel = new StaffModel();

        $assignment = $assignmentModel->find($id);

        if (!$assignment) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Assignment not found: ID $id");
        }

        $data = [
            'assignment' => $assignment,
            'clients'    => $clientModel->findAll(),
            'staff'      => $staffModel->findAll(),
            'menus'      => $this->getMenus(),
        ];

        return view('homecare/assignments_edit', $data);
    }

    //     public function updateAssignments($id)
    //     {
    //         $assignmentModel = new ClientStaffAssignmentModel();

    //         $data = [
    //             'client_id'  => $this->request->getPost('client_id'),
    //             'staff_id'   => $this->request->getPost('staff_id'),
    //             'shift_date' => $this->request->getPost('shift_date'),
    //             'shift_type' => $this->request->getPost('shift_type'),
    //             'start_time' => $this->request->getPost('start_time'),
    //             'end_time'   => $this->request->getPost('end_time'),
    //         ];
    // // if (!$assignmentModel->isStaffAvailable($staffId, $shiftDate, $startTime, $endTime, $id)) {
    // //     return redirect()->back()->withInput()->with('error', 'Staff is already assigned to another shift at that time.');
    // // }

    //         if ($assignmentModel->update($id, $data)) {
    //             return redirect()->to(site_url('listassignments'))->with('success', 'Assignment updated successfully.');
    //         } else {
    //             return redirect()->back()->with('error', 'Failed to update assignment.')->withInput();
    //         }
    //     }

    public function updateAssignments($id)
    {
        $assignmentModel = new ClientStaffAssignmentModel();

        $staffId   = $this->request->getPost('staff_id');
        $clientId  = $this->request->getPost('client_id');
        $shiftDate = $this->request->getPost('shift_date');
        $shiftType = $this->request->getPost('shift_type');
        $startTime = $this->request->getPost('start_time');
        $endTime   = $this->request->getPost('end_time');

        // Check if the staff is available for new time (excluding this assignment)
        if (!$assignmentModel->isStaffAvailable($staffId, $shiftDate, $startTime, $endTime, $id)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Staff is already assigned to another shift at that time.');
        }

        $data = [
            'client_id'  => $clientId,
            'staff_id'   => $staffId,
            'shift_date' => $shiftDate,
            'shift_type' => $shiftType,
            'start_time' => $startTime,
            'end_time'   => $endTime,
        ];

        if ($assignmentModel->update($id, $data)) {
            return redirect()->to(site_url('listassignments'))->with('success', 'Assignment updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update assignment.')->withInput();
        }
    }
    public function getAssignments()
    {
        $assignmentModel = new \App\Models\ClientStaffAssignmentModel();
        $clientModel     = new \App\Models\ClientModel();
        $staffModel      = new \App\Models\StaffModel();
        $date       = $this->request->getGet('date');
        $clientId   = $this->request->getGet('client_id');
        $shiftType  = $this->request->getGet('shift_type');
        $staffId    = $this->request->getGet('staff_id');
        $builder = $assignmentModel
            ->select('client_staff_assignments.*, clients.care_home_name AS client_name, staff.full_name AS staff_name')
            ->join('clients', 'clients.id = client_staff_assignments.client_id')
            ->join('staff', 'staff.id = client_staff_assignments.staff_id');
        if ($date) {
            $builder->where('shift_date', $date);
        }

        if ($clientId) {
            $builder->where('client_id', $clientId);
        }

        if ($shiftType) {
            $builder->where('shift_type', $shiftType);
        }

        if ($staffId) {
            $builder->where('staff_id', $staffId);
        }
        $assignments = $builder->findAll();
        $clients = $clientModel->findAll();
        if ($date && $shiftType) {
            $availableStaff = $staffModel->getAvailableStaffForShift($date, $shiftType);
            if ($staffId && !in_array($staffId, array_column($availableStaff, 'id'))) {
                $selectedStaff = $staffModel->find($staffId);
                if ($selectedStaff) {
                    $availableStaff[] = $selectedStaff;
                }
            }
        } else {
            $availableStaff = $staffModel->findAll();
        }

        usort($availableStaff, function ($a, $b) {
            return strcmp($a['full_name'], $b['full_name']);
        });
        return view('homecare/assignments_list_view', [
            'assignments'  => $assignments,
            'clients'      => $clients,
            'staff'        => $availableStaff,
            'date'         => $date,
            'client_id'    => $clientId,
            'shift_type'   => $shiftType,
            'staff_id'     => $staffId,
            'menus'        => $this->getMenus(),
        ]);
    }
}
