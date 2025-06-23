<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayReference extends Model
{
    protected $fillable = [
        'pay_reference_name',
        'branch_id',
        'payroll_number',
        'pay_period_start_date',
        'pay_period_end_date',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function departments()
    {
        return $this->belongsToMany(PayReferenceDepartment::class, 'pay_reference_department_rels');
    }

    public function payLocations()
    {
        return $this->belongsToMany(PayReferencePayLocation::class, 'pay_reference_pay_location_rels');
    }
}
