<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffModel extends Model
{
    protected $table = 'staff';  // The table to interact with
    protected $primaryKey = 'id';  // Primary key of the table
    protected $allowedFields = ['name','nickname', 'email', 'phone', 'hub', 'image', 'status','pancard','licence','insurance','aadhaarcard','bankaccountnumber','bankname','ifsccode'];  // Fields that can be inserted/updated
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]'
    ];
   public function getStaffWithHub()
    {
        return $this->select('staff.id, staff.name, staff.email, staff.phone, staff.status, hub.hub_name')
            ->join('hub', 'staff.hub = hub.hub_id', 'left')
            ->findAll(); 
    }
    
    public function getStaffbyHub($hub)
    {
        return $this->select('staff.id, staff.name, staff.email, staff.phone, staff.status, hub.hub_name')
            ->where('hub.hub_id', $hub)
            ->join('hub', 'staff.hub = hub.hub_id', 'left')
            ->findAll(); 
    }
    
    
    public function getStaffWithHubQuery()
    {
        return $this->select('staff.*, hub.hub_name')
            ->join('hub', 'hub.hub_id = staff.hub', 'left');
    }

    public function getStaffByHubQuery($hub)
    {
        return $this->select('staff.*, hub.hub_name')
            ->join('hub', 'hub.hub_id = staff.hub', 'left')
            ->where('staff.hub', $hub);
    }
    public function countStaff()
    {
        return $this->countAll();
    }
}
