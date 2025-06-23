<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CostCenter extends Model
{
    protected $fillable = [
        'name',
        'cost_center_code',
        'status',
    ];

    /**
     * Define a many-to-many relationship with the Department model.
     */
    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'cost_center_department_rel', 'cost_center_id', 'department_id');
    }
}
