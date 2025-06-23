<!-- resources/views/leave/edit.blade.php -->
@extends('administrator.master')
@section('title', __('Change Leave Status'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Change Leave Status') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Leave') }}</a></li>
            <li><a href="{{ url('/hrm/leave') }}">{{ __('Show Leave Application Lists') }}</a></li>
            <li class="active">{{ __('Change Leave Status') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Change Leave Status') }}</h3>
            </div>
            <form action="{{ route('leave.update', $leave->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                            <label for="user_id">{{ __('Employee Name') }} <span class="text-danger">*</span></label>
                            <select name="user_id" class="form-control" id="user_id" required readonly>
                                <option selected disabled>{{ __('Select One') }}</option>
                                @foreach($employees as $employee)
                                <option value="{{ $employee['id'] }}" {{ $employee['id']==$leave->user_id ? 'selected' : '' }}>{{ $employee['name'] }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('user_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('user_id') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                      <!-- Leave Category -->
                      <div class="col-md-6">
                        <div class="form-group{{ $errors->has('leave_category_id') ? ' has-error' : '' }}">
                            <label for="leave_category_id">{{ __('Leave Category') }} <span class="text-danger">*</span></label>
                            <select name="leave_category_id" id="leave_category_id" class="form-control" required readonly>
                                @foreach ($leaveCategories as $category)
                                    @if($category->id==$leave->leave_category_id)
                                        <option value="{{ $category->id }}" {{ $category->id==$leave->leave_category_id ? 'selected' : '' }}>{{ $category->leave_category }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('leave_category_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('leave_category_id') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <!-- Start Date -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date">{{ __('Start Date') }} <span class="text-danger">*</span></label>
                            <input type="text" name="start_date" id="start_date" class="form-control datepicker" value="{{ $leave->start_date }}" readonly>
                        </div>
                    </div>

                    <!-- End Date -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_date">{{ __('End Date') }} <span class="text-danger">*</span></label>
                            <input type="text" name="end_date" id="end_date" class="form-control datepicker" value="{{ $leave->end_date }}" readonly>
                        </div>
                    </div>

                    
                    
                    <!-- Pending Leave -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pending_leave">{{ __('Pending Leave') }}</label>
                            <input name="pending_leave" class="form-control" id="pending_leave" value="{{ $leave->pending_leave }}" readonly />
                        </div>
                    </div>
                    <!-- Loss of Pay Days -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="loss_of_pay_days">{{ __('Loss of Pay Days') }}</label>
                            <input name="loss_of_pay_days" class="form-control" id="loss_of_pay_days" value="{{ $leave->loss_of_pay_days }}" readonly/>
                        </div>
                    </div>

                    <!-- Leave Applied Days -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="leave_applied_days">{{ __('Leave Applied Days') }}</label>
                            <input name="leave_applied_days" class="form-control" id="leave_applied_days" value="{{ $leave->leave_applied_days }}" readonly />
                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">{{ __('Status') }} <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control" required>
                                <option value="0" {{ $leave->status == 0 ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                    @if(auth()->user()->user_type==1)
                                        <option value="1" {{ $leave->status == 1 ? 'selected' : '' }}>{{ __('Approved') }}</option>
                                        <option value="2" {{ $leave->status == 2 ? 'selected' : '' }}>{{ __('Disapproved') }}</option>
                                    @else
                                        <option value="3" {{ $leave->status == 3 ? 'selected' : '' }}>{{ __('Cancel') }}</option>
                                    @endif
                 
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="message">{{ __('Message') }}</label>
                                <textarea name="message" id="message" class="form-control" rows="3">{{ $leave->message }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
