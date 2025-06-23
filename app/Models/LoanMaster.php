<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanMaster extends Model
{
    protected $table = 'loan_master';

    protected $fillable = ['loan_code', 'loan_name'];
}
