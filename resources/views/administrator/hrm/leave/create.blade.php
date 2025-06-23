@extends('administrator.master')
@section('title', __('Add Leave Application'))

@section('main_content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      {{ __('Add Leave Application') }}
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
      <li><a>{{ __('Setting') }}</a></li>
      <li><a href="{{ url('/hrm/leave') }}">{{ __('Show Leave Application List') }}</a></li>
      <li class="active">{{ __('Add Leave Application') }}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">{{ __('Add Leave Application') }}</h3>
      </div>
      <!-- /.box-header -->
        <form action="{{ route('leave.store') }}" method="POST">
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
                        <p class="text-yellow">{{ __('Enter New Application details. All fields are required.') }}</p>
                        @endif
                    </div>

                    
                  <div class="col-md-6">
                        <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                            <label for="user_id">{{ __('Employee Name') }} <span class="text-danger">*</span></label>
                            <select name="user_id" class="form-control" id="user_id" required>
                                <option selected disabled>{{ __('Select One') }}</option>
                                   @if(Auth::user()->access_label==1)
                                        @foreach($employees as $employee)
                                        <option value="{{ $employee['id'] }}">{{ $employee['name'] }}</option>
                                        @endforeach
                                    @else
                                        @foreach($employees as $employee)
                                        <option value="{{ $employee['id'] }}" {{ $employee['id'] == Auth::user()->id ? 'selected' : '' }}>{{ $employee['name'] }}</option>
                                        @endforeach
                                    @endif
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
                            <select name="leave_category_id" id="leave_category_id" class="form-control" required>
                                <option value="" selected disabled>{{ __('Select Leave Category') }}</option>
                                @foreach ($leaveCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->leave_category }}</option>
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
                            <input type="text" name="start_date" id="start_date" class="form-control datepicker" required>
                        </div>
                    </div>

                    <!-- End Date -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_date">{{ __('End Date') }} <span class="text-danger">*</span></label>
                            <input type="text" name="end_date" id="end_date" class="form-control datepicker" required>
                        </div>
                    </div>

                    <div id="casual_leave_only" class="d-none">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('leave_duration') ? ' has-error' : '' }}">
                                <label for="leave_duration">{{ __('Leave Duration') }} <span class="text-danger">*</span></label>
                                <select name="leave_duration" id="leave_duration" class="form-control" required>
                                    <option value="1" selected>Full Day</option>
                                    <option value="0.5">Half Day</option>
                                    <option value="0.25">Quarter Day</option>
                                </select>
                                @if ($errors->has('leave_duration'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('leave_duration') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pending Leave -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pending_leave">{{ __('Pending Leave') }}</label>
                            <input name="pending_leave" class="form-control" id="pending_leave" />
                        </div>
                    </div>
                    <!-- Loss of Pay Days -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="loss_of_pay_days">{{ __('Loss of Pay Days') }}</label>
                            <input name="loss_of_pay_days" class="form-control" id="loss_of_pay_days"/>
                        </div>
                    </div>

                    <!-- Leave Applied Days -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="leave_applied_days">{{ __('Leave Applied Days') }}</label>
                            <input name="leave_applied_days" class="form-control" id="leave_applied_days" />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="is_sandwich_leave">{{ __('Is Sandwitch Leave') }}</label>
                            <input name="is_sandwich_leave" class="form-control" id="is_sandwich_leave" readonly />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sandwich_leave_days">{{ __('Sandwitch Leave Days') }}</label>
                            <input name="sandwich_leave_days" class="form-control" id="sandwich_leave_days" readonly />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="holiday_count">{{ __('Holiday Count') }}</label>
                            <input name="holiday_count" class="form-control" id="holiday_count" readonly />
                        </div>
                    </div>
              
                    <!-- Reason -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="reason">{{ __('Reason') }} <span class="text-danger">*</span></label>
                            <textarea name="reason" id="reason" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
    <!-- /.box -->


  </section>
  <!-- /.content -->
</div>

<!-- Include jQuery and jQuery UI -->
<style>
    .ui-datepicker .ui-state-disabled .ui-state-disabled, .ui-datepicker .ui-state-disabled span {
        background: #ffdddd !important; /* Light red background */
        color: #d9534f !important;      /* Red text color */
        border-color: #d9534f !important;
    }

</style>
@endsection
