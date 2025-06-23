<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxResident extends Model
{
    protected $fillable = [
        'created_by', 'resi_status', 'min_amt', 'max_amt', 'gross_tax_per', 'deduted_amt'
    ];
}
