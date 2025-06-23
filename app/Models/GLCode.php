<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GLCode extends Model
{
    protected $table = 'gl_codes';
    protected $fillable = [
        'gl_code',
        'gl_name',
        'status',
    ];
}
