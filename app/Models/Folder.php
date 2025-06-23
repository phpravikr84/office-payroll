<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model {

    protected $fillable = [
        'created_by', 'folder_name', 'folder_description', 'publication_status', 'deletion_status'
    ];

}
