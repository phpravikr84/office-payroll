<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KinaBankTransferSetup extends Model
{
    protected $fillable = [
        'kina_customer_reference',
        'kina_folder_directory',
        'gl_code_id',
    ];
}
