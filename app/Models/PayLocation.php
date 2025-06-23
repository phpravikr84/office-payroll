<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayLocation extends Model
{
    protected $fillable = [
        'payroll_location_code',
        'payroll_location_name',
        'bank_id',
        'bank_detail_id',
        'status',
    ];
}
