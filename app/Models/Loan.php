<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
	protected $fillable = [
		'created_by', 'user_id', 'loan_name', 'loan_amount', 'loan_date', 'deduction_start_date', 'deduction_amount', 'outstanding_amount', 'number_of_installments', 'remaining_installments', 'loan_master_id', 'loan_description', 'loan_status', 'deletion_status'
	];
}
