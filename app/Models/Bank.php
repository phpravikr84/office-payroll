<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'bank_list';
    protected $fillable = ['bank_code', 'bank_name', 'status'];
}
