<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SetTime extends Model
{
    protected $fillable = [
		'created_by', 'in_time', 'out_time', 'tot_working_hrs', 'half_day_id',
	];
}
