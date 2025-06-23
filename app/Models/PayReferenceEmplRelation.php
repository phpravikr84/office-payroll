<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayReferenceEmplRelation extends Model
{
    protected $fillable = [
        'pay_reference_id',
        'emp_id',
    ];
}
