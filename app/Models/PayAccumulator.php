<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayAccumulator extends Model
{
    protected $fillable = [
        'pay_accumulator_code',
        'pay_accumulator_name',
        'status',
    ];
}
