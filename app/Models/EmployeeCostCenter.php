<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeCostCenter extends Model
{
    protected $fillable = [
        'employee_id',
        'cost_center_id',
        'department_id',
        'share_percentage',
        'payroll_location_id',
        'payroll_batch_id',
    ];

    // Optional relationships
    // public function employee() {
    //     return $this->belongsTo(Employee::class);
    // }

    // public function costCenter() {
    //     return $this->belongsTo(CostCenter::class);
    // }

    // public function department() {
    //     return $this->belongsTo(Department::class);
    // }

    // public function payrollLocation() {
    //     return $this->belongsTo(Location::class, 'payroll_location_id');
    // }

    // public function payrollBatch() {
    //     return $this->belongsTo(PayrollBatch::class, 'payroll_batch_id');
    // }
}
