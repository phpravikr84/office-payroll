<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CostCenterDepartmentRel extends Model
{
    protected $table = 'cost_center_department_rel';

    protected $fillable = [
        'cost_center_id',
        'department_id',
    ];

    public $timestamps = true;

    /**
     * Relation with CostCenter
     */
    public function costCenter()
    {
        return $this->belongsTo(CostCenter::class);
    }

    /**
     * Relation with Department
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
