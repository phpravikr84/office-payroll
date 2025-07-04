<?php
use Carbon\Carbon;
?>
@extends('administrator.master')
@section('title', __('Show Leave Application Lists'))

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ __('Show Leave Application Lists') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Leave') }}</a></li>
            <li class="active">{{ __('Show Leave Application Lists') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Show Leave Application Lists') }}</h3>
                @if(Auth::user()->access_label!=1)
                <div class="box-tools pull-right">
                <a href="{{ route('leave.create') }}" class="btn btn-primary">{{ __('Apply for Leave') }}</a>
                </div>
                @endif
            </div>
            <div class="box-body table-responsive">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($leaveApplications->isEmpty())
                    <p>{{ __('No leave applications found.') }}</p>
                @else
                    <table id="example1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('Start Date') }}</th>
                                <th>{{ __('End Date') }}</th>
                                <th>{{ __('Leave Type') }}</th>
                                <th>{{ __('Reason') }}</th>
                                <th>{{ __('Leave Applied') }}</th>
                                <th>{{ __('Pending Leave') }}</th>
                                <th>{{ __('Loss of Pay') }}</th>
                                <th>{{ __('Employee Name') }}</th>
                                <th>{{ __('Apply Date') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leaveApplications as $leave)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('d F Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('d F Y') }}</td>
                                    <td>{{ ucfirst($leave->leave_type) }}</td>
                                    <td>{{ $leave->reason }}</td>

                                    <td>{{ $leave->leave_applied_days }}</td>
                                    <td>{{ $leave->pending_leave }}</td>
                                    <td>{{ $leave->loss_of_pay_days	}}</td>
                                    <td>{{ $leave->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($leave->created_at)->format('D d F Y h:ia') }}</td>
                                    <td>
                                        @if ($leave->status == 1)
                                            <span class="badge badge-success">{{ __('Accepted') }}</span>
                                        @elseif ($leave->status == 2)
                                            <span class="badge badge-danger">{{ __('Not Accepted') }}</span>
                                        @elseif ($leave->status == 3)
                                            <span class="badge badge-danger">{{ __('Cancel') }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ __('Pending') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($leave->status != 3)
                                            <a href="{{ route('leave.edit', $leave->id) }}" class="btn btn-warning btn-sm">{{ __('Change Status') }}</a>
                                        @else
                                            <button type="button" class="btn btn-warning btn-sm" disabled data-bs-toggle="button" autocomplete="off">{{ __('Change Status') }}</button>
                                        @endif
                                    </td>
                                   
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
@endsection
