<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceReport extends Model
{
    protected  $table = ['attendance_reports'];
    
    protected $fillable = [
        'employee_id', 'employee_name', 'attendance_date', 'in_time', 'out_time', 
        'work_time', 'late', 'early', 'absence', 'absence_type', 'leave_id', 
        'leave_category_id', 'start_date', 'end_date', 'leave_status', 'leave_reason', 
        'late_count_flag', 'holiday_id', 'is_holiday', 'working_days_id', 'working_hours', 
        'working_day_name', 'paid_hours'
    ];
}
