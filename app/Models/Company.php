<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';
    protected $fillable = [
        'name', 'trading_name', 'phone1', 'phone2', 'fax1', 'fax2', 'tax_number', 'business_number',
        'initial_payroll_year', 'current_payroll_year', 'employee_limit', 'contact_person', 'email',
        'address_street_no', 'address_street_name', 'address_city', 'address_state', 'address_postcode',
        'address_country', 'mailing_street_no', 'mailing_street_name', 'mailing_city', 'mailing_state',
        'mailing_postcode', 'mailing_country', 'bank_id','bank_detail_id','setting_table_name','bank_setting_id','transaction_fee', 'superannuation_id', 'superannuation_fund', 'superannuation_number', 'ncsl_number'
    ];
}

