<?php

namespace App\Models;

use CodeIgniter\Model;

class DonationPurposeModel extends Model
{
    protected $table = 'donation_purposes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'description', 'is_active'];
    protected $useTimestamps = false;
}
