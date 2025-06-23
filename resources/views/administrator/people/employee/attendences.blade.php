@extends('administrator.master')
@section('title', __('Upload Attendance Sheet'))

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ __('Upload Employee Attendance Sheet') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i>{{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Attendance') }}</a></li>
            <li><a href="{{ url('/attendance') }}">{{ __('Upload') }}</a></li>
            <li class="active">{{ __('Upload Sheet') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Upload Excel Sheet') }}</h3>
            </div>
            
            <div class="box-body">
                <!-- Form to Upload Excel File -->
                <form action="{{ url('/attendance/upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="attendance_file">{{ __('Choose Excel File') }}</label>
                        <input type="file" name="attendance_file" id="attendance_file" class="form-control" required>
                    </div>

                    <div class="btn-group btn-group-justified">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary btn-flat">
                                <i class="fa fa-upload"></i> {{ __('Upload') }}
                            </button>
                        </div>
                        <div class="btn-group">
                            <a href="{{ url('/attendance') }}" class="btn btn-default btn-flat">
                                <i class="fa fa-arrow-left"></i> {{ __('Back') }}
                            </a>
                        </div>
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
