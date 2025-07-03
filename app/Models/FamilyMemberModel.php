<?php namespace App\Models;

use CodeIgniter\Model;

class FamilyMemberModel extends Model
{
    protected $table = 'family_members';
    protected $primaryKey = 'member_id';
    protected $allowedFields = [
        'family_id', 'full_name', 'relation_to_head', 'date_of_birth',
        'gender', 'job', 'education', 'current_status'
    ];
    protected $useTimestamps = false;
}
