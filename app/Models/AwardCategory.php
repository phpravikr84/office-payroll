<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AwardCategory extends Model {
	protected $fillable = [
		'created_by', 'award_title', 'publication_status', 'deletion_status',
	];
}
