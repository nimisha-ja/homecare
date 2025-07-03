<?php

namespace App\Models;

use CodeIgniter\Model;

class CertificateRequestModel extends Model
{
    protected $table = 'certificate_requests';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'family_id',
        'certificate_type',
        'details',
        'status','certificate_file',
        'created_at',
        'updated_at'
    ];
}
