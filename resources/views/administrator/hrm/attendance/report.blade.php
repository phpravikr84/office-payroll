@extends('administrator.master')
@section('title', __('Manage Attendance'))

@section('main_content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     {{ __(' ATTENDANCE REPORT') }} 
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }} </a></li>
      <li><a>{{ __('Attendance') }} </a></li>
      <li class="active">{{ __(' Attendance Report') }}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">{{ __('Attendance Report') }} </h3>
      </div>
      <div class="box-body">
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
        <!-- /.Notification Box -->
        <div class="col-md-12">
          <form id="employee_attendance" action="{{ url('/hrm/attendance/search') }}" method="GET">
          {{ csrf_field() }}
              <div class="row">
                  <div class="col-lg-4 col-md-6 col-sm-12 form-group{{ $errors->has('emp_id') ? ' has-error' : '' }}">
                      <div class="col-sm-12">
                        @php
                            if(is_array($employees)){
                        @endphp
                        <select name="emp_id" id="user_id" class="form-control">
                              <option value="0">{{ __('Select Employee Name') }}</option>
                              @foreach($employees as $employee)
                                  <option value="{{ $employee['id'] }}" {{ request('emp_id') == $employee['id'] ? 'selected' : '' }}>
                                      {{ $employee['name'] }}
                                  </option>
                              @endforeach
                          </select>
                        @php } else { @endphp
                            <select name="emp_id" id="user_id" class="form-control">
                              <option value="0">{{ __('Select Employee Name') }}</option>
                              @foreach($employees as $employee)
                                  <option value="{{ $employee->id }}" {{ request('emp_id') == $employee->id ? 'selected' : '' }}>
                                      {{ $employee->name }}
                                  </option>
                              @endforeach
                          </select>
                        @php    } @endphp
                          

                      </div>
                  </div>
                  <div class="col-lg-2 col-md-6 col-sm-12">
                      <input type="date" name="start" class="form-control form-control-sm rounded-0" value="{{ request('start') }}">
                  </div>
                  <div class="col-lg-2 col-md-6 col-sm-12">
                      <input type="date" name="end" class="form-control form-control-sm rounded-0" value="{{ request('end') }}">
                  </div>
                  <div class="col-2">
                      <button type="submit" class="btn btn-primary btn-sm rounded-0 bg-gradient-primary">
                          <i class="fa fa-file"></i> View Attendance Statement
                      </button>
                  </div>
                  <div class="col-2">
                      <button type="button" class="btn btn-secondary btn-sm rounded-0" onclick="resetForm()">
                          <i class="fa fa-refresh"></i> Reset
                      </button>
                  </div>
              </div>
          </form>

        <div class="box box-primary border-top">
            <!-- Table to display attendance data -->
            <div class="table-responsive">
                <table id="example1" id="example1" class="table table-bordered table-striped" id="attendanceTable">
                    <thead class="bg-info">
                        <tr>
                            <th>sl#</th>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Attendance Date</th>
                            <th>In Time</th>
                            <th>Out Time</th>
                            <th>Work Time</th>
                            <th>Late</th>
                            <th>Early</th>
                            <th>Absence</th>
                            <th>Absence Type</th>
                            <th>Leave ID</th>
                            <th>Leave Category ID</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Leave Status</th>
                            <th>Leave Reason</th>
                            <th>Late Count Flag</th>
                            <th>Holiday ID</th>
                            <th>Is Holiday</th>
                            <th>Working Days ID</th>
                            <th>Working Hours</th>
                            <th>Working Day Name</th>
                            <th>Paid Hours</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($attendanceRecords->count() > 0)
                            @php $i = 1; @endphp
                            @foreach($attendanceRecords as $attendance)
                                @php
                                    // Row conditions
                                    $rowClass = '';
                                    $statusBadge = '';

                                    if ($attendance->absence == 1 && $attendance->absence_type == null) {
                                        $rowClass = 'table-danger';
                                        $statusBadge = '<span class="badge bg-danger">Leave Without Pay</span>';
                                    } elseif ($attendance->absence == 1 && $attendance->absence_type == 'leave_applied') {
                                        $rowClass = 'table-success';
                                        $statusBadge = '<span class="badge bg-success">Leave Approved</span>';
                                    } elseif (in_array($attendance->working_day_name, ['Sat', 'Sun'])) {
                                        $rowClass = 'table-warning';
                                        $statusBadge = '<span class="badge bg-warning">Weekend Holiday</span>';
                                    }
                                @endphp
                                <tr class="{{ $rowClass }}">
                                    <td>{{ $i }}</td>
                                    <td>{{ $attendance->employee_id }}</td>
                                    <td>{{ $attendance->employee_name }}</td>
                                    <td>{{ $attendance->attendance_date }}</td>
                                    <td>{{ $attendance->in_time ? $attendance->in_time : '-'}}</td>
                                    <td>{{ $attendance->out_time ? $attendance->out_time : '-' }}</td>
                                    <td>{{ $attendance->work_time ? $attendance->work_time : '-' }}</td>
                                    <td>{{ $attendance->late ? $attendance->late : '-' }}</td>
                                    <td>{{ $attendance->early ? $attendance->early : '-'}}</td>
                                    <td>{{ $attendance->absence == 1 ? 'Yes' : 'No' }}</td>
                                    <td>{{ $attendance->absence_type }}</td>
                                    <td>{{ $attendance->leave_type ?? '-' }}</td>
                                    <td>{{ $attendance->leave_category ?? '-' }}</td>
                                    <td>{{ $attendance->start_date }}</td>
                                    <td>{{ $attendance->end_date }}</td>
                                    <td>
                                        @if($attendance->leave_status === 0)
                                            Pending
                                        @elseif($attendance->leave_status === 1)
                                            Approved
                                        @elseif($attendance->leave_status === 2)
                                            Disapproved
                                        @elseif($attendance->leave_status === 3)
                                            Canceled
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $attendance->leave_reason }}</td>
                                    <td>{{ $attendance->late_count_flag }}</td>
                                    <td>{{ $attendance->holiday_id }}</td>
                                    <td>{{ $attendance->is_holiday == 1 ? 'Yes' : 'No' }}</td>
                                    <td>{{ $attendance->working_days_id }}</td>
                                    <td>{{ $attendance->working_hours }}</td>
                                    <td>{{ $attendance->working_day_name }}</td>
                                    <td>{{ $attendance->paid_hours }}</td>
                                    <td>{{ $attendance->created_at }}</td>
                                    <td>{{ $attendance->updated_at }}</td>
                                    <td>{!! $statusBadge !!}
                                        <!-- @if(Auth::user()->user_type == 1)
                                            <a href="{{ url('/hrm/attendance/edit_attendance/'.$attendance->attendance_id) }}" class="btn btn-xs btn-primary">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        @endif -->
                                    </td>
                                </tr>
                                @php $i++ @endphp
                            @endforeach
                        @else
                            <tr>
                                <td colspan="28" class="text-center">No Attendance Records Available!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        <!-- /. end col -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer clearfix">
        
      </div>
      <!-- /.box-footer -->
    </div>
    <!-- /.box -->
  </section>
  <!-- /.content -->
</div>
<script>
    
    function resetForm() {
        document.getElementById('employee_attendance').reset(); // Reset the entire form
        
        // Additionally reset the dropdown to the default option if needed
        document.getElementById('user_id').selectedIndex = 0; // Reset to "Select Employee Name"

        window.location.href = window.Laravel.routes.AttendanceSearch;
    }

</script>
<!-- Include DataTables CSS -->
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">

<!-- Include DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- Initialize DataTables -->
<script>
    $(document).ready(function() {
        $('#attendanceTable').DataTable({
            responsive: true,
            paging: true,
            pageLength: 10
        });
    });
</script>

@endsection