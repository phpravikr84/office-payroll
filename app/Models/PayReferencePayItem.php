<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayReferencePayItem extends Model
{
    protected $table = 'pay_reference_payitems';

    protected $fillable = [
        'pay_reference_id', 'pay_item_id', 'payitem_unit', 'payitem_amount', 'paid_on', 'payitem_summary'
    ];
}
