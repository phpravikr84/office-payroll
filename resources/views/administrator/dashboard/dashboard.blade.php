@extends('administrator.master')
@section('title', __('Dashboard'))

@section('main_content')
<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row bg-title">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ol class="breadcrumb">
                    <li class="active breadcrumbColor"><a href="#"><i class="fa fa-home"></i> {{ __('Dashboard') }}</a></li>
                </ol>
            </div>
        </div>

        <!-- Analytics Boxes -->
        <div class="row">
            <!-- Total Employees -->
            <div class="col-lg-3 col-sm-6 col-xs-12">
                <div class="white-box analytics-info">
                    <h3 class="box-title">{{ __('Total Employee') }}</h3>
                    <ul class="list-inline two-part">
                        <li>
                            <img class="dash_image" src="{{ asset('icons//employee.png') }}" alt="employee">
                        </li>
                        <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success">{{ count($employees) }}</span></li>
                    </ul>
                </div>
            </div>

            <!-- Total Departments -->
            <div class="col-lg-3 col-sm-6 col-xs-12">
                <div class="white-box analytics-info">
                    <h3 class="box-title">{{ __('Department') }}</h3>
                    <ul class="list-inline two-part">
                        <li>
                            <img class="dash_image" src="{{ asset('icons//department.png') }}" alt="department">
                        </li>
                        <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple">{{ count($departments) }}</span></li>
                    </ul>
                </div>
            </div>

            <!-- Present Today -->
            <div class="col-lg-3 col-sm-6 col-xs-12">
                <div class="white-box analytics-info">
                    <h3 class="box-title">{{ __('Present') }}</h3>
                    <ul class="list-inline two-part">
                        <li>
                            <img class="dash_image" src="{{ asset('icons//present.png') }}" alt="present">
                        </li>
                        <li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="counter text-info">{{ $present_count }}</span></li>
                    </ul>
                </div>
            </div>

            <!-- Absent Today -->
            <div class="col-lg-3 col-sm-6 col-xs-12">
                <div class="white-box analytics-info">
                    <h3 class="box-title">{{ __('Absent') }}</h3>
                    <ul class="list-inline two-part">
                        <li>
                            <img class="dash_image" src="{{ asset('icons//absent.png') }}" alt="absent">
                        </li>
                        <li class="text-right"><i class="ti-arrow-down text-danger"></i> <span class="counter text-danger">{{ $absent_count }}</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Today's Attendance -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="panel">
                    <div class="panel-heading">{{ __('Today Attendance') }}</div>
                    <div class="table-responsive">
                        <table class="table table-hover manage-u-table">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('#') }}</th>
                                    <th>{{ __('Photo') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('In Time') }}</th>
                                    <th>{{ __('Out Time') }}</th>
                                    <th>{{ __('Late') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($today_attendance as $index => $attendance)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                           <img src="{{ $attendance->avatar ? asset('uploads/employeePhoto/' . $attendance->avatar) : asset('icons/default.png') }}" alt="user" class="img-circle" width="40">
                                        </td>
                                        <td>{{ $attendance->name }}</td>
                                        <td>{{ $attendance->in_time ? date('h:i A', strtotime($attendance->in_time)) : '-' }}</td>
                                        <td>{{ $attendance->out_time ? date('h:i A', strtotime($attendance->out_time)) : '-' }}</td>
                                        <td>{{ $attendance->late ? 'Yes' : 'No' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">{{ __('No data available') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Attendance Check-In/Out and Notice Board -->
        <div class="row">
            <!-- Attendance Check-In/Out -->
            <div class="col-md-6">
                <div class="white-box">
                    <h3 class="box-title">{{ __('Hey admin please Check in/out your attendance') }}</h3>
                    <hr>
                    <div class="noticeBord">
                        <form action="{{ url('/ip-attendance') }}" method="POST">
                            @csrf
                            <p>Your IP is {{ request()->ip() }}</p>
                            <input type="hidden" name="employee_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="ip_check_status" value="1">
                            <input type="hidden" name="finger_id" value="{{ Auth::user()->id }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-clock-o"></i> {{ __('Check In') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Notice Board -->
            <div class="col-md-6">
                <div class="white-box">
                    <h3 class="box-title">{{ __('Notice Board') }}</h3>
                    <hr>
                    <div class="noticeBord">
                        @forelse($notices as $notice)
                            <div class="comment-center p-t-10">
                                <div class="comment-body">
                                    <div class="user-img"><i style="font-size: 31px" class="fa fa-flag-checkered text-info"></i></div>
                                    <div class="mail-contnet">
                                        <h5 class="text-danger">{{ $notice->notice_title }}</h5>
                                        <span class="time">{{ __('Published Date') }}: {{ date('d M Y', strtotime($notice->publication_date)) }}</span>
                                        <br>
                                        <span class="mail-desc">
                                            {{ __('Publish By') }}: {{ $notice->created_by ? App\Models\User::find($notice->created_by)->name : 'Admin' }}
                                            <br>
                                            {{ __('Description') }}: {{ \Illuminate\Support\Str::limit($notice->description, 50) }}
                                        </span>
                                        <a href="{{ url('/notice/' . $notice->id) }}" class="btn m-r-5 btn-rounded btn-outline btn-info">{{ __('Read More') }}</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>{{ __('No notices available') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Birthdays and Events -->
        <div class="row">
            <!-- Upcoming Birthdays -->
            <div class="col-md-4">
                <div class="white-box">
                    <h3 class="box-title">{{ __('Upcoming Birthday') }}</h3>
                    <hr>
                    <div class="noticeBord">
                        @forelse($upcoming_birthdays as $user)
                            <div class="comment-center p-t-10">
                                <div class="comment-body">
                                    <div class="user-img">
                                        <img src="{{ $user->avatar ? asset('uploads/employeePhoto/' . $user->avatar) : asset('icons/default.png') }}" alt="user" class="img-circle" width="40">
                                    </div>
                                    <div class="mail-contnet">
                                        <h5>{{ $user->name }}</h5>
                                        <span class="time">{{ date('D d M Y', strtotime($user->date_of_birth)) }}</span>
                                        <br>
                                        <span class="mail-desc">
                                            {{ __('Wish') }} {{ $user->gender == 'M' ? 'Him' : 'Her' }} {{ __('on') }} {{ date('D d M Y', strtotime('+1 year', strtotime($user->date_of_birth))) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>{{ __('No upcoming birthdays') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>

             <!-- Upcoming Holidays -->
            <div class="col-md-4">
                <div class="white-box">
                    <h3 class="box-title">{{ __('Upcoming Holidays') }}</h3>
                    <hr>
                    <div class="noticeBord">
                        @forelse($upcoming_holidays as $holiday)
                            <div class="comment-center p-t-10">
                                <div class="comment-body">
                                    <div class="user-img"><i style="font-size: 31px" class="fa fa-calendar-check-o text-success"></i></div>
                                    <div class="mail-contnet">
                                        <h5 class="text-success">{{ $holiday->holiday_name }}</h5>
                                        <span class="time">{{ __('Date') }}: {{ date('d M Y', strtotime($holiday->date)) }}</span>
                                        <br>
                                        <!-- <span class="mail-desc">
                                            {{ __('Description') }}: {{ \Illuminate\Support\Str::limit($holiday->description, 50, '...') }}
                                            <br>
                                            {{ __('Created By') }}: {{ $holiday->created_by_name ?? 'Admin' }}
                                        </span> -->
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>{{ __('No upcoming holidays') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>


            <!-- Events -->
            <div class="col-md-4">
                <div class="white-box">
                    <h3 class="box-title">{{ __('Events') }}</h3>
                    <hr>
                    <div class="noticeBord">
                        @forelse($personal_events as $index => $event)
                            <div class="comment-center p-t-10">
                                <div class="comment-body">
                                    <div class="user-img"><i style="font-size: 31px" class="fa fa-calendar text-primary"></i></div>
                                    <div class="mail-contnet">
                                        <h5>{{ $event->personal_event }}</h5>
                                        <span class="time">{{ __('Start Date') }}: {{ date('d M Y', strtotime($event->start_date)) }}</span>
                                        <br>
                                        <span class="mail-desc">
                                            {{ __('End Date') }}: {{ date('d M Y', strtotime($event->end_date)) }}
                                            <br>
                                            {{ __('Created By') }}: {{ $event->name }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>{{ __('No upcoming events') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery for Counter Animation -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
<script>
$(document).ready(function() {
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });
});
</script>

<style>
.white-box {
    background: #fff;
    padding: 25px;
    margin-bottom: 15px;
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}
.analytics-info .box-title {
    margin-bottom: 15px;
    font-size: 18px;
}
.analytics-info .list-inline.two-part {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.analytics-info .dash_image {
    width: 50px;
}
.analytics-info .counter {
    font-size: 24px;
    font-weight: bold;
}
.panel-heading {
    padding: 10px 15px;
    background: #f7f7f7;
    border-bottom: 1px solid #ddd;
    font-size: 16px;
    font-weight: bold;
}
.manage-u-table th, .manage-u-table td {
    padding: 12px;
    vertical-align: middle;
}
.comment-center .comment-body {
    display: flex;
    margin-bottom: 15px;
}
.comment-center .user-img {
    margin-right: 15px;
}
.comment-center .mail-contnet h5 {
    margin: 0 0 5px;
}
.comment-center .mail-contnet .time {
    font-size: 12px;
    color: #999;
}
.comment-center .mail-contnet .mail-desc {
    font-size: 14px;
}
.btn-rounded {
    border-radius: 20px;
}
</style>
@endsection