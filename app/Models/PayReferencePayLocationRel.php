<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayReferencePayLocationRel extends Model
{
    protected $fillable = [
        'pay_reference_id',
        'pay_reference_pay_location_id',
    ];
}
