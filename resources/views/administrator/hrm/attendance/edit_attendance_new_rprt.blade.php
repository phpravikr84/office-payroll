@extends('administrator.master')
@section('title', __('Edit Attendance'))

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           {{ __('Edit Attendance') }} 
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }} </a></li>
            <li><a href="{{ url('/hrm/attendance') }}">{{ __('Attendance') }}</a></li>
            <li class="active">{{ __('Edit Attendance') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Attendance Record</h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <!-- Notification Box -->
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @elseif(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- Edit Attendance Form -->
                <form action="{{ url('/hrm/attendance/updated/' . $attendance->id) }}" method="POST">
                {{ csrf_field() }}
   

                    <div class="form-group">
                        <label for="employee_id">{{ __('Employee ID') }}</label>
                        <input type="text" class="form-control" id="employee_id" name="employee_id" value="{{ $attendance->employee_id }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="employee_name">{{ __('Employee Name') }}</label>
                        <input type="text" class="form-control" id="employee_name" name="employee_name" value="{{ $attendance->employee_name }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="date">{{ __('Date') }}</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ $attendance->attendance_date }}" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="in_time">{{ __('In Time') }}</label>
                        <input type="time" class="form-control" id="in_time" name="in_time" value="{{ $attendance->in_time }}" required>
                    </div>

                    <div class="form-group">
                        <label for="out_time">{{ __('Out Time') }}</label>
                        <input type="time" class="form-control" id="out_time" name="out_time" value="{{ $attendance->out_time }}" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">{{ __('Update Attendance') }}</button>
                        <a href="{{ url('/hrm/attendance') }}" class="btn btn-default">{{ __('Cancel') }}</a>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
@endsection
