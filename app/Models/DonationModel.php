<?php

namespace App\Models;

use CodeIgniter\Model;

class DonationModel extends Model
{
    protected $table = 'donations';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'family_id', 'purpose_id', 'amount', 'donation_date', 'notes'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
}
