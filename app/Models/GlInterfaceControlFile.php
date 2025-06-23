<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlInterfaceControlFile extends Model
{
    protected $table = 'gl_interface_control_files';

    protected $fillable = [
        'control_setup_name',
        'gl_code_account_name',
    ];
}
