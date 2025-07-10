@extends('administrator.master')
@section('title', __('Edit Employee'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Edit Employee') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i>{{ __('Dashboard') }}</a></li>
            <li><a href="{{ url('/people/employees') }}">{{ __('Employee') }}</a></li>
            <li class="active">{{ __('Edit Employee') }}</li>
        </ol>
    </section>

    <section class="content">
        <!-- Step Indicator -->
        <div class="step-indicator">
            <div class="step active" data-step="personal">
                <div class="step-circle">1</div>
                <div class="step-text">{{ __('Personal Details') }}</div>
            </div>
            <div class="step" data-step="payroll">
                <div class="step-circle">2</div>
                <div class="step-text">{{ __('Payroll Details') }}</div>
            </div>
            <div class="step" data-step="costcenter">
                <div class="step-circle">3</div>
                <div class="step-text">{{ __('Cost Center') }}</div>
            </div>
            <div class="step" data-step="contact">
                <div class="step-circle">4</div>
                <div class="step-text">{{ __('Contact Info') }}</div>
            </div>
            <div class="step" data-step="leave">
                <div class="step-circle">5</div>
                <div class="step-text">{{ __('Leave Details') }}</div>
            </div>
            <div class="step" data-step="superannuation">
                <div class="step-circle">6</div>
                <div class="step-text">{{ __('Superannuation') }}</div>
            </div>
            <div class="step" data-step="bank">
                <div class="step-circle">7</div>
                <div class="step-text">{{ __('Bank Credits') }}</div>
            </div>
        </div>

        <!-- Personal Details -->
        <div class="form-step active" data-step="personal">
            <form id="personalDetailsForm" method="post" action="{{ url('/people/employees/update/' . $user->id) }}" novalidate>
                {{ csrf_field() }}
                <input type="hidden" name="step" value="personal">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p style="color: #ffc107">{{ __('Update team member details. All (*) fields are required.') }}</p>
                        </div>
                    </div>
                    <!-- Bootstrap 4 Accordion -->
                    <div class="accordion" id="personalAccordion">
                        <!-- Personal Information -->
                        <div class="card">
                            <div class="card-header" id="headingPersonal">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapsePersonal" aria-expanded="true" aria-controls="collapsePersonal">
                                        {{ __('Personal Information') }}
                                    </button>
                                </h5>
                            </div>
                            <div id="collapsePersonal" class="collapse show" aria-labelledby="headingPersonal" data-parent="#personalAccordion">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="employee_id">{{ __('ID') }} <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <input type="hidden" name="employee_id" value="{{ $user->employee_id }}">
                                                <input type="text" class="form-control" value="{{ __('EMPID') }}{{ $user->employee_id }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="name">{{ __('Name') }} <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" placeholder="{{ __('Enter name..') }}" required>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="father_name">{{ __('Fathers Name') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="father_name" id="father_name" class="form-control" value="{{ $user->father_name ?? '' }}" placeholder="{{ __('Enter fathers name..') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="mother_name">{{ __('Mothers Name') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="mother_name" id="mother_name" class="form-control" value="{{ $user->mother_name ?? '' }}" placeholder="{{ __('Enter mothers name..') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="spouse_name">{{ __('Spouse Name') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="spouse_name" id="spouse_name" class="form-control" value="{{ $user->spouse_name ?? '' }}" placeholder="{{ __('Enter spouse name..') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="gender">{{ __('Gender') }} <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <select name="gender" id="gender" class="form-control" required>
                                                    <option value="" {{ !$user->gender ? 'selected' : '' }}>{{ __('Select one') }}</option>
                                                    <option value="m" {{ $user->gender == 'm' ? 'selected' : '' }}>{{ __('Male') }}</option>
                                                    <option value="f" {{ $user->gender == 'f' ? 'selected' : '' }}>{{ __('Female') }}</option>
                                                </select>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="marital_status">{{ __('Marital Status') }}</label>
                                            <div class="form-group">
                                                <select name="marital_status" id="marital_status" class="form-control">
                                                    <option value="" {{ !$user->marital_status ? 'selected' : '' }}>{{ __('Select one') }}</option>
                                                    <option value="1" {{ $user->marital_status == '1' ? 'selected' : '' }}>{{ __('Married') }}</option>
                                                    <option value="2" {{ $user->marital_status == '2' ? 'selected' : '' }}>{{ __('Single') }}</option>
                                                    <option value="3" {{ $user->marital_status == '3' ? 'selected' : '' }}>{{ __('Divorced') }}</option>
                                                    <option value="4" {{ $user->marital_status == '4' ? 'selected' : '' }}>{{ __('Separated') }}</option>
                                                    <option value="5" {{ $user->marital_status == '5' ? 'selected' : '' }}>{{ __('Widowed') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="date_of_birth">{{ __('Date of Birth') }}</label>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" name="date_of_birth" class="form-control datepicker" value="{{ $user->date_of_birth ? \Carbon\Carbon::parse($user->date_of_birth)->format('d/m/Y') : '' }}" id="datepicker">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Employment Details -->
                        <div class="card">
                            <div class="card-header" id="headingEmployment">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEmployment" aria-expanded="false" aria-controls="collapseEmployment">
                                        {{ __('Employment Details') }}
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseEmployment" class="collapse" aria-labelledby="headingEmployment" data-parent="#personalAccordion">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="designation_id">{{ __('Designation') }} <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <select name="designation_id" id="designation_id" class="form-control" required>
                                                    <option value="" {{ !$user->designation_id ? 'selected' : '' }}>{{ __('Select one') }}</option>
                                                    @foreach($designations as $designation)
                                                        <option value="{{ $designation['id'] }}" {{ $user->designation_id == $designation['id'] ? 'selected' : '' }}>{{ $designation['designation'] }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="joining_date">{{ __('Joining Date') }}<span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <div class="input-group date">
                                                    <input type="text" name="joining_date" class="form-control datepicker" id="datepicker4" value="{{ $user->joining_date ? \Carbon\Carbon::parse($user->joining_date)->format('d/m/Y') : '' }}" placeholder="{{ __('dd/mm/yyyy') }}" required>
                                                </div>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="end_date">{{ __('End Date') }}</label>
                                            <div class="form-group">
                                                <div class="input-group date">
                                                    <input type="text" name="end_date" class="form-control datepicker" id="datepicker5" value="{{ $user->end_date ? \Carbon\Carbon::parse($user->end_date)->format('d/m/Y') : '' }}" placeholder="{{ __('dd/mm/yyyy') }}">
                                                </div>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="home_district" value="None">
                                        <div class="col-md-3">
                                            <label for="branch">{{ __('Branch') }} <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <select name="branch" id="branch" class="form-control" required>
                                                    <option value="" {{ !$user->branch ? 'selected' : '' }}>{{ __('Select one') }}</option>
                                                    @foreach(\App\Models\Branch::all() as $branch)
                                                        <option value="{{ $branch->id }}" {{ $user->branch == $branch->id ? 'selected' : '' }}>{{ $branch->branch_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="role">{{ __('Role') }}<span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <select name="role" id="role" class="form-control" required>
                                                    <option value="" {{ !$user->user_type ? 'selected' : '' }}>{{ __('Select one') }}</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id }}" {{ $user->user_type == $role->id ? 'selected' : '' }}>{{ $role->display_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="employee_type">{{ __('Employee Type') }}<span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <select name="employee_type" id="employee_type" class="form-control" required>
                                                    <option value="" {{ !$user->employee_type ? 'selected' : '' }}>{{ __('Select One') }}</option>
                                                    <option value="1" {{ $user->employee_type == '1' ? 'selected' : '' }}>{{ __('Provision') }}</option>
                                                    <option value="2" {{ $user->employee_type == '2' ? 'selected' : '' }}>{{ __('Permanent') }}</option>
                                                    <option value="3" {{ $user->employee_type == '3' ? 'selected' : '' }}>{{ __('Full Time') }}</option>
                                                    <option value="4" {{ $user->employee_type == '4' ? 'selected' : '' }}>{{ __('Part Time') }}</option>
                                                    <option value="5" {{ $user->employee_type == '5' ? 'selected' : '' }}>{{ __('Adhoc') }}</option>
                                                </select>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="resident_status">{{ __('Resident Status') }}<span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <select name="resident_status" id="resident_status" class="form-control" required>
                                                    <option value="" {{ !$user->resident_status ? 'selected' : '' }}>{{ __('Select Resident/Non-Resident') }}</option>
                                                    <option value="1" {{ $user->resident_status == '1' ? 'selected' : '' }}>{{ __('Resident') }}</option>
                                                    <option value="2" {{ $user->resident_status == '2' ? 'selected' : '' }}>{{ __('Non-Resident') }}</option>
                                                </select>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Qualifications -->
                        <div class="card">
                            <div class="card-header" id="headingQualifications">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseQualifications" aria-expanded="false" aria-controls="collapseQualifications">
                                        {{ __('Qualifications & Experience') }}
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseQualifications" class="collapse" aria-labelledby="headingQualifications" data-parent="#personalAccordion">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="academic_qualification">{{ __('Academic Qualification') }}</label>
                                            <div class="form-group">
                                                <textarea name="academic_qualification" id="academic_qualification" class="form-control textarea" placeholder="{{ __('Enter academic qualification..') }}">{{ $user->academic_qualification ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="professional_qualification">{{ __('Professional Qualification') }}</label>
                                            <div class="form-group">
                                                <textarea name="professional_qualification" id="professional_qualification" class="form-control textarea" placeholder="{{ __('Enter professional qualification..') }}">{{ $user->professional_qualification ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="experience">{{ __('Experience') }}</label>
                                            <div class="form-group">
                                                <textarea name="experience" id="experience" class="form-control textarea" placeholder="{{ __('Enter experience..') }}">{{ $user->experience ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Residential Address -->
                        <div class="card">
                            <div class="card-header" id="headingResidential">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseResidential" aria-expanded="false" aria-controls="collapseResidential">
                                        {{ __('Residential Address') }}
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseResidential" class="collapse" aria-labelledby="headingResidential" data-parent="#personalAccordion">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="present_address">{{ __('Present Address') }} <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <input type="text" name="present_address" id="present_address" class="form-control" value="{{ $userDetail->present_address ?? '' }}" placeholder="{{ __('Enter present address..') }}" required>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="city_pr">{{ __('City') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="city_pr" id="city_pr" class="form-control" value="{{ $userDetail->city_pr ?? '' }}" placeholder="{{ __('Enter city..') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="state_pr">{{ __('State') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="state_pr" id="state_pr" class="form-control" value="{{ $userDetail->state_pr ?? '' }}" placeholder="{{ __('Enter state.') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="postcode_pr">{{ __('Postcode') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="postcode_pr" id="postcode_pr" class="form-control" value="{{ $userDetail->postcode_pr ?? '' }}" placeholder="{{ __('Enter postcode..') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="country_pr">{{ __('Country') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="country_pr" id="country_pr" class="form-control" value="{{ $userDetail->country_pr ?? '' }}" placeholder="{{ __('Enter country..') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="permanent_address">{{ __('Permanent Address') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="permanent_address" id="permanent_address" class="form-control" value="{{ $userDetail->permanent_address ?? '' }}" placeholder="{{ __('Enter permanent address..') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="city">{{ __('City') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="city" id="city" class="form-control" value="{{ $userDetail->city ?? '' }}" placeholder="{{ __('Enter city..') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="state">{{ __('State') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="state" id="state" class="form-control" value="{{ $userDetail->state ?? '' }}" placeholder="{{ __('Enter state.') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="postcode">{{ __('Postcode') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="postcode" id="postcode" class="form-control" value="{{ $userDetail->postcode ?? '' }}" placeholder="{{ __('Enter postcode..') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="country">{{ __('Country') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="country" id="country" class="form-control" value="{{ $userDetail->country ?? '' }}" placeholder="{{ __('Enter country..') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Contact Details -->
                        <div class="card">
                            <div class="card-header" id="headingContact">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseContact" aria-expanded="false" aria-controls="collapseContact">
                                        {{ __('Contact Details') }}
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseContact" class="collapse" aria-labelledby="headingContact" data-parent="#personalAccordion">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="email">{{ __('Email') }} <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" placeholder="{{ __('Enter email address..') }}" required>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="contact_no_one">{{ __('Contact No') }} <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <input type="text" name="contact_no_one" id="contact_no_one" class="form-control" value="{{ $user->contact_no_one ?? '' }}" placeholder="{{ __('Enter contact no..') }}" required>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="emergency_contact">{{ __('Emergency Contact') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="emergency_contact" id="emergency_contact" class="form-control" value="{{ $user->emergency_contact ?? '' }}" placeholder="{{ __('Enter emergency contact no..') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Passport & Visa Details -->
                        <div class="card">
                            <div class="card-header" id="headingPassport">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsePassport" aria-expanded="false" aria-controls="collapsePassport">
                                        {{ __('Passport & Visa Details (If Any)') }}
                                    </button>
                                </h5>
                            </div>
                            <div id="collapsePassport" class="collapse" aria-labelledby="headingPassport" data-parent="#personalAccordion">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="passport_number">{{ __('Passport Number') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="passport_number" id="passport_number" class="form-control" value="{{ $user->passport_number ?? '' }}" placeholder="{{ __('Enter passport number...') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="visa_number">{{ __('Visa Number') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="visa_number" id="visa_number" class="form-control" value="{{ $user->visa_number ?? '' }}" placeholder="{{ __('Enter visa number...') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary prev-step" data-prev="personal" disabled>
                        {{ __('Previous') }}
                    </button>
                    <button type="button" class="btn btn-primary next-step" data-next="payroll">
                        {{ __('Next') }}
                    </button>
                    <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
                </div>
            </form>
        </div>

        <!-- Payroll Details -->
        <div class="form-step" data-step="payroll">
            <form id="payrollDetailsForm" method="post" action="{{ url('/people/employees/update/' . $user->id) }}">
                {{ csrf_field() }}
                <input type="hidden" name="step" value="payroll">
                <div class="box-body">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="card">
                                <div class="card-header" style="background-color: #007bff; color: #fff; padding: 10px;">
                                    <h5>{{ __('Basic Salary') }}</h5>
                                    <div style="text-align: right;">
                                        <label for="tax_residency">{{ __('Select Tax Residency') }}</label>
                                        <select name="tax_residency" id="tax_residency" class="form-control" required>
                                            <option value="1" {{ $payroll->resident_status == '1' ? 'selected' : '' }}>Residential</option>
                                            <option value="2" {{ $payroll->resident_status == '2' ? 'selected' : '' }}>Non-Resident</option>
                                        </select>
                                        <div class="error-message"></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead style="background-color: #343a40; color: #000;">
                                            <tr>
                                                <th>{{ __('Period Definition') }}</th>
                                                <th>{{ __('Annual Salary') }}</th>
                                                <th>{{ __('Fortnight Salary') }}</th>
                                                <th>{{ __('Hourly Salary Rate') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" name="period_definition" class="form-control" id="period_definition" value="{{ $payroll->period_definition ?? 'FN - Fortnightly ' . ($sumOfWorkingHours*2 ?? 80) . ' Hours' }}" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" name="annual_salary" class="form-control" id="annual_salary" value="{{ $payroll->annual_salary ?? '' }}" placeholder="{{ __('Enter annual salary..') }}" required>
                                                    <div class="error-message"></div>
                                                </td>
                                                <td>
                                                    <input type="number" name="basic_salary" class="form-control" id="basic_salary" value="{{ $payroll->basic_salary ?? '' }}" placeholder="{{ __('Enter fortnight salary..') }}" required>
                                                    <div class="error-message"></div>
                                                </td>
                                                <td>
                                                    <input type="number" name="hrly_salary_rate" class="form-control" id="hrly_salary_rate" value="{{ $payroll->hrly_salary_rate ?? '' }}" placeholder="{{ __('Enter working hours..') }}" required>
                                                    <div class="error-message"></div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="box">
                                <div class="box-header" style="background-color: #28a745; color: white; padding: 10px;">
                                    <h4>{{ __('Allowances') }}</h4>
                                </div>
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <thead style="background-color: #007bff; color: #000;">
                                            <tr>
                                                <th colspan="2">{{ __('House Allowances') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><label for="hr_place">{{ __('Place Name') }}</label></td>
                                                <td>
                                                    <select name="hr_place" id="hr_place" class="form-control">
                                                        <option value="" {{ !$payroll->hr_place ? 'selected' : '' }}>{{ __('Select place for house allowance') }}</option>
                                                        @if(isset($loca_places))
                                                            @foreach($loca_places as $item)
                                                                <option value="{{ $item['id'] }}" {{ $payroll->hr_place == $item['id'] ? 'selected' : '' }}>{{ $item['places'] }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="hr_area">{{ __('Area Name') }}</label></td>
                                                <td>
                                                    <input type="text" name="hr_area" id="hr_area" class="form-control" value="{{ $payroll->hr_area ?? '' }}" placeholder="{{ __('Area...') }}" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="hra_type">{{ __('Housing Allowance Type') }}</label></td>
                                                <td>
                                                    <select name="hra_type" id="hra_type" class="form-control">
                                                        <option value="" selected>{{ __('Select One') }}</option>
                                                        <option value="1" {{ $payroll->hra_type == '1' ? 'selected' : '' }}>{{ __('Rental') }}</option>
                                                        <option value="2" {{ $payroll->hra_type == '2' ? 'selected' : '' }}>{{ __('Kind') }}</option>
                                                        <option value="3" {{ $payroll->hra_type == '3' ? 'selected' : '' }}>{{ __('Not Applicable') }}</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="hra_amount_per_week">{{ __('House Rent/Purchase Amount') }}</label></td>
                                                <td>
                                                    <input type="number" name="hra_amount_per_week" id="hra_amount_per_week" value="{{ $payroll->hra_amount_per_week ?? '' }}" class="form-control" placeholder="{{ __('Enter amount ..') }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="house_rent_allowance">{{ __('Housing Allowance') }}</label></td>
                                                <td>
                                                    <input type="number" name="house_rent_allowance" id="house_rent_allowance" value="{{ $payroll->house_rent_allowance ?? '' }}" class="form-control" placeholder="0" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <thead style="background-color: #007bff; color: #000;">
                                            <tr>
                                                <th colspan="2">{{ __('Vehicle Allowances') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><label for="va_type">{{ __('Vehicle Allowance Type') }}</label></td>
                                                <td>
                                                    <select name="va_type" id="va_type" class="form-control">
                                                        <option value="" selected>{{ __('Select One') }}</option>
                                                        <option value="1" {{ $payroll->va_type == '1' ? 'selected' : '' }}>{{ __('With Fuel') }}</option>
                                                        <option value="2" {{ $payroll->va_type == '2' ? 'selected' : '' }}>{{ __('Without Fuel') }}</option>
                                                        <option value="3" {{ $payroll->va_type == '3' ? 'selected' : '' }}>{{ __('Not Applicable') }}</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="vehicle_allowance">{{ __('Vehicle Allowance') }}</label></td>
                                                <td>
                                                    <input type="number" name="vehicle_allowance" id="vehicle_allowance" value="{{ $payroll->vehicle_allowance ?? '' }}" class="form-control" placeholder="0" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <thead style="background-color: #007bff; color: #000;">
                                            <tr>
                                                <th colspan="2">{{ __('Other Allowances') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><label for="meals_allowance">{{ __('Meals (Messing) Allowance') }}</label></td>
                                                <td>
                                                    <input type="checkbox" name="meals_tag" id="meals_tag" value="1" {{ $payroll->meals_tag ? 'checked' : '' }}>
                                                    <input type="number" name="meals_allowance" id="meals_allowance" value="{{ $payroll->meals_allowance ?? '' }}" class="form-control" placeholder="0" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="medical_allowance">{{ __('Medical Allowance') }}</label></td>
                                                <td>
                                                    <input type="number" name="medical_allowance" id="medical_allowance" value="{{ $payroll->medical_allowance ?? '' }}" class="form-control" placeholder="{{ __('Enter medical allowance..') }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="special_allowance">{{ __('Telephone Allowance') }}</label></td>
                                                <td>
                                                    <input type="number" name="special_allowance" id="special_allowance" value="{{ $payroll->special_allowance ?? '' }}" class="form-control" placeholder="{{ __('Enter telephone allowance..') }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="other_allowance">{{ __('Servant Allowance') }}</label></td>
                                                <td>
                                                    <input type="number" name="other_allowance" id="other_allowance" value="{{ $payroll->other_allowance ?? '' }}" class="form-control" placeholder="{{ __('Enter domestic servant allowance..') }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="electricity_allowance">{{ __('Electricity Allowance') }}</label></td>
                                                <td>
                                                    <input type="number" name="electricity_allowance" id="electricity_allowance" value="{{ $payroll->electricity_allowance ?? '' }}" class="form-control" placeholder="{{ __('Enter electricity allowance..') }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="security_allowance">{{ __('Security Allowance') }}</label></td>
                                                <td>
                                                    <input type="number" name="security_allowance" id="security_allowance" value="{{ $payroll->security_allowance ?? '' }}" class="form-control" placeholder="{{ __('Enter security allowance..') }}">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="box">
                                <div class="box-header" style="background-color: #ffc107; color: white; padding: 10px;">
                                    <h4>{{ __('Deductions') }}</h4>
                                </div>
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <thead style="background-color: #343a40; color: #000;">
                                            <tr>
                                                <th>{{ __('Deductions & Rebate') }}</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ __('Tax Deduction (A)') }}</td>
                                                <td>
                                                    <input type="number" name="tax_deduction_a" id="tax_deduction_a" value="{{ $payroll->tax_deduction_a ?? '' }}" class="form-control" placeholder="{{ __('Enter tax deduction..') }}" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Dependents') }}</td>
                                                <td>
                                                    <select name="no_of_dependent" id="no_of_dependent" class="form-control">
                                                        @for ($i = 0; $i <= 5; $i++)
                                                            <option value="{{ $i }}" {{ $payroll->no_of_dependent == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Superannuation Name') }}</td>
                                                <td>
                                                    <select id="empl_superannuation_id" name="superannuation_id" class="form-control" required>
                                                        <option value="">{{ __('Select Superannuation') }}</option>
                                                        @foreach($superannuations as $superannuation)
                                                            <option value="{{ $superannuation->id }}" data-superannuation="{{ json_encode($superannuation) }}" {{ $payroll->superannuation_id == $superannuation->id ? 'selected' : '' }}>
                                                                {{ $superannuation->name }} ({{ $superannuation->code }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <input type="text" id="employer_contribution_percentage" name="employer_contribution_percentage" class="form-control" readonly value="{{ $payroll->employer_contribution_percentage ?? '' }}">
                                                    <div class="error-message"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Superannuation Fund Deduction') }}</td>
                                                <td>
                                                    <input type="number" name="provident_fund_deduction" id="provident_fund_deduction" value="{{ $payroll->provident_fund_deduction ?? '' }}" class="form-control" placeholder="{{ __('Enter superannuation fund deduction..') }}">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="box mt-4">
                                <div class="card-header" style="background-color: #007bff; color: white; padding: 10px;">
                                    <h3>{{ __('Standard Pay') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="gross_salary">{{ __('Gross Salary') }}</label>
                                        <input type="number" disabled class="form-control" id="gross_salary" value="{{ $payroll->gross_salary ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="total_deduction">{{ __('Total Deduction') }}</label>
                                        <input type="number" disabled class="form-control" id="total_deduction" value="{{ $payroll->total_deduction ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="net_salary">{{ __('Net Salary') }}</label>
                                        <input type="number" disabled class="form-control" id="net_salary" value="{{ $payroll->net_salary ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <button type="button" class="btn btn-secondary prev-step" data-prev="personal">{{ __('Previous') }}</button>
                    <button type="button" class="btn btn-primary next-step" data-next="costcenter">{{ __('Next') }}</button>
                    <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
                </div>
            </form>
        </div>

        <!-- Cost Center -->
        <div class="form-step" data-step="costcenter">
            <form id="costCenterForm" method="post" action="{{ url('/people/employees/update/' . $user->id) }}">
                {{ csrf_field() }}
                <input type="hidden" name="step" value="costcenter">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-bordered">
                                <thead style="background-color: #343a40; color: #000;">
                                    <tr>
                                        <th>{{ __('Payroll Location') }} <span class="text-danger">*</span></th>
                                        <th>{{ __('Pay Batch Number') }} <span class="text-danger">*</span></th>
                                        <th>{{ __('Cost Center') }} <span class="text-danger">*</span></th>
                                        <th>{{ __('Department') }} <span class="text-danger">*</span></th>
                                        <th>{{ __('Cost Center Share Percentage') }} <span class="text-danger">*</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="payroll_location" id="payroll_location" class="form-control" required>
                                                <option value="" {{ !$costcenter->payroll_location_id ? 'selected' : '' }}>{{ __('Select one') }}</option>
                                                @foreach(\App\Models\PayLocation::all() as $location)
                                                    <option value="{{ $location->id }}" {{ $costcenter->payroll_location_id == $location->id ? 'selected' : '' }}>{{ $location->payroll_location_name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="error-message"></div>
                                        </td>
                                        <td>
                                            <select name="pay_batch_number" id="pay_batch_number" class="form-control" required>
                                                <option value="" {{ !$costcenter->payroll_batch_id ? 'selected' : '' }}>{{ __('Select one') }}</option>
                                                @foreach(\App\Models\PayBatchNumber::all() as $batch)
                                                    <option value="{{ $batch->id }}" {{ $costcenter->payroll_batch_id == $batch->id ? 'selected' : '' }}>{{ $batch->pay_batch_number_name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="error-message"></div>
                                        </td>
                                        <td>
                                            <select name="cost_center" id="cost_center" class="form-control" required>
                                                <option value="" {{ !$costcenter->cost_center_id ? 'selected' : '' }}>{{ __('Select one') }}</option>
                                                @if(isset($costcenters))
                                                    @foreach($costcenters as $costcenter_item)
                                                        <option value="{{ $costcenter_item->id }}" {{ $costcenter->cost_center_id == $costcenter_item->id ? 'selected' : '' }}>{{ $costcenter_item->name }} - {{ $costcenter_item->cost_center_code }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="error-message"></div>
                                        </td>
                                        <td>
                                            <select name="department[]" id="department" class="form-control" multiple required>
                                                <option value="" disabled>{{ __('Select one or more') }}</option>
                                                @if(isset($departments))
                                                    @foreach($departments as $dept)
                                                        <option value="{{ $dept->id }}" {{ in_array($dept->id, $costcenter->department_ids ?? []) ? 'selected' : '' }}>{{ $dept->department }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="error-message"></div>
                                        </td>
                                        <td>
                                            <div id="share_percentage_fields">
                                                @if(isset($departments) && $costcenter->department_ids)
                                                    @foreach($costcenter->department_ids as $deptId)
                                                        @php $dept = collect($departments)->firstWhere('id', $deptId); @endphp
                                                        <div class="form-group">
                                                            <label for="share_percentage_{{ $deptId }}">{{ $dept ? $dept->department : 'Department' }} Share Percentage</label>
                                                            <input type="number" class="form-control" name="cost_center_share_percentage[{{ $deptId }}]" id="share_percentage_{{ $deptId }}" value="{{ $costcenter->share_percentage[$deptId] ?? '' }}" min="0" max="100" step="0.01" required>
                                                            <div class="error-message"></div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="error-message" id="general_percentage_error"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary prev-step" data-prev="payroll">{{ __('Previous') }}</button>
                    <button type="button" class="btn btn-primary next-step" data-next="contact">{{ __('Next') }}</button>
                    <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
                </div>
            </form>
        </div>

        <!-- Contact Information -->
        <div class="form-step" data-step="contact">
            <form id="contactForm" method="post" action="{{ url('/people/employees/update/' . $user->id) }}">
                {{ csrf_field() }}
                <input type="hidden" name="step" value="contact">
                <div class="box-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="employee_contact_name">{{ __('Contact Name') }} <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="text" name="employee_contact_name" id="employee_contact_name" class="form-control" value="{{ $contact->employee_contact_name ?? '' }}" placeholder="{{ __('Enter name..') }}" required>
                                <div class="error-message"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="employee_contact_address">{{ __('Address') }} <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="text" name="employee_contact_address" id="employee_contact_address" class="form-control" value="{{ $contact->employee_contact_address ?? '' }}" placeholder="{{ __('Enter contact address..') }}" required>
                                <div class="error-message"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="employee_contact_phone">{{ __('Phone') }} <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="text" name="employee_contact_phone" id="employee_contact_phone" class="form-control" value="{{ $contact->employee_contact_phone ?? '' }}" placeholder="{{ __('Enter phone no..') }}" required>
                                <div class="error-message"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="employee_contact_mobile">{{ __('Mobile') }} <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="text" name="employee_contact_mobile" id="employee_contact_mobile" class="form-control" value="{{ $contact->employee_contact_mobile ?? '' }}" placeholder="{{ __('Enter mobile no..') }}" required>
                                <div class="error-message"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="employee_contact_email">{{ __('Employee Contact Email') }} <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="email" name="employee_contact_email" id="employee_contact_email" class="form-control" value="{{ $contact->employee_contact_email ?? '' }}" placeholder="{{ __('Enter personal email address..') }}" required>
                                <div class="error-message"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="employee_contact_relationship">{{ __('Relation') }} <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="text" name="employee_contact_relationship" id="employee_contact_relationship" class="form-control" value="{{ $contact->employee_contact_relationship ?? '' }}" placeholder="{{ __('Enter relation..') }}" required>
                                <div class="error-message"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <button type="button" class="btn btn-secondary prev-step" data-prev="costcenter">{{ __('Previous') }}</button>
                    <button type="button" class="btn btn-primary next-step" data-next="leave">{{ __('Next') }}</button>
                    <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
                </div>
            </form>
        </div>

        <!-- Leave Details -->
        <div class="form-step" data-step="leave">
            <form id="leaveForm" method="post" action="{{ url('/people/employees/update/' . $user->id) }}">
                {{ csrf_field() }}
                <input type="hidden" name="step" value="leave">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="background-color: #343a40; color: #000;">
                                <tr>
                                    <th>{{ __('Leave Category') }}</th>
                                    <th>{{ __('Leave Count') }}</th>
                                    <th>{{ __('Leave Type') }}</th>
                                    <th>{{ __('Active') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaveCategories as $leave)
                                    <tr>
                                        <td>{{ $leave->leave_category }}
                                            <input type="hidden" name="leave_category_id[]" value="{{ $leave->id }}">
                                        </td>
                                        <td>
                                            <input type="number" id="leave_balance_{{ $leave->id }}" name="leave_balance[]" class="form-control" value="{{ $leaves[$leave->id]->leave_balance ?? $leave->qty }}" readonly>
                                            <div class="error-message"></div>
                                        </td>
                                        <td>
                                            <input type="text" id="leave_type_{{ $leave->id }}" name="leave_type[]" class="form-control" value="{{ $leaves[$leave->id]->leave_type ?? $leave->type_of_leave }}" readonly>
                                            <div class="error-message"></div>
                                        </td>
                                        <td>
                                            <input type="checkbox" id="leave_active_{{ $leave->id }}" name="leave_active[]" value="{{ $leave->id }}" class="form-control" {{ isset($leaves[$leave->id]) && $leaves[$leave->id]->leave_active ? 'checked' : '' }}>
                                            <div class="error-message"></div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <button type="button" class="btn btn-secondary prev-step" data-prev="contact">{{ __('Previous') }}</button>
                    <button type="button" class="btn btn-primary next-step" data-next="superannuation">{{ __('Next') }}</button>
                    <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
                </div>
            </form>
        </div>

        <!-- Superannuation -->
        <div class="form-step" data-step="superannuation">
            <form id="superannuationForm" method="post" action="{{ url('/people/employees/update/' . $user->id) }}">
                {{ csrf_field() }}
                <input type="hidden" name="step" value="superannuation">
                <div class="box-body">
                    <div class="mb-3">
                        <label for="superannuation_id" class="form-label">{{ __('Superannuation') }} <span class="text-danger">*</span></label>
                        <select name="superannuation_id" id="superannuation_id" class="form-control" required>
                            <option value="" {{ !$superannuation->superannuation_id ? 'selected' : '' }}>{{ __('Select Superannuation') }}</option>
                            @foreach($superannuations as $superannuation_item)
                                <option value="{{ $superannuation_item->id }}" data-superannuation="{{ json_encode($superannuation_item) }}" {{ $superannuation->superannuation_id == $superannuation_item->id ? 'selected' : '' }}>
                                    {{ $superannuation_item->name }} ({{ $superannuation_item->code }})
                                </option>
                            @endforeach
                        </select>
                        <div class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="employer_superannuation_no" class="form-label">{{ __('Employer Superannuation No') }} <span class="text-danger">*</span></label>
                        <select id="employer_superannuation_no" name="employer_superannuation_no" class="form-control" required>
                            <option value="" {{ !$superannuation->employer_superannuation_no ? 'selected' : '' }}>{{ __('Select one') }}</option>
                            @if($companies)
                                @foreach($companies as $company)
                                    <option value="{{ $company->superannuation_number }}" {{ $superannuation->employer_superannuation_no == $company->superannuation_number ? 'selected' : '' }}>{{ $company->superannuation_number }} - {{ $company->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <div class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="employer_contribution_percentage_sup" class="form-label">{{ __('Employer Contribution (%)') }}</label>
                        <input type="text" id="employer_contribution_percentage_sup" name="employer_contribution_percentage" value="{{ $superannuation->employer_contribution_percentage ?? '' }}" class="form-control" readonly>
                        <div class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="employer_contribution_fixed_amount_sup" class="form-label">{{ __('Employer Fixed Contribution') }}</label>
                        <input type="text" id="employer_contribution_fixed_amount_sup" name="employer_contribution_fixed_amount" value="{{ $superannuation->employer_contribution_fixed_amount ?? '' }}" class="form-control" readonly>
                        <div class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="bank_name" class="form-label">{{ __('Employee Superannuation Bank Name (If any)') }}</label>
                        @if($bankLists)
                            <select name="bank_name" id="bank_name" class="form-control">
                                <option value="" {{ !$superannuation->bank_name ? 'selected' : '' }}>{{ __('Select Bank') }}</option>
                                @foreach($bankLists as $bank)
                                    <option value="{{ $bank->id }}" {{ $superannuation->bank_name == $bank->id ? 'selected' : '' }}>{{ $bank->bank_name }}</option>
                                @endforeach
                            </select>
                        @else
                            <input type="text" name="bank_name" id="bank_name" class="form-control" value="{{ $superannuation->bank_name ?? '' }}" placeholder="{{ __('Enter bank name..') }}">
                        @endif
                        <div class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="bank_address" class="form-label">{{ __('Employee Superannuation Bank Address (If any)') }}</label>
                        <input type="text" id="bank_address" name="bank_address" value="{{ $superannuation->bank_address ?? '' }}" class="form-control" placeholder="{{ __('Enter bank address..') }}">
                        <div class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="bank_account_number" class="form-label">{{ __('Employee Bank Account Number (If any)') }}</label>
                        <input type="text" id="bank_account_number" name="bank_account_number" value="{{ $superannuation->bank_account_number ?? '' }}" class="form-control" placeholder="{{ __('Enter bank account number..') }}">
                        <div class="error-message"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <button type="button" class="btn btn-secondary prev-step" data-prev="leave">{{ __('Previous') }}</button>
                    <button type="button" class="btn btn-primary next-step" data-next="bank">{{ __('Next') }}</button>
                    <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
                </div>
            </form>
        </div>

        <!-- Bank Credits -->
        <div class="form-step" data-step="bank">
            <form id="bankForm" method="post" action="{{ url('/people/employees/update/' . $user->id) }}">
                {{ csrf_field() }}
                <input type="hidden" name="step" value="bank">
                <div class="box-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <strong class="d-block mb-2">{{ __('Select Bank') }} <span class="text-danger"></span></strong>
                                    @if($bankLists)
                                        <select class="form-control mb-3" name="bank_id" id="bank_id">
                                            <option value="" {{ !$bank->bank_id ? 'selected' : '' }}>{{ __('Select one') }}</option>
                                            @foreach($bankLists as $bankList)
                                                <option value="{{ $bankList->id }}_{{ $bankList->bank_code }}" {{ $bank->bank_id == $bankList->id ? 'selected' : '' }}>{{ $bankList->bank_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="error-message"></div>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="acct_no" id="acct_no" value="{{ $bank->account_no ?? '' }}" placeholder="{{ __('Account No') }}">
                                    <div class="error-message"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="swift_code" id="swift_code" value="{{ $bank->swift_code ?? '' }}" placeholder="{{ __('Swift Code') }}">
                                    <div class="error-message"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="acct_name" id="acct_name" value="{{ $bank->account_holder_name ?? '' }}" placeholder="{{ __('Account Name') }}">
                                    <div class="error-message"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="acct_add" id="acct_add" value="{{ $bank->address ?? '' }}" placeholder="{{ __('Address') }}">
                                    <div class="error-message"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="acct_city" id="acct_city" value="{{ $bank->city ?? '' }}" placeholder="{{ __('City') }}">
                                    <div class="error-message"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="email" class="form-control" name="acct_email" id="acct_email" value="{{ $bank->email_address ?? '' }}" placeholder="{{ __('Email Address') }}">
                                    <div class="error-message"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" maxlength="3" name="acct_ccode" id="acct_ccode" value="{{ $bank->country_code ?? '' }}" placeholder="{{ __('Country Code') }}">
                                    <div class="error-message"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <button type="button" class="btn btn-secondary prev-step" data-prev="superannuation">{{ __('Previous') }}</button>
                    <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
                </div>
            </form>
        </div>
    </section>
</div>

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<style>
    .form-step {
        display: none;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    .form-step.active {
        display: block;
    }
    .error {
        border-color: red !important;
        box-shadow: 0 0 5px rgba(255, 0, 0, 0.3);
    }
    .error-message {
        color: red;
        font-size: 0.85em;
        margin-top: 5px;
    }
    .step-indicator {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0 15px;
        text-align: center;
    }
    .step-circle {
        width: 30px;
        height: 30px;
        line-height: 30px;
        border-radius: 50%;
        background-color: #ddd;
        color: #fff;
        text-align: center;
        font-weight: bold;
        margin-bottom: 5px;
    }
    .step.active .step-circle {
        background-color: #007bff;
    }
    .step-text {
        font-size: 0.9em;
        color: #333;
    }
    .accordion .card {
        border: 1px solid #ddd !important;
        border-radius: 5px !important;
        margin-bottom: 10px !important;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) !important;
    }
    .accordion .card-header {
        background-color: #f8f9fa !important;
        padding: 15px !important;
        cursor: pointer !important;
        border-bottom: 1px solid #ddd !important;
        border-radius: 5px 5px 0 0 !important;
    }
    .accordion .card-header button {
        width: 100% !important;
        text-align: left !important;
        font-weight: bold !important;
        color: #333 !important;
        text-decoration: none !important;
        background: none !important;
        border: none !important;
        padding: 0 !important;
    }
    .accordion .card-header button:not(.collapsed) {
        color: #007bff !important;
    }
    .accordion .card-body {
        padding: 15px !important;
        background-color: #fff !important;
        border-top: 1px solid #ddd !important;
    }
</style>
@endsection
