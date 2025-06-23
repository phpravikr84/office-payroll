<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HraRate extends Model {
	protected $fillable = [
		'created_by', 'hra_type', 'hra_amt', 'area_type', 'wkly_hra_min_val', 'wkly_hra_max_val', 'chk_amt', 'house_min_val', 'house_max_val'
	];
}