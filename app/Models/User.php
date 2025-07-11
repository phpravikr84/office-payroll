<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'created_by',
        'employee_id',
        'name',
        'father_name',
        'mother_name',
        'spouse_name',
        'email',
        'password',
        'present_address',
        'permanent_address',
        'home_district',
        'id_name',
        'id_number',
        'contact_no_one',
        'contact_no_two',
        'emergency_contact',
        'web',
        'gender',
        'date_of_birth',
        'marital_status',
        'avatar',
        'client_type_id',
        'designation_id',
        'access_label',
        'joining_position',
        'activation_status',
        'academic_qualification',
        'professional_qualification',
        'experience',
        'reference',
        'joining_date',
        'deletion_status',
        'role',
        'shift_id',
        'employee_type',
        'resident_status',
        'no_of_dependent',
        'user_payroll_rel_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function userDetails()
    {
        return $this->hasOne(UserDetail::class, 'user_id');
    }

    public function payroll()
    {
        return $this->hasOne(Payroll::class, 'user_id');
    }

    // public function costCenter()
    // {
    //     return $this->hasOne(CostCenter::class, 'employee_id');
    // }

    public function contact()
    {
        return $this->hasOne(EmployeeContact::class, 'employee_id');
    }

    public function leaves()
    {
        return $this->hasMany(EmployeeLeaveMst::class, 'emp_id');
    }

    public function superannuation()
    {
        return $this->hasOne(EmplSuperannuationRel::class, 'employee_id');
    }

    public function bank()
    {
        return $this->hasOne(EmployeeBankRel::class, 'emp_id');
    }
}
