<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'overtime_list';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'fixed_amount',
    ];
}
