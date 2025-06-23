<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeBankRel extends Model
{
    protected $table = 'employee_bank_rels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'emp_id',
        'bank_id',
        'account_no',
        'bank_code',
        'ifsc_code',
        'swift_code',
        'account_holder_name',
        'address',
        'city',
        'state',
        'branch_name',
        'email_address',
        'country_code',
    ];
}
