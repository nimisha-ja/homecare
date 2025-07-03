<?php namespace App\Models;

use CodeIgniter\Model;

class FamilyModel extends Model
{
    protected $table = 'families';
    protected $primaryKey = 'family_id';
    protected $allowedFields = [
        'family_code', 'family_name', 'head_of_family', 'members_count',
        'address', 'contact_number', 'registered_on', 'photo','family_email', 'password'
    ];
    protected $useTimestamps = false;
}
