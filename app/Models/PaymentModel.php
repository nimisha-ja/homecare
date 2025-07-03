<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    // Define the table associated with this model
    protected $table = 'payments';

    // Define the primary key of the table
    protected $primaryKey = 'id';

    // Define which fields are allowed to be inserted or updated
    protected $allowedFields = [
        'staff_id', 'advance_amount', 'payment_date'
    ];

    // Enable automatic timestamp management (optional)
    protected $useTimestamps = true;

    // Fields for created and updated timestamps
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation rules (optional, can be added to improve form validation)
    protected $validationRules = [
        'staff_id' => 'required|is_not_unique[staff.id]',
        'advance_amount' => 'required|numeric',
        'payment_date' => 'required|valid_date',
    ];

    // Custom validation messages (optional)
    protected $validationMessages = [
        'staff_id' => [
            'required' => 'Staff is required',
            'is_not_unique' => 'Selected staff does not exist in the system',
        ],
        'advance_amount' => [
            'required' => 'Advance amount is required',
            'numeric' => 'Advance amount must be a valid number',
        ],
        'payment_date' => [
            'required' => 'Payment date is required',
            'valid_date' => 'Please provide a valid date',
        ],
    ];

    // Optionally, you can define other methods specific to the payment model
}
