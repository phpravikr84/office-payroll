<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayItem extends Model
{
    protected $fillable = [
        'code',
        'name',
        'accumulator',
        'glaccount',
        'tax_rate',
        'spread_code',
        'taxflag',
        'bank_id',
        'bank_detail_id',
        'superannuation_fund_id',
        'payment_mode',
        'fixed_amount',
        'percentage',
        'sequence',
        'will_accure_leave',
    ];
    
    public function glCode()
    {
        return $this->belongsTo(GLCode::class, 'gl_account_id');
    }

    public function accumulatorCode()
    {
        return $this->belongsTo(PayAccumulator::class, 'accumulator_id');
    }


}
