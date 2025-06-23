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
                            <h3 class="box-title">{{ __('EMPLOYEE PERSONAL DETAILS') }}</h3>
                        </div>
                        <!-- Check if Employee not added -->
                        @if(isset($employee_id))
                        <form action="{{ url('people/employees/update/'.$employee_id) }}" method="post" name="employee_add_form">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="row">
                                    <?php 
                                        //Get Employees
                                        $employee = \App\Models\User::where('id', $employee_id)->first();
                                    ?>
                                    <div class="col-md-3">
                                        <label for="employee_id">{{ __('ID') }} <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                                            <input type="text" class="form-control" value="{{ __('EMPID') }}{{ $employee->id }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name">{{ __('Name') }} <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <input type="text" name="name" id="name" class="form-control" value="{{ $employee->name }}" placeholder="{{ __('Enter name..') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="father_name">{{ __('Fathers Name') }}</label>
                                        <div class="form-group">
                                            <input type="text" name="father_name" id="father_name" class="form-control" value="{{ $employee->father_name }}" placeholder="{{ __('Enter fathers name..') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="mother_name">{{ __('Mothers Name') }}</label>
                                        <div class="form-group">
                                            <input type="text" name="mother_name" id="mother_name" class="form-control" value="{{ $employee->mother_name }}" placeholder="{{ __('Enter mothers name..') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="spouse_name">{{ __('Spouse Name') }}</label>
                                        <div class="form-group">
                                            <input type="text" name="spouse_name" id="spouse_name" class="form-control" value="{{ $employee->spouse_name }}" placeholder="{{ __('Enter spouse name..') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="present_address">{{ __('Present Address') }} <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <input type="text" name="present_address" id="present_address" class="form-control" value="{{ $employee->present_address }}" placeholder="{{ __('Enter present address..') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="permanent_address">{{ __('Permanent Address') }}</label>
                                        <div class="form-group">
                                            <input type="text" name="permanent_address" id="permanent_address" class="form-control" value="{{ $employee->permanent_address }}" placeholder="{{ __('Enter permanent address..') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="email">{{ __('Email') }} <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <input type="text" name="email" id="email" class="form-control" value="{{ $employee->email }}" placeholder="{{ __('Enter email address..') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="contact_no_one">{{ __('Contact No') }} <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <input type="text" name="contact_no_one" id="contact_no_one" class="form-control" value="{{ $employee->contact_no_one }}" placeholder="{{ __('Enter contact no..') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="emergency_contact">{{ __('Emergency Contact') }}</label>
                                        <div class="form-group">
                                            <input type="text" name="emergency_contact" id="emergency_contact" class="form-control" value="{{ $employee->emergency_contact }}" placeholder="{{ __('Enter emergency contact no..') }}" readonly>
                                        </div>
                                    </div>
                                                                
                                    <div class="col-md-3">
                                        <label for="gender">{{ __('Gender') }} <span class="text-danger">*</span></label>
                                        <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
                                            <select name="gender" id="gender" class="form-control" readonly>
                                                <option value="" selected disabled>{{ __('Select one') }}</option>
                                                <option value="m" {{ $employee->gender=='m' ? 'selected' : '' }}>{{ __('Male') }}</option>
                                                <option value="f" {{ $employee->gender=='f' ? 'selected' : '' }}>{{ __('Female') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="marital_status">{{ __('Marital Status') }} </label>
                                        <div class="form-group">
                                            <select name="marital_status" id="marital_status" class="form-control" readonly>
                                                <option value="" selected disabled>{{ __('Select one') }}</option>
                                                <option value="1" {{ $employee->marital_status==1 ? 'selected' : '' }}>{{ __('Married') }}</option>
                                                <option value="2" {{ $employee->marital_status==2 ? 'selected' : '' }}>{{ __('Single') }}</option>
                                                <option value="3" {{ $employee->marital_status==3 ? 'selected' : '' }}>{{ __('Divorced') }}</option>
                                                <option value="4" {{ $employee->marital_status==4 ? 'selected' : '' }}>{{ __('Separated') }}</option>
                                                <option value="5" {{ $employee->marital_status==5 ? 'selected' : '' }}>{{ __('Widowed') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="datepicker">{{ __('Date of Birth') }}</label>
                                        <div class="form-group">
                                            <div class="input-group date">
                                                <input type="text" name="date_of_birth" class="form-control pull-right" value="{{ old('date_of_birth') }}" id="datepicker" readonly>
                                                <div class="input-group-append">
                                                    <span class="input-group-text calendar-icon" id="date_picker_icon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="datepicker4">{{ __('Joining Date') }}<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <div class="input-group date">
                                                <input type="text" name="joining_date" class="form-control pull-right" id="datepicker4" value="{{ $employee->joining_date }}" placeholder="{{ __('yyyy-mm-dd') }}" readonly>
                                                <div class="input-group-append">
                                                    <span class="input-group-text calendar-icon" id="date_picker_icon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="datepicker5">{{ __('End Date') }}<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <div class="input-group date">
                                                <input type="text" name="end_date" class="form-control pull-right" id="datepicker5" placeholder="{{ __('yyyy-mm-dd') }}" readonly>
                                                <div class="input-group-append">
                                                    <span class="input-group-text calendar-icon" id="date_picker_icon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="home_district" value="None">

                                    <div class="col-md-3">
                                        <label for="designation_id">{{ __('Designation') }} <span class="text-danger">*</span></label>
                                        <div class="form-group {{ $errors->has('designation_id') ? ' has-error' : '' }}">
                                            <select name="designation_id" id="designation_id" class="form-control" readonly>
                                                <option value="" selected disabled>{{ __('Select one') }}</option>
                                                @foreach($designations as $designation)
                                                <option value="{{ $designation['id'] }}" {{ $designation['id'] == $employee->designation_id ? 'selected' : '' }}>{{ $designation['designation'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="joining_position">{{ __('Department') }} <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <select name="joining_position" id="joining_position" class="form-control" readonly>
                                                <option value="" selected disabled>{{ __('Select one') }}</option>
                                                <?php $departments= \App\Models\Department::all();?>
                                                @foreach($departments as $department)
                                                <option value="{{ $department['id'] }}" {{ $department['id'] == $employee->joining_position ? 'selected' : '' }}>{{ $department['department'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="id_name">{{ __('Photo ID Name') }}</label>
                                        <div class="form-group">
                                            <select name="id_name" id="id_name" class="form-control" readonly>
                                                <option value="" selected disabled>{{ __('Select one') }}</option>
                                                <option value="1">{{ __('NID') }}</option>
                                                <option value="2">{{ __('Passport') }}</option>
                                                <option value="3">{{ __('Driving License') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="id_number">{{ __('Photo ID Number') }}</label>
                                        <div class="form-group">
                                            <input type="text" name="id_number" id="id_number" class="form-control" value="{{ old('id_number') }}" placeholder="{{ __('Enter id number..') }}" readonly>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <label for="role">{{ __('Role') }}<span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <select name="role" id="role" class="form-control" readonly>
                                                <option value="" selected disabled>{{ __('Select one') }}</option>
                                                @foreach($roles as $role)
                                                <option value="{{ $role->name }}"  {{ $role->name == $employee->role ? 'selected' : '' }}>{{ $role->display_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="employee_type" class="control-label">{{ __('Employee Type') }}</label>
                                        <div class="form-group">
                                            <select name="employee_type" class="form-control" id="employee_type" readonly>
                                                <option selected disabled>{{ __('Select One') }}</option>
                                                <option value="1" {{ $employee->employee_type == 1 ? 'selected' : '' }}>{{ __('Provision') }}</option>
                                                <option value="2" {{ $employee->employee_type == 2 ? 'selected' : '' }}>{{ __('Permanent') }}</option>
                                                <option value="3" {{ $employee->employee_type == 3 ? 'selected' : '' }}>{{ __('Full Time') }}</option>
                                                <option value="4" {{ $employee->employee_type == 4 ? 'selected' : '' }}>{{ __('Part Time') }}</option>
                                                <option value="5" {{ $employee->employee_type == 5 ? 'selected' : '' }}>{{ __('Adhoc') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="resident_status" class="control-label">{{ __('Resident Status') }}</label>
                                        <div class="form-group">
                                            <select name="resident_status" class="form-control" id="resident_status" readonly>
                                                <option selected disabled>{{ __('Select Resident/Non-Resident') }}</option>
                                                <option value="1" {{ $employee->resident_status == 1 ? 'selected' : '' }}>{{ __('Resident') }}</option>
                                                <option value="2" {{ $employee->resident_status == 2 ? 'selected' : '' }}>{{ __('Non-Resident') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="no_of_dependent" class="control-label">{{ __('No. of Dependent') }}</label>
                                        <div class="form-group">
                                            <input type="number" name="no_of_dependent" class="form-control" id="no_of_dependent" value="{{ $employee['no_of_dependent'] }}" placeholder="{{ __('Enter no. of dependent..') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="academic_qualification" class="control-label">{{ __('Academic Qualification') }}</label>
                                        <div class="form-group">
                                            <textarea name="academic_qualification" id="academic_qualification" class="form-control textarea" placeholder="{{ __('Enter academic qualification..') }}">{{ $employee['academic_qualification'] }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="professional_qualification" class="control-label">{{ __('Professional Qualification') }}</label>
                                        <div class="form-group">
                                            <textarea name="professional_qualification" id="professional_qualification" class="form-control textarea" placeholder="{{ __('Enter professional qualification..') }}">{{ $employee['professional_qualification'] }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="experience" class="control-label">{{ __('Experience') }}</label>
                                        <div class="form-group">
                                            <textarea name="experience" id="experience" class="form-control textarea" placeholder="{{ __('Enter experience..') }}">{{ $employee['experience'] }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-flat">{{ __('Update') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @else
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
                                    <div class="col-md-3">
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

                                    <div class="col-md-3">
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
                                        
                                    <div class="col-md-3">
                                        <label for="reference">{{ __('Reference ') }}<span class="text-danger">*</span></label>
                                        <div class="form-group{{ $errors->has('reference') ? ' has-error' : '' }} has-feedback">
                                            <select name="reference" id="reference" class="form-control">
                                                <option value="" selected disabled>{{ __('Select one') }}</option>
                                                <?php $references = \App\Models\User::where('access_label', 4)
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

                                    <div class="col-md-3">
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
                                    <div class="col-md-3">
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

                                    <div class="col-md-3">    
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

                                    <!-- /.form-group -->

                                    <input type="hidden" name="home_district" value="None">

                    
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
                                    <!-- /.form-group -->
                                    <div class="col-md-3">
                                        <label for="joining_position">{{ __('Department') }} <span class="text-danger">*</span></label>
                                        <div class="form-group{{ $errors->has('joining_position') ? ' has-error' : '' }} has-feedback">
                                            <select name="joining_position" id="joining_position" class="form-control">
                                                <option value="" selected disabled>{{ __('Select one') }}</option>
                                                <?php $departments= \App\Models\Department::all();?>
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
                                        <!-- /.form-group -->

                                        <div class="col-md-3">
                                            <label for="payroll_location">{{ __('Payroll Location') }} <span class="text-danger">*</span></label>
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
                                        </div>
                                        <!-- /.form-group -->

                                        <div class="col-md-3">
                                            <label for="pay_batch_number">{{ __('Pay Batch Number') }} <span class="text-danger">*</span></label>
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
                                        </div>
                                        <!-- /.form-group -->

                                    <div class="col-md-3">
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
                                    <div class="col-md-3">
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

                                    <div class="col-md-3">
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
    
                                    <div class="col-md-3">
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
                                    <div class="col-md-3">
                                        <label for="resident_status" class="control-label">{{ __('Resident Status') }}<span class="text-danger">*</span></label>
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
                                    <div class="col-md-3">
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



                                    <!-- Cost Center New code -->
                                    <div class="col-md-3">
                                        <label for="cost_center">{{ __('Cost Center') }} <span class="text-danger">*</span></label>
                                        <div class="form-group{{ $errors->has('cost_center') ? ' has-error' : '' }} has-feedback">
                                            <select name="cost_center" id="cost_center" class="form-control">
                                                <option value="" selected disabled>{{ __('Select one') }}</option>
                                                @foreach($costcenters as $costcenter)
                                                <option value="{{ $costcenter->id }}">{{ $costcenter->name }} - {{ $costcenter->cost_center_code }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('cost_center'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('cost_center') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="department">{{ __('Department') }} <span class="text-danger">*</span></label>
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
                                    </div>

                                    <div class="col-md-3">
                                        <label for="cost_center_share_percentage">{{ __('Cost Center Share Percentage') }} <span class="text-danger">*</span></label>
                                        <div id="share_percentage_fields">
                                            <!-- Dynamic share percentage fields will be populated here -->
                                        </div>
                                        @if ($errors->has('cost_center_share_percentage'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cost_center_share_percentage') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <!-- Cost Center New code end-->



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
                        @endif
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
                        @if (isset($employees) && isset($employee_id))
                            <div class="col-md-12">
                                <!-- Default box -->
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">{{ __('Employee Details') }}</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="employee_id">{{ __('ID') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <span>{{ __('EMPID') }}{{ $employee->id }}</span>
                                                </div>
                                                <div class="col-md-3">
                                                <label for="user_id">{{ __('Employee Name') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                @foreach($employees as $employee)
                                                    @if($employee['id'] == $employee_id)
                                                    <input type="hidden" name="user_id" class="form-control" id="user_id" value="{{ $employee['id'] }}">
                                                    <span>{{ $employee['name'] }}</span>
                                                    @endif
                                                @endforeach
                                                </div>
                                            </div>
                                            @if ($errors->has('user_id'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('user_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                    <!-- /. end col -->
                            </div>
                                <!-- /.box-body -->
                            <div class="box-footer clearfix"></div>
                                <!-- /.box-footer -->
                                <!-- /.box -->
                            <!-- /.end.col -->
                        @endif

                        <?php 
                            //Get Employees
                            if (isset($employee_id)){
                                $employee = \App\Models\User::where('id', $employee_id)->first();
                            }
                            if(isset($employee)){
                                $payroll_id = $employee->user_payroll_rel_id;
                            } else {
                                $payroll_id = 0;
                            }
                        ?>
                        <!-- Check New Payroll -->  
                        @if(isset($payroll_id) && $payroll_id==0)
                            <form name="employee_salary_form" id="employee_salary_form" action="{{ url('/people/employees/payroll_store') }}" method="post">
                                {{ csrf_field() }}
                                @if (isset($employee_id))
                                <input type="hidden" name="user_id" value="{{ $employee_id }}">
                            
                                    <input type="hidden" name="employee_type" class="form-control" id="employee_type" value="{{ $employee->employee_type }}"/>
                                    <input type="hidden" name="resident_status" class="form-control" id="resident_status" value="{{ $employee->resident_status }}"/>
                                    <input type="hidden" name="no_of_dependent" class="form-control" id="no_of_dependent" value="{{ $employee->no_of_dependent }}"/>
                                @else
                                    <input type="hidden" name="employee_type" class="form-control" id="employee_type" value="0"/>
                                    <input type="hidden" name="resident_status" class="form-control" id="resident_status" value="0"/>
                                    <input type="hidden" name="no_of_dependent" class="form-control" id="no_of_dependent" value="0"/>
                                @endif
                                <div class="box-body">
                                        <!-- Add your form fields here -->
                                        <?php 
                                            $users = \App\Models\User::orderBy('id', 'desc')->first();
                                            $sl=$users->id;
                                        ?>
                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <div class="card">
                                                <div class="card-header text-center">
                                                <h5 class="text-primary">{{ __('Salary Details') }}</h5>
                                                </div>
                                                <div class="card-body">
                                                <div class="form-horizontal">
                                                    <div class="form-group{{ $errors->has('period_definition') ? ' has-error' : '' }}">
                                                    <label for="period_definition" class="col-sm-3 control-label">{{ __('Period Definition') }}</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="period_definition" class="form-control" id="period_definition" value="FN - Fortnightly {{ $sumOfWorkingHours*2 }} Hours" readonly>
                                                        @if ($errors->has('period_definition'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('period_definition') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    </div>

                                                    <div class="form-group{{ $errors->has('annual_basic') ? ' has-error' : '' }}">
                                                    <label for="basic_salary" class="col-sm-3 control-label">{{ __('Annual Salary') }}</label>
                                                    <div class="col-sm-6">
                                                        <input type="number" name="annual_salary" class="form-control" id="annual_salary" value="{{ old('annual_salary') }}" placeholder="{{ __('Enter annual salary..') }}">
                                                        @if ($errors->has('annual_salary'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('annual_salary') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    </div>

                                                    <div class="form-group{{ $errors->has('basic_salary') ? ' has-error' : '' }}">
                                                    <label for="basic_salary" class="col-sm-3 control-label">{{ __('Fortnight Salary') }}</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="basic_salary" class="form-control" id="basic_salary" value="{{ old('basic_salary') }}" placeholder="{{ __('Enter fortnight salary..') }}">
                                                        @if ($errors->has('basic_salary'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('basic_salary') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    </div>

                                                    <div class="form-group{{ $errors->has('hrly_salary_rate') ? ' has-error' : '' }}">
                                                    <label for="hrly_salary_rate" class="col-sm-3 control-label text-secondary">{{ __('Rate') }}</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="hrly_salary_rate" class="form-control" id="hrly_salary_rate" value="{{ old('hrly_salary_rate') }}" placeholder="{{ __('Enter working hours..') }}">
                                                        @if ($errors->has('hrly_salary_rate'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('hrly_salary_rate') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- /.end.col -->
                                        <div class="col-6">
                                            <div class="box box-success">
                                                <div class="box-header with-border">
                                                <h3 class="box-title">{{ __('Allowances') }}</h3>
                                                </div>
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="card-title text-primary">{{ __('House Allowances') }}</h3>
                                                        </div>
                                                            <div class="card-body">
                                                                <div class="col-sm-8" style="padding-left: unset;">
                                                                    <div class="form-group{{ $errors->has('hr_place') ? ' has-error' : '' }}">
                                                                    <label for="hr_place">{{ __('Place Name') }}</label>
                                                                        <select name="hr_place" id="hr_place" class="form-control">
                                                                        <option selected disabled>{{ __('Select place for house allowance') }}</option>
                                                                        @if(isset($loca_places))
                                                                            @foreach($loca_places as $item)
                                                                            <option value="{{ $item['id'] }}">{{ $item['places'] }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                        </select>
                                                                        @if ($errors->has('hr_place'))
                                                                        <span class="help-block">
                                                                        <strong>{{ $errors->first('hr_place') }}</strong>
                                                                        </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-12" style="padding-right: unset;">
                                                                    <div class="form-group{{ $errors->has('hr_area') ? ' has-error' : '' }}">  
                                                                    <label for="hr_area">{{ __('Area Name') }}</label>
                                                                        <input type="text" name="hr_area" class="form-control" id="hr_area" value="{{ old('hr_area') }}" placeholder="{{ __('Area...') }}" readonly="true">
                                                                        @if ($errors->has('hr_area'))
                                                                        <span class="help-block">
                                                                        <strong>{{ $errors->first('hr_area') }}</strong>
                                                                        </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-12" style="padding-left: unset;">
                                                                    <div class="form-group{{ $errors->has('hra_type') ? ' has-error' : '' }}">
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
                                                                <div class="col-12" style="padding-left: unset;">
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
                                                                <div class="col-12" style="padding-left: unset;">
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
                                                            </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="card-title text-primary">{{ __('Vehicle Allowances') }}</h3>
                                                        </div>
                                                            <div class="card-body">
                                                                <div class="col-12" style="padding-left: unset;">
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
                                                                <div class="col-12" style="padding-right: unset;">
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
                                                            </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="card-title text-primary">{{ __('Other Allowances') }}</h3>
                                                        </div>
                                                            <div class="card-body">
                                                                <div class="col-12" style="padding-left: unset;">
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
                                                                <div class="col-12" style="padding-right: unset;">
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
                                                                <div class="col-12" style="padding-left: unset;">
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
                                                                <div class="col-12" style="padding-right: unset;">
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
                                                                <div class="col-12" style="padding-left: unset;">
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
                                                                <div class="col-12" style="padding-right: unset;">
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
                                                                <div class="col-12 d-none" style="padding-left: unset;">
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
                                                            </div>
                                                    </div>
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                        </div>
                                        <!-- /.end.col -->
                                        <div class="col-6">
                                            <div class="box box-warning">
                                                <div class="box-header with-border">
                                                    <h3 class="card-title text-primary">{{ __('Deductions') }}</h3>
                                                </div>
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>{{ __('Tax and Superannuation Deductions') }}</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                            <div class="col-12">
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
                                                            <div class="col-12">
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
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                            <div class="box box-success">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title text-primary">{{ __('Superannuation Fund') }}</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label for="total_provident_fund">{{ __('Total Superannuation Fund') }}</label>
                                                            <input type="number" class="form-control" id="total_provident_fund" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                            <div class="box box-danger">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title text-primary">{{ __('Total Salary Details') }}</h3>
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
                        @else

                            @php
                                $payroll = \App\Models\Payroll::where('id', $payroll_id)->first();
                            @endphp
                            <form name="employee_salary_form" id="employee_salary_form" action="{{ url('/people/employees/payroll_update/' . $payroll_id) }}" method="post">
                                {{ csrf_field() }}
                                @if (isset($employee_id))
                                <input type="hidden" name="user_id" value="{{ $employee_id }}">
                            
                                    <input type="hidden" name="employee_type" class="form-control" id="employee_type" value="{{ $employee->employee_type }}"/>
                                    <input type="hidden" name="resident_status" class="form-control" id="resident_status" value="{{ $employee->resident_status }}"/>
                                    <input type="hidden" name="no_of_dependent" class="form-control" id="no_of_dependent" value="{{ $employee->no_of_dependent }}"/>
                                @else
                                    <input type="hidden" name="employee_type" class="form-control" id="employee_type" value="0"/>
                                    <input type="hidden" name="resident_status" class="form-control" id="resident_status" value="0"/>
                                    <input type="hidden" name="no_of_dependent" class="form-control" id="no_of_dependent" value="0"/>
                                @endif
                                <div class="box-body">
                                        <!-- Add your form fields here -->
                                        <?php 
                                            $users = \App\Models\User::orderBy('id', 'desc')->first();
                                            $sl=$users->id;
                                        ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                        <div class="box box-info">
                                            <div class="box-header with-border">
                                            <h3 class="box-title">{{ __('Salary Details') }}</h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="form-horizontal">
                                            <div class="box-body">
                                                <div class="form-group{{ $errors->has('period_definition') ? ' has-error' : '' }}">
                                                    <label for="period_definition" class="col-sm-3 control-label">{{ __('Period Definition') }}</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="period_definition" class="form-control" id="period_definition" value="FN - Fortnightly {{ $sumOfWorkingHours*2 }} Hours" readonly>
                                                        @if ($errors->has('period_definition'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('period_definition') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group{{ $errors->has('annual_basic') ? ' has-error' : '' }}">
                                                    <label for="basic_salary" class="col-sm-3 control-label">{{ __('Annual Salary') }}</label>
                                                    <div class="col-sm-6">
                                                        <input type="number" name="annual_salary" class="form-control" id="annual_salary" value="{{ $payroll->basic_salary*26 }}" placeholder="{{ __('Enter annual salary..') }}">
                                                        @if ($errors->has('annual_salary'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('annual_salary') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group{{ $errors->has('basic_salary') ? ' has-error' : '' }}">
                                                    <label for="basic_salary" class="col-sm-3 control-label">{{ __('Fortnight Salary') }}</label>
                                                    <div class="col-sm-6">
                                                        <input type="number" name="basic_salary" class="form-control" id="basic_salary" value="{{ $payroll->basic_salary }}" placeholder="{{ __('Enter fortnight salary..') }}">
                                                        @if ($errors->has('basic_salary'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('basic_salary') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>    
                                                <div class="form-group{{ $errors->has('hrly_salary_rate') ? ' has-error' : '' }}">
                                                    <label for="hrly_salary_rate" class="col-sm-3 control-label">{{ __('Rate') }}</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="hrly_salary_rate" class="form-control" id="hrly_salary_rate" value="{{ $payroll->hrly_salary_rate }}" placeholder="{{ __('Enter working hours..') }}">
                                                        @if ($errors->has('hrly_salary_rate'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('hrly_salary_rate') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                            </div>
                                        </div>
                                        </div>
                                        <!-- /.end.col -->
                                        <div class="col-md-6">
                                        <div class="box box-success">
                                            <div class="box-header with-border">
                                            <h3 class="box-title">{{ __('Allowances') }}</h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title text-primary">{{ __('House Allowances') }}</h3>
                                                    </div>
                                                        <div class="card-body">
                                                            <div class="col-sm-8" style="padding-left: unset;">
                                                                <div class="form-group{{ $errors->has('hr_place') ? ' has-error' : '' }}">
                                                                <label for="hr_place">{{ __('Place Name') }}</label>
                                                                <!-- <div class="col-sm-3"> -->
                                                                    <select name="hr_place" id="hr_place" class="form-control">
                                                                    <option selected disabled>{{ __('Select place for house allowance') }}</option>
                                                                    @if(isset($loca_places))
                                                                        @foreach($loca_places as $item)
                                                                        <option value="{{ $item['id'] }}"{{ $item['id'] == $payroll->hr_place ? 'selected' :  '' }}>{{ $item['places'] }}</option>
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
                                                            <div class="col-sm-4" style="padding-right: unset;">
                                                                <div class="form-group{{ $errors->has('hr_area') ? ' has-error' : '' }}">  
                                                                <label for="hr_area">{{ __('Area Name') }}</label>
                                                                <!-- <div class="col-sm-3"> -->
                                                                    <input type="text" name="hr_area" class="form-control" id="hr_area" value="{{ $payroll->hr_area }}" readonly="true">
                                                                    @if ($errors->has('hr_area'))
                                                                    <span class="help-block">
                                                                    <strong>{{ $errors->first('hr_area') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                <!-- </div> -->
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12" style="padding-left: unset;">
                                                                <div class="form-group{{ $errors->has('hra_type') ? ' has-error' : '' }}">
                                                                    <!-- <label for="hra_type" class="col-sm-4 control-label" style="padding: unset;">{{ __('Housing Allowance Type') }}</label> -->
                                                                    <label for="hra_type">{{ __('Housing Allowance Type') }}</label>
                                                                    <select name="hra_type" class="form-control" id="hra_type">
                                                                        <option selected disabled>{{ __('Select One') }}</option>
                                                                        <option value="1" {{ $payroll->hra_type == 1 ? 'selected' : '' }}>{{ __('Rental') }}</option>
                                                                        <option value="2" {{ $payroll->hra_type == 2 ? 'selected' : '' }}>{{ __('Kind') }}</option>
                                                                        <option value="3" {{ $payroll->hra_type == 3 ? 'selected' : '' }}>{{ __('Not Applicable') }}</option>
                                                                    </select>
                                                                    @if ($errors->has('hra_type'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('hra_type') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6" style="padding-left: unset;">
                                                                <div class="form-group{{ $errors->has('hra_amount_per_week') ? ' has-error' : '' }}">
                                                                    <label for="hra_amount_per_week">{{ __('House Rent/Purchase Amount') }}</label>
                                                                    <input type="number" name="hra_amount_per_week" value="{{  $payroll->hra_amount_per_week }}" class="form-control" id="hra_amount_per_week" placeholder="{{ __('Enter amount ..') }}">
                                                                    @if ($errors->has('hra_amount_per_week'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('hra_amount_per_week') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6" style="padding-left: unset;">
                                                                <div class="form-group{{ $errors->has('house_rent_allowance') ? ' has-error' : '' }}">
                                                                <label for="house_rent_allowance">{{ __('Housing Allowance') }}</label>
                                                                <input type="number" name="house_rent_allowance" value="{{ $payroll->house_rent_allowance }}" class="form-control"  id="house_rent_allowance" placeholder="{{ __('0') }}" readonly>
                                                                @if ($errors->has('house_rent_allowance'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('house_rent_allowance') }}</strong>
                                                                </span>
                                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title text-primary">{{ __('Vehicle Allowances') }}</h3>
                                                    </div>
                                                        <div class="card-body">
                                                            <div class="col-sm-6" style="padding-left: unset;">
                                                                <div class="form-group{{ $errors->has('va_type') ? ' has-error' : '' }}">
                                                                    <label for="va_type">{{ __('Vehicle Allowance Type') }}</label>
                                                                    <select name="va_type" class="form-control" id="va_type">
                                                                        <option selected disabled>{{ __('Select One') }}</option>
                                                                        <option value="1" {{ $payroll->va_type == 1 ? 'selected' : '' }}>{{ __('With Fuel') }}</option>
                                                                        <option value="2" {{ $payroll->va_type == 2 ? 'selected' : '' }}>{{ __('Without Fuel') }}</option>
                                                                        <option value="3" {{ $payroll->va_type == 3 ? 'selected' : '' }}>{{ __('Not Applicable') }}</option>
                                                                    </select>
                                                                    @if ($errors->has('va_type'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('va_type') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6" style="padding-right: unset;">
                                                                <div class="form-group{{ $errors->has('vehicle_allowance') ? ' has-error' : '' }}">
                                                                <label for="vehicle_allowance">{{ __('Vehicle Allowance') }}</label>
                                                                <input type="number" name="vehicle_allowance" value="{{ $payroll->vehicle_allowance }}" class="form-control" id="vehicle_allowance" placeholder="{{ __('0') }}" readonly>
                                                                @if ($errors->has('vehicle_allowance'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('vehicle_allowance') }}</strong>
                                                                </span>
                                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title text-primary">{{ __('Other Allowances') }}</h3>
                                                    </div>
                                                        <div class="card-body">
                                                            <div class="col-sm-6" style="padding-left: unset;">
                                                                <div class="form-group{{ $errors->has('meals_allowance') ? ' has-error' : '' }}">
                                                                    <label for="meals_allowance">{{ __('Meals (Messing) Allowance') }}</label> 
                                                                    <input type="checkbox" style="margin-left: 10px; margin-top: unset" name="meals_tag" id="meals_tag" value="0" >
                                                                    <input type="number" name="meals_allowance" value="{{ $payroll->meals_allowance }}" class="form-control" id="meals_allowance" placeholder="{{ __('0') }}" readonly>
                                                                    @if ($errors->has('meals_allowance'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('meals_allowance') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6" style="padding-right: unset;">
                                                                <div class="form-group{{ $errors->has('medical_allowance') ? ' has-error' : '' }}">
                                                                <label for="medical_allowance">{{ __('Medical Allowance') }}</label>
                                                                <input type="number" name="medical_allowance" value="{{ $payroll->medical_allowance }}" class="form-control" id="medical_allowance" placeholder="{{ __('Enter medical allowance..') }}">
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
                                                                <input type="number" name="special_allowance" value="{{ $payroll->special_allowance }}" class="form-control" id="special_allowance" placeholder="{{ __('Enter telephone allowance..') }}">
                                                                @if ($errors->has('special_allowance'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('special_allowance') }}</strong>
                                                                </span>
                                                                @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6" style="padding-right: unset;">
                                                                <div class="form-group{{ $errors->has('other_allowance') ? ' has-error' : '' }}">
                                                                    <label for="other_allowance">{{ __('Servant Allowance') }}</label>
                                                                    <input type="number" name="other_allowance" value="{{ $payroll->other_allowance }}" class="form-control" id="other_allowance" placeholder="{{ __('Enter domestic servant allowance..') }}">
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
                                                                    <input type="number" name="electricity_allowance" value="{{ $payroll->electricity_allowance }}" class="form-control" id="electricity_allowance" placeholder="{{ __('Enter electricity allowance..') }}">
                                                                    @if ($errors->has('electricity_allowance'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('electricity_allowance') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6" style="padding-right: unset;">
                                                                <div class="form-group{{ $errors->has('security_allowance') ? ' has-error' : '' }}">
                                                                    <label for="security_allowance">{{ __('Security Allowance') }}</label>
                                                                    <input type="number" name="security_allowance" value="{{ $payroll->security_allowance }}" class="form-control" id="security_allowance" placeholder="{{ __('Enter security allowance..') }}">
                                                                    @if ($errors->has('security_allowance'))
                                                                    <span class="help-block">
                                                                    <strong>{{ $errors->first('security_allowance') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="col-sm-12" style="padding-left: unset;">
                                                    <div class="form-group{{ $errors->has('provident_fund_contribution') ? ' has-error' : '' }}">
                                                        <label for="provident_fund_contribution">{{ __('Superannuation Fund Contribution') }}</label>
                                                        <input type="number" name="provident_fund_contribution" value="{{ $payroll->provident_fund_contribution }}" class="form-control" id="provident_fund_contribution" placeholder="{{ __('Enter superannuation fund contribution..') }}">
                                                        @if ($errors->has('provident_fund_contribution'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('provident_fund_contribution') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
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
                                                <div class="col-sm-12" style="padding-left: unset;">
                                                    <div class="form-group{{ $errors->has('tax_deduction_a') ? ' has-error' : '' }}">
                                                    <label for="tax_deduction_a">{{ __('Tax Deduction (A)') }}</label>
                                                    <input type="number" name="tax_deduction_a" value="{{ $payroll->tax_deduction_a }}" class="form-control" id="tax_deduction_a" placeholder="{{ __('Enter tax deduction..') }}" readonly>
                                                    @if ($errors->has('tax_deduction_a'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('tax_deduction_a') }}</strong>
                                                    </span>
                                                    @endif
                                                    </div>
                                                </div>
                                                <!-- <div class="col-sm-8" style="padding-left: unset;">
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
                                                </div> -->
                                                <div class="form-group{{ $errors->has('provident_fund_deduction') ? ' has-error' : '' }}">
                                                    <label for="provident_fund_deduction">{{ __('Superannuation Fund Deduction') }}</label>
                                                    <input type="number" name="provident_fund_deduction" value="{{ $payroll->provident_fund_deduction }}" class="form-control" id="provident_fund_deduction" placeholder="{{ __('Enter superannuation fund deduction..') }}">
                                                    @if ($errors->has('provident_fund_deduction'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('provident_fund_deduction') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                    <!-- <div class="form-group{{ $errors->has('other_deduction') ? ' has-error' : '' }}">
                                                        <label for="other_deduction">{{ __('Other Deduction') }}</label>
                                                        <input type="number" name="other_deduction" value="{{ old('other_deduction') }}" class="form-control" id="other_deduction" placeholder="{{ __('Enter other deduction..') }}">
                                                        @if ($errors->has('other_deduction'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('other_deduction') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div> -->
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
                                                    <input type="number" disabled class="form-control" id="gross_salary" value="{{ isset($payroll->gross_salary) && !empty($payroll->gross_salary) ? $payroll->gross_salary : '' }}">
                                                </div>
                                                <div class="form-group{{ $errors->has('total_deduction') ? ' has-error' : '' }}">
                                                    <label for="total_deduction">{{ __('Total Deduction') }}</label>
                                                    <input type="number" disabled class="form-control" id="total_deduction" value="{{ isset($payroll->total_deduction) && !empty($payroll->total_deduction) ? $payroll->total_deduction : '' }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="net_salary">{{ __('Net Salary') }}</label>
                                                    <input type="number" disabled class="form-control" id="net_salary" value="{{ isset($payroll->net_salary) && !empty($payroll->net_salary) ? $payroll->net_salary : '' }}">
                                                </div>
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                        </div>
                                        <!-- /.end.col -->
                                    </div> 
                                    <!-- /.row -->
                                </div>
                                <div class="box-footer">
                                <button type="submit" class="btn btn-primary btn-flat pull-right"> {{ __('Update Details') }}</button>
                                </div>
                            </form>
                        @endif

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
                        @if (isset($employee_id) && $employee_id!=0)
                            <?php 
                                //Get Employees
                                //$employee = \App\User::where('id', $employee_id)->first();
                                $emp_id = $employee_id;
                            ?>
                            <div class="col-12">
                                <!-- Default box -->
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">{{ __('Employee Details') }}</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="employee_id">{{ __('ID') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <span>{{ __('EMPID') }}{{ $employee->id }}</span>
                                                </div>
                                                <div class="col-md-3">
                                                <label for="user_id">{{ __('Employee Name') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="hidden" name="user_id" class="form-control" id="user_id" value="{{ $employee->id }}">
                                                    <span>{{ $employee->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <!-- /. end col -->
                            </div>
                                <!-- /.box-body -->
                            <div class="box-footer clearfix"></div>
                                <!-- /.box-footer -->
                                <!-- /.box -->
                            <!-- /.end.col -->
                        @else
                            <?php $emp_id = 0; ?>
                        @endif

                        <!-- Contact Form Condition in case of employee id exist -->
                        <?php 
                            //Get Employees
                            if (isset($employee_id)){
                                $employee_contact = \App\Models\EmployeeContact::where('employee_id', $employee_id)->first();
                                if(isset($employee_contact) && !empty($employee_contact)){
                            ?>
                                    <form action="{{ url('/employee_contacts/update/'. $employee_contact->id) }}" method="post" name="employee_update_contact_form">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="user_id" class="form-control" id="user_id" value="{{ $emp_id }}">
                                        <input type="hidden" name="employee_id" class="form-control" id="employee_id" value="{{ $emp_id }}">
                                        <div class="box-body">
                                                <div class="row">
                                                    <!-- Add your form fields here -->
                                                    <div class="col-12">
                                                        <label for="employee_contact_name">{{ __('Contact Name') }} <span class="text-danger">*</span></label>
                                                        <div class="form-group{{ $errors->has('employee_contact_name') ? ' has-error' : '' }} has-feedback">
                                                            <input type="text" name="employee_contact_name" id="employee_contact_name" class="form-control" value="{{ $employee_contact->employee_contact_name }}" placeholder="{{ __('Enter name..') }}">
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
                                                            <input type="text" name="employee_contact_address" id="employee_contact_address" class="form-control" value="{{ $employee_contact->employee_contact_address }}" placeholder="{{ __('Enter contact address..') }}">
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
                                                            <input type="text" name="employee_contact_phone" id="employee_contact_phone" class="form-control" value="{{ $employee_contact->employee_contact_phone }}" placeholder="{{ __('Enter phone no..') }}">
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
                                                            <input type="text" name="employee_contact_mobile" id="employee_contact_mobile" class="form-control" value="{{ $employee_contact->employee_contact_mobile }}" placeholder="{{ __('Enter mobile no..') }}">
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
                                                            <input type="email" name="employee_contact_email" id="employee_contact_email" class="form-control" value="{{ $employee_contact->employee_contact_email }}" placeholder="{{ __('Enter employee_contact_email address..') }}">
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
                                                            <input type="text" name="employee_contact_relationship" id="employee_contact_relationship" class="form-control" value="{{ $employee_contact->employee_contact_relationship }}" placeholder="{{ __('Enter relation..') }}">
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
                                <?php } else { ?>
                                        <form action="{{ url('employee_contacts/store') }}" method="post" name="employee_add_contact_form">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="user_id" class="form-control" id="user_id" value="{{ $emp_id }}">
                                            <input type="hidden" name="employee_id" class="form-control" id="employee_id" value="{{ $emp_id }}">
                                            <div class="box-body">
                                                    <!-- Add your form fields here -->
                                                        <div class="col-12">
                                                            <label for="employee_contact_name">{{ __('Contact Name') }} <span class="text-danger">*</span></label>
                                                            <div class="form-group{{ $errors->has('employee_contact_name') ? ' has-error' : '' }} has-feedback">
                                                                <input type="text" name="employee_contact_name" id="employee_contact_name" class="form-control" value="{{ old('employee_contact_name') }}" placeholder="{{ __('Enter name..') }}">
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
                                                                <input type="text" name="employee_contact_address" id="employee_contact_address" class="form-control" value="{{ old('employee_contact_address') }}" placeholder="{{ __('Enter contact address..') }}">
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
                                                                <input type="text" name="employee_contact_phone" id="employee_contact_phone" class="form-control" value="{{ old('employee_contact_phone') }}" placeholder="{{ __('Enter phone no..') }}">
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
                                                                <input type="text" name="employee_contact_mobile" id="employee_contact_mobile" class="form-control" value="{{ old('employee_contact_mobile') }}" placeholder="{{ __('Enter mobile no..') }}">
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
                                                                <input type="email" name="employee_contact_email" id="employee_contact_email" class="form-control" value="{{ old('employee_contact_email') }}" placeholder="{{ __('Enter employee_contact_email address..') }}">
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
                                                                <input type="text" name="employee_contact_relationship" id="employee_contact_relationship" class="form-control" value="{{ old('employee_contact_relationship') }}" placeholder="{{ __('Enter relation..') }}">
                                                                @if ($errors->has('employee_contact_relationship'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('contact_no_') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                            <!-- /.form-group -->                        </div>
                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-plus"></i> {{ __('Save Contact') }}</button>
                                            </div>
                                        </form>
                                <?php } ?>
                            <?php } else { ?>
                                <!-- Insert Employee Contact Form -->
                                <form action="{{ url('employee_contacts/store') }}" method="post" name="employee_add_contact_form">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="user_id" class="form-control" id="user_id" value="{{ $emp_id }}">
                                    <input type="hidden" name="employee_id" class="form-control" id="employee_id" value="{{ $emp_id }}">
                                    <div class="box-body">
                                            <!-- Add your form fields here -->
                                                <div class="col-12">
                                                    <label for="employee_contact_name">{{ __('Contact Name') }} <span class="text-danger">*</span></label>
                                                    <div class="form-group{{ $errors->has('employee_contact_name') ? ' has-error' : '' }} has-feedback">
                                                        <input type="text" name="employee_contact_name" id="employee_contact_name" class="form-control" value="{{ old('employee_contact_name') }}" placeholder="{{ __('Enter name..') }}">
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
                                                        <input type="text" name="employee_contact_address" id="employee_contact_address" class="form-control" value="{{ old('employee_contact_address') }}" placeholder="{{ __('Enter contact address..') }}">
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
                                                        <input type="text" name="employee_contact_phone" id="employee_contact_phone" class="form-control" value="{{ old('employee_contact_phone') }}" placeholder="{{ __('Enter phone no..') }}">
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
                                                        <input type="text" name="employee_contact_mobile" id="employee_contact_mobile" class="form-control" value="{{ old('employee_contact_mobile') }}" placeholder="{{ __('Enter mobile no..') }}">
                                                        @if ($errors->has('employee_contact_mobile'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('employee_contact_mobile') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                    <!-- /.form-group -->
        
                                                
                                                <div class="col-6">
                                                    <label for="employee_contact_email">{{ __('employee_contact_email') }} <span class="text-danger">*</span></label>
                                                    <div class="form-group{{ $errors->has('employee_contact_email') ? ' has-error' : '' }} has-feedback">
                                                        <input type="email" name="employee_contact_email" id="employee_contact_email" class="form-control" value="{{ old('employee_contact_email') }}" placeholder="{{ __('Enter employee_contact_email address..') }}">
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
                                                        <input type="text" name="employee_contact_relationship" id="employee_contact_relationship" class="form-control" value="{{ old('employee_contact_relationship') }}" placeholder="{{ __('Enter relation..') }}">
                                                        @if ($errors->has('employee_contact_relationship'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('contact_no_') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                    <!-- /.form-group -->                        </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-plus"></i> {{ __('Save Contact') }}</button>
                                    </div>
                                </form>
                           <?php }
                        ?>
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
                        @if (isset($employee_id))
                            <?php 
                                //Get Employees
                                $employee = \App\Models\User::where('id', $employee_id)->first();
                            ?>
                            <div class="col-md-12">
                                <!-- Default box -->
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">{{ __('Employee Details') }}</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="employee_id">{{ __('ID') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <span>{{ __('EMPID') }}{{ $employee->id }}</span>
                                                </div>
                                                <div class="col-md-3">
                                                <label for="user_id">{{ __('Employee Name') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="hidden" name="user_id" class="form-control" id="user_id" value="{{ $employee->id }}">
                                                    <span>{{ $employee->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <!-- /. end col -->
                            </div>
                                <!-- /.box-body -->
                            <div class="box-footer clearfix"></div>
                                <!-- /.box-footer -->
                                <!-- /.box -->
                            <!-- /.end.col -->
                        @endif
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
                                <div class="row">
                                    @foreach ($leaveCategories as $leave)
                                        <div class="col-md-3">
                                            <h4>{{ $leave->leave_category }}</h4>
                                            <input type="hidden" name="leave_category_id[]" value="{{ $leave->id }}" />
                                            <div class="form-group">
                                                <label for="leave_balance_{{ $leave->id }}">{{ __('Leave Count') }}</label>
                                                <input type="number" id="leave_balance_{{ $leave->id }}" class="form-control" value="{{ $leave->qty }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="leave_type_{{ $leave->id }}">{{ __('Leave Type') }}</label>
                                                <input type="text" id="leave_type_{{ $leave->id }}" class="form-control" value="{{ $leave->type_of_leave }}" readonly>
                                            </div>
                                        </div>
                                    @endforeach
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
                        @if (isset($employee_id))
                            <?php 
                                //Get Employees
                                $employee = \App\Models\User::where('id', $employee_id)->first();
                                $superannuationRel = \App\Models\EmplSuperannuationRel::where('employee_id', $employee_id)->first();

                            ?>
                              <div class="col-md-12">
                                <!-- Default box -->
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">{{ __('Employee Details') }}</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="employee_id">{{ __('ID') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <span>{{ __('EMPID') }}{{ $employee->id }}</span>
                                                </div>
                                                <div class="col-md-3">
                                                <label for="user_id">{{ __('Employee Name') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="hidden" name="user_id" class="form-control" id="user_id" value="{{ $employee->id }}">
                                                    <span>{{ $employee->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <!-- /. end col -->
                            </div>
                                <!-- /.box-body -->
                            <div class="box-footer clearfix"></div>

                            <div class="col-md-12">
                                @if($superannuationRel)
                                <!-- Check SuperAnnuation Relation data exist then update -->
                                    <!-- Default box -->
                                        <form action="{{ url('people/employees/superannuation_update/'. $superannuationRel->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            <?php 
                                                $users = \App\Models\User::orderBy('id', 'desc')->first();
                                                $sl=$users->id;
                                            ?>
                                    
                                                    <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                                            <div class="mb-3">
                                                <label for="superannuation_id" class="form-label">Superannuation</label>
                                                <select class="form-control" id="empl_superannuation_id" name="superannuation_id" class="form-select" required>
                                                    <option value="">Select Superannuation</option>
                                                    @foreach($superannuations as $superannuation)
                                                        <option value="{{ $superannuation->id }}" data-superannuation="{{ json_encode($superannuation) }}" {{ $superannuationRel->superannuation_id==$superannuation->id ? 'selected' : '' }}>
                                                            {{ $superannuation->name }} ({{ $superannuation->code }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="employer_contribution_percentage" class="form-label">Employer Contribution (%)</label>
                                                <input type="text" id="employer_contribution_percentage" name="employer_contribution_percentage" value="{{ $superannuationRel->employer_contribution_percentage }}" class="form-control" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="employer_contribution_fixed_amount" class="form-label">Employer Fixed Contribution</label>
                                                <input type="text" id="employer_contribution_fixed_amount" name="employer_contribution_fixed_amount" class="form-control" value="{{ $superannuationRel->employer_contribution_percentage }}" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="bank_name" class="form-label">Bank Name</label>
                                                <input type="text" id="bank_name" name="bank_name" class="form-control" value="{{ $superannuationRel->bank_name }}" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="bank_address" class="form-label">Bank Address</label>
                                                <input type="text" id="bank_address" name="bank_address" class="form-control" value="{{ $superannuationRel->bank_address }}" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="bank_account_number" class="form-label">Bank Account Number</label>
                                                <input type="text" id="bank_account_number" name="bank_account_number" class="form-control" value="{{ $superannuationRel->bank_account_number }}" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="employer_superannuation_no" class="form-label">Employer Superannuation No</label>
                                                    <select id="employer_superannuation_no" name="employer_superannuation_no" value="{{ $superannuationRel->employer_superannuation_no }}" class="form-control">
                                                        @if($companies)
                                                            @foreach($companies as $company)
                                                                <option value="{{ $company->superannuation_number}}" {{ $superannuationRel->employer_superannuation_no==$company->superannuation_number ? 'selected' : '' }}>{{ $company->superannuation_number}} - {{ $company->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Update Superannuation</button>
                                        </form>
                                    <!-- /. end col -->
                                <!-- End Supuerannuation Relation data-->
                                @else
                                <!-- Check Superannuation relation data not exixt -->
                                    <!-- Default box -->
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
                                    <!-- /. end col -->
                                <!-- END -->
                                @endif
                            </div>
                                <!-- /.box-body -->
                            <div class="box-footer clearfix"></div>
                                <!-- /.box-footer -->
                                <!-- /.box -->
                            <!-- /.end.col -->
                             <!-- Default box -->
                        @else
                        <div class="col-md-12">
                                <!-- Default box -->
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
                                    <!-- /. end col -->
                            </div>
                                <!-- /.box-body -->
                            <div class="box-footer clearfix"></div>
                                <!-- /.box-footer -->
                                <!-- /.box -->
                            <!-- /.end.col -->
                        @endif
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
                        @if (isset($employee_id))
                            <?php 
                                //Get Employees
                                $employee = \App\Models\User::where('id', $employee_id)->first();
                                $emplBankRel = \App\Models\EmployeeBankRel::where('emp_id', $employee_id)->first();
                            ?>
                            <div class="col-md-12">
                                <!-- Default box -->
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">{{ __('Employee Details') }}</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="employee_id">{{ __('ID') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <span>{{ __('EMPID') }}{{ $employee->id }}</span>
                                                </div>
                                                <div class="col-md-3">
                                                <label for="user_id">{{ __('Employee Name') }}</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="hidden" name="user_id" class="form-control" id="user_id" value="{{ $employee->id }}">
                                                    <span>{{ $employee->name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <!-- /. end col -->
                            </div>
                                <!-- /.box-body -->
                            <div class="box-footer clearfix"></div>
                                <!-- /.box-footer -->
                                <!-- /.box -->
                            <!-- /.end.col -->
                            @if($emplBankRel)
                                <form action="{{ url('people/employees/bank_update/'. $emplBankRel->id) }}" method="post" name="employee_add_form">
                                    {{ csrf_field() }}
                                    <?php 
                                        $users = \App\Models\User::orderBy('id', 'desc')->first();
                                        $sl=$users->id;
                                        $user_id = Route::current()->parameter('id') ? Route::current()->parameter('id') : '';
                                    ?>
                                    <input type="hidden" name="employee_bk_id" value="{{$employee_id}}">
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
                                                                    <option value="{{ $bankList->id }}_{{ $bankList->bank_code }}" {{ $emplBankRel->bank_id==$bankList->id ? 'selected' : '' }}>{{ $bankList->bank_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <input type="text" class="form-control" name="acct_no"  id="acct_no" value="{{ $emplBankRel->account_no }}" placeholder="Account No">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <input type="text" class="form-control" name="swift_code" id="swift_code" value="{{ $emplBankRel->swift_code }}"  placeholder="Swift Code">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <input type="text" class="form-control" name="acct_name"  id="acct_name" value="{{ $emplBankRel->account_holder_name }}" placeholder="Account Name">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <input type="text" class="form-control" name="acct_add" id="acct_add" value="{{ $emplBankRel->address }}" placeholder="Address">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <input type="text" class="form-control" name="acct_city"  id="acct_city" value="{{  $emplBankRel->city }}" placeholder="City">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <input type="email" class="form-control" name="acct_email" id="acct_email" value="{{ $emplBankRel->email_address }}" placeholder="Email Address">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <input type="text" class="form-control" maxlength="3" name="acct_ccode"  id="acct_ccode" value="{{ $emplBankRel->country_code }}" placeholder="Country Code">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary btn-flat">
                                            {{ __('Update') }}
                                        </button>
                                    </div>
                                </form>
                            @else
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
                            @endif
                        @else
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
                        @endif
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
            } else if (submittedForm === 'add_payroll_form') {
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
