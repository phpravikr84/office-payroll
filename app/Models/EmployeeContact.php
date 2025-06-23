<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeContact extends Model
{
      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $fillable = [
        'employee_id',
        'employee_contact_name',
        'employee_contact_address',
        'employee_contact_phone',
        'employee_contact_mobile',
        'employee_contact_email',
        'employee_contact_relationship',
    ];

}