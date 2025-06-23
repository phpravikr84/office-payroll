<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model {
	protected $fillable = [
			'created_by',	'user_id', 'employee_type',	'resident_status', 'no_of_dependent', 'declaration_lodge_status', 'hrly_salary_rate', 'overtime_hr', 	'overtime_rate', 'overtime_amt', 'sales_comm', 'basic_salary', 'house_rent_allowance', 'medical_allowance', 'special_allowance', 'provident_fund_contribution',	'other_allowance', 'electricity_allowance',	'security_allowance',	'tax_deduction_a', 'tax_deduction_b', 'provident_fund_deduction', 'other_deduction', 'activation_status', 'hr_place', 'hra_area', 'hra_type', 'hra_amount_per_week', 'va_type', 'vehicle_allowance', 'meals_tag', 'meals_allowance',
	];
}