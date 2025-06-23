<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmplSuperannuationRel extends Model
{
    protected $table = 'empl_superannuation_rels';

    protected $fillable = [
        'employee_id',
        'superannuation_id',
        'employer_contribution_percentage',
        'employer_contribution_fixed_amount',
        'bank_name',
        'bank_address',
        'bank_account_number',
        'employer_superannuation_no',
    ];
}
