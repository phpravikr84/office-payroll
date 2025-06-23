<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkingDay extends Model {
	protected $fillable = [
		'updated_by', 'day', 'working_status',
	];
}
