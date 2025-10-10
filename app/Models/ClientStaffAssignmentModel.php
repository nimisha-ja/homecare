<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientStaffAssignmentModel extends Model
{
    protected $table = 'client_staff_assignments';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'client_id',
        'staff_id',
        'shift_date',
        'shift_type',
        'start_time',
        'end_time'
    ];

    public function getAssignmentsWithDetailsPaginated($perPage = 10)
    {
        return $this->select('client_staff_assignments.*, clients.care_home_name, staff.full_name')
            ->join('clients', 'clients.id = client_staff_assignments.client_id')
            ->join('staff', 'staff.id = client_staff_assignments.staff_id')
            ->orderBy('shift_date', 'DESC')
            ->paginate($perPage);
    }
}
