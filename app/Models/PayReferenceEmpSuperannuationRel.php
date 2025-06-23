<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayReferenceEmpSuperannuationRel extends Model
{
    protected $table = 'pay_reference_emp_superannuation_rels';
    protected $fillable = [
        'payref_id',
        'emp_id',
        'superannuation_id',
        'employer_contribution_percentage',
        'employee_contribution_percentage',
        'employer_contribution_amount',
        'employee_contribution_amount',
        'contribution_paid_on'
    ];

    // Define relationships if applicable
    public function payReference()
    {
        return $this->belongsTo(PayReference::class, 'payref_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }

    public function superannuation()
    {
        return $this->belongsTo(Superannuation::class, 'superannuation_id');
    }


}
