<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DependentRebate extends Model
{
    protected $fillable = [
        'created_by', 'no_of_dependent', 'rebate_amt1', 'rebate_amt2', 'per_of_tax'
    ];
}
