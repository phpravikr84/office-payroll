@extends('administrator.master')
@section('title', __('Add Employee'))

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           {{ __(' EMPLOYEE') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i>{{ __('Dashboard') }} </a></li>
            <li><a href="{{ url('/people/employees') }}">{{ __('Employee') }}</a></li>
            <li class="active">{{ __('Add Employee') }}</li>
        </ol>
    </section>

    <!-- Main content -->
     
    <section class="content">
        @if (!empty(Session::get('message')))
        <div class="alert alert-success alert-dismissible" id="notification_box">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fa fa-check"></i> {{ Session::get('message') }}
        </div>
        @elseif (!empty(Session::get('exception')))
        <div class="alert alert-warning alert-dismissible" id="notification_box">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fa fa-warning"></i> {{ Session::get('exception') }}
        </div>
        @endif

        <!-- Tab Navigation -->
        <ul class="nav nav-pills" role="tablist">
            <li class="nav-item active">
                <a class="nav-link emp-tablink" href="#personalDetailsTab" aria-controls="personalDetailsTab" role="tab" data-toggle="tab">
                    {{ __('Personal Details') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link emp-tablink" href="#payrollDetailsTab" aria-controls="payrollDetailsTab" role="tab" data-toggle="tab">
                    {{ __('Payroll Details') }}
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link emp-tablink" href="#costcenterInfoTab" aria-controls="costcenterInfoTab" role="tab" data-toggle="tab">
                    {{ __('Cost Cemter') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link emp-tablink" href="#contactInfoTab" aria-controls="contactInfoTab" role="tab" data-toggle="tab">
                    {{ __('Contact Information') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link emp-tablink" href="#leaveDetailsTab" aria-controls="leaveDetailsTab" role="tab" data-toggle="tab">
                    {{ __('Leave Details') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link emp-tablink" href="#superannuationTab" aria-controls="superannuationTab" role="tab" data-toggle="tab">
                    {{ __('Superannuation') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link emp-tablink" href="#bankCreditsTab" aria-controls="bankCreditsTab" role="tab" data-toggle="tab">
                    {{ __('Bank Credits') }}
                </a>
            </li>
        </ul>

        <!-- Tab Panes -->
        <div class="tab-content">
            <!-- Personal Details Tab -->
            <div role="tabpanel" class="tab-pane active" id="personalDetailsTab">
                <div class="panel-body">
                    <!-- Personal Details Form -->
                    <!-- Add your Personal Details form here -->
                    <div class="box box-default">
                        <div class="box-header">
                            <h4 class="box-title">{{ __('EMPLOYEE PERSONAL DETAILS') }}</h3>
                        </div>
                        <form action="{{ url('people/employees/store') }}" method="post" name="employee_add_form">
                            {{ csrf_field() }}
                            
                            @if(session()->has('employee_data'))
                                @php
                                    $employeeData = session()->get('employee_data');
                                    $userId = $employeeData['user_id'] ?? 0;

                                    // Retrieve user data if valid user ID exists
                                    $user = ($userId != 0 && $userId != '') ? \App\Models\User::find($userId) : null;
                                @endphp
                            @endif


                            <div class="box-body">
                                <div class="row">
                                    <!-- Notification Box -->
                                    <div class="col-md-12">
                                        @if (Session::has('message'))
                                            <div class="alert alert-success alert-dismissible" id="notification_box">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <i class="icon fa fa-check"></i> {{ Session::get('message') }}
                                            </div>
                                        @elseif (Session::has('exception'))
                                            <div class="alert alert-warning alert-dismissible" id="notification_box">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <i class="icon fa fa-warning"></i> {{ Session::get('exception') }}
                                            </div>
                                        @else
                                            <p class="text-yellow">{{ __('Enter team member details. All (*) fields are required. (Default password for added user is 12345678)') }}</p>
                                        @endif
                                    </div>
                                </div>
                                    <!-- Add your form fields here -->
                                    <?php 
                                        $users = \App\Models\User::orderBy('id', 'desc')->first();
                                        $sl=$users->id;
                                    ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="employee_id">{{ __('ID') }} <span class="text-danger">*</span></label>
                                        <div class="form-group{{ $errors->has('employee_id') ? ' has-error' : '' }} has-feedback">
                                            <input type="hidden" name="employee_id" value="{{$sl+1}}">
                                            <input type="text" class="form-control" value="{{ __('EMPID') }}{{$sl+1}}" disabled>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">{{ __('Name') }} <span class="text-danger">*</span></label>
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} has-feedback">
                                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="{{ __('Enter name..') }}">
                                            @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-3">
                                        <label for="father_name">{{ __('Fathers Name') }}</label>
                                        <div class="form-group{{ $errors->has('father_name') ? ' has-error' : '' }} has-feedback">
                                            <input type="text" name="father_name" id="father_name" class="form-control" value="{{ old('father_name') }}" placeholder="{{ __('Enter fathers name..') }}">
                                            @if ($errors->has('father_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('father_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-3">
                                        <label for="mother_name">{{ __('Mothers Name') }} </label>
                                        <div class="form-group{{ $errors->has('mother_name') ? ' has-error' : '' }} has-feedback">
                                            <input type="text" name="mother_name" id="mother_name" class="form-control" value="{{ old('mother_name') }}" placeholder="{{ __('Enter mothers name..') }}">
                                            @if ($errors->has('mother_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('mother_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-3">
                                        <label for="spouse_name">{{ __('Spouse Name') }} </label>
                                        <div class="form-group{{ $errors->has('spouse_name') ? ' has-error' : '' }} has-feedback">
                                            <input type="text" name="spouse_name" id="spouse_name" class="form-control" value="{{ old('spouse_name') }}" placeholder="{{ __('Enter spouse name..') }}">
                                            @if ($errors->has('spouse_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('spouse_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                 
                                   
                                    <!-- /.form-group -->
                                    <div class="col-md-3">
                                        <label for="gender">{{ __('Gender') }} <span class="text-danger">*</span></label>
                                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }} has-feedback">
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="" selected disabled>{{ __('Select one') }}</option>
                                                <option value="m">{{ __('Male') }}</option>
                                                <option value="f">{{ __('Female') }}</option>
                                            </select>
                                            @if ($errors->has('gender'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('gender') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- /.form-group -->

                                    <div class="col-md-3">
                                        <label for="marital_status">{{ __('Marital Status') }} </label>
                                        <div class="form-group{{ $errors->has('marital_status') ? ' has-error' : '' }} has-feedback">
                                            <select name="marital_status" id="marital_status" class="form-control">
                                                <option value="" selected disabled>{{ __('Select one') }}</option>
                                                <option value="1">{{ __('Married') }}</option>
                                                <option value="2">{{ __('Single') }}</option>
                                                <option value="3">{{ __('Divorced') }}</option>
                                                <option value="4">{{ __('Separated') }}</option>
                                                <option value="5">{{ __('Widowed') }}</option>
                                            </select>
                                            @if ($errors->has('marital_status'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('marital_status') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                        <!-- /.form-group -->
                                        
                                    <div class="col-md-3">                            
                                        <label for="datepicker">{{ __('Date of Birth') }}</label>
                                        <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }} has-feedback">
                                            <div class="input-group">
                                                <input type="text" name="date_of_birth" class="form-control pull-right" value="{{ old('date_of_birth') }}" id="datepicker">
                                                <div class="input-group-append">
                                                    <span class="input-group-text calendar-icon" id="date_picker_icon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <!-- /.form-group -->

                                    
                                        <div class="col-md-3">
                                        <label for="designation_id">{{ __('Designation') }} <span class="text-danger">*</span></label>
                                        <div class="form-group{{ $errors->has('designation_id') ? ' has-error' : '' }} has-feedback">
                                            <select name="designation_id" id="designation_id" class="form-control">
                                                <option value="" selected disabled>{{ __('Select one') }}</option>
                                                @foreach($designations as $designation)
                                                <option value="{{ $designation['id'] }}">{{ $designation['designation'] }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('designation_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('designation_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">                            
                                        <label for="datepicker4">{{ __('Joining Date') }}<span class="text-danger">*</span></label>
                                        <div class="form-group{{ $errors->has('joining_date') ? ' has-error' : '' }} has-feedback">
                                            <div class="input-group date">
                                                <input type="text" name="joining_date" class="form-control pull-right" id="datepicker4" placeholder="{{ __('yyyy-mm-dd') }}">
                                                <span class="input-group-text calendar-icon" id="date_picker_icon4">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>

                                    <div class="col-md-3">                            
                                        <label for="datepicker5">{{ __('End Date') }}<span class="text-danger">*</span></label>
                                        <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }} has-feedback">
                                            <div class="input-group date">
                                                <input type="text" name="end_date" class="form-control pull-right" id="datepicker4" placeholder="{{ __('yyyy-mm-dd') }}">
                                                <span class="input-group-text calendar-icon" id="date_picker_icon4">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <input type="hidden" name="home_district" value="None">

                                        <div class="col-md-3">
                                            <label for="branch">{{ __('Branch') }} <span class="text-danger">*</span></label>
                                            <div class="form-group{{ $errors->has('branch') ? ' has-error' : '' }} has-feedback">
                                                <select name="branch" id="branch" class="form-control">
                                                    <option value="" selected disabled>{{ __('Select one') }}</option>
                                                    <?php $branches = \App\Models\Branch::all(); ?>
                                                    @foreach($branches as $branch)
                                                    <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('branch'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('branch') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        <label for="role">{{ __('Role') }}<span class="text-danger">*</span></label>
                                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }} has-feedback">
                                            <select name="role" id="role" class="form-control">
                                                <option value="" selected disabled>{{ __('Select one') }}</option>
                                                @foreach($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->display_name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('role'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('role') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-4">
                                        <label for="employee_type" class="control-label">{{ __('Employee Type') }}<span class="text-danger">*</span></label>
                                        <div class="form-group{{ $errors->has('employee_type') ? ' has-error' : '' }} has-feedback">
                                            <select name="employee_type" class="form-control" id="employee_type">
                                                <option selected disabled>{{ __('Select One') }}</option>
                                                <option value="1">{{ __('Provision') }}</option>
                                                <option value="2">{{ __('Permanent') }}</option>
                                                <option value="3">{{ __('Full Time') }}</option>
                                                <option value="4">{{ __('Part Time') }}</option>
                                                <option value="5">{{ __('Adhoc') }}</option>
                                            </select>
                                            @if ($errors->has('employee_type'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('employee_type') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="resident_status" class="control-label">{{ __('Resident Status') }}<span class="text-danger">*</span></label>
                                        <div class="form-group{{ $errors->has('resident_status') ? ' has-error' : '' }} has-feedback">
                                            <select name="resident_status" class="form-control" id="resident_status_emp">
                                                <option selected disabled>{{ __('Select Resident/Non-Resident') }}</option>
                                                <option value="1">{{ __('Resident') }}</option>
                                                <option value="2">{{ __('Non-Resident') }}</option>
                                            </select>
                                            @if ($errors->has('resident_status'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('resident_status') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="academic_qualification" class="control-label">{{ __('Academic Qualification') }}</label>
                                        <div class="form-group{{ $errors->has('academic_qualification') ? ' has-error' : '' }} has-feedback">
                                            <textarea name="academic_qualification" id="academic_qualification" class="form-control textarea" placeholder="{{ __('Enter academic qualification..') }}">{{ old('academic_qualification') }}</textarea>
                                            @if ($errors->has('academic_qualification'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('academic_qualification') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="col-md-6">
                                        <label for="professional_qualification" class="control-label">{{ __('Professional Qualification') }}</label>
                                        <div class="form-group{{ $errors->has('professional_qualification') ? ' has-error' : '' }} has-feedback">
                                            <textarea name="professional_qualification" id="professional_qualification" class="form-control textarea" placeholder="{{ __('Enter professional qualification..') }}">{{ old('professional_qualification') }}</textarea>
                                            @if ($errors->has('professional_qualification'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('professional_qualification') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="experience" class="control-label">{{ __('Experience') }}</label>
                                        <div class="form-group{{ $errors->has('experience') ? ' has-error' : '' }} has-feedback">
                                            <textarea name="experience" id="experience" class="form-control textarea" placeholder="{{ __('Enter experience..') }}">{{ old('experience') }}</textarea>
                                            @if ($errors->has('experience'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('experience') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Residentail Address -->
                                    <div class="col-md-12">
                                        <h4 class="box-title">{{ __('RESIDENTIAL ADDRESS') }}</h3>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="present_address">{{ __('Present Address') }} <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <input type="text" name="present_address" id="present_address" class="form-control" placeholder="{{ __('Enter present address..') }}" >
                                        </div>
                                        @if ($errors->has('present_address'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('present_address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <label for="city_pr">{{ __('City') }}</label>
                                        <div class="form-group">
                                            <input type="text" name="city_pr" id="city_pr" class="form-control" placeholder="{{ __('Enter city..') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="state_pr">{{ __('State') }}</label>
                                        <div class="form-group">
                                            <input type="text" name="state_pr" id="state_pr" class="form-control" placeholder="{{ __('Enter state.') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="postcode_pr">{{ __('Postcode') }}</label>
                                        <div class="form-group">
                                            <input type="text" name="postcode_pr" id="postcode_pr" class="form-control" placeholder="{{ __('Enter state.') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="country_pr">{{ __('Country') }}</label>
                                        <div class="form-group">
                                            <input type="text" name="country_pr" id="country_pr" class="form-control" placeholder="{{ __('Enter pincode..') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="permanent_address">{{ __('Permanent Address') }}</label>
                                        <div class="form-group">
                                            <input type="text" name="permanent_address" id="permanent_address" class="form-control" placeholder="{{ __('Enter permanent address..') }}" >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="city">{{ __('City') }}</label>
                                        <div class="form-group">
                                            <input type="text" name="city" id="city" class="form-control" placeholder="{{ __('Enter city..') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="state">{{ __('State') }}</label>
                                        <div class="form-group">
                                            <input type="text" name="state" id="state" class="form-control" placeholder="{{ __('Enter state.') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="postcode">{{ __('Postcode') }}</label>
                                        <div class="form-group">
                                            <input type="text" name="postcode" id="postcode" class="form-control" placeholder="{{ __('Enter state.') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="country">{{ __('Country') }}</label>
                                        <div class="form-group">
                                            <input type="text" name="country" id="country" class="form-control" placeholder="{{ __('Enter pincode..') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="email">{{ __('Email') }} <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <input type="text" name="email" id="email" class="form-control" placeholder="{{ __('Enter email address..') }}">
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label for="contact_no_one">{{ __('Contact No') }} <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <input type="text" name="contact_no_one" id="contact_no_one" class="form-control" placeholder="{{ __('Enter contact no..') }}">
                                        </div>
                                        @if ($errors->has('contact_no_one'))
                                            <span class="help-block text-danger">
                                                <strong>{{ $errors->first('contact_no_one') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label for="emergency_contact">{{ __('Emergency Contact') }}</label>
                                        <div class="form-group">
                                            <input type="text" name="emergency_contact" id="emergency_contact" class="form-control" placeholder="{{ __('Enter emergency contact no..') }}">
                                        </div>
                                    </div>
                                    <!-- Residential Adress End -->
                                    <!-- Passport or Visa Details Begin -->
                                    <div class="col-md-12">
                                        <h4 class="box-title">{{ __('PASSPORT & VISA DETAILS (IF ANY)') }}</h4>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="passport_number">{{ __('Passport Number') }}</label>
                                        <div class="form-group{{ $errors->has('passport_number') ? ' has-error' : '' }} has-feedback">
                                            <input type="text" name="passport_number" id="passport_number" class="form-control" 
                                                value="{{ old('passport_number') }}" placeholder="{{ __('Enter passport number...') }}">
                                            @if ($errors->has('passport_number'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('passport_number') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="visa_number">{{ __('Visa Number') }}</label>
                                        <div class="form-group{{ $errors->has('visa_number') ? ' has-error' : '' }} has-feedback">
                                            <input type="text" name="visa_number" id="visa_number" class="form-control" 
                                                value="{{ old('visa_number') }}" placeholder="{{ __('Enter visa number...') }}">
                                            @if ($errors->has('visa_number'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('visa_number') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!--  Passport or Visa Details End -->

                                </div> 
                                <!-- /.row -->
                            </div>
                            <div class="box-footer">
                                <a href="{{ url('/people/employees') }}" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i>{{ __('Cancel') }} </a>
                                <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-plus"></i> {{ __('Add') }}</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Payroll Details Tab -->
            <div role="tabpanel" class="tab-pane" id="payrollDetailsTab">
                <div class="panel-body">
                    <!-- Payroll Details Form -->
                    <!-- Add your payroll form here -->
                    <div class="box box-default">
                        <div class="box-header">
                            <h4 class="box-title">{{ __('PAYROLL DETAILS') }}</h3>
                        </div>
                        <div class="box-footer clearfix"></div>
                        <!-- Check New Payroll -->  
                        <form name="employee_salary_form" id="employee_salary_form" action="{{ url('/people/employees/payroll_store') }}" method="post">
                            {{ csrf_field() }}

                                <input type="hidden" name="employee_type" class="form-control" id="employee_type" value="0"/>
                                <input type="hidden" name="resident_status" class="form-control" id="resident_status"/>
                                <input type="hidden" name="no_of_dependent" class="form-control" id="no_of_dependent" />
                            <div class="box-body">
                                    <!-- Add your form fields here -->
                                    <?php 
                                        $users = \App\Models\User::orderBy('id', 'desc')->first();
                                        $sl=$users->id;

                                        //Check if any request uri id given in url
                                    ?>

                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="text-primary">{{ __('Basic Salary') }}</h5>
                                            <div class="text-right">
                                                <label for="tax_residency" class="d-block">Select Tax Residency</label>
                                                <select name="tax_residency" id="tax_residency" class="form-control text-right">
                                                <option value="1">Residential</option>
                                                <option value="2">Non-Resident</option>
                                                </select>
                                            </div>
                                        </div>

                                            <div class="card-body">
                                                <table class="table table-bordered table-responsive">
                                                    <thead class="thead-dark text-dark">
                                                        <tr>
                                                            <th class="text-dark">Period Definition</th>
                                                            <th class="text-dark">Annual Salary</th>
                                                            <th class="text-dark">Fortnight Salary</th>
                                                            <th class="text-dark">Hourly Salary Rate</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="period_definition" class="form-control" id="period_definition"
                                                                    value="FN - Fortnightly {{ $sumOfWorkingHours*2 }} Hours" readonly>
                                                                    @if ($errors->has('period_definition'))
                                                                    <span class="text-danger">
                                                                        <strong>{{ $errors->first('period_definition') }}</strong>
                                                                    </span>
                                                                    @endif
                                                            </td>
                                                            <td>
                                                                <input type="number" name="annual_salary" class="form-control" id="annual_salary"
                                                                    value="{{ old('annual_salary') }}" placeholder="Enter annual salary..">
                                                                    @if ($errors->has('annual_salary'))
                                                                    <span class="text-danger">
                                                                        <strong>{{ $errors->first('annual_salary') }}</strong>
                                                                    </span>
                                                                    @endif
                                                            </td>
                                                            <td>
                                                                <input type="text" name="basic_salary" class="form-control" id="basic_salary"
                                                                    value="{{ old('basic_salary') }}" placeholder="Enter fortnight salary..">
                                                                    @if ($errors->has('basic_salary'))
                                                                    <span class="text-danger">
                                                                        <strong>{{ $errors->first('basic_salary') }}</strong>
                                                                    </span>
                                                                    @endif
                                                            </td>
                                                            <td>
                                                                <input type="text" name="hrly_salary_rate" class="form-control" id="hrly_salary_rate"
                                                                    value="{{ old('hrly_salary_rate') }}" placeholder="Enter working hours..">
                                                                @if ($errors->has('hrly_salary_rate'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('hrly_salary_rate') }}</strong>
                                                                </span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- /.end.col -->
                                    <div class="col-6">
                                        <div class="box box-success">
                                            <div class="box-header with-border">
                                            <h4 class="box-title">{{ __('Allowances') }}</h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead class="bg-primary text-white">
                                                            <tr>
                                                                <th colspan="2" class="text-dark">{{ __('House Allowances') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><label for="hr_place">{{ __('Place Name') }}</label></td>
                                                                <td>
                                                                    <select name="hr_place" id="hr_place" class="form-control">
                                                                        <option selected disabled>{{ __('Select place for house allowance') }}</option>
                                                                        @if(isset($loca_places))
                                                                            @foreach($loca_places as $item)
                                                                                <option value="{{ $item['id'] }}">{{ $item['places'] }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                    @error('hr_place') 
                                                                        <span class="text-danger">{{ $message }}</span> 
                                                                    @enderror
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label for="hr_area">{{ __('Area Name') }}</label></td>
                                                                <td>
                                                                    <input type="text" name="hr_area" class="form-control" id="hr_area" value="{{ old('hr_area') }}" placeholder="{{ __('Area...') }}" readonly>
                                                                    @error('hr_area') 
                                                                        <span class="text-danger">{{ $message }}</span> 
                                                                    @enderror
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label for="hra_type">{{ __('Housing Allowance Type') }}</label></td>
                                                                <td>
                                                                    <select name="hra_type" class="form-control" id="hra_type">
                                                                        <option selected disabled>{{ __('Select One') }}</option>
                                                                        <option value="1">{{ __('Rental') }}</option>
                                                                        <option value="2">{{ __('Kind') }}</option>
                                                                        <option value="3">{{ __('Not Applicable') }}</option>
                                                                    </select>
                                                                    @error('hra_type') 
                                                                        <span class="text-danger">{{ $message }}</span> 
                                                                    @enderror
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label for="hra_amount_per_week">{{ __('House Rent/Purchase Amount') }}</label></td>
                                                                <td>
                                                                    <input type="number" name="hra_amount_per_week" value="{{ old('hra_amount_per_week') }}" class="form-control" id="hra_amount_per_week" placeholder="{{ __('Enter amount ..') }}">
                                                                    @error('hra_amount_per_week') 
                                                                        <span class="text-danger">{{ $message }}</span> 
                                                                    @enderror
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label for="house_rent_allowance">{{ __('Housing Allowance') }}</label></td>
                                                                <td>
                                                                    <input type="number" name="house_rent_allowance" value="{{ old('house_rent_allowance') }}" class="form-control" id="house_rent_allowance" placeholder="{{ __('0') }}" readonly>
                                                                    @error('house_rent_allowance') 
                                                                        <span class="text-danger">{{ $message }}</span> 
                                                                    @enderror
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        <thead class="bg-primary text-white">
                                                            <tr>
                                                                <th colspan="2" class="text-dark">{{ __('Vehicle Allowances') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><label for="va_type">{{ __('Vehicle Allowance Type') }}</label></td>
                                                                <td>
                                                                    <select name="va_type" class="form-control" id="va_type">
                                                                        <option selected disabled>{{ __('Select One') }}</option>
                                                                        <option value="1">{{ __('With Fuel') }}</option>
                                                                        <option value="2">{{ __('Without Fuel') }}</option>
                                                                        <option value="3">{{ __('Not Applicable') }}</option>
                                                                    </select>
                                                                    @error('va_type') 
                                                                        <span class="text-danger">{{ $message }}</span> 
                                                                    @enderror
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label for="vehicle_allowance">{{ __('Vehicle Allowance') }}</label></td>
                                                                <td>
                                                                    <input type="number" name="vehicle_allowance" value="{{ old('vehicle_allowance') }}" class="form-control" id="vehicle_allowance" placeholder="{{ __('0') }}" readonly>
                                                                    @error('vehicle_allowance') 
                                                                        <span class="text-danger">{{ $message }}</span> 
                                                                    @enderror
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        <thead class="bg-primary text-white">
                                                            <tr>
                                                                <th colspan="2" class="text-dark">{{ __('Other Allowances') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><label for="meals_allowance">{{ __('Meals (Messing) Allowance') }}</label></td>
                                                                <td>
                                                                    <input type="checkbox" name="meals_tag" id="meals_tag" value="0"> &nbsp;
                                                                    <input type="number" name="meals_allowance" value="{{ old('meals_allowance') }}" class="form-control" id="meals_allowance" placeholder="{{ __('0') }}" readonly>
                                                                    @error('meals_allowance') 
                                                                        <span class="text-danger">{{ $message }}</span> 
                                                                    @enderror
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label for="medical_allowance">{{ __('Medical Allowance') }}</label></td>
                                                                <td>
                                                                    <input type="number" name="medical_allowance" value="{{ old('medical_allowance') }}" class="form-control" id="medical_allowance" placeholder="{{ __('Enter medical allowance..') }}">
                                                                    @error('medical_allowance') 
                                                                        <span class="text-danger">{{ $message }}</span> 
                                                                    @enderror
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label for="special_allowance">{{ __('Telephone Allowance') }}</label></td>
                                                                <td>
                                                                    <input type="number" name="special_allowance" value="{{ old('special_allowance') }}" class="form-control" id="special_allowance" placeholder="{{ __('Enter telephone allowance..') }}">
                                                                    @error('special_allowance') 
                                                                        <span class="text-danger">{{ $message }}</span> 
                                                                    @enderror
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label for="other_allowance">{{ __('Servant Allowance') }}</label></td>
                                                                <td>
                                                                    <input type="number" name="other_allowance" value="{{ old('other_allowance') }}" class="form-control" id="other_allowance" placeholder="{{ __('Enter domestic servant allowance..') }}">
                                                                    @error('other_allowance') 
                                                                        <span class="text-danger">{{ $message }}</span> 
                                                                    @enderror
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><label for="electricity_allowance">{{ __('Electricity Allowance') }}</label></td>
                                                                <td>
                                                                    <input type="number" name="electricity_allowance" value="{{ old('electricity_allowance') }}" class="form-control" id="electricity_allowance" placeholder="{{ __('Enter electricity allowance..') }}">
                                                                    @error('electricity_allowance') 
                                                                        <span class="text-danger">{{ $message }}</span> 
                                                                    @enderror
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td><label for="security_allowance">{{ __('Security Allowance') }}</label></td>
                                                                <td>
                                                                    <input type="number" name="security_allowance" value="{{ old('security_allowance') }}" class="form-control" id="security_allowance" placeholder="{{ __('Enter security allowance..') }}">
                                                                    @error('security_allowance') 
                                                                        <span class="text-danger">{{ $message }}</span> 
                                                                    @enderror
                                                                </td>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                    <!-- /.end.col -->
                                    <div class="col-6">
                                        <div class="box box-warning">
                                            <div class="box-header with-border">
                                                <h4 class="box-title">{{ __('Deductions') }}</h4>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <h5></h5>
                                                <table class="table table-bordered">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th class="text-dark">{{ __('Deductions & Rebate') }}</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ __('Tax Deduction (A)') }}</td>
                                                            <td>
                                                                <input type="number" name="tax_deduction_a" value="{{ old('tax_deduction_a') }}" class="form-control" id="tax_deduction_a" placeholder="{{ __('Enter tax deduction..') }}" readonly>
                                                                @if ($errors->has('tax_deduction_a'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('tax_deduction_a') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ __('Dependents') }}</td>
                                                            <td>
                                                                <select name="no_of_dependent" class="form-control" id="no_of_dependent_frm">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                                    @endfor
                                                                </select>
                                                                @if ($errors->has('no_of_dependent'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('no_of_dependent') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <!-- <tr>
                                                            <td>{{ __('Dependent Rebate') }}</td>
                                                            <td>
                                                                <input type="number" name="no_of_dependent_rebate" class="form-control" id="no_of_dependent_rebate" value="{{ old('no_of_dependent_rebate') }}" placeholder="{{ __('Enter no. of dependent..') }}">
                                                                @if ($errors->has('no_of_dependent_rebate'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('no_of_dependent_rebate') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </td>
                                                        </tr> -->
                                                        <tr>
                                                            <td colspan="2" class="text-left"><strong>{{ __('Superannuation Fund') }}</strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ __('Superannuation Name') }}</td>
                                                            <td>
                                                                <select class="form-control" id="empl_superannuation_id" name="superannuation_id" class="form-select" required>
                                                                    <option value="">Select Superannuation</option>
                                                                    @foreach($superannuations as $superannuation)
                                                                        <option value="{{ $superannuation->id }}" data-superannuation="{{ json_encode($superannuation) }}">
                                                                            {{ $superannuation->name }} ({{ $superannuation->code }})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <input type="text" id="employer_contribution_percentage" name="employer_contribution_percentage" class="form-control" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ __('Superannuation Fund Deduction') }}</td>
                                                            <td>
                                                                <input type="number" name="provident_fund_deduction" value="{{ old('provident_fund_deduction') }}" class="form-control" id="provident_fund_deduction" placeholder="{{ __('Enter superannuation fund deduction..') }}">
                                                                @if ($errors->has('provident_fund_deduction'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('provident_fund_deduction') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <!-- /.box-body -->
                                        </div>
            
                                        <div class="box box-danger mt-4">
                                            <div class="card">
                                                <div class="card-header bg-primary">
                                                    <h3 class="card-title text-light pt-2">{{ __('Standard Pay') }}</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                    <label for="gross_salary">{{ __('Gross Salary') }}</label>
                                                    <input type="number" disabled class="form-control" id="gross_salary">
                                                    </div>
                                                    <div class="form-group{{ $errors->has('total_deduction') ? ' has-error' : '' }}">
                                                    <label for="total_deduction">{{ __('Total Deduction') }}</label>
                                                    <input type="number" disabled class="form-control" id="total_deduction">
                                                    @if ($errors->has('total_deduction'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('total_deduction') }}</strong>
                                                    </span>
                                                    @endif
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
                                <!-- /.row -->
                            </div>
                            <div class="box-footer mt-4">
                            <button type="submit" class="btn btn-primary btn-flat pull-right"><i class="fa fa-save"></i> {{ __('Save Details') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

             <!-- Cost Center Tab -->
             <div role="tabpanel" class="tab-pane" id="costcenterInfoTab">
                <div class="panel-body">
                    <!-- Cost Center Form -->
                    <!-- Add your Cost Center form here -->
                    <div class="box box-default">
                        <div class="box-header">
                            <h4 class="box-title">{{ __('COST CENTER') }}</h3>
                        </div>
                        <!-- Cost Center Condition in case of employee id exist -->

                                    <form action="{{ url('/employee_contacts/update/') }}" method="post" name="add_cost_center_form">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="user_id" class="form-control" id="user_id" value="">
                                        <input type="hidden" name="employee_id" class="form-control" id="employee_id" value="">
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-md-12 table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th class="text-dark">{{ __('Payroll Location') }} <span class="text-danger">*</span></th>
                                                                    <th class="text-dark">{{ __('Pay Batch Number') }} <span class="text-danger">*</span></th>
                                                                    <th class="text-dark">{{ __('Cost Center') }} <span class="text-danger">*</span></th>
                                                                    <th class="text-dark">{{ __('Department') }} <span class="text-danger">*</span></th>
                                                                    <th class="text-dark">{{ __('Cost Center Share Percentage') }} <span class="text-danger">*</span></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group{{ $errors->has('payroll_location') ? ' has-error' : '' }} has-feedback">
                                                                            <select name="payroll_location" id="payroll_location" class="form-control">
                                                                                <option value="" selected disabled>{{ __('Select one') }}</option>
                                                                                <?php $payroll_locations = \App\Models\PayLocation::all(); ?>
                                                                                @foreach($payroll_locations as $location)
                                                                                    <option value="{{ $location->id }}">{{ $location->payroll_location_name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @if ($errors->has('payroll_location'))
                                                                                <span class="help-block">
                                                                                    <strong>{{ $errors->first('payroll_location') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group{{ $errors->has('pay_batch_number') ? ' has-error' : '' }} has-feedback">
                                                                            <select name="pay_batch_number" id="pay_batch_number" class="form-control">
                                                                                <option value="" selected disabled>{{ __('Select one') }}</option>
                                                                                <?php $pay_batch_numbers = \App\Models\PayBatchNumber::all(); ?>
                                                                                @foreach($pay_batch_numbers as $batch)
                                                                                    <option value="{{ $batch->id }}">{{ $batch->pay_batch_number_name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @if ($errors->has('pay_batch_number'))
                                                                                <span class="help-block">
                                                                                    <strong>{{ $errors->first('pay_batch_number') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group{{ $errors->has('cost_center') ? ' has-error' : '' }} has-feedback">
                                                                            <select name="cost_center" id="cost_center" class="form-control">
                                                                                <option value="" selected disabled>{{ __('Select one') }}</option>
                                                                                @if(isset($costcenters))
                                                                                    @foreach($costcenters as $costcenter)
                                                                                        <option value="{{ $costcenter->id }}">{{ $costcenter->name }} - {{ $costcenter->cost_center_code }}</option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                            @if ($errors->has('cost_center'))
                                                                                <span class="help-block">
                                                                                    <strong>{{ $errors->first('cost_center') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }} has-feedback">
                                                                            <select name="department[]" id="department" class="form-control" multiple>
                                                                                <option value="" selected disabled>{{ __('Select one or more') }}</option>
                                                                                <!-- Dynamic departments will be populated here -->
                                                                            </select>
                                                                            @if ($errors->has('department'))
                                                                                <span class="help-block">
                                                                                    <strong>{{ $errors->first('department') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div id="share_percentage_fields">
                                                                            <!-- Dynamic share percentage fields will be populated here -->
                                                                        </div>
                                                                        @if ($errors->has('cost_center_share_percentage'))
                                                                            <span class="help-block">
                                                                                <strong>{{ $errors->first('cost_center_share_percentage') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                                        <!-- /.form-group -->                        
                                      
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary btn-flat"> {{ __('Update Cost Center') }}</button>
                                        </div>
                                    </form>
                    </div>
                </div>
            </div>

            <!-- Contact Information Tab -->
            <div role="tabpanel" class="tab-pane" id="contactInfoTab">
                <div class="panel-body">
                    <!-- Contact Information Form -->
                    <!-- Add your Contact Information form here -->
                    <div class="box box-default">
                        <div class="box-header">
                            <h4 class="box-title">{{ __('OTHER CONTACT INFORMATION') }}</h3>
                        </div>
                        <!-- Contact Form Condition in case of employee id exist -->
                        <form action="{{ url('/employee_contacts/update/') }}" method="post" name="employee_update_contact_form">
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" class="form-control" id="user_id" value="">
                            <input type="hidden" name="employee_id" class="form-control" id="employee_id" value="">
                            <div class="box-body">
                                    <div class="row">
                                        <!-- Add your form fields here -->
                                        <div class="col-12">
                                            <label for="employee_contact_name">{{ __('Contact Name') }} <span class="text-danger">*</span></label>
                                            <div class="form-group{{ $errors->has('employee_contact_name') ? ' has-error' : '' }} has-feedback">
                                                <input type="text" name="employee_contact_name" id="employee_contact_name" class="form-control" placeholder="{{ __('Enter name..') }}">
                                                @if ($errors->has('employee_contact_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('employee_contact_name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <div class="col-12">
                                            <label for="employee_contact_address">{{ __('Address') }}<span class="text-danger">*</span></label>
                                            <div class="form-group{{ $errors->has('employee_contact_address') ? ' has-error' : '' }} has-feedback">
                                                <input type="text" name="employee_contact_address" id="employee_contact_address" class="form-control"  placeholder="{{ __('Enter contact address..') }}">
                                                @if ($errors->has('employee_contact_address'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('employee_employee_contact_address') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                            <!-- /.form-group -->
                                        <div class="col-6">
                                            <label for="employee_contact_phone">{{ __('Phone') }}<span class="text-danger">*</span></label>
                                            <div class="form-group{{ $errors->has('employee_contact_phone') ? ' has-error' : '' }} has-feedback">
                                                <input type="text" name="employee_contact_phone" id="employee_contact_phone" class="form-control" placeholder="{{ __('Enter phone no..') }}">
                                                @if ($errors->has('employee_contact_phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('employee_contact_phone') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                            <!-- /.form-group -->
                                        <div class="col-6">
                                            <label for="employee_contact_mobile">{{ __('Mobile') }}<span class="text-danger">*</span></label>
                                            <div class="form-group{{ $errors->has('employee_contact_mobile') ? ' has-error' : '' }} has-feedback">
                                                <input type="text" name="employee_contact_mobile" id="employee_contact_mobile" class="form-control" placeholder="{{ __('Enter mobile no..') }}">
                                                @if ($errors->has('employee_contact_mobile'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('employee_contact_mobile') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                            <!-- /.form-group -->
                                        <div class="col-6">
                                            <label for="employee_contact_email">{{ __('Employee Contact Email') }} <span class="text-danger">*</span></label>
                                            <div class="form-group{{ $errors->has('employee_contact_email') ? ' has-error' : '' }} has-feedback">
                                                <input type="email" name="employee_contact_email" id="employee_contact_email" class="form-control"  placeholder="{{ __('Enter employee_contact_email address..') }}">
                                                @if ($errors->has('employee_contact_email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('employee_contact_email') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <!-- /.form-group -->
                                        </div>

                                        <!-- /.form-group -->
                                        <div class="col-6">
                                            <label for="employee_contact_relationship">{{ __('Relation') }}<span class="text-danger">*</span></label>
                                            <div class="form-group{{ $errors->has('employee_contact_relationship') ? ' has-error' : '' }} has-feedback">
                                                <input type="text" name="employee_contact_relationship" id="employee_contact_relationship" class="form-control"  placeholder="{{ __('Enter relation..') }}">
                                                @if ($errors->has('employee_contact_relationship'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('contact_no_') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                            <!-- /.form-group -->                        
                                </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary btn-flat"> {{ __('Update Contact') }}</button>
                            </div>
                        </form>                             
                    </div>
                </div>
            </div>

            <!-- Leave Details Tab -->
            <div role="tabpanel" class="tab-pane" id="leaveDetailsTab">
                <div class="panel-body">
                    <!-- Leave Details Form -->
                    <!-- Add your Leave Details form here -->
                    <div class="box box-default">
                        <div class="box-header">
                            <h4 class="box-title">{{ __('EMPLOYEE LEAVE DETAILS') }}</h3>
                        </div>
                                <!-- /.box-body -->
                            <div class="box-footer clearfix"></div>
                                <!-- /.box-footer -->
                                <form action="{{ url('people/employees/leave_store') }}" method="post" name="employee_add_form">
                                    {{ csrf_field() }}
                                    <div class="box-body">
                                        <!-- Add your form fields here -->
                                        <?php 
                                            $users = \App\Models\User::orderBy('id', 'desc')->first();
                                            $sl = $users->id;
                                            $user_id = Route::current()->parameter('id') ? Route::current()->parameter('id') : '';
                                        ?>
                                        <input type="hidden" name="employee_lv_id" value="{{ $user_id }}" />

                                        <!-- Sick Leave, Annual Leave, Long Service Leave Section -->
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th class="text-dark">{{ __('Leave Category') }}</th>
                                                        <th class="text-dark">{{ __('Leave Count') }}</th>
                                                        <th class="text-dark">{{ __('Leave Type') }}</th>
                                                        <th class="text-dark">{{ __('Action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($leaveCategories as $leave)
                                                        <tr>
                                                            <td>{{ $leave->leave_category }}
                                                                <input type="hidden" name="leave_category_id[]" value="{{ $leave->id }}" />
                                                            </td>
                                                            <td>
                                                                <input type="number" id="leave_balance_{{ $leave->id }}" class="form-control" value="{{ $leave->qty }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" id="leave_type_{{ $leave->id }}" class="form-control" value="{{ $leave->type_of_leave }}" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" id="leave_active_{{ $leave->id }}" name="leave_active[]" class="form-control" {{ $leave->active ? 'checked' : '' }}>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-plus"></i> {{ __('Submit') }}</button>
                                    </div>
                                </form>
                    </div>
                </div>
            </div>

            <!-- Superannuation Tab -->
            <div role="tabpanel" class="tab-pane" id="superannuationTab">
                <div class="panel-body">
                    <!-- Superannuation Form -->
                    <!-- Add your Superannuation form here -->
                    <div class="box box-default">
                        <div class="box-header">
                            <h4 class="box-title">{{ __('EMPLOYEE SUPERANNUATION') }}</h3>
                        </div>
                        <div class="col-md-12">
                            <form action="{{ route('employees.submit_superannuation') }}" method="POST">
                                {{ csrf_field() }}
                                <?php 
                                    $users = \App\Models\User::orderBy('id', 'desc')->first();
                                    $sl=$users->id;
                                    $user_id = Route::current()->parameter('id') ? Route::current()->parameter('id') : '';
                                ?>
                        
                                        <input type="hidden" name="employee_id" value="{{$user_id}}">
                                <div class="mb-3">
                                    <label for="superannuation_id" class="form-label">Superannuation</label>
                                    <select class="form-control" id="empl_superannuation_id" name="superannuation_id" class="form-select" required>
                                        <option value="">Select Superannuation</option>
                                        @foreach($superannuations as $superannuation)
                                            <option value="{{ $superannuation->id }}" data-superannuation="{{ json_encode($superannuation) }}">
                                                {{ $superannuation->name }} ({{ $superannuation->code }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="employer_contribution_percentage" class="form-label">Employer Contribution (%)</label>
                                    <input type="text" id="employer_contribution_percentage" name="employer_contribution_percentage" class="form-control" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="employer_contribution_fixed_amount" class="form-label">Employer Fixed Contribution</label>
                                    <input type="text" id="employer_contribution_fixed_amount" name="employer_contribution_fixed_amount" class="form-control" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="bank_name" class="form-label">Bank Name</label>
                                    <input type="text" id="bank_name" name="bank_name" class="form-control" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="bank_address" class="form-label">Bank Address</label>
                                    <input type="text" id="bank_address" name="bank_address" class="form-control" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="bank_account_number" class="form-label">Bank Account Number</label>
                                    <input type="text" id="bank_account_number" name="bank_account_number" class="form-control" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="employer_superannuation_no" class="form-label">Employer Superannuation No</label>
                                    
                                        <select id="employer_superannuation_no" name="employer_superannuation_no" class="form-control">
                                        @if($companies)
                                            @foreach($companies as $company)
                                                <option value="{{ $company->superannuation_number}}">{{ $company->superannuation_number}} -   {{ $company->name }}</option>
                                            @endforeach
                                        @endif
                                        </select>  
                                </div>

                                <button type="submit" class="btn btn-primary">Submit Superannuation</button>
                            </form>
                        </div>
                                <!-- /.box-body -->
                            <div class="box-footer clearfix"></div>
                                <!-- /.box-footer -->
                    </div>
                </div>
            </div>

            <!-- Bank Credits Tab -->
            <div role="tabpanel" class="tab-pane" id="bankCreditsTab">
                <div class="panel-body">
                    <!-- Bank Credits Form -->
                    <!-- Add your Bank Credits form here -->
                    <div class="box box-default">
                        <div class="box-header">
                            <h4 class="box-title">{{ __('BANK CREDITS') }}</h3>
                        </div>
                            <form action="{{ url('people/employees/bank_store') }}" method="post" name="employee_add_form">
                                {{ csrf_field() }}
                                <?php 
                                    $users = \App\Models\User::orderBy('id', 'desc')->first();
                                    $sl=$users->id;
                                    $user_id = Route::current()->parameter('id') ? Route::current()->parameter('id') : '';
                                ?>
                                <input type="hidden" name="employee_bk_id" value="{{$user_id}}">
                                <div class="box-body">
                                    <!-- Bank Details Section -->
                                    <div class="card">
                                        <div class="card-body">
                                            <!-- Bank Details Section -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <strong class="d-block mb-2">Select Bank</strong>
                                                    @if($bankLists)
                                                        <select class="form-control mb-3" name="bank_id" id="bank_id">
                                                            @foreach($bankLists as $bankList)
                                                                <option value="{{ $bankList->id }}_{{ $bankList->bank_code }}">{{ $bankList->bank_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <input type="text" class="form-control" name="acct_no" value="1000234569" id="acct_no" placeholder="Account No">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <input type="text" class="form-control" name="swift_code" value="Swift Code" id="swift_code" placeholder="Swift Code">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <input type="text" class="form-control" name="acct_name" value="S Mathew" id="acct_name" placeholder="Account Name">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <input type="text" class="form-control" name="acct_add" value="" id="acct_add" placeholder="Address">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <input type="text" class="form-control" name="acct_city" value="" id="acct_city" placeholder="City">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <input type="email" class="form-control" name="acct_email" value="" id="acct_email" placeholder="Email Address">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <input type="text" class="form-control" maxlength="3" name="acct_ccode" value="" id="acct_ccode" placeholder="Country Code">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <a href="{{ url('/people/employees') }}" class="btn btn-danger btn-flat">
                                        <i class="icon fa fa-close"></i> {{ __('Cancel') }}
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-flat">
                                        <i class="icon fa fa-plus"></i> {{ __('Add') }}
                                    </button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
     
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Function to open the specified tab
        function openTab(tabId) {
            var tabLink = document.querySelector('a[aria-controls="' + tabId + '"]');
            if (tabLink) {
                tabLink.click();
            }
        }
        // Check if the form submission was successful
        var message = "{{ session('message') }}";
        var submittedForm = "{{ session('submitted_form') }}";

        if (message && submittedForm) {
            if (submittedForm === 'add_employee_form') {
                openTab('payrollDetailsTab');
                window.location.hash='payrollDetailsTab';
            }// costcenterInfoTab
            else if(submittedForm === 'add_cost_center_form') {
                openTab('costcenterInfoTab');
                window.location.hash = 'costcenterInfoTab';
            }
            else if (submittedForm === 'add_payroll_form') {
                openTab('contactInfoTab');
                window.location.hash='contactInfoTab';
            } else if (submittedForm === 'add_contact_form') {
                openTab('leaveDetailsTab');
                window.location.hash='leaveDetailsTab';
            }  else if (submittedForm === 'update_contact_form') {
                openTab('leaveDetailsTab');
                window.location.hash='leaveDetailsTab';
            } else if (submittedForm === 'add_leave_form') {
                openTab('superannuationTab');
                window.location.hash='superannuationTab';
            } else if (submittedForm === 'add_superannuation_form') {
                openTab('bankCreditsTab');
                window.location.hash='bankCreditsTab';
            }
        } else {
            // Open the Add Employee tab by default
            openTab('personalDetailsTab');
        }
    });

    // Get tab click
    document.addEventListener("DOMContentLoaded", function() {
        let empTabLinks = document.querySelectorAll('.emp-tablink');
        empTabLinks.forEach(function(empTabLink) {
            empTabLink.addEventListener("click", function(event) {
                event.preventDefault(); // Prevent default behavior if necessary
                let hash = this.getAttribute("href"); // Get the href (hash)
                window.location.hash = hash; // Update the hash in the URL
            });
        });
    });


    
</script>




<script type="text/javascript">
    // document.forms['employee_add_form'].elements['gender'].value = "{{ old('gender') }}";
    // document.forms['employee_add_form'].elements['id_name'].value = "{{ old('id_name') }}";
    // document.forms['employee_add_form'].elements['designation_id'].value = "{{ old('designation_id') }}";
    // document.forms['employee_add_form'].elements['role'].value = "{{ old('role') }}";
    // document.forms['employee_add_form'].elements['joining_position'].value = "{{ old('joining_position') }}";
    // document.forms['employee_add_form'].elements['marital_status'].value = "{{ old('marital_status') }}";
</script>


<!-- @if(!empty(old('employee_type')))
    document.forms['employee_salary_form'].elements['employee_type'].value = "{{ old('employee_type') }}";
  @endif
<style>
    .card-title {
        font-size: 1.5rem; /* Adjust the font size as needed */
        font-weight:800;
    }
</style>
@endsection -->
