<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodDefinationRate extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'period_defination_rates';

   /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
   protected $fillable = [
       'code',
       'name',
       'pay_unit',
       'pays_per_year',
       'hours_per_day',
       'hours_per_pay',
       'days_per_pay',
       'rate_per_pay_unit_hours',
       'overtime_rate_one',
       'overtime_rate_two',
       'special_rate_one',
       'special_rate_two',
       'annual_leave_flag',
       'casual_leave_flag',
       'sick_leave_flag',
       'accurate_type',
       'compensate_leave',
       'salary_days_count'
   ];
}
