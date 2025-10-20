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


    public function isStaffAvailable($staffId, $shiftDate, $startTime, $endTime, $excludeId = null)
    {
        $builder = $this->where('staff_id', $staffId)
            ->where('shift_date', $shiftDate)
            ->groupStart()
            ->groupStart()
            ->where('start_time <=', $startTime)
            ->where('end_time >', $startTime)
            ->groupEnd()
            ->orGroupStart()
            ->where('start_time <', $endTime)
            ->where('end_time >=', $endTime)
            ->groupEnd()
            ->orGroupStart()
            ->where('start_time >=', $startTime)
            ->where('end_time <=', $endTime)
            ->groupEnd()
            ->groupEnd();

        // Exclude the current assignment (for updates)
        if ($excludeId !== null) {
            $builder->where('id !=', $excludeId);
        }

        return $builder->countAllResults() == 0;
    }
    public function getFilteredAssignments($date = null, $client_id = null, $shift_type = null, $staff_id = null)
    {
        $builder = $this->db->table($this->table . ' AS a');
        $builder->select('
        a.*, 
        clients.care_home_name AS client_name, 
        staff.full_name AS staff_name
    ');
        $builder->join('clients', 'clients.id = a.client_id');
        $builder->join('staff', 'staff.id = a.staff_id');

        if (!empty($date)) {
            $builder->where('a.shift_date', $date);
        }

        if (!empty($client_id)) {
            $builder->where('a.client_id', $client_id);
        }

        if (!empty($shift_type)) {
            $builder->where('a.shift_type', $shift_type);
        }

        if (!empty($staff_id)) {
            $builder->where('a.staff_id', $staff_id);
        }

        $builder->orderBy('a.shift_date', 'DESC');

        return $builder->get()->getResultArray();
    }
}
