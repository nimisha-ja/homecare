<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffModel extends Model
{
    protected $table = 'staff';              // Your table name
    protected $primaryKey = 'id';            // Primary key

    protected $allowedFields = [
        'full_name',
        'current_address',
        'permanent_address',
        'phone_number',
        'email',
        'salary','visa_type',
        'passport_file',
        'dbs_file',
        'brp_file',
        'application_form_file',
        'checklist_file',
        'training_certificate_file',
        'reference_1_file',
        'reference_2_file',
        'passport_photo_file',
        'bank_statement_file',
    ];

    protected $useTimestamps = true;         // Enable automatic timestamps
    protected $createdField  = 'created_at'; // DB field for created_at
    protected $updatedField  = 'updated_at'; // DB field for updated_at

    public function getAvailableStaffForShift($date, $shift_type)
    {
        $builder = $this->db->table('staff s');
        $builder->select('s.id, s.full_name');
        $builder->join(
            'client_staff_assignments csa',
            "s.id = csa.staff_id AND csa.shift_date = " . $this->db->escape($date) . " AND csa.shift_type = " . $this->db->escape($shift_type),
            'left'
        );
        $builder->where('csa.id IS NULL'); // Not assigned

        return $builder->get()->getResultArray();
    }
}
