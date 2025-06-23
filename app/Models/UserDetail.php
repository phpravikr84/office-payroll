<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_details';

    protected $fillable = [
        'user_id',
        'present_address',
        'city_pr',
        'state_pr',
        'postcode_pr',
        'country_pr',
        'permanent_address',
        'city',
        'state',
        'postcode',
        'country',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
