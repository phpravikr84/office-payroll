<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceRecord extends Model
{
    protected $table = 'attendance_records';
     // Define the fillable attributes for mass assignment
     protected $fillable = [
        'employee_id',
        'employee_name',
        'department',
        'date',
        'in_time',
        'out_time',
        'work_time',
        'overtime_hours',
        'shift_in',
        'shift_out',
        'late',
        'early',
        'absence',
        'attendance_status',
        'remarks',
    ];
}
