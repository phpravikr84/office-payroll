<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    // protected $fillable = [
    //     'created_by', 'department', 'publication_status', 'department_description'
    // ];

    protected $fillable = ['department', 'department_description', 'publication_status', 'deletion_status', 'created_by'];

    /**
     * Scope to get active departments (published and not deleted).
     */
    public function scopeActive($query)
    {
        return $query->where('publication_status', 1)->where('deletion_status', 0);
    }
}
