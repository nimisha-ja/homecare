<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table = 'clients';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'care_home_name', 'provider_name', 'address', 'post_code',
        'manager_name', 'phone_number', 'email', 'accounts_email',

        'hca_weekday_day', 'hca_weekday_night', 'hca_weekend_day',
        'hca_weekend_night', 'hca_bank_holiday',

        'nurse_weekday_day', 'nurse_weekday_night', 'nurse_weekend_day',
        'nurse_weekend_night', 'nurse_bank_holiday',

        'special_rate_below_8hrs', 'special_rate_above_8hrs',
        'contract_file'
    ];
}
