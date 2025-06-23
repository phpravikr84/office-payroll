<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveCategory extends Model
{
    protected $fillable = [
        'created_by', 'leave_category', 'item', 'qty', 'remarks', 'type_of_leave', 'publication_status', 'leave_category_description'
    ];
}
