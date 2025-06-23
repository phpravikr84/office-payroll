<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WpacSettingBank extends Model
{
    protected $fillable = [
        'wpac_setting_id',
        'bank_id',
    ];
}
