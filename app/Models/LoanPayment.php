<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanPayment extends Model
{
    protected $table = 'loan_payments';

    protected $fillable = [
        'loan_code', 'loan_name', 'loan_id', 'user_id', 'loan_amount', 'balance_amount', 'amount_to_pay', 'reference', 'repayment_paid_on', 'payment_schedule', 'payment_status'
    ];
}
