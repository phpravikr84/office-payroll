<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayReferenceUpdateLoan extends Model
{
    // Define the table name if it's not following the convention
    protected $table = 'pay_reference_update_loans';

    // Define which fields are mass assignable
    protected $fillable = [
        'pay_reference_id',
        'loan_id',
        'user_id',
        'loan_name',
        'loan_master_id',
        'loan_date',
        'deduction_start_date',
        'deduction_amount',
        'outstanding_amount'
    ];
}
