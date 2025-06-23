<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayReferencePaySlip extends Model
{
    protected $table = ['pay_reference_pay_slips'];
    protected $fillable = [
        'pay_ref_id',
        'employee_id',
        'hourly_rate',
        'total_working_hours',
        'total_working_days',
        'late_count',
        'late_deduction',
        'sandwich_leave_count',
        'sandwich_leave_deduction',
        'loss_of_pay_days',
        'loss_of_pay_amount',
        'house_rent_allowance',
        'medical_allowance',
        'special_allowance',
        'other_allowance',
        'electricity_allowance',
        'security_allowance',
        'tax_deduction_a',
        'hra_type',
        'va_type',
        'vechile_allowance',
        'meal_tag',
        'meals_allowance',
        'total_benefits_payable',
        'total_taxable_deduct_wdays',
        'loan_deduction_installment',
        'payItems',
        'total_payable_amount'
    ];
}
