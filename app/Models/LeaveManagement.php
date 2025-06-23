<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveManagement extends Model
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'leave_managements';

    protected $fillable = [
        'user_id',
        'leave_category_id',
        'leave_type',
        'leave_option',
        'start_date',
        'end_date',
        'reason',
        'loss_of_pay_days',
        'is_sandwich_leave',
        'sandwich_leave_days',
        'holiday_count',
        'pending_leave',
        'leave_applied_days',
        'status',
        'message',
        'applied_by',
        'authorize_by',
        'created_at',
        'updated_at',
    ];
}
