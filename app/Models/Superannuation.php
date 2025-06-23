<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Superannuation extends Model
{
    
    protected $fillable = [
        'code',
        'name',
        'employer_contribution_percentage',
        'employer_contribution_fixed_amount',
        'tax_method_for_employee_contribution',
        'included_bank_transfer',
        'bank_account_number',
        'account_name',
        'bank_name',
        'employer_name',
        'employer_superannuation_no',
        'registration_date',
        'status',
    ];
}
