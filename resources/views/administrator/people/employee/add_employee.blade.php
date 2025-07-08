@extends('administrator.master')
@section('title', __('Add Employee'))

@section('main_content')
<!-- Include Bootstrap 4 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Add Employee') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i>{{ __('Dashboard') }}</a></li>
            <li><a href="{{ url('/people/employees') }}">{{ __('Employee') }}</a></li>
            <li class="active">{{ __('Add Employee') }}</li>
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
            <form id="personalDetailsForm" method="post" action="{{ url('/people/employees/store') }}">
                {{ csrf_field() }}
                <input type="hidden" name="step" value="personal">
                <?php 
                    $users = \App\Models\User::orderBy('id', 'desc')->first();
                    $sl = $users->id ?? 0;
                ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p style="color: #ffc107">{{ __('Enter team member details. All (*) fields are required. (Default password for added user is 12345678)') }}</p>
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
                                                <input type="hidden" name="employee_id" value="{{ $sl + 1 }}">
                                                <input type="text" class="form-control" value="{{ __('EMPID') }}{{ $sl + 1 }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="name">{{ __('Name') }} <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <input type="text" name="name" id="name" class="form-control" value="{{ session('employee_data.personal.name', old('name')) }}" placeholder="{{ __('Enter name..') }}" required>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="father_name">{{ __('Fathers Name') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="father_name" id="father_name" class="form-control" value="{{ session('employee_data.personal.father_name', old('father_name')) }}" placeholder="{{ __('Enter fathers name..') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="mother_name">{{ __('Mothers Name') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="mother_name" id="mother_name" class="form-control" value="{{ session('employee_data.personal.mother_name', old('mother_name')) }}" placeholder="{{ __('Enter mothers name..') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="spouse_name">{{ __('Spouse Name') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="spouse_name" id="spouse_name" class="form-control" value="{{ session('employee_data.personal.spouse_name', old('spouse_name')) }}" placeholder="{{ __('Enter spouse name..') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="gender">{{ __('Gender') }} <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <select name="gender" id="gender" class="form-control" required>
                                                    <option value="" {{ !session('employee_data.personal.gender', old('gender')) ? 'selected' : '' }}>{{ __('Select one') }}</option>
                                                    <option value="m" {{ session('employee_data.personal.gender', old('gender')) == 'm' ? 'selected' : '' }}>{{ __('Male') }}</option>
                                                    <option value="f" {{ session('employee_data.personal.gender', old('gender')) == 'f' ? 'selected' : '' }}>{{ __('Female') }}</option>
                                                </select>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="marital_status">{{ __('Marital Status') }}</label>
                                            <div class="form-group">
                                                <select name="marital_status" id="marital_status" class="form-control">
                                                    <option value="" {{ !session('employee_data.personal.marital_status', old('marital_status')) ? 'selected' : '' }}>{{ __('Select one') }}</option>
                                                    <option value="1" {{ session('employee_data.personal.marital_status', old('marital_status')) == '1' ? 'selected' : '' }}>{{ __('Married') }}</option>
                                                    <option value="2" {{ session('employee_data.personal.marital_status', old('marital_status')) == '2' ? 'selected' : '' }}>{{ __('Single') }}</option>
                                                    <option value="3" {{ session('employee_data.personal.marital_status', old('marital_status')) == '3' ? 'selected' : '' }}>{{ __('Divorced') }}</option>
                                                    <option value="4" {{ session('employee_data.personal.marital_status', old('marital_status')) == '4' ? 'selected' : '' }}>{{ __('Separated') }}</option>
                                                    <option value="5" {{ session('employee_data.personal.marital_status', old('marital_status')) == '5' ? 'selected' : '' }}>{{ __('Widowed') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="date_of_birth">{{ __('Date of Birth') }}</label>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" name="date_of_birth" class="form-control" value="{{ session('employee_data.personal.date_of_birth', old('date_of_birth')) }}" id="datepicker">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text calendar-icon" id="date_picker_icon"><i class="fa fa-calendar"></i></span>
                                                    </div>
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
                                                    <option value="" {{ !session('employee_data.personal.designation_id', old('designation_id')) ? 'selected' : '' }}>{{ __('Select one') }}</option>
                                                    @foreach($designations as $designation)
                                                    <option value="{{ $designation['id'] }}" {{ session('employee_data.personal.designation_id', old('designation_id')) == $designation['id'] ? 'selected' : '' }}>{{ $designation['designation'] }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="joining_date">{{ __('Joining Date') }}<span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <div class="input-group date">
                                                    <input type="text" name="joining_date" class="form-control" id="datepicker4" value="{{ session('employee_data.personal.joining_date', old('joining_date')) }}" placeholder="{{ __('yyyy-mm-dd') }}" required>
                                                    <span class="input-group-text calendar-icon" id="date_picker_icon4"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="end_date">{{ __('End Date') }}<span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <div class="input-group date">
                                                    <input type="text" name="end_date" class="form-control" id="datepicker5" value="{{ session('employee_data.personal.end_date', old('end_date')) }}" placeholder="{{ __('yyyy-mm-dd') }}" required>
                                                    <span class="input-group-text calendar-icon" id="date_picker_icon5"><i class="fa fa-calendar"></i></span>
                                                </div>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="home_district" value="None">
                                        <div class="col-md-3">
                                            <label for="branch">{{ __('Branch') }} <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <select name="branch" id="branch" class="form-control" required>
                                                    <option value="" {{ !session('employee_data.personal.branch', old('branch')) ? 'selected' : '' }}>{{ __('Select one') }}</option>
                                                    @foreach(\App\Models\Branch::all() as $branch)
                                                    <option value="{{ $branch->id }}" {{ session('employee_data.personal.branch', old('branch')) == $branch->id ? 'selected' : '' }}>{{ $branch->branch_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="role">{{ __('Role') }}<span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <select name="role" id="role" class="form-control" required>
                                                    <option value="" {{ !session('employee_data.personal.role', old('role')) ? 'selected' : '' }}>{{ __('Select one') }}</option>
                                                    @foreach($roles as $role)
                                                    <option value="{{ $role->name }}" {{ session('employee_data.personal.role', old('role')) == $role->name ? 'selected' : '' }}>{{ $role->display_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="employee_type">{{ __('Employee Type') }}<span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <select name="employee_type" id="employee_type" class="form-control" required>
                                                    <option value="" {{ !session('employee_data.personal.employee_type', old('employee_type')) ? 'selected' : '' }}>{{ __('Select One') }}</option>
                                                    <option value="1" {{ session('employee_data.personal.employee_type', old('employee_type')) == '1' ? 'selected' : '' }}>{{ __('Provision') }}</option>
                                                    <option value="2" {{ session('employee_data.personal.employee_type', old('employee_type')) == '2' ? 'selected' : '' }}>{{ __('Permanent') }}</option>
                                                    <option value="3" {{ session('employee_data.personal.employee_type', old('employee_type')) == '3' ? 'selected' : '' }}>{{ __('Full Time') }}</option>
                                                    <option value="4" {{ session('employee_data.personal.employee_type', old('employee_type')) == '4' ? 'selected' : '' }}>{{ __('Part Time') }}</option>
                                                    <option value="5" {{ session('employee_data.personal.employee_type', old('employee_type')) == '5' ? 'selected' : '' }}>{{ __('Adhoc') }}</option>
                                                </select>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="resident_status">{{ __('Resident Status') }}<span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <select name="resident_status" id="resident_status_emp" class="form-control" required>
                                                    <option value="" {{ !session('employee_data.personal.resident_status', old('resident_status')) ? 'selected' : '' }}>{{ __('Select Resident/Non-Resident') }}</option>
                                                    <option value="1" {{ session('employee_data.personal.resident_status', old('resident_status')) == '1' ? 'selected' : '' }}>{{ __('Resident') }}</option>
                                                    <option value="2" {{ session('employee_data.personal.resident_status', old('resident_status')) == '2' ? 'selected' : '' }}>{{ __('Non-Resident') }}</option>
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
                                        {{ __('Qualifications') }}
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseQualifications" class="collapse" aria-labelledby="headingQualifications" data-parent="#personalAccordion">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="academic_qualification">{{ __('Academic Qualification') }}</label>
                                            <div class="form-group">
                                                <textarea name="academic_qualification" id="academic_qualification" class="form-control textarea" placeholder="{{ __('Enter academic qualification..') }}">{{ session('employee_data.personal.academic_qualification', old('academic_qualification')) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="professional_qualification">{{ __('Professional Qualification') }}</label>
                                            <div class="form-group">
                                                <textarea name="professional_qualification" id="professional_qualification" class="form-control textarea" placeholder="{{ __('Enter professional qualification..') }}">{{ session('employee_data.personal.professional_qualification', old('professional_qualification')) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="experience">{{ __('Experience') }}</label>
                                            <div class="form-group">
                                                <textarea name="experience" id="experience" class="form-control textarea" placeholder="{{ __('Enter experience..') }}">{{ session('employee_data.personal.experience', old('experience')) }}</textarea>
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
                                                <input type="text" name="present_address" id="present_address" class="form-control" value="{{ session('employee_data.personal.present_address', old('present_address')) }}" placeholder="{{ __('Enter present address..') }}" required>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="city_pr">{{ __('City') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="city_pr" id="city_pr" class="form-control" value="{{ session('employee_data.personal.city_pr', old('city_pr')) }}" placeholder="{{ __('Enter city..') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="state_pr">{{ __('State') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="state_pr" id="state_pr" class="form-control" value="{{ session('employee_data.personal.state_pr', old('state_pr')) }}" placeholder="{{ __('Enter state.') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="postcode_pr">{{ __('Postcode') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="postcode_pr" id="postcode_pr" class="form-control" value="{{ session('employee_data.personal.postcode_pr', old('postcode_pr')) }}" placeholder="{{ __('Enter postcode..') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="country_pr">{{ __('Country') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="country_pr" id="country_pr" class="form-control" value="{{ session('employee_data.personal.country_pr', old('country_pr')) }}" placeholder="{{ __('Enter country..') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="permanent_address">{{ __('Permanent Address') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="permanent_address" id="permanent_address" class="form-control" value="{{ session('employee_data.personal.permanent_address', old('permanent_address')) }}" placeholder="{{ __('Enter permanent address..') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="city">{{ __('City') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="city" id="city" class="form-control" value="{{ session('employee_data.personal.city', old('city')) }}" placeholder="{{ __('Enter city..') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="state">{{ __('State') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="state" id="state" class="form-control" value="{{ session('employee_data.personal.state', old('state')) }}" placeholder="{{ __('Enter state.') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="postcode">{{ __('Postcode') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="postcode" id="postcode" class="form-control" value="{{ session('employee_data.personal.postcode', old('postcode')) }}" placeholder="{{ __('Enter postcode..') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="country">{{ __('Country') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="country" id="country" class="form-control" value="{{ session('employee_data.personal.country', old('country')) }}" placeholder="{{ __('Enter country..') }}">
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
                                                <input type="email" name="email" id="email" class="form-control" value="{{ session('employee_data.personal.email', old('email')) }}" placeholder="{{ __('Enter email address..') }}" required>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="contact_no_one">{{ __('Contact No') }} <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <input type="text" name="contact_no_one" id="contact_no_one" class="form-control" value="{{ session('employee_data.personal.contact_no_one', old('contact_no_one')) }}" placeholder="{{ __('Enter contact no..') }}" required>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="emergency_contact">{{ __('Emergency Contact') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="emergency_contact" id="emergency_contact" class="form-control" value="{{ session('employee_data.personal.emergency_contact', old('emergency_contact')) }}" placeholder="{{ __('Enter emergency contact no..') }}">
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
                                                <input type="text" name="passport_number" id="passport_number" class="form-control" value="{{ session('employee_data.personal.passport_number', old('passport_number')) }}" placeholder="{{ __('Enter passport number...') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="visa_number">{{ __('Visa Number') }}</label>
                                            <div class="form-group">
                                                <input type="text" name="visa_number" id="visa_number" class="form-control" value="{{ session('employee_data.personal.visa_number', old('visa_number')) }}" placeholder="{{ __('Enter visa number...') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-group">
                    <a href="{{ url('/people/employees') }}" class="btn btn-danger">{{ __('Cancel') }}</a>
                    <button type="submit" class="btn btn-primary next-step" data-next="payroll">{{ __('Next') }}</button>
                </div>
            </form>
        </div>

        <!-- Payroll Details -->
        <div class="form-step" data-step="payroll">
            <form id="payrollDetailsForm" method="post" action="{{ url('/people/employees/payroll_store') }}">
                {{ csrf_field() }}
                <input type="hidden" name="step" value="payroll">
                <div class="box-body">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="card">
                                <div class="card-header" style="background-color: #007bff; color: white; padding: 10px;">
                                    <h5>{{ __('Basic Salary') }}</h5>
                                    <div style="text-align: right;">
                                        <label for="tax_residency">{{ __('Select Tax Residency') }}</label>
                                        <select name="tax_residency" id="tax_residency" class="form-control" required>
                                            <option value="1" {{ session('employee_data.payroll.tax_residency', old('tax_residency')) == '1' ? 'selected' : '' }}>Residential</option>
                                            <option value="2" {{ session('employee_data.payroll.tax_residency', old('tax_residency')) == '2' ? 'selected' : '' }}>Non-Resident</option>
                                        </select>
                                        <div class="error-message"></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead style="background-color: #343a40; color: white;">
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
                                                    <input type="text" name="period_definition" class="form-control" id="period_definition" value="{{ session('employee_data.payroll.period_definition', 'FN - Fortnightly ' . ($sumOfWorkingHours*2 ?? 80) . ' Hours') }}" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" name="annual_salary" class="form-control" id="annual_salary" value="{{ session('employee_data.payroll.annual_salary', old('annual_salary')) }}" placeholder="{{ __('Enter annual salary..') }}" required>
                                                    <div class="error-message"></div>
                                                </td>
                                                <td>
                                                    <input type="number" name="basic_salary" class="form-control" id="basic_salary" value="{{ session('employee_data.payroll.basic_salary', old('basic_salary')) }}" placeholder="{{ __('Enter fortnight salary..') }}" required>
                                                    <div class="error-message"></div>
                                                </td>
                                                <td>
                                                    <input type="number" name="hrly_salary_rate" class="form-control" id="hrly_salary_rate" value="{{ session('employee_data.payroll.hrly_salary_rate', old('hrly_salary_rate')) }}" placeholder="{{ __('Enter working hours..') }}" required>
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
                                        <thead style="background-color: #007bff; color: white;">
                                            <tr>
                                                <th colspan="2">{{ __('House Allowances') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><label for="hr_place">{{ __('Place Name') }}</label></td>
                                                <td>
                                                    <select name="hr_place" id="hr_place" class="form-control">
                                                        <option value="" {{ !session('employee_data.payroll.hr_place', old('hr_place')) ? 'selected' : '' }}>{{ __('Select place for house allowance') }}</option>
                                                        @if(isset($loca_places))
                                                            @foreach($loca_places as $item)
                                                                <option value="{{ $item['id'] }}" {{ session('employee_data.payroll.hr_place', old('hr_place')) == $item['id'] ? 'selected' : '' }}>{{ $item['places'] }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="hr_area">{{ __('Area Name') }}</label></td>
                                                <td>
                                                    <input type="text" name="hr_area" id="hr_area" class="form-control" value="{{ session('employee_data.payroll.hr_area', old('hr_area')) }}" placeholder="{{ __('Area...') }}" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="hra_type">{{ __('Housing Allowance Type') }}</label></td>
                                                <td>
                                                    <select name="hra_type" id="hra_type" class="form-control">
                                                        <option value="" selected>{{ __('Select One') }}</option>
                                                        <option value="1" {{ session('employee_data.payroll.hra_type', old('hra_type')) == '1' ? 'selected' : '' }}>{{ __('Rental') }}</option>
                                                        <option value="2" {{ session('employee_data.payroll.hra_type', old('hra_type')) == '2' ? 'selected' : '' }}>{{ __('Kind') }}</option>
                                                        <option value="3" {{ session('employee_data.payroll.hra_type', old('hra_type')) == '3' ? 'selected' : '' }}>{{ __('Not Applicable') }}</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="hra_amount_per_week">{{ __('House Rent/Purchase Amount') }}</label></td>
                                                <td>
                                                    <input type="number" name="hra_amount_per_week" id="hra_amount_per_week" value="{{ session('employee_data.payroll.hra_amount_per_week', old('hra_amount_per_week')) }}" class="form-control" placeholder="{{ __('Enter amount ..') }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="house_rent_allowance">{{ __('Housing Allowance') }}</label></td>
                                                <td>
                                                    <input type="number" name="house_rent_allowance" id="house_rent_allowance" value="{{ session('employee_data.payroll.house_rent_allows', old('house_rent_allowance')) }}" class="form-control" placeholder="0" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <thead style="background-color: #007bff; color: white;">
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
                                                        <option value="1" {{ session('employee_data.payroll.va_type', old('va_type')) == '1' ? 'selected' : '' }}>{{ __('With Fuel') }}</option>
                                                        <option value="2" {{ session('employee_data.payroll.va_type', old('va_type')) == '2' ? 'selected' : '' }}>{{ __('Without Fuel') }}</option>
                                                        <option value="3" {{ session('employee_data.payroll.va_type', old('va_type')) == '3' ? 'selected' : '' }}>{{ __('Not Applicable') }}</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="vehicle_allowance">{{ __('Vehicle Allowance') }}</label></td>
                                                <td>
                                                    <input type="number" name="vehicle_allowance" id="vehicle_allowance" value="{{ session('employee_data.payroll.vehicle_allowance', old('vehicle_allowance')) }}" class="form-control" placeholder="0" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <thead style="background-color: #007bff; color: white;">
                                            <tr>
                                                <th colspan="2">{{ __('Other Allowances') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><label for="meals_allowance">{{ __('Meals (Messing) Allowance') }}</label></td>
                                                <td>
                                                    <input type="checkbox" name="meals_tag" id="meals_tag" value="1" {{ session('employee_data.payroll.meals_tag', old('meals_tag')) ? 'checked' : '' }}>
                                                    <input type="number" name="meals_allowance" id="meals_allowance" value="{{ session('employee_data.payroll.meals_allowance', old('meals_allowance')) }}" class="form-control" placeholder="0" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="medical_allowance">{{ __('Medical Allowance') }}</label></td>
                                                <td>
                                                    <input type="number" name="medical_allowance" id="medical_allowance" value="{{ session('employee_data.payroll.medical_allowance', old('medical_allowance')) }}" class="form-control" placeholder="{{ __('Enter medical allowance..') }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="special_allowance">{{ __('Telephone Allowance') }}</label></td>
                                                <td>
                                                    <input type="number" name="special_allowance" id="special_allowance" value="{{ session('employee_data.payroll.special_allowance', old('special_allowance')) }}" class="form-control" placeholder="{{ __('Enter telephone allowance..') }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="other_allowance">{{ __('Servant Allowance') }}</label></td>
                                                <td>
                                                    <input type="number" name="other_allowance" id="other_allowance" value="{{ session('employee_data.payroll.other_allowance', old('other_allowance')) }}" class="form-control" placeholder="{{ __('Enter domestic servant allowance..') }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="electricity_allowance">{{ __('Electricity Allowance') }}</label></td>
                                                <td>
                                                    <input type="number" name="electricity_allowance" id="electricity_allowance" value="{{ session('employee_data.payroll.electricity_allowance', old('electricity_allowance')) }}" class="form-control" placeholder="{{ __('Enter electricity allowance..') }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label for="security_allowance">{{ __('Security Allowance') }}</label></td>
                                                <td>
                                                    <input type="number" name="security_allowance" id="security_allowance" value="{{ session('employee_data.payroll.security_allowance', old('security_allowance')) }}" class="form-control" placeholder="{{ __('Enter security allowance..') }}">
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
                                        <thead style="background-color: #343a40; color: white;">
                                            <tr>
                                                <th>{{ __('Deductions & Rebate') }}</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ __('Tax Deduction (A)') }}</td>
                                                <td>
                                                    <input type="number" name="tax_deduction_a" id="tax_deduction_a" value="{{ session('employee_data.payroll.tax_deduction_a', old('tax_deduction_a')) }}" class="form-control" placeholder="{{ __('Enter tax deduction..') }}" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Dependents') }}</td>
                                                <td>
                                                    <select name="no_of_dependent" id="no_of_dependent_frm" class="form-control">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <option value="{{ $i }}" {{ session('employee_data.payroll.no_of_dependent', old('no_of_dependent')) == $i ? 'selected' : '' }}>{{ $i }}</option>
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
                                                            <option value="{{ $superannuation->id }}" data-superannuation="{{ json_encode($superannuation) }}" {{ session('employee_data.payroll.superannuation_id', old('superannuation_id')) == $superannuation->id ? 'selected' : '' }}>
                                                                {{ $superannuation->name }} ({{ $superannuation->code }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <input type="text" id="employer_contribution_percentage" name="employer_contribution_percentage" class="form-control" readonly>
                                                    <div class="error-message"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Superannuation Fund Deduction') }}</td>
                                                <td>
                                                    <input type="number" name="provident_fund_deduction" id="provident_fund_deduction" value="{{ session('employee_data.payroll.provident_fund_deduction', old('provident_fund_deduction')) }}" class="form-control" placeholder="{{ __('Enter superannuation fund deduction..') }}">
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
                                        <input type="number" disabled class="form-control" id="gross_salary">
                                    </div>
                                    <div class="form-group">
                                        <label for="total_deduction">{{ __('Total Deduction') }}</label>
                                        <input type="number" disabled class="form-control" id="total_deduction">
                                    </div>
                                    <div class="form-group">
                                        <label for="net_salary">{{ __('Net Salary') }}</label>
                                        <input type="number" disabled class="form-control" id="net_salary">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary prev-step" data-prev="personal">{{ __('Previous') }}</button>
                    <button type="submit" class="btn btn-primary next-step" data-next="costcenter">{{ __('Next') }}</button>
                </div>
            </form>
        </div>

        <!-- Cost Center -->
        <div class="form-step" data-step="costcenter">
            <form id="costCenterForm" method="post" action="{{ url('/people/employees/cost_store') }}">
                {{ csrf_field() }}
                <input type="hidden" name="step" value="costcenter">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-bordered">
                                <thead style="background-color: #343a40; color: white;">
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
                                                <option value="" {{ !session('employee_data.costcenter.payroll_location', old('payroll_location')) ? 'selected' : '' }}>{{ __('Select one') }}</option>
                                                @foreach(\App\Models\PayLocation::all() as $location)
                                                    <option value="{{ $location->id }}" {{ session('employee_data.costcenter.payroll_location', old('payroll_location')) == $location->id ? 'selected' : '' }}>{{ $location->payroll_location_name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="error-message"></div>
                                        </td>
                                        <td>
                                            <select name="pay_batch_number" id="pay_batch_number" class="form-control" required>
                                                <option value="" {{ !session('employee_data.costcenter.pay_batch_number', old('pay_batch_number')) ? 'selected' : '' }}>{{ __('Select one') }}</option>
                                                @foreach(\App\Models\PayBatchNumber::all() as $batch)
                                                    <option value="{{ $batch->id }}" {{ session('employee_data.costcenter.pay_batch_number', old('pay_batch_number')) == $batch->id ? 'selected' : '' }}>{{ $batch->pay_batch_number_name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="error-message"></div>
                                        </td>
                                        <td>
                                            <select name="cost_center" id="cost_center" class="form-control" required>
                                                <option value="" {{ !session('employee_data.costcenter.cost_center', old('cost_center')) ? 'selected' : '' }}>{{ __('Select one') }}</option>
                                                @if(isset($costcenters))
                                                    @foreach($costcenters as $costcenter)
                                                        <option value="{{ $costcenter->id }}" {{ session('employee_data.costcenter.cost_center', old('cost_center')) == $costcenter->id ? 'selected' : '' }}>{{ $costcenter->name }} - {{ $costcenter->cost_center_code }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="error-message"></div>
                                        </td>
                                        <td>
                                            <select name="department[]" id="department" class="form-control" multiple required>
                                                <option value="" {{ !session('employee_data.costcenter.department', old('department')) ? 'selected' : '' }}>{{ __('Select one or more') }}</option>
                                                <!-- Assume departments are populated dynamically -->
                                            </select>
                                            <div class="error-message"></div>
                                        </td>
                                        <td>
                                            <div id="share_percentage_fields">
                                                <input type="number" name="cost_center_share_percentage" class="form-control" value="{{ session('employee_data.costcenter.cost_center_share_percentage', old('cost_center_share_percentage')) }}" required>
                                            </div>
                                            <div class="error-message"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary prev-step" data-prev="payroll">{{ __('Previous') }}</button>
                    <button type="submit" class="btn btn-primary next-step" data-next="contact">{{ __('Next') }}</button>
                </div>
            </form>
        </div>

        <!-- Contact Information -->
        <div class="form-step" data-step="contact">
            <form id="contactInfoForm" method="post" action="{{ url('/employee_contacts/update/') }}">
                {{ csrf_field() }}
                <input type="hidden" name="step" value="contact">
                <div class="box-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="employee_contact_name">{{ __('Contact Name') }} <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="text" name="employee_contact_name" id="employee_contact_name" class="form-control" value="{{ session('employee_data.contact.employee_contact_name', old('employee_contact_name')) }}" placeholder="{{ __('Enter name..') }}" required>
                                <div class="error-message"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="employee_contact_address">{{ __('Address') }}<span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="text" name="employee_contact_address" id="employee_contact_address" class="form-control" value="{{ session('employee_data.contact.employee_contact_address', old('employee_contact_address')) }}" placeholder="{{ __('Enter contact address..') }}" required>
                                <div class="error-message"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="employee_contact_phone">{{ __('Phone') }}<span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="text" name="employee_contact_phone" id="employee_contact_phone" class="form-control" value="{{ session('employee_data.contact.employee_contact_phone', old('employee_contact_phone')) }}" placeholder="{{ __('Enter phone no..') }}" required>
                                <div class="error-message"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="employee_contact_mobile">{{ __('Mobile') }}<span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="text" name="employee_contact_mobile" id="employee_contact_mobile" class="form-control" value="{{ session('employee_data.contact.employee_contact_mobile', old('employee_contact_mobile')) }}" placeholder="{{ __('Enter mobile no..') }}" required>
                                <div class="error-message"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="employee_contact_email">{{ __('Employee Contact Email') }} <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="email" name="employee_contact_email" id="employee_contact_email" class="form-control" value="{{ session('employee_data.contact.employee_contact_email', old('employee_contact_email')) }}" placeholder="{{ __('Enter employee_contact_email address..') }}" required>
                                <div class="error-message"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="employee_contact_relationship">{{ __('Relation') }}<span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="text" name="employee_contact_relationship" id="employee_contact_relationship" class="form-control" value="{{ session('employee_data.contact.employee_contact_relationship', old('employee_contact_relationship')) }}" placeholder="{{ __('Enter relation..') }}" required>
                                <div class="error-message"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary prev-step" data-prev="costcenter">{{ __('Previous') }}</button>
                    <button type="submit" class="btn btn-primary next-step" data-next="leave">{{ __('Next') }}</button>
                </div>
            </form>
        </div>

        <!-- Leave Details -->
        <div class="form-step" data-step="leave">
            <form id="leaveDetailsForm" method="post" action="{{ url('people/employees/leave_store') }}">
                {{ csrf_field() }}
                <input type="hidden" name="step" value="leave">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="background-color: #343a40; color: white;">
                                <tr>
                                    <th>{{ __('Leave Category') }}</th>
                                    <th>{{ __('Leave Count') }}</th>
                                    <th>{{ __('Leave Type') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaveCategories as $leave)
                                    <tr>
                                        <td>{{ $leave->leave_category }}
                                            <input type="hidden" name="leave_category_id[]" value="{{ $leave->id }}">
                                        </td>
                                        <td>
                                            <input type="number" id="leave_balance_{{ $leave->id }}" name="leave_balance[]" class="form-control" value="{{ session('employee_data.leave.leave_balance.' . $leave->id, $leave->qty) }}" readonly>
                                        </td>
                                        <td>
                                            <input type="text" id="leave_type_{{ $leave->id }}" name="leave_type[]" class="form-control" value="{{ session('employee_data.leave.leave_type.' . $leave->id, $leave->type_of_leave) }}" readonly>
                                        </td>
                                        <td>
                                            <input type="checkbox" id="leave_active_{{ $leave->id }}" name="leave_active[]" value="{{ $leave->id }}" class="form-control" {{ session('employee_data.leave.leave_active.' . $leave->id, $leave->active) ? 'checked' : '' }}>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary prev-step" data-prev="contact">{{ __('Previous') }}</button>
                    <button type="submit" class="btn btn-primary next-step" data-next="superannuation">{{ __('Next') }}</button>
                </div>
            </form>
        </div>

        <!-- Superannuation -->
        <div class="form-step" data-step="superannuation">
            <form id="superannuationForm" method="post" action="{{ route('employees.submit_superannuation') }}">
                {{ csrf_field() }}
                <input type="hidden" name="step" value="superannuation">
                <div class="box-body">
                    <div class="mb-3">
                        <label for="superannuation_id" class="form-label">{{ __('Superannuation') }}</label>
                        <select name="superannuation_id" id="empl_superannuation_id" class="form-control" required>
                            <option value="" {{ !session('employee_data.superannuation.superannuation_id', old('superannuation_id')) ? 'selected' : '' }}>{{ __('Select Superannuation') }}</option>
                            @foreach($superannuations as $superannuation)
                                <option value="{{ $superannuation->id }}" data-superannuation="{{ json_encode($superannuation) }}" {{ session('employee_data.superannuation.superannuation_id', old('superannuation_id')) == $superannuation->id ? 'selected' : '' }}>
                                    {{ $superannuation->name }} ({{ $superannuation->code }})
                                </option>
                            @endforeach
                        </select>
                        <div class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="employer_contribution_percentage" class="form-label">{{ __('Employer Contribution (%)') }}</label>
                        <input type="text" id="employer_contribution_percentage" name="employer_contribution_percentage" value="{{ session('employee_data.superannuation.employer_contribution_percentage', old('employer_contribution_percentage')) }}" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="employer_contribution_fixed_amount" class="form-label">{{ __('Employer Fixed Contribution') }}</label>
                        <input type="text" id="employer_contribution_fixed_amount" name="employer_contribution_fixed_amount" value="{{ session('employee_data.superannuation.employer_contribution_fixed_amount', old('employer_contribution_fixed_amount')) }}" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="bank_name" class="form-label">{{ __('Bank Name') }}</label>
                        <input type="text" id="bank_name" name="bank_name" value="{{ session('employee_data.superannuation.bank_name', old('bank_name')) }}" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="bank_address" class="form-label">{{ __('Bank Address') }}</label>
                        <input type="text" id="bank_address" name="bank_address" value="{{ session('employee_data.superannuation.bank_address', old('bank_address')) }}" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="bank_account_number" class="form-label">{{ __('Bank Account Number') }}</label>
                        <input type="text" id="bank_account_number" name="bank_account_number" value="{{ session('employee_data.superannuation.bank_account_number', old('bank_account_number')) }}" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="employer_superannuation_no" class="form-label">{{ __('Employer Superannuation No') }}</label>
                        <select id="employer_superannuation_no" name="employer_superannuation_no" class="form-control" required>
                            <option value="" {{ !session('employee_data.superannuation.employer_superannuation_no', old('employer_superannuation_no')) ? 'selected' : '' }}>{{ __('Select one') }}</option>
                            @if($companies)
                                @foreach($companies as $company)
                                    <option value="{{ $company->superannuation_number }}" {{ session('employee_data.superannuation.employer_superannuation_no', old('employer_superannuation_no')) == $company->superannuation_number ? 'selected' : '' }}>{{ $company->superannuation_number }} - {{ $company->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <div class="error-message"></div>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary prev-step" data-prev="leave">{{ __('Previous') }}</button>
                    <button type="submit" class="btn btn-primary next-step" data-next="bank">{{ __('Next') }}</button>
                </div>
            </form>
        </div>

        <!-- Bank Credits -->
        <div class="form-step" data-step="bank">
            <form id="bankCreditsForm" method="post" action="{{ url('people/employees/bank_store') }}">
                {{ csrf_field() }}
                <input type="hidden" name="step" value="bank">
                <div class="box-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <strong class="d-block mb-2">{{ __('Select Bank') }}</strong>
                                    @if($bankLists)
                                        <select class="form-control mb-3" name="bank_id" id="bank_id" required>
                                            <option value="" {{ !session('employee_data.bank.bank_id', old('bank_id')) ? 'selected' : '' }}>{{ __('Select one') }}</option>
                                            @foreach($bankLists as $bankList)
                                                <option value="{{ $bankList->id }}_{{ $bankList->bank_code }}" {{ session('employee_data.bank.bank_id', old('bank_id')) == $bankList->id . '_' . $bankList->bank_code ? 'selected' : '' }}>{{ $bankList->bank_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="error-message"></div>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="acct_no" id="acct_no" value="{{ session('employee_data.bank.acct_no', old('acct_no', '1000234569')) }}" placeholder="{{ __('Account No') }}" required>
                                    <div class="error-message"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="swift_code" id="swift_code" value="{{ session('employee_data.bank.swift_code', old('swift_code', 'Swift Code')) }}" placeholder="{{ __('Swift Code') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="acct_name" id="acct_name" value="{{ session('employee_data.bank.acct_name', old('acct_name', 'S Mathew')) }}" placeholder="{{ __('Account Name') }}" required>
                                    <div class="error-message"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="acct_add" id="acct_add" value="{{ session('employee_data.bank.acct_add', old('acct_add')) }}" placeholder="{{ __('Address') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="acct_city" id="acct_city" value="{{ session('employee_data.bank.acct_city', old('acct_city')) }}" placeholder="{{ __('City') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="email" class="form-control" name="acct_email" id="acct_email" value="{{ session('employee_data.bank.acct_email', old('acct_email')) }}" placeholder="{{ __('Email Address') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" maxlength="3" name="acct_ccode" id="acct_ccode" value="{{ session('employee_data.bank.acct_ccode', old('acct_ccode')) }}" placeholder="{{ __('Country Code') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary prev-step" data-prev="superannuation">{{ __('Previous') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Save Employee') }}</button>
                </div>
            </form>
        </div>
    </section>
</div>

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

    /* Ensure Bootstrap 4 accordion styling compatibility with !important */
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

<!-- Include Bootstrap 4 JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Initialize datepickers
    $('#datepicker, #datepicker4, #datepicker5').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    // Function to update Previous button state
    function updatePreviousButtonState() {
        if ($('.form-step.active').data('step') === 'personal') {
            $('.prev-step').prop('disabled', true);
        } else {
            $('.prev-step').prop('disabled', false);
        }
    }

    // Initial check for Previous button state
    updatePreviousButtonState();

    // Form validation and submission
    $('form').each(function() {
        $(this).on('submit', function(e) {
            e.preventDefault();
            let form = $(this);
            let isValid = true;
            let errors = [];
            let firstErrorField = null;

            // Clear previous errors
            form.find('.error').removeClass('error');
            form.find('.error-message').text('');

            // Open all accordions in Personal Details step to validate all fields
            if (form.attr('id') === 'personalDetailsForm') {
                $('#personalAccordion .collapse').collapse('show');
            }

            // Validate required fields
            form.find('[required]').each(function() {
                let field = $(this);
                let value = field.val().trim();
                let fieldName = field.prev('label').text() || field.attr('name');

                if (!value || (field.is('select') && value === '')) {
                    isValid = false;
                    field.addClass('error');
                    field.closest('.form-group').find('.error-message').text(`${fieldName} is required`);
                    errors.push(`${fieldName} is required`);
                    if (!firstErrorField) {
                        firstErrorField = field;
                    }
                }
            });

            // Validate email fields
            form.find('input[type="email"]').each(function() {
                let email = $(this);
                let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                let fieldName = email.prev('label').text() || email.attr('name');
                if (email.val() && !emailRegex.test(email.val())) {
                    isValid = false;
                    email.addClass('error');
                    email.closest('.form-group').find('.error-message').text('Invalid email format');
                    errors.push(`Invalid email format for ${fieldName}`);
                    if (!firstErrorField) {
                        firstErrorField = email;
                    }
                }
            });

            // Scroll to first error field
            if (firstErrorField) {
                $('html, body').animate({
                    scrollTop: firstErrorField.offset().top - 100
                }, 500);
            }

            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: errors.join('<br>'),
                });
                return;
            }

            // Submit form via AJAX
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        }).then(() => {
                            let nextStep = form.find('.next-step').data('next');
                            if (nextStep) {
                                $('.form-step').removeClass('active');
                                $(`.form-step[data-step="${nextStep}"]`).addClass('active');
                                $('.step').removeClass('active');
                                $(`.step[data-step="${nextStep}"]`).addClass('active');
                                $('html, body').animate({
                                    scrollTop: $(`.form-step[data-step="${nextStep}"]`).offset().top
                                }, 500);
                                updatePreviousButtonState();
                            } else {
                                window.location.href = '{{ url('/people/employees') }}';
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message || 'An error occurred while saving.',
                        });
                    }
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON?.errors || {};
                    let errorMessages = [];
                    let firstErrorField = null;

                    for (let field in errors) {
                        errorMessages.push(errors[field][0]);
                        let $field = form.find(`[name="${field}"]`);
                        $field.addClass('error');
                        $field.closest('.form-group').find('.error-message').text(errors[field][0]);
                        if (!firstErrorField) {
                            firstErrorField = $field;
                        }
                    }

                    if (firstErrorField) {
                        // Open the accordion containing the error field
                        let $accordionContent = firstErrorField.closest('.collapse');
                        if ($accordionContent.length) {
                            $accordionContent.collapse('show');
                        }
                        $('html, body').animate({
                            scrollTop: firstErrorField.offset().top - 100
                        }, 500);
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        html: errorMessages.join('<br>'),
                    });
                }
            });
        });
    });

    // Previous step navigation
    $('.prev-step').on('click', function() {
        let prevStep = $(this).data('prev');
        $('.form-step').removeClass('active');
        $(`.form-step[data-step="${prevStep}"]`).addClass('active');
        $('.step').removeClass('active');
        $(`.step[data-step="${prevStep}"]`).addClass('active');
        $('html, body').animate({
            scrollTop: $(`.form-step[data-step="${prevStep}"]`).offset().top
        }, 500);
        updatePreviousButtonState();
    });

    // Handle superannuation selection
    $('#empl_superannuation_id').on('change', function() {
        let selectedOption = $(this).find('option:selected');
        let superannuation = selectedOption.data('superannuation');
        if (superannuation) {
            $('#employer_contribution_percentage').val(superannuation.employer_contribution_percentage || '');
            $('#employer_contribution_fixed_amount').val(superannuation.employer_contribution_fixed_amount || '');
            $('#bank_name').val(superannuation.bank_name || '');
            $('#bank_address').val(superannuation.bank_address || '');
            $('#bank_account_number').val(superannuation.bank_account_number || '');
        }
    });
});
</script>
@endsection