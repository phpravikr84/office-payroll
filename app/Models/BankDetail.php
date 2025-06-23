<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bank_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bank_detail_code',
        'bank_detail_name',
        'bsb_number',
        'bank_type',
        'bank_address',
        'bank_phone',
        'employment_account_number',
        'account_suffix',
        'status'
    ];
}
