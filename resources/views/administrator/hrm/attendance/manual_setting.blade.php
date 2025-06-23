@extends('administrator.master')
@section('title', __('Manage Attendance'))

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           {{ __('ATTENDANCE') }} 
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }} </a></li>
            <li><a>{{ __('Attendance') }} </a></li>
            <li class="active">{{ __(' Add Attendance') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Manage the Software of Attendance Machine [Biometrics]</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-bs-toggle="collapse" data-bs-target="#collapseContent">
                <i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool">
                <i class="fa fa-remove"></i>
            </button>
        </div>
    </div>

    <div class="collapse show" id="collapseContent">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Step 01: Open and start the Attendance Machine Software</label>
                    <img src="{{  asset('backend/images/demo/1.jpg') }}" class="img-fluid">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Step 02: Click the OK Button</label>
                    <img src="{{  asset('backend/images/demo/2.jpg') }}" class="img-fluid">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Step 03: Select the Device and Click the Connect in the software</label>
                    <img src="{{  asset('backend/images/demo/3.jpg') }}" class="img-fluid">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Step 04: Create All Employee Records like Enrollment or Registration</label>
                    <img src="{{  asset('backend/images/demo/4.jpg') }}" class="img-fluid">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Step 05: After recorded, must be Upload and Download from left Button</label>
                    <img src="{{  asset('backend/images/demo/5.jpg') }}" class="img-fluid">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Step 06: Select the report for calculation by date wise</label>
                    <img src="{{  asset('backend/images/demo/6.jpg') }}" class="img-fluid">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Step 07: View the attendance reports by the dates</label>
                    <img src="{{  asset('backend/images/demo/7.jpg') }}" class="img-fluid">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Step 08: Export the Attendance Report</label>
                    <img src="{{  asset('backend/images/demo/8.jpg') }}" class="img-fluid">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Step 09: Save the Attendance Report in your PC</label>
                    <img src="{{  asset('backend/images/demo/9.jpg') }}" class="img-fluid">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Step 10: Export the Attendance Report in your HRM Software</label>
                    <img src="{{  asset('backend/images/demo/10.jpg') }}" class="img-fluid">
                </div>
            </div>

            <hr>

            <h3 class="box-title">Manage the Device of Attendance Machine</h3>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label>Step 01: Setup the Attendance Machine by IP</label>
                        <img src="{{  asset('backend/images/demo/h1.jpg') }}" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label>Step 02: Select the User Management in the Machine</label>
                        <img src="{{  asset('backend/images/demo/h2.jpg') }}" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label>Step 03: Go to the All User Management</label>
                        <img src="{{  asset('backend/images/demo/h3.jpg') }}" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label>Step 04: Select One User and go</label>
                        <img src="{{  asset('backend/images/demo/h4.jpg') }}" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label>Step 05: Select the finger for print by the user</label>
                        <img src="{{  asset('backend/images/demo/h5.jpg') }}" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

      <!-- /.box -->
  </section>
  <!-- /.content -->
</div>
@endsection