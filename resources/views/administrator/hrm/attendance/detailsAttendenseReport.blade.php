@extends('administrator.master')
@section('title', __('Attendance Statement'))
@section('main_content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        {{ __('Attendance Statement') }} 
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>Attendance</a></li>
            <li class="active">{{ __('Attendance Statement') }}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Attendance Statement') }}    </h3>
            </div>
            <div class="box-body">
                <!-- <div class="btn-body">
                    <a href="{{ url('/hrm/attendance/details/report/go') }}" class="tip btn btn-primary btn-flat"><i class="fa fa-plus"></i>{{ __('add new Attendance Statement') }} </a>
                    
                    <form action="{{ url('/hrm/attendance/details/report/pdf') }}" method="get">
                        {{ csrf_field() }}
                        <input type="hidden" name="emp_id" value="{{$empid}}">
                        <input type="hidden" name="date1" value="{{$startdate}}">
                        <input type="hidden" name="date2" value="{{$enddate}}">
                        
                        <button type="submit" class="tip btn btn-primary btn-flat">{{ __('PDF') }} </button>
                        
                    </form>
                </div> -->
                <hr>
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
                    <form class="form-horizontal" action="{{ url('/hrm/attendance/details/report/all') }}" method="get">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                            <label for="user_id" class="col-sm-3 control-label">{{ __('Employee Name') }} </label>
                            <div class="col-sm-3">
                                <select name="emp_id" id="user_id" class="form-control">
                                    <option value="0">{{ __('Select One') }}</option>
                                    @foreach($employees as $employee)
                                        <?php $isSelected ="";
                                            if($employee['id']  == $empid){
                                                $isSelected = "selected";
                                            }?>
                                        <option value="{{ $employee['id'] }}" {{ $isSelected }}><strong>{{ $employee['name'] }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('user_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- /.end group -->
                       
                        <div class="form-group{{ $errors->has('salary_month') ? ' has-error' : '' }}">
                            <label for="salary_month" class="col-sm-3 control-label">{{ __('Select Date') }}</label>
                            <div class="col-sm-3">
                                <input type="text" name="daterange" class="form-control" id="reservation" value="{{ $date1 }} {{ __('-') }} {{ $date2 }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-arrow-right"></i> {{ __('View Attendence Statement') }}</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div id="printable_area">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('SL') }}</th>
                                <!-- <th>{{ __('User ID') }}</th> -->
                                <th>{{ __('Employee') }}</th>
                                <th>{{ __('Attendance Date') }}</th>
                                <th>{{ __('Attendance Status') }}</th>
                                <!-- <th>{{ __('Leave Category') }}</th> -->
                                <th>{{ __('Shift') }}</th>
                                <th>{{ __('In Time') }}</th>
                                <th>{{ __('Out Time') }}</th>
                                <th style="text-align: center;">{{ __('In-Status') }}</th>
                                <th style="text-align: center;">{{ __('Out-Status') }}</th>
                                <th>{{ __('Worked (Hrs)') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

use function Psy\debug;

 $sl=1;?>
                            @foreach($attendance as $attd)
                            <tr>
                                <td>{{$sl++}}</td>
                                <!-- <td>ATTD{{$attd->id}}</td> -->
                                <!-- <td>{{Auth::user()->name}}</td> -->
                                <td>{{ $attd->name }}</td>
                                <td>{{ $attd->attendance_date }}</td>
                                <td>
                                    @if($attd->attendance_status==1)
                                    <b class="btn btn-success">{{ __('P') }}</b>
                                    @else
                                    <b class="btn btn-danger">{{ __('A') }}</b>
                                    @endif
                                <!-- </td>
                                <td> -->
                                    @if($attd->leave_category_id==0)
                                    <!-- <b class="btn btn-primary">{{ __('No Leave') }}</b> -->
                                    @elseif($attd->leave_category_id==3)
                                    <b class="btn btn-success">{{ __('LWP') }}</b>
                                    @else
                                    <b class="btn btn-success">{{ __('Leave') }}</b>
                                    @endif
                                </td>
                                <td>{{ $attd->shift_in }} - {{ $attd->shift_out }}</td>
                                <td>{{ $attd->check_in }}</td>
                                <td>{{ $attd->check_out }}</td>
                                <?php 
                                    //xdebug_break();
                                    $chk_in1 = strtotime($attd->shift_in);
                                    $chk_in2 = strtotime($attd->check_in);

                                    $check_in = $chk_in2 - $chk_in1;
                                    
                                    $hours = floor($check_in / 3600);
                                    $minutes = floor(($check_in % 3600) / 60);
                                    $seconds = $check_in % 60;
                                    $check_in = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                                    // If the result is negative, adjust for crossing midnight
                                    // if ($check_in < 0) {
                                    //     $check_in += 24 * 3600; // Adding 24 hours in seconds
                                    // }
                                    // echo gmdate('H:i:s', $check_in);
                                ?>
                                <td >  
                                    <?php if($attd->shift_in < $attd->check_in): ?>
                                        <!-- <img src="<?php //echo url('/public/profile_picture/late.png'); ?> "> &nbsp; <?php //echo gmdate('H:i:s', $check_in); ?> -->
                                        <img src="<?php echo url('/public/profile_picture/late.png'); ?> "> &nbsp; <?php echo $check_in; ?>

                                    <?php elseif($attd->shift_in == $attd->check_in): ?>
                                        <img src="<?php echo url('/public/profile_picture/ontime.png'); ?> "> &nbsp; <?php echo __('On Time'); ?>

                                    <?php else: ?>
                                        <img src="<?php echo url('/public/profile_picture/early.png'); ?> "> &nbsp; <?php echo $check_in; ?>

                                    <?php endif; ?>
                                </td>
                                <?php 
                                //xdebug_break();
                                    $chk_out1 = strtotime($attd->shift_out);
                                    $chk_out2 = strtotime($attd->check_out);

                                    $check_out = abs($chk_out1 - $chk_out2);

                                    $hours = floor($check_out / 3600);
                                    $minutes = floor(($check_out % 3600) / 60);
                                    $seconds = $check_out % 60;
                                    
                                    $check_out = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                                    // If the result is negative, adjust for crossing midnight
                                     //if ($check_out < 0) {
                                         //$check_out += 24 * 3600; // Adding 24 hours in seconds
                                    //     $check_out = ($check_out + (24 * 3600)) % (24 * 3600);
                                    //}
                                    // echo gmdate('H:i:s', $check_out);
                                ?>
                                <td>
                                    <?php if($attd->shift_out < $attd->check_out): ?>
                                        <img src="<?php echo url('/public/profile_picture/early.png'); ?> "> &nbsp; <?php echo $check_out; ?>

                                    <?php elseif($attd->shift_out == $attd->check_out): ?>
                                        <img src="<?php echo url('/public/profile_picture/ontime.png'); ?> "> &nbsp; <?php echo __('On Time'); ?>

                                    <?php else: ?>
                                        <img src="<?php echo url('/public/profile_picture/late.png'); ?> "> &nbsp; <?php echo $check_out; ?>

                                    <?php endif; ?>
                                </td>
                                <td><?php 
                                    $time1 = strtotime($attd->check_in);
                                    $time2 = strtotime($attd->check_out);

                                    // Adding time
                                    // $added_time = $time1 + $time2;
                                    // echo "Added Time: " . date('H:i:s', $added_time) . "\n";

                                    // Subtracting time
                                    $subtracted_time = $time2 - $time1;

                                    // If the result is negative, adjust for crossing midnight
                                    if ($subtracted_time < 0) {
                                        $subtracted_time += 24 * 3600; // Adding 24 hours in seconds
                                    }
                                    echo gmdate('H:i:s', $subtracted_time);
                                ?></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                            <br>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td>
                                    {{ __('Total') }}
                                </td>
                                <td>
                                    {{$attendance->count()}} days
                                </td>
                            <!-- </tr>
                            <tr> -->
                                <td>
                                    <!-- {{ __('Total') }} -->
                                    {{$attds->count()}} {{ __('Present') }}
                                </td>
                            <!-- </tr>
                            <tr> -->
                                <td>
                                    <!-- {{ __('Total') }} -->
                                    {{$abs->count()}} {{ __('Absence') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div><!--printable-->
                    <!-- <div class="sign-body-l">-----------------------------------<br>{{ __('Employee') }}</div>
                    <div class="sign-body-r">-----------------------------------<br>{{ __('Authorized') }}</div> -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    @endsection