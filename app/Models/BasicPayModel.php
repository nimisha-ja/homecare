<?php

namespace App\Models;

use CodeIgniter\Model;

class BasicPayModel extends Model
{
    protected $table = 'basicpay';
    protected $primaryKey = 'id';

    protected $allowedFields = ['amount','operation','from_date','to_date'];

    public function getBasicPaylist($perPage, $currentPage)
    {
        return $this->select('basicpay.*')
            ->paginate($perPage, 'default', $currentPage);
    }
}
