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
            <li class="active">{{ __(' Manage Attendance') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Attendance Manage</h3>
    </div>
    <!-- /.box-header -->

    <div class="box-body">
        <!-- Notification Box -->
        <div class="row">
            <div class="col-md-12">
                <!-- Add notification content here if needed -->
            </div>
        </div>
        <!-- /.Notification Box -->

        <div class="box box-primary">
            <!-- Table to display attendance data -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-info">
                        <tr>
                            <th>sl#</th>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Date</th>
                            <th>In Time</th>
                            <th>Out Time</th>
                            <th>Work Time</th>
                            <th>Late</th>
                            <th>Early</th>
                            <th>Absence</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($attendenceRecords->count() > 0)
                            @php $i = 1; @endphp
                            @foreach($attendenceRecords as $attendance)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $attendance->employee_id }}</td>
                                    <td>{{ $attendance->employee_name }}</td>
                                    <td>{{ $attendance->date }}</td> <!-- Assuming date is a Carbon instance -->
                                    <td>{{ $attendance->in_time }}</td>
                                    <td>{{ $attendance->out_time }}</td>
                                    <td>{{ $attendance->work_time }}</td>
                                    <td>{{ $attendance->late }}</td>
                                    <td>{{ $attendance->early }}</td>
                                    <td>{{ $attendance->absence }}</td>
                                    <td><a href="{{ url('/hrm/attendance/edit/' . $attendance->id) }}" class="btn btn-success btn-sm">Edit</a></td>
                                </tr>
                                @php $i++ @endphp
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10" class="text-center">No Attendance Records Available!</td>
                            </tr>
                        @endif
                        
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.box-body -->
</div>

    </section>
  <!-- /.content -->
</div>
@endsection