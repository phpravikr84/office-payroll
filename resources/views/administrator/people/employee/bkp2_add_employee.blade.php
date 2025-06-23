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
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#personalDetailsTab" aria-controls="personalDetailsTab" role="tab" data-toggle="tab">
                    {{ __('Personal Details') }}
                </a>
            </li>
            <li role="presentation">
                <a href="#payrollDetailsTab" aria-controls="payrollDetailsTab" role="tab" data-toggle="tab">
                    {{ __('Payroll Details') }}
                </a>
            </li>
            <li role="presentation">
                <a href="#contactInfoTab" aria-controls="contactInfoTab" role="tab" data-toggle="tab">
                    {{ __('Contact Information') }}
                </a>
            </li>
            <li role="presentation">
                <a href="#leaveDetailsTab" aria-controls="leaveDetailsTab" role="tab" data-toggle="tab">
                    {{ __('Leave Details') }}
                </a>
            </li>
            <li role="presentation">
                <a href="#superannuationTab" aria-controls="superannuationTab" role="tab" data-toggle="tab">
                    {{ __('Superannuation') }}
                </a>
            </li>
            <li role="presentation">
                <a href="#bankCreditsTab" aria-controls="bankCreditsTab" role="tab" data-toggle="tab">
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
                            <h3 class="box-title">{{ __('EMPLOYEE PERSONAL DETAILS') }}</h3>
                        </div>
                        <form action="{{ url('people/employees/store') }}" method="post" name="employee_add_form">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="row">
                                    <!-- Notification Box -->
                                    <div class="col-md-12">
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
                                        @else
                                        <p class="text-yellow">{{ __('Enter team member details. All (*) fields are required. (Default password for added user is 12345678)') }}</p>
                                        @endif
                                    </div>
                                </div>
                                    <!-- Add your form fields here -->
                                    <?php 
                                        $users = \App\User::orderBy('id', 'desc')->first();
                                        $sl=$users->id;
                                    ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="employee_id">{{ __('ID') }} <span class="text-danger">*</span></label>
                                        <div class="form-group{{ $errors->has('employee_id') ? ' has-error' : '' }} has-feedback">
                                            <input type="hidden" name="employee_id" value="{{$sl}}">
                                            <input type="text" class="form-control" value="{{ __('EMPID') }}{{$sl}}" disabled>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
                                        <label for="present_address">{{ __('Present Address') }}<span class="text-danger">*</span></label>
                                        <div class="form-group{{ $errors->has('present_address') ? ' has-error' : '' }} has-feedback">
                                            <input type="text" name="present_address" id="present_address" class="form-control" value="{{ old('present_address') }}" placeholder="{{ __('Enter present address..') }}">
                                            @if ($errors->has('present_address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('present_address') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                            <!-- /.form-group -->

                                    <div class="col-md-4">
                                        <label for="permanent_address">{{ __('Permanent Address') }}</label>
                                        <div class="form-group{{ $errors->has('permanent_address') ? ' has-error' : '' }} has-feedback">
                                            <input type="text" name="permanent_address" id="permanent_address" class="form-control" value="{{ old('permanent_address') }}" placeholder="{{ __('Enter permanent address..') }}">
                                            @if ($errors->has('permanent_address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('permanent_address') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                        
                                    <div class="col-md-4">
                                        <label for="joining_position">{{ __('Reference ') }}<span class="text-danger">*</span></label>
                                        <div class="form-group{{ $errors->has('joining_position') ? ' has-error' : '' }} has-feedback">
                                            <select name="reference" id="joining_position" class="form-control">
                                                <option value="" selected disabled>{{ __('Select one') }}</option>
                                                <?php $references = \App\User::where('access_label', 4)
                                                ->where('deletion_status', 0)
                                                ->select('id', 'name', 'present_address', 'contact_no_one', 'created_at', 'activation_status')
                                                ->orderBy('id', 'DESC')
                                                ->get()
                                                ->toArray();?>
                                                @foreach($references as $reference)
                                                <option value="{{ $reference['name'] }}">{{ $reference['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                            <!-- /.form-group -->

                                    <div class="col-md-4">
                                        <label for="email">{{ __('Email') }} <span class="text-danger">*</span></label>
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                                            <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="{{ __('Enter email address..') }}">
                                            @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <div class="col-md-4">
                                        <label for="contact_no_one">{{ __('Contact No') }}<span class="text-danger">*</span></label>
                                        <div class="form-group{{ $errors->has('contact_no_one') ? ' has-error' : '' }} has-feedback">
                                            <input type="text" name="contact_no_one" id="contact_no_one" class="form-control" value="{{ old('contact_no_one') }}" placeholder="{{ __('Enter contact no..') }}">
                                            @if ($errors->has('contact_no_one'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('contact_no_one') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                        <!-- /.form-group -->

                                    <div class="col-md-4">    
                                        <label for="emergency_contact">{{ __('Emergency Contact') }}</label>
                                        <div class="form-group{{ $errors->has('emergency_contact') ? ' has-error' : '' }} has-feedback">
                                            <input type="text" name="emergency_contact" id="emergency_contact" class="form-control" value="{{ old('emergency_contact') }}" placeholder="{{ __('Enter emergency contact no..') }}">
                                            @if ($errors->has('emergency_contact'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('emergency_contact') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="col-md-4">
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

                                    <div class="col-md-4">
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
                                        
                                    <div class="col-md-4">                            
                                        <label for="datepicker">{{ __('Date of Birth') }}</label>
                                        <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }} has-feedback">
                                            <div class="input-group date">
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

                                    <div class="col-md-4">                            
                                        <label for="datepicker4">{{ __('Joining Date') }}<span class="text-danger">*</span></label>
                                        <div class="form-group{{ $errors->has('joining_date') ? ' has-error' : '' }} has-feedback">
                                            <div class="input-group date">
                                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                <input type="text" name="joining_date" class="form-control pull-right" id="datepicker4" placeholder="{{ __('yyyy-mm-dd') }}">
                                            </div>
                                            @if ($errors->has('joining_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('joining_date') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <!-- /.form-group -->
                                    </div>

                                    <div class="col-md-4">                            
                                        <label for="datepicker5">{{ __('End Date') }}<span class="text-danger">*</span></label>
                                        <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }} has-feedback">
                                            <div class="input-group date">
                                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                <input type="text" name="end_date" class="form-control pull-right" id="datepicker4" placeholder="{{ __('yyyy-mm-dd') }}">
                                            </div>
                                            @if ($errors->has('joining_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('joining_date') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <!-- /.form-group -->
                                    </div>

                                    <!-- /.form-group -->

                                    <input type="hidden" name="home_district" value="None">

                    
                                    <!-- /.form-group -->

                                    <div class="col-md-4">
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
                                    <!-- /.form-group -->
                                    <div class="col-md-4">
                                        <label for="joining_position">{{ __('Department') }} <span class="text-danger">*</span></label>
                                        <div class="form-group{{ $errors->has('joining_position') ? ' has-error' : '' }} has-feedback">
                                            <select name="joining_position" id="joining_position" class="form-control">
                                                <option value="" selected disabled>{{ __('Select one') }}</option>
                                                <?php $departments= \App\Department::all();?>
                                                @foreach($departments as $department)
                                                <option value="{{ $department['id'] }}">{{ $department['department'] }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('joining_position'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('joining_position') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                        <!-- /.form-group -->

                                    <div class="col-md-4">
                                        <label for="id_name">{{ __('Photo ID Name') }}</label>
                                        <div class="form-group{{ $errors->has('id_name') ? ' has-error' : '' }} has-feedback">
                                            <select name="id_name" id="id_name" class="form-control">
                                                <option value="" selected disabled>{{ __('Select one') }}</option>
                                                <option value="1">{{ __('NID') }}</option>
                                                <option value="2">{{ __('Passport') }}</option>
                                                <option value="3">{{ __('Driving License') }}</option>
                                            </select>
                                            @if ($errors->has('id_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('id_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="col-md-4">
                                        <label for="id_number">{{ __('Photo ID Number') }}</label>
                                        <div class="form-group{{ $errors->has('id_number') ? ' has-error' : '' }} has-feedback">
                                            <input type="text" name="id_number" id="id_number" class="form-control" value="{{ old('id_number') }}" placeholder="{{ __('Enter id number..') }}">
                                            @if ($errors->has('id_number'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('id_number') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                        <!-- /.form-group -->

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
                                        <!-- /.form-group -->
    
                                    <div class="col-md-4">
                                        <label for="employee_type" class="control-label">{{ __('Employee Type') }}</label>
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
                                        <label for="resident_status" class="control-label">{{ __('Resident Status') }}</label>
                                        <div class="form-group{{ $errors->has('resident_status') ? ' has-error' : '' }} has-feedback">
                                            <select name="resident_status" class="form-control" id="resident_status">
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
                                    <div class="col-md-4">
                                        <label for="no_of_dependent" class="control-label">{{ __('No. of Dependent') }}</label>
                                        <div class="form-group{{ $errors->has('no_of_dependent') ? ' has-error' : '' }} has-feedback">
                                            <input type="number" name="no_of_dependent" class="form-control" id="no_of_dependent" value="{{ old('no_of_dependent') }}" placeholder="{{ __('Enter no. of dependent..') }}">
                                            @if ($errors->has('no_of_dependent'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('no_of_dependent') }}</strong>
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
                            <h3 class="box-title">{{ __('EMPLOYEE PAYROLL DETAILS') }}</h3>
                        </div>
                        <form name="employee_salary_form" id="employee_salary_form" action="{{ url('/hrm/payroll/store') }}" method="post">
                                {{ csrf_field() }}
                                @if (session('inserted_id'))
                                    <input type="hidden" name="user_id" value="{{ session('inserted_id') }}">
                                @endif
                                <!-- /.end.col -->
                                <div class="col-md-6">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">{{ __('Allowances') }}</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="col-sm-8" style="padding-left: unset;">
                                            <div class="form-group{{ $errors->has('hr_place') ? ' has-error' : '' }}">
                                                <label for="hr_place">{{ __('Place Name') }}</label>
                                                <!-- <div class="col-sm-3"> -->
                                                <select name="hr_place" id="hr_place" class="form-control">
                                                <option selected disabled>{{ __('Select place for house allowance') }}</option>
                                                @if (session('loca_places'))
                                                    @foreach(session('loca_places') as $item)
                                                    <option value="{{ $item['id'] }}">{{ $item['places'] }}</option>
                                                    @endforeach
                                                @endif
                                                </select>
                                                @if ($errors->has('hr_place'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('hr_place') }}</strong>
                                                </span>
                                                @endif
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                        <div class="col-sm-4" style="padding-left: unset;">
                                            <div class="form-group{{ $errors->has('hr_area') ? ' has-error' : '' }}">  
                                            <label for="hr_area">{{ __('Area Name') }}</label>
                                            <!-- <div class="col-sm-3"> -->
                                                <input type="text" name="hr_area" class="form-control" id="hr_area" value="{{ old('hr_area') }}" placeholder="{{ __('Area...') }}" readonly="true">
                                                @if ($errors->has('hr_area'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('hr_area') }}</strong>
                                                </span>
                                                @endif
                                            <!-- </div> -->
                                            </div>
                                        </div>
                                    <div class="col-sm-4" style="padding-left: unset;">
                                        <div class="form-group{{ $errors->has('hra_type') ? ' has-error' : '' }}">
                                            <!-- <label for="hra_type" class="col-sm-4 control-label" style="padding: unset;">{{ __('Housing Allowance Type') }}</label> -->
                                            <label for="hra_type">{{ __('Housing Allowance Type') }}</label>
                                            <select name="hra_type" class="form-control" id="hra_type">
                                                <option selected disabled>{{ __('Select One') }}</option>
                                                <option value="1">{{ __('Rental') }}</option>
                                                <option value="2">{{ __('Kind') }}</option>
                                                <option value="3">{{ __('Not Applicable') }}</option>
                                            </select>
                                            @if ($errors->has('hra_type'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('hra_type') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-5" style="padding-left: unset;">
                                        <div class="form-group{{ $errors->has('hra_amount_per_week') ? ' has-error' : '' }}">
                                        <label for="hra_amount_per_week">{{ __('House Rent/Purchase Amount') }}</label>
                                        <input type="number" name="hra_amount_per_week" value="{{ old('hra_amount_per_week') }}" class="form-control" id="hra_amount_per_week" placeholder="{{ __('Enter amount ..') }}">
                                        @if ($errors->has('hra_amount_per_week'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('hra_amount_per_week') }}</strong>
                                        </span>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-3" style="padding: unset;">
                                        <div class="form-group{{ $errors->has('house_rent_allowance') ? ' has-error' : '' }}">
                                        <label for="house_rent_allowance">{{ __('Housing Allowance') }}</label>
                                        <input type="number" name="house_rent_allowance" value="{{ old('house_rent_allowance') }}" class="form-control"  id="house_rent_allowance" placeholder="{{ __('0') }}" readonly>
                                        @if ($errors->has('house_rent_allowance'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('house_rent_allowance') }}</strong>
                                        </span>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6" style="padding-left: unset;">
                                        <div class="form-group{{ $errors->has('va_type') ? ' has-error' : '' }}">
                                            <label for="va_type">{{ __('Vehicle Allowance Type') }}</label>
                                            <select name="va_type" class="form-control" id="va_type">
                                                <option selected disabled>{{ __('Select One') }}</option>
                                                <option value="1">{{ __('With Fuel') }}</option>
                                                <option value="2">{{ __('Without Fuel') }}</option>
                                                <option value="3">{{ __('Not Applicable') }}</option>
                                            </select>
                                            @if ($errors->has('va_type'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('va_type') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6" style="padding: unset;">
                                        <div class="form-group{{ $errors->has('vehicle_allowance') ? ' has-error' : '' }}">
                                        <label for="vehicle_allowance">{{ __('Vehicle Allowance') }}</label>
                                        <input type="number" name="vehicle_allowance" value="{{ old('vehicle_allowance') }}" class="form-control" id="vehicle_allowance" placeholder="{{ __('0') }}" readonly>
                                        @if ($errors->has('vehicle_allowance'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('vehicle_allowance') }}</strong>
                                        </span>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6" style="padding-left: unset;">
                                        <div class="form-group{{ $errors->has('meals_allowance') ? ' has-error' : '' }}">
                                        <label for="meals_allowance">{{ __('Meals (Messing) Allowance') }}</label> 
                                        <input type="checkbox" style="margin-left: 10px; margin-top: unset" name="meals_tag" id="meals_tag" value="0" >
                                        <input type="number" name="meals_allowance" value="{{ old('meals_allowance') }}" class="form-control" id="meals_allowance" placeholder="{{ __('0') }}" readonly>
                                        @if ($errors->has('meals_allowance'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('meals_allowance') }}</strong>
                                        </span>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6" style="padding: unset;">
                                        <div class="form-group{{ $errors->has('medical_allowance') ? ' has-error' : '' }}">
                                        <label for="medical_allowance">{{ __('Medical Allowance') }}</label>
                                        <input type="number" name="medical_allowance" value="{{ old('medical_allowance') }}" class="form-control" id="medical_allowance" placeholder="{{ __('Enter medical allowance..') }}">
                                        @if ($errors->has('medical_allowance'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('medical_allowance') }}</strong>
                                        </span>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6" style="padding-left: unset;">
                                        <div class="form-group{{ $errors->has('special_allowance') ? ' has-error' : '' }}">
                                        <label for="special_allowance">{{ __('Telephone Allowance') }}</label>
                                        <input type="number" name="special_allowance" value="{{ old('special_allowance') }}" class="form-control" id="special_allowance" placeholder="{{ __('Enter telephone allowance..') }}">
                                        @if ($errors->has('special_allowance'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('special_allowance') }}</strong>
                                        </span>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6" style="padding: unset;">
                                    <div class="form-group{{ $errors->has('other_allowance') ? ' has-error' : '' }}">
                                        <label for="other_allowance">{{ __('Servant Allowance') }}</label>
                                        <input type="number" name="other_allowance" value="{{ old('other_allowance') }}" class="form-control" id="other_allowance" placeholder="{{ __('Enter domestic servant allowance..') }}">
                                        @if ($errors->has('other_allowance'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('other_allowance') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-sm-6" style="padding-left: unset;">
                                        <div class="form-group{{ $errors->has('electricity_allowance') ? ' has-error' : '' }}">
                                        <label for="electricity_allowance">{{ __('Electricity Allowance') }}</label>
                                        <input type="number" name="electricity_allowance" value="{{ old('electricity_allowance') }}" class="form-control" id="electricity_allowance" placeholder="{{ __('Enter electricity allowance..') }}">
                                        @if ($errors->has('electricity_allowance'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('electricity_allowance') }}</strong>
                                        </span>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6" style="padding: unset;">
                                    <div class="form-group{{ $errors->has('security_allowance') ? ' has-error' : '' }}">
                                        <label for="security_allowance">{{ __('Security Allowance') }}</label>
                                        <input type="number" name="security_allowance" value="{{ old('security_allowance') }}" class="form-control" id="security_allowance" placeholder="{{ __('Enter security allowance..') }}">
                                        @if ($errors->has('security_allowance'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('security_allowance') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('provident_fund_contribution') ? ' has-error' : '' }}">
                                        <label for="provident_fund_contribution">{{ __('Superannuation Fund Contribution') }}</label>
                                        <input type="number" name="provident_fund_contribution" value="{{ old('provident_fund_contribution') }}" class="form-control" id="provident_fund_contribution" placeholder="{{ __('Enter superannuation fund contribution..') }}">
                                        @if ($errors->has('provident_fund_contribution'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('provident_fund_contribution') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                </div>
                                <!-- /.end.col -->
                                <div class="col-md-6">
                                <div class="box box-warning">
                                    <div class="box-header with-border">
                                    <h3 class="box-title">{{ __('Deductions') }}</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                    <div class="col-sm-4" style="padding-left: unset;">
                                        <div class="form-group{{ $errors->has('tax_deduction_a') ? ' has-error' : '' }}">
                                        <label for="tax_deduction_a">{{ __('Tax Deduction (A)') }}</label>
                                        <input type="number" name="tax_deduction_a" value="{{ old('tax_deduction_a') }}" class="form-control" id="tax_deduction_a" placeholder="{{ __('Enter tax deduction..') }}" readonly>
                                        @if ($errors->has('tax_deduction_a'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('tax_deduction_a') }}</strong>
                                        </span>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-8" style="padding-left: unset;">
                                        <div class="form-group{{ $errors->has('tax_deduction_b') ? ' has-error' : '' }}">
                                        <label for="tax_deduction_b">{{ __('Tax Deduction (B)') }}</label>
                                        <div class="row">
                                        <div class="col-sm-6">
                                        <input type="number" name="tax_deduction_b" value="{{ old('tax_deduction_b') }}" class="form-control" id="tax_deduction_b" placeholder="{{ __('Enter tax deduction..') }}" readonly>
                                        </div>
                                        <div class="col-sm-6">
                                        <input type="button" id="taxcal" class="btn btn-primary btn-flat" value="{{ __('Calculate Tax') }}">
                                        </div>
                                        </div>
                                        @if ($errors->has('tax_deduction_b'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('tax_deduction_b') }}</strong>
                                        </span>
                                        @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('provident_fund_deduction') ? ' has-error' : '' }}">
                                        <label for="provident_fund_deduction">{{ __('Superannuation Fund Deduction') }}</label>
                                        <input type="number" name="provident_fund_deduction" value="{{ old('provident_fund_deduction') }}" class="form-control" id="provident_fund_deduction" placeholder="{{ __('Enter superannuation fund deduction..') }}">
                                        @if ($errors->has('provident_fund_deduction'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('provident_fund_deduction') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                </div>
                                <!-- /.end.col -->

                                <div class="col-md-6">
                                <div class="box box-success">
                                    <div class="box-header with-border">
                                    <h3 class="box-title">{{ __('Superannuation Fund') }}</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                    <div class="form-group">
                                        <label for="total_provident_fund">{{ __('Total Superannuation Fund') }}</label>
                                        <input type="number" class="form-control" id="total_provident_fund" readonly>
                                    </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                </div>
                                <!-- /.end.col -->

                                <!-- <div class="col-md-offset-6 col-md-6"> -->
                                <div class="col-md-6">
                                <div class="box box-danger">
                                    <div class="box-header with-border">
                                    <h3 class="box-title">{{ __('Total Salary Details') }}</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                    <div class="form-group">
                                        <label for="gross_salary">{{ __('Gross Salary') }}</label>
                                        <input type="number" disabled class="form-control" id="gross_salary">
                                    </div>
                                    <div class="form-group{{ $errors->has('total_deduction') ? ' has-error' : '' }}">
                                        <label for="total_deduction">{{ __('Total Deduction') }}</label>
                                        <input type="number" disabled class="form-control" id="total_deduction">
                                    </div>
                                    <div class="form-group">
                                        <label for="net_salary">{{ __('Net Salary') }}</label>
                                        <input type="number" disabled class="form-control" id="net_salary">
                                    </div>
                                    </div>
                                    <!-- /.box-body -->

                                    <div class="box-footer">
                                    <button type="submit" class="btn btn-primary btn-flat pull-right"><i class="fa fa-save"></i> {{ __('Save Details') }}</button>
                                    </div>
                                </div>
                                </div>
                                <!-- /.end.col -->

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
                            <h3 class="box-title">{{ __('EMPLOYEE CONTACT INFORMATION') }}</h3>

                            <!-- <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                            </div> -->
                        </div>
                        <form action="{{ url('people/employees/store') }}" method="post" name="employee_add_form">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="row">
                                    <!-- Notification Box -->
                                    <div class="col-md-12">
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
                                        @else
                                        <p class="text-yellow">{{ __('Enter team member details. All (*) fields are required. (Default password for added user is 12345678)') }}</p>
                                        @endif
                                    </div>
                                </div>
                                    <!-- Add your form fields here -->
                                    <?php 
                                        $users = \App\User::orderBy('id', 'desc')->first();
                                        $sl=$users->id;
                                    ?>
                                        <div class="col-md-12">
                                            <label for="contact_name">{{ __('Contact Name') }} <span class="text-danger">*</span></label>
                                            <div class="form-group{{ $errors->has('contact_name') ? ' has-error' : '' }} has-feedback">
                                                <input type="text" name="contact_name" id="contact_name" class="form-control" value="{{ old('contact_name') }}" placeholder="{{ __('Enter name..') }}">
                                                @if ($errors->has('contact_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('contact_name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <div class="col-md-12">
                                            <label for="contact_address">{{ __('Address') }}<span class="text-danger">*</span></label>
                                            <div class="form-group{{ $errors->has('contact_address') ? ' has-error' : '' }} has-feedback">
                                                <input type="text" name="contact_address" id="contact_address" class="form-control" value="{{ old('contact_address') }}" placeholder="{{ __('Enter contact address..') }}">
                                                @if ($errors->has('contact_address'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('contact_address') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                            <!-- /.form-group -->
                                        <div class="col-md-6">
                                            <label for="contact_phone">{{ __('Phone') }}<span class="text-danger">*</span></label>
                                            <div class="form-group{{ $errors->has('contact_phone') ? ' has-error' : '' }} has-feedback">
                                                <input type="text" name="contact_phone" id="contact_phone" class="form-control" value="{{ old('contact_phone') }}" placeholder="{{ __('Enter phone no..') }}">
                                                @if ($errors->has('contact_phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('contact_phone') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                            <!-- /.form-group -->
                                        <div class="col-md-6">
                                            <label for="contact_mobile">{{ __('Mobile') }}<span class="text-danger">*</span></label>
                                            <div class="form-group{{ $errors->has('contact_mobile') ? ' has-error' : '' }} has-feedback">
                                                <input type="text" name="contact_mobile" id="contact_mobile" class="form-control" value="{{ old('contact_mobile') }}" placeholder="{{ __('Enter mobile no..') }}">
                                                @if ($errors->has('contact_mobile'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('contact_mobile') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                            <!-- /.form-group -->

                                        
                                        <div class="col-md-6">
                                            <label for="email">{{ __('Email') }} <span class="text-danger">*</span></label>
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                                                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="{{ __('Enter email address..') }}">
                                                @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <!-- /.form-group -->
                                        </div>

                                        <!-- /.form-group -->
                                        <div class="col-md-6">
                                            <label for="contact_relation">{{ __('Relation') }}<span class="text-danger">*</span></label>
                                            <div class="form-group{{ $errors->has('contact_relation') ? ' has-error' : '' }} has-feedback">
                                                <input type="text" name="contact_relation" id="contact_relation" class="form-control" value="{{ old('contact_relation') }}" placeholder="{{ __('Enter relation..') }}">
                                                @if ($errors->has('contact_relation'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('contact_no_') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                            <!-- /.form-group -->                        </div>
                            <div class="box-footer">
                                <a href="{{ url('/people/employees') }}" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i>{{ __('Cancel') }} </a>
                                <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-plus"></i> {{ __('Add') }}</button>
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
                            <h3 class="box-title">{{ __('EMPLOYEE LEAVE DETAILS') }}</h3>
                        </div>
                        <form action="{{ url('people/employees/store') }}" method="post" name="employee_add_form">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="row">
                                    <!-- Notification Box -->
                                    <div class="col-md-12">
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
                                        @else
                                        
                                        @endif
                                    </div>
                                </div>
                                <!-- Add your form fields here -->
                                <?php 
                                    $users = \App\User::orderBy('id', 'desc')->first();
                                    $sl = $users->id;
                                ?>
                                <!-- Sick Leave, Annual Leave, Long Service Leave Section -->
                                <div class="col-md-4">
                                    <h4>{{ __('Sick Leave') }}</h4>
                                    <div class="form-group{{ $errors->has('sick_leave_balance') ? ' has-error' : '' }}">
                                        <label for="sick_leave_balance">{{ __('C/F Balance Leave') }}</label>
                                        <input type="number" name="sick_leave_balance" id="sick_leave_balance" class="form-control" value="{{ old('sick_leave_balance') }}" placeholder="{{ __('Enter balance leave..') }}">
                                        @if ($errors->has('sick_leave_balance'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('sick_leave_balance') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('sick_leave_date') ? ' has-error' : '' }}">
                                        <label for="sick_leave_date">{{ __('C/F Date') }}</label>
                                        <input type="date" name="sick_leave_date" id="sick_leave_date" class="form-control" value="{{ old('sick_leave_date') }}">
                                        @if ($errors->has('sick_leave_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('sick_leave_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h4>{{ __('Annual Leave') }}</h4>
                                    <div class="form-group{{ $errors->has('annual_leave_balance') ? ' has-error' : '' }}">
                                        <label for="annual_leave_balance">{{ __('C/F Balance Leave') }}</label>
                                        <input type="number" name="annual_leave_balance" id="annual_leave_balance" class="form-control" value="{{ old('annual_leave_balance') }}" placeholder="{{ __('Enter balance leave..') }}">
                                        @if ($errors->has('annual_leave_balance'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('annual_leave_balance') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('annual_leave_date') ? ' has-error' : '' }}">
                                        <label for="annual_leave_date">{{ __('C/F Date') }}</label>
                                        <input type="date" name="annual_leave_date" id="annual_leave_date" class="form-control" value="{{ old('annual_leave_date') }}">
                                        @if ($errors->has('annual_leave_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('annual_leave_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h4>{{ __('Long Service Leave') }}</h4>
                                    <div class="form-group{{ $errors->has('long_service_leave_balance') ? ' has-error' : '' }}">
                                        <label for="long_service_leave_balance">{{ __('C/F Balance Leave') }}</label>
                                        <input type="number" name="long_service_leave_balance" id="long_service_leave_balance" class="form-control" value="{{ old('long_service_leave_balance') }}" placeholder="{{ __('Enter balance leave..') }}">
                                        @if ($errors->has('long_service_leave_balance'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('long_service_leave_balance') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('long_service_leave_date') ? ' has-error' : '' }}">
                                        <label for="long_service_leave_date">{{ __('C/F Date') }}</label>
                                        <input type="date" name="long_service_leave_date" id="long_service_leave_date" class="form-control" value="{{ old('long_service_leave_date') }}">
                                        @if ($errors->has('long_service_leave_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('long_service_leave_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <a href="{{ url('/people/employees') }}" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i>{{ __('Cancel') }} </a>
                                <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-plus"></i> {{ __('Add') }}</button>
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
        <h3 class="box-title">{{ __('EMPLOYEE SUPERANNUATION') }}</h3>
    </div>
    <form action="{{ url('people/employees/store') }}" method="post" name="employee_add_form">
        {{ csrf_field() }}
        <div class="box-body">
            <div class="row">
                <!-- Notification Box -->
                <div class="col-md-12">
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
                    @else
                    @endif
                </div>
            </div>

            <!-- Employee Superannuation Section -->
            <div class="row">
                <div class="col-md-6">
                    <span><strong>1</strong> - Superannuation</span>
                    <select class="form-control" id="sup_id-1">
                        <option value="0">Select - Superannuation</option>
                        <option value="1" selected>NPF - NATIONAL SUPERANNUATION FUND</option>
                        <option value="2">NPFH - NASFUND HOUSING</option>
                        <option value="3">NSL - NAMBAWAN SUPERANNUATION FUND</option>
                        <option value="4">NSLH - Nambawan Super Limited Housing</option>
                        <option value="5">NPS - National Pension Scheme</option>
                        <option value="6">LIC1 - Life Insurance</option>
                        <option value="7">NPMM - National PPF</option>
                    </select>
                    <span>Superannuation No.:</span>
                    <input type="text" class="form-control" value="99056" id="sup_no-1">
                    <span>Commence Date</span>
                    <input type="date" min="1900-01-01" max="3000-01-01" class="form-control" value="2013-03-21" id="sup_commence-1">
                </div>
                <div class="col-md-6">
                    <span><strong>2</strong> - Superannuation</span>
                    <select class="form-control" id="sup_id-2">
                        <option value="0" selected>Select - Superannuation</option>
                        <option value="1">NPF - NATIONAL SUPERANNUATION FUND</option>
                        <option value="2">NPFH - NASFUND HOUSING</option>
                        <option value="3">NSL - NAMBAWAN SUPERANNUATION FUND</option>
                        <option value="4">NSLH - Nambawan Super Limited Housing</option>
                        <option value="5">NPS - National Pension Scheme</option>
                        <option value="6">LIC1 - Life Insurance</option>
                        <option value="7">NPMM - National PPF</option>
                    </select>
                    <span>Superannuation No.:</span>
                    <input type="text" class="form-control" value="" id="sup_no-2">
                    <span>Commence Date</span>
                    <input type="date" min="1900-01-01" max="3000-01-01" class="form-control" value="" id="sup_commence-2">
                </div>
                <div class="col-md-6">
                    <span><strong>3</strong> - Superannuation</span>
                    <select class="form-control" id="sup_id-3">
                        <option value="0" selected>Select - Superannuation</option>
                        <option value="1">NPF - NATIONAL SUPERANNUATION FUND</option>
                        <option value="2">NPFH - NASFUND HOUSING</option>
                        <option value="3">NSL - NAMBAWAN SUPERANNUATION FUND</option>
                        <option value="4">NSLH - Nambawan Super Limited Housing</option>
                        <option value="5">NPS - National Pension Scheme</option>
                        <option value="6">LIC1 - Life Insurance</option>
                        <option value="7">NPMM - National PPF</option>
                    </select>
                    <span>Superannuation No.:</span>
                    <input type="text" class="form-control" value="" id="sup_no-3">
                    <span>Commence Date</span>
                    <input type="date" min="1900-01-01" max="3000-01-01" class="form-control" value="" id="sup_commence-3">
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <a href="{{ url('/people/employees') }}" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i>{{ __('Cancel') }} </a>
            <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-plus"></i> {{ __('Add') }}</button>
        </div>
    </form>
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
                            <h3 class="box-title">{{ __('BANK CREDITS') }}</h3>
                        </div>
                        <form action="{{ url('people/employees/store') }}" method="post" name="employee_add_form">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="row">
                                    <!-- Notification Box -->
                                    <div class="col-md-12">
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
                                    </div>
                                </div>
                                <!-- Bank Details Section -->
                                <div class="row">
                                    <div class="col-md-12">
                                    <strong>BC#: 1</strong>
                                        <select class="form-control" id="bankdet_id">
                                            <option value="0"> Select Bank Detail</option>
                                            <option value="1">032001-Test West Pac Bank</option>
                                            <option value="2" selected>2-Bank South Pacific</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="1000234569" id="acct_no" placeholder="Account No">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="S Mathew" id="acct_name" placeholder="Account Name">
                                    </div>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="" id="acct_add" placeholder="Address">
                                    </div>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="" id="acct_city" placeholder="City">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="" id="acct_email" placeholder="Email Address">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" maxlength="2" value="" id="acct_ccode" placeholder="Country Code">
                                    </div>
                                </div>
                                <br>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <a href="{{ url('/people/employees') }}" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i>{{ __('Cancel') }} </a>
                                <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-plus"></i> {{ __('Add') }}</button>
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
        // Function to open the Add Employee accordion tab
        function openAddEmployeeTab() {
            var addEmployeeHeading = document.getElementById("addEmployeeHeading");
            if (addEmployeeHeading) {
                var addEmployeeLink = addEmployeeHeading.querySelector("a");
                if (addEmployeeLink) {
                    addEmployeeLink.click();
                }
            }
        }

        // Function to open the Payroll accordion tab
        function openPayrollTab() {
            var payrollHeading = document.getElementById("payrollHeading");
            if (payrollHeading) {
                var payrollLink = payrollHeading.querySelector("a");
                if (payrollLink) {
                    payrollLink.click();
                }
            }
        }

        // Function to open the Bank Information accordion tab
        function openBankTab() {
            var bankHeading = document.getElementById("bankHeading");
            if (bankHeading) {
                var bankLink = bankHeading.querySelector("a");
                if (bankLink) {
                    bankLink.click();
                }
            }
        }

        // Check if the form submission was successful
        var message = "{{ session('message') }}";
        var submittedForm = "{{ session('submitted_form') }}";

        if (message && submittedForm) {
            if (submittedForm === 'add_employee_form') {
                openPayrollTab();
            } else if (submittedForm === 'payroll_form') {
                openBankTab();
            }
        } else {
            // Open the Add Employee accordion tab by default
            openAddEmployeeTab();
        }
    });
</script>




<script type="text/javascript">
    document.forms['employee_add_form'].elements['gender'].value = "{{ old('gender') }}";
        document.forms['employee_add_form'].elements['id_name'].value = "{{ old('id_name') }}";
    document.forms['employee_add_form'].elements['designation_id'].value = "{{ old('designation_id') }}";
    document.forms['employee_add_form'].elements['role'].value = "{{ old('role') }}";
    document.forms['employee_add_form'].elements['joining_position'].value = "{{ old('joining_position') }}";
    document.forms['employee_add_form'].elements['marital_status'].value = "{{ old('marital_status') }}";
</script>


<script>
    (function($){
        $(document).ready(function(){
            $("#hr_place").on("change", function(){
                  var hra_place_id = $("#hr_place").val();
                  if(hra_place_id >= 1) {
                    $.ajax({
                        type: "get",
                        url: "{{ secure_url('/hrm/payroll/hra_area_src') }}" + "/" + hra_place_id,
                        success: function(response) {
                            $("#hr_area").val(response);
                            hra_area1 = $("#hr_area").val();
                            if(hra_area1 == "" || hra_area1 == 'Area 3') {
                              $('#hra_amount_per_week').attr('readonly', true);
                              $('#hra_type').attr('readonly', true);
                              $('#hra_amount_per_week').val('');
                              $('#house_rent_allowance').val('');
                            }else{
                              $('#hra_amount_per_week').attr('readonly', false);
                              $('#hra_type').attr('readonly', false);                  
                              $('#hra_amount_per_week').val('');
                              $('#house_rent_allowance').val('');
                            }
                        },
                        error:function(err){

                        }
                    })
                  }
                  //$("#hr_area").val(hra_area1);
                  // hra_area1 = $("#hr_area").val();
                  // if(hra_area1 == "" || hra_area1 == 'Area 3') {
                  //   $('#hra_amount_per_week').attr('readonly', true);
                  //   $('#hra_type').attr('readonly', true);
                  //   $('#hra_amount_per_week').val('');
                  //   $('#house_rent_allowance').val('');
                  // }else{
                  //   $('#hra_amount_per_week').attr('readonly', false);
                  //   $('#hra_type').attr('readonly', false);                  
                  //   $('#hra_amount_per_week').val('');
                  //   $('#house_rent_allowance').val('');
                  // }
            })

            $("#hra_amount_per_week").on("keyup", function(){
                var hra_rent = $("#hra_amount_per_week").val();
                var hra_type = $("#hra_type").val();

                  if(parseInt(hra_rent) >0 ){
                    if(hra_type == 0 || hra_type == null){
                      alert("Please select Housing Allowance Type...");
                      $("#hra_amount_per_week").val('');
                      return;
                    }
                  }else{
                    $("#house_rent_allowance").val(0);
                    return;
                  }

                var area_type = $("#hr_area").val(); //'Area 1';
                if(hra_rent) {
                    $.ajax({
                        type: "get",
                        url: "{{ secure_url('/hrm/payroll/hra') }}" + "/" + hra_rent + "/" + hra_type+ "/" + area_type,
                        success: function(response) {
                            console.log(response);
                            $("#house_rent_allowance").val(response);
                        },
                        error:function(err){

                        }
                    })
                }
            })
            
            $("#va_type").on("change", function(){
                // alert("finally bye");
                var va_type = $("#va_type").val();
                if(va_type>=1 && va_type<=2) {
                    $.ajax({
                        type: "get",
                        url: "{{ secure_url('/hrm/payroll/vehicle') }}" + "/" + va_type,
                        success: function(response) {
                            console.log(response);
                            $("#vehicle_allowance").val(response);
                        },
                        error:function(err){

                        }
                    })
                } else {
                  $("#vehicle_allowance").val('');
                  return;
                }
            })

            $("#meals_tag").on("click", function(){
                var meals_type = $("#meals_tag").is(":checked");
                if(meals_type) {
                    $.ajax({
                        type: "get",
                        url: "{{ secure_url('/hrm/payroll/meals') }}" + "/" + '3',
                        success: function(response) {
                            console.log(response);
                            $("#meals_allowance").val(response);
                        },
                        error:function(err){

                        }
                    })
                }else{
                  $("#meals_allowance").val('');
                  return;
                }
            })

            $("#overtime_hrs").on("keyup", function(){
                var overtime_hrs = $("#overtime_hrs").val();
                var overtime_rate = $("#overtime_rate").val();
                var overtime_amt = +overtime_hrs * +overtime_rate;
                $("#overtime_amt").val(overtime_amt);
            })
            $("#overtime_rate").on("keyup", function(){
                var overtime_hrs = $("#overtime_hr").val();
                var overtime_rate = $("#overtime_rate").val();
                var overtime_amt = +overtime_hrs * +overtime_rate;
                $("#overtime_amt").val(overtime_amt);
            })

            $("#taxcal").on("click", function(){
                 //alert("finally bye");
                var gross_sal = $("#gross_salary").val();
                var dependent = $("#no_of_dependent").val();
                if(dependent == ""){
                  dependent = 0;
                }
                var resident_status = $("#resident_status").val();
                if(gross_sal == 0 || gross_sal == '' || resident_status == null){
                  return;
                }
                console.log('Gross Sal'+gross_sal);
                console.log("Dependent"+dependent);
                $.ajax({
                    type: "get",
                    url: "{{ secure_url('/hrm/payroll/taxcal') }}" + "/" + gross_sal + "/" + dependent + "/" + resident_status,
                    success: function(response) {
                        console.log(response);
                        $("#tax_deduction_a").val(parseFloat(response.frt_tax_amt).toFixed(2));
                        calculation();
                    },
                    error:function(err){
                        console.log('Error: '+err);
                    }
                })
            })

      });
    })(jQuery);
</script>

<script type="text/javascript">
  // For Kepp Data After Reload
  //document.forms['employee_select_form'].elements['user_id'].value = "{{ session('inserted_id') }}";

  @if(!empty(old('employee_type')))
    document.forms['employee_salary_form'].elements['employee_type'].value = "{{ old('employee_type') }}";
  @endif

 
  $(document).ready(function(){
    calculation();
  });


  //For Calculation
  $(document).on("keyup", "#employee_salary_form", function() {
    calculation();
  });

  function calculation() {
    var sum = 0;
    var basic_salary = $("#basic_salary").val();
    var overtime_amt = $("#overtime_amt").val();
    var sales_comm = $("#sales_comm").val();
    var house_rent_allowance = $("#house_rent_allowance").val();
    var vehicle_allowance = $("#vehicle_allowance").val();
    var meals_allowance = $("#meals_allowance").val();
    var electricity_allowance = $("#electricity_allowance").val();
    var security_allowance = $("#security_allowance").val();
    var medical_allowance = $("#medical_allowance").val();
    var special_allowance = $("#special_allowance").val(); // Telephone
    var provident_fund_contribution = $("#provident_fund_contribution").val();
    var other_allowance = $("#other_allowance").val();  //Servant
    var tax_deduction_a = $("#tax_deduction_a").val();
    var tax_deduction_a = $("#tax_deduction_a").val();
    var provident_fund_deduction = $("#provident_fund_deduction").val();
    // var other_deduction = $("#other_deduction").val();

    //var gross_salary = (basic_salary + house_rent_allowance + vehicle_allowance + meals_allowance + electricity_allowance + security_allowance + medical_allowance + special_allowance + other_allowance);
    //var gross_salary = (+basic_salary + +house_rent_allowance + +vehicle_allowance + +meals_allowance + +electricity_allowance + +security_allowance + +medical_allowance + +special_allowance + +other_allowance);
    var gross_salary = +basic_salary + +overtime_amt + +sales_comm + +house_rent_allowance + +medical_allowance + +special_allowance + +other_allowance + +vehicle_allowance + +meals_allowance + +electricity_allowance + +security_allowance;

    //var total_deduction = parseFloat(+tax_deduction + +provident_fund_deduction + +other_deduction);
    var total_deduction = +tax_deduction_a + +provident_fund_deduction;

    $("#total_provident_fund").val(+provident_fund_contribution + +provident_fund_deduction);

    $("#gross_salary").val(gross_salary);
    $("#total_deduction").val(total_deduction);
    $("#net_salary").val(+gross_salary - +total_deduction);
  }
</script>
@endsection
