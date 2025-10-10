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
        'salary',
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
}
