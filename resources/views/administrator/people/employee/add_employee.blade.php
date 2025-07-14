@extends('administrator.master')
@section('title', __('Add Employee'))

@section('main_content')
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
            <form id="personalDetailsForm" method="post" action="{{ url('/people/employees/store') }}" novalidate>
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
                                                    <input type="text" name="date_of_birth" class="form-control datepicker" value="{{ session('employee_data.personal.date_of_birth', old('date_of_birth')) }}" id="datepicker">
                                                    <div class="input-group-append">
                                                        <!-- <span class="input-group-text calendar-icon"><i class="fa fa-calendar"></i></span> -->
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
                                                    <input type="text" name="joining_date" class="form-control datepicker" id="datepicker4" value="{{ session('employee_data.personal.joining_date', old('joining_date')) }}" placeholder="{{ __('dd/mm/yyyy') }}" required>
                                                    <!-- <span class="input-group-text calendar-icon"><i class="fa fa-calendar"></i></span> -->
                                                </div>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="end_date">{{ __('End Date') }}<span class="text-danger"></span></label>
                                            <div class="form-group">
                                                <div class="input-group date">
                                                    <input type="text" name="end_date" class="form-control datepicker" id="datepicker5" value="{{ session('employee_data.personal.end_date', old('end_date')) }}" placeholder="{{ __('dd/mm/yyyy') }}">
                                                    <!-- <span class="input-group-text calendar-icon"><i class="fa fa-calendar"></i></span> -->
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
                                                    <option value="{{ $role->id }}" {{ session('employee_data.personal.role', old('role')) == $role->id ? 'selected' : '' }}>{{ $role->display_name }}</option>
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
                                                <select name="resident_status" id="resident_status" class="form-control" required>
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
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary prev-step" data-prev="personal" disabled>
                        {{ __('Previous') }}
                    </button>
                    
                    <button type="button" class="btn btn-primary next-step" data-next="payroll">
                        {{ __('Next') }}
                    </button>
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
                                <div class="card-header" style="background-color: #007bff; color: #fff; padding: 10px;">
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
                                                    <input type="number" name="house_rent_allowance" id="house_rent_allowance" value="{{ session('employee_data.payroll.house_rent_allowance', old('house_rent_allowance')) }}" class="form-control" placeholder="0" readonly>
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
                                        <thead style="background-color: #007bff; color: #000;">
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
                                                    <input type="number" name="tax_deduction_a" id="tax_deduction_a" value="{{ session('employee_data.payroll.tax_deduction_a', old('tax_deduction_a')) }}" class="form-control" placeholder="{{ __('Enter tax deduction..') }}" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Dependents') }}</td>
                                                <td>
                                                    <select name="no_of_dependent" id="no_of_dependent" class="form-control">
                                                        @for ($i = 0; $i <= 5; $i++)
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
                <div class="d-flex justify-content-between mt-2">
                    <button type="button" class="btn btn-secondary prev-step" data-prev="personal">{{ __('Previous') }}</button>
                    <button type="button" class="btn btn-primary next-step" data-next="costcenter">{{ __('Next') }}</button>
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
                                                <option value="" disabled>{{ __('Select one or more') }}</option>
                                                @if(isset($departments))
                                                    @foreach($departments as $dept)
                                                        <option value="{{ $dept->id }}" {{ in_array($dept->id, session('employee_data.costcenter.department', old('department', []))) ? 'selected' : '' }}>{{ $dept->department }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="error-message"></div>
                                        </td>
                                        <td>
                                            <div id="share_percentage_fields">
                                                @if(isset($departments) && session('employee_data.costcenter.department', old('department', [])))
                                                    @foreach(session('employee_data.costcenter.department', old('department', [])) as $deptId)
                                                        @php $dept = collect($departments)->firstWhere('id', $deptId); @endphp
                                                        <div class="form-group">
                                                            <label for="share_percentage_{{ $deptId }}">{{ $dept ? $dept->department : 'Department' }} Share Percentage</label>
                                                            <input type="number" class="form-control" name="cost_center_share_percentage[{{ $deptId }}]" id="share_percentage_{{ $deptId }}" value="{{ session('employee_data.costcenter.cost_center_share_percentage.' . $deptId, old('cost_center_share_percentage.' . $deptId)) ?? '' }}" min="0" max="100" step="0.01" required>
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
                </div>
            </form>
        </div>

        <!-- Contact Information -->
        <div class="form-step" data-step="contact">
            <form id="contactForm" method="post" action="{{ url('/people/employees/employee_contacts_add') }}">
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
                            <label for="employee_contact_address">{{ __('Address') }} <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="text" name="employee_contact_address" id="employee_contact_address" class="form-control" value="{{ session('employee_data.contact.employee_contact_address', old('employee_contact_address')) }}" placeholder="{{ __('Enter contact address..') }}" required>
                                <div class="error-message"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="employee_contact_phone">{{ __('Phone') }} <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="text" name="employee_contact_phone" id="employee_contact_phone" class="form-control" value="{{ session('employee_data.contact.employee_contact_phone', old('employee_contact_phone')) }}" placeholder="{{ __('Enter phone no..') }}" required>
                                <div class="error-message"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="employee_contact_mobile">{{ __('Mobile') }} <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="text" name="employee_contact_mobile" id="employee_contact_mobile" class="form-control" value="{{ session('employee_data.contact.employee_contact_mobile', old('employee_contact_mobile')) }}" placeholder="{{ __('Enter mobile no..') }}" required>
                                <div class="error-message"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="employee_contact_email">{{ __('Employee Contact Email') }} <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="email" name="employee_contact_email" id="employee_contact_email" class="form-control" value="{{ session('employee_data.contact.employee_contact_email', old('employee_contact_email')) }}" placeholder="{{ __('Enter personal email address..') }}" required>
                                <div class="error-message"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="employee_contact_relationship">{{ __('Relation') }} <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="text" name="employee_contact_relationship" id="employee_contact_relationship" class="form-control" value="{{ session('employee_data.contact.employee_contact_relationship', old('employee_contact_relationship')) }}" placeholder="{{ __('Enter relation..') }}" required>
                                <div class="error-message"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <button type="button" class="btn btn-secondary prev-step" data-prev="costcenter">{{ __('Previous') }}</button>
                    <button type="button" class="btn btn-primary next-step" data-next="leave">{{ __('Next') }}</button>
                </div>
            </form>
        </div>

        <!-- Leave Details -->
        <div class="form-step" data-step="leave">
            <form id="leaveForm" method="post" action="{{ url('/people/employees/leave_store') }}">
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
                                            <input type="number" id="leave_balance_{{ $leave->id }}" name="leave_balance[]" class="form-control" value="{{ session('employee_data.leave.' . $leave->id . '.leave_balance', old('leave_balance.' . $leave->id, $leave->qty)) }}" readonly>
                                            <div class="error-message"></div>
                                        </td>
                                        <td>
                                            <input type="text" id="leave_type_{{ $leave->id }}" name="leave_type[]" class="form-control" value="{{ session('employee_data.leave.' . $leave->id . '.leave_type', old('leave_type.' . $leave->id, $leave->type_of_leave)) }}" readonly>
                                            <div class="error-message"></div>
                                        </td>
                                        <td>
                                            <input type="checkbox" id="leave_active_{{ $leave->id }}" name="leave_active[]" value="{{ $leave->id }}" class="form-control" {{ session('employee_data.leave.' . $leave->id . '.leave_active', old('leave_active.' . $leave->id, $leave->active)) ? 'checked' : '' }}>
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
                </div>
            </form>
        </div>

        <!-- Superannuation -->
        <div class="form-step" data-step="superannuation">
            <form id="superannuationForm" method="post" action="{{ url('/people/employees/submit_superannuation') }}">
                {{ csrf_field() }}
                <input type="hidden" name="step" value="superannuation">
                <div class="box-body">
                    <div class="mb-3">
                        <label for="superannuation_id" class="form-label">{{ __('Superannuation') }} <span class="text-danger">*</span></label>
                        <select name="superannuation_id" id="superannuation_id" class="form-control" required>
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
                        <label for="employer_superannuation_no" class="form-label">{{ __('Employer Superannuation No') }} <span class="text-danger">*</span></label>
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
                    <div class="mb-3">
                        <label for="employer_contribution_percentage_sup" class="form-label">{{ __('Employer Contribution (%)') }}</label>
                        <input type="text" id="employer_contribution_percentage_sup" name="employer_contribution_percentage" value="{{ session('employee_data.superannuation.employer_contribution_percentage', old('employer_contribution_percentage')) }}" class="form-control" readonly>
                        <div class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="employer_contribution_fixed_amount_sup" class="form-label">{{ __('Employer Fixed Contribution') }}</label>
                        <input type="text" id="employer_contribution_fixed_amount_sup" name="employer_contribution_fixed_amount" value="{{ session('employee_data.superannuation.employer_contribution_fixed_amount', old('employer_contribution_fixed_amount')) }}" class="form-control" readonly>
                        <div class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="bank_name" class="form-label">{{ __('Employee Superannuation Bank Name (If any)') }}</label>
                        @if($bankLists)
                            <select name="bank_name" id="bank_name" class="form-control">
                                <option value="" {{ !session('employee_data.superannuation.bank_name', old('bank_name')) ? 'selected' : '' }}>{{ __('Select Bank') }}</option>
                                @foreach($bankLists as $bank)
                                    <option value="{{ $bank->id }}" {{ session('employee_data.superannuation.bank_name', old('bank_name')) == $bank->id ? 'selected' : '' }}>{{ $bank->bank_name }}</option>
                                @endforeach
                            </select>
                        @else
                            <input type="text" name="bank_name" id="bank_name" class="form-control" value="{{ session('employee_data.superannuation.bank_name', old('bank_name')) }}" placeholder="{{ __('Enter bank name..') }}">
                        @endif
                        <div class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="bank_address" class="form-label">{{ __('Employee Superannuation Bank Address (If any)') }}</label>
                        <input type="text" id="bank_address" name="bank_address" value="{{ session('employee_data.superannuation.bank_address', old('bank_address')) }}" class="form-control" placeholder="{{ __('Enter bank address..') }}">
                        <div class="error-message"></div>
                    </div>
                    <div class="mb-3">
                        <label for="bank_account_number" class="form-label">{{ __('Employee Bank Account Number (If any)') }}</label>
                        <input type="text" id="bank_account_number" name="bank_account_number" value="{{ session('employee_data.superannuation.bank_account_number', old('bank_account_number')) }}" class="form-control" placeholder="{{ __('Enter bank account number..') }}">
                        <div class="error-message"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <button type="button" class="btn btn-secondary prev-step" data-prev="leave">{{ __('Previous') }}</button>
                    <button type="button" class="btn btn-primary next-step" data-next="bank">{{ __('Next') }}</button>
                </div>
            </form>
        </div>

        <!-- Bank Credits -->
        <div class="form-step" data-step="bank">
            <form id="bankForm" method="post" action="{{ url('/people/employees/bank_store') }}">
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
                                            <option value="" {{ !session('employee_data.bank.bank_id', old('bank_id')) ? 'selected' : '' }}>{{ __('Select one') }}</option>
                                            @foreach($bankLists as $bankList)
                                                <option value="{{ $bankList->id }}" {{ session('employee_data.bank.bank_id', old('bank_id')) == $bankList->id . '_' . $bankList->bank_code ? 'selected' : '' }}>{{ $bankList->bank_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="error-message"></div>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="acct_no" id="acct_no" value="{{ session('employee_data.bank.acct_no', old('acct_no')) }}" placeholder="{{ __('Account No') }}">
                                    <div class="error-message"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="swift_code" id="swift_code" value="{{ session('employee_data.bank.swift_code', old('swift_code')) }}" placeholder="{{ __('Swift Code') }}">
                                    <div class="error-message"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="acct_name" id="acct_name" value="{{ session('employee_data.bank.acct_name', old('acct_name')) }}" placeholder="{{ __('Account Name') }}">
                                    <div class="error-message"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="acct_add" id="acct_add" value="{{ session('employee_data.bank.acct_add', old('acct_add')) }}" placeholder="{{ __('Address') }}">
                                    <div class="error-message"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="acct_city" id="acct_city" value="{{ session('employee_data.bank.acct_city', old('acct_city')) }}" placeholder="{{ __('City') }}">
                                    <div class="error-message"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="email" class="form-control" name="acct_email" id="acct_email" value="{{ session('employee_data.bank.acct_email', old('acct_email')) }}" placeholder="{{ __('Email Address') }}">
                                    <div class="error-message"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" maxlength="3" name="acct_ccode" id="acct_ccode" value="{{ session('employee_data.bank.acct_ccode', old('acct_ccode')) }}" placeholder="{{ __('Country Code') }}">
                                    <div class="error-message"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <button type="button" class="btn btn-secondary prev-step" data-prev="superannuation">{{ __('Previous') }}</button>
                    <button type="submit" class="btn btn-success">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
<!-- Include Bootstrap 4 CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
<script>
$(document).ready(function () {
    // Initialize datepicker with consistent format
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    }).on('changeDate', function (e) {
        // Ensure date is formatted correctly for submission
        $(this).val(e.format('dd/mm/yyyy'));
    });

    // Define steps in order
    const steps = ['personal', 'payroll', 'costcenter', 'contact', 'leave', 'superannuation', 'bank'];

    // Function to update step visibility
    function updateStep(currentStep) {
        $('.form-step').removeClass('active');
        $(`.form-step[data-step="${currentStep}"]`).addClass('active');
        $('.step').removeClass('active');
        $(`.step[data-step="${currentStep}"]`).addClass('active');

        // Enable/Disable Previous button
        if (currentStep === 'personal') {
            $('.prev-step').prop('disabled', true);
        } else {
            $('.prev-step').prop('disabled', false);
        }

        // Update Next button visibility
        if (currentStep === 'bank') {
            $('.next-step').hide();
        } else {
            $('.next-step').show();
        }

        // Trigger department change for cost center step
        if (currentStep === 'costcenter' && $('#department').val()) {
            $('#department').trigger('change');
        }

        // Trigger superannuation population
        if (currentStep === 'superannuation' && $('#superannuation_id').val()) {
            $('#superannuation_id').trigger('change');
        }

        // Reinitialize datepicker for personal step after refresh
        if (currentStep === 'personal') {
            $('#joining_date').datepicker('update');
        }
    }

    // Client-side validation for cost center form
    function validateCostCenterForm(form) {
        const $form = $(form);
        const $percentageFields = $form.find('input[name^="cost_center_share_percentage["]');
        const selectedDepartments = $form.find('#department').val() || [];
        const errors = [];

        // Only validate percentages if more than one department is selected
        if (selectedDepartments.length > 1) {
            let totalPercentage = 0;
            const percentageKeys = [];

            // Calculate sum of percentages and collect keys
            $percentageFields.each(function () {
                const value = parseFloat($(this).val()) || 0;
                totalPercentage += value;
                const key = $(this).attr('name').match(/\[(\d+)\]/)[1];
                percentageKeys.push(key);
            });

            // Check if sum equals 100
            if (Math.abs(totalPercentage - 100) > 0.01) {
                errors.push('The sum of cost center share percentages must equal 100%.');
                $form.find('#general_percentage_error').html('The sum of cost center share percentages must equal 100%.');
            } else {
                $form.find('#general_percentage_error').empty();
            }

            // Check if department IDs match percentage keys
            const departments = selectedDepartments.map(String);
            const missingPercentageKeys = departments.filter(id => !percentageKeys.includes(id));
            const extraPercentageKeys = percentageKeys.filter(id => !departments.includes(id));

            if (missingPercentageKeys.length || extraPercentageKeys.length) {
                errors.push('Each selected department must have a corresponding share percentage, and vice versa.');
                $form.find('#general_percentage_error').append('<br>Each selected department must have a corresponding share percentage, and vice versa.');
            }
        }

        // Validate individual percentage fields
        $percentageFields.each(function () {
            const value = $(this).val();
            if (value === '' || isNaN(value) || parseFloat(value) < 0 || parseFloat(value) > 100) {
                $(this).addClass('error');
                $(this).next('.error-message').html('Percentage must be a number between 0 and 100.');
                errors.push('Invalid percentage value.');
            }
        });

        return errors.length === 0;
    }

    // Handle superannuation selection to populate readonly fields
    $('#superannuation_id').on('change', function () {
        const selectedOption = $(this).find('option:selected');
        const superannuationData = selectedOption.data('superannuation') || {};
        $('#employer_contribution_percentage_sup').val(superannuationData.employer_contribution_percentage || '');
        $('#employer_contribution_fixed_amount_sup').val(superannuationData.employer_contribution_fixed_amount || '');
    });

    // Handle Next button click
    $('.next-step').on('click', function (e) {
        e.preventDefault();
        const currentForm = $(this).closest('form');
        const currentStep = currentForm.find('input[name="step"]').val();
        const nextStep = $(this).data('next');

        // Clear previous error messages
        currentForm.find('.error-message').empty();
        currentForm.find('.form-control').removeClass('error');

        // Run client-side validation for cost center step
        if (currentStep === 'costcenter' && !validateCostCenterForm(currentForm)) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please correct the errors in the form.',
            });
            return;
        }

        // Perform AJAX submission
        $.ajax({
            url: currentForm.attr('action'),
            method: 'POST',
            data: currentForm.serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    updateStep(nextStep); // Move to next step without SweetAlert
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'An unexpected error occurred.',
                    });
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors || {};
                    $.each(errors, function (key, messages) {
                        let field;
                        if (key.includes('cost_center_share_percentage.')) {
                            const index = key.split('.').pop();
                            field = currentForm.find(`[name="cost_center_share_percentage[${index}]"]`);
                        } else if (key.includes('department.')) {
                            field = currentForm.find('[name="department[]"]');
                        } else if (key === 'cost_center_share_percentage') {
                            field = currentForm.find('#general_percentage_error');
                        } else if (key.includes('leave_balance.')) {
                            const index = key.split('.').pop();
                            field = currentForm.find(`[name="leave_balance[]"]:eq(${index})`);
                        } else if (key.includes('leave_type.')) {
                            const index = key.split('.').pop();
                            field = currentForm.find(`[name="leave_type[]"]:eq(${index})`);
                        } else if (key.includes('leave_active.')) {
                            const index = key.split('.').pop();
                            field = currentForm.find(`[name="leave_active[]"]:eq(${index})`);
                        } else {
                            field = currentForm.find(`[name="${key}"], [name="${key}[]"]`);
                        }
                        if (field.length) {
                            field.addClass('error');
                            field.next('.error-message').html(messages.join('<br>'));
                        }
                        // Open relevant accordion if in personal step
                        if (currentStep === 'personal') {
                            if (['name', 'gender', 'marital_status', 'date_of_birth'].includes(key)) {
                                $('#collapsePersonal').collapse('show');
                            } else if (['designation_id', 'joining_date', 'end_date', 'branch', 'role', 'employee_type', 'resident_status'].includes(key)) {
                                $('#collapseEmployment').collapse('show');
                            } else if (['academic_qualification', 'professional_qualification', 'experience'].includes(key)) {
                                $('#collapseQualifications').collapse('show');
                            } else if (['present_address', 'city_pr', 'state_pr', 'postcode_pr', 'country_pr', 'permanent_address', 'city', 'state', 'postcode', 'country'].includes(key)) {
                                $('#collapseResidential').collapse('show');
                            } else if (['email', 'contact_no_one', 'emergency_contact'].includes(key)) {
                                $('#collapseContact').collapse('show');
                            } else if (['passport_number', 'visa_number'].includes(key)) {
                                $('#collapsePassport').collapse('show');
                            }
                        }
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: 'Please correct the errors in the form.',
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'An error occurred. Please try again.',
                    });
                }
            }
        });
    });

    // Handle Previous button click
    $('.prev-step').on('click', function (e) {
        e.preventDefault();
        const prevStep = $(this).data('prev');
        updateStep(prevStep);
    });

    // Handle form submission for the bank step
    $('#bankForm').on('submit', function (e) {
        e.preventDefault();
        const form = $(this);

        // Clear previous error messages
        form.find('.error-message').empty();
        form.find('.form-control').removeClass('error');

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Your employee application saved successfully.',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = response.redirect || '{{ url("/people/employees") }}';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'An unexpected error occurred.',
                    });
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors || {};
                    $.each(errors, function (key, messages) {
                        const field = form.find(`[name="${key}"], [name="${key}[]"]`);
                        if (field.length) {
                            field.addClass('error');
                            field.next('.error-message').html(messages.join('<br>'));
                        }
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: 'Please correct the errors in the form.',
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'An error occurred. Please try again.',
                    });
                }
            }
        });
    });

    // Dynamic department population based on cost_center
    $('#cost_center').on('change', function () {
        const costCenterId = $(this).val();
        const selectedDepartments = @json(session('employee_data.costcenter.department', old('department', [])));
        const $department = $('#department');
        $department.empty().append('<option value="" disabled>Select one or more</option>');

        if (costCenterId) {
            $.ajax({
                url: window.Laravel.routes.GetDepartmentsByCostCenter + '/' + costCenterId,
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    const departments = response.departments || [];
                    departments.forEach(dept => {
                        $department.append(`<option value="${dept.id}" ${selectedDepartments.includes(dept.id.toString()) ? 'selected' : ''}>${dept.department}</option>`);
                    });
                    $department.trigger('change');
                },
                error: function (xhr) {
                    console.error('Error fetching departments:', xhr.responseText);
                    $department.append('<option value="">No departments available</option>');
                    $department.trigger('change');
                }
            });
        } else {
            $department.trigger('change');
        }
    });

    // Dynamic cost_center_share_percentage fields based on department selection
    $('#department').on('change', function () {
        const selectedDepartments = $(this).val() || [];
        const $percentageFields = $('#share_percentage_fields');
        const existingPercentages = @json(session('employee_data.costcenter.cost_center_share_percentage', old('cost_center_share_percentage', [])));
        $percentageFields.empty();

        if (selectedDepartments.length) {
            $.ajax({
                url: window.Laravel.routes.PeopleGetDepartment,
                method: 'GET',
                data: { ids: selectedDepartments },
                dataType: 'json',
                success: function (response) {
                    const departments = response.departments || [];
                    departments.forEach(dept => {
                        const percentage = existingPercentages[dept.id] || '';
                        $percentageFields.append(`
                            <div class="form-group">
                                <label for="share_percentage_${dept.id}">${dept.department} Share Percentage</label>
                                <input type="number" class="form-control" name="cost_center_share_percentage[${dept.id}]" id="share_percentage_${dept.id}" value="${percentage}" min="0" max="100" step="0.01" ${selectedDepartments.length > 1 ? 'required' : ''}>
                                <div class="error-message"></div>
                            </div>
                        `);
                    });
                },
                error: function (xhr) {
                    console.error('Error fetching department names:', xhr.responseText);
                    selectedDepartments.forEach(id => {
                        const percentage = existingPercentages[id] || '';
                        $percentageFields.append(`
                            <div class="form-group">
                                <label for="share_percentage_${id}">Department ${id} Share Percentage</label>
                                <input type="number" class="form-control" name="cost_center_share_percentage[${id}]" id="share_percentage_${id}" value="${percentage}" min="0" max="100" step="0.01" ${selectedDepartments.length > 1 ? 'required' : ''}>
                                <div class="error-message"></div>
                            </div>
                        `);
                    });
                }
            });
        }
    });

    // Trigger initial population
    if ($('#cost_center').val()) {
        $('#cost_center').trigger('change');
    } else if ($('#department').val()) {
        $('#department').trigger('change');
    }

    // Trigger superannuation population
    if ($('#superannuation_id').val()) {
        $('#superannuation_id').trigger('change');
    }
});
</script>