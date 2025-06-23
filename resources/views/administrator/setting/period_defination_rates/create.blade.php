@extends('administrator.master')
@section('title', __('Create Period Definition Rate'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Create Period Definition Rate') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Period Management') }}</a></li>
            <li class="active">{{ __('Create Period Definition Rate') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Create Period Definition Rate') }}</h3>
                <div class="box-tools pull-right">
                    <a href="{{ route('period_defination_rates.index') }}" class="btn btn-primary">{{ __('Back to List') }}</a>
                </div>
            </div>
            <div class="box-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('period_defination_rates.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="code">{{ __('Code') }}</label>
                        <input type="text" name="code" class="form-control" value="">
                    </div>

                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control" value="">
                    </div>

                    <div class="form-group">
                        <label for="pay_unit">{{ __('Pay Unit') }}</label>
                        <select name="pay_unit" class="form-control">
                            <option value="hour">{{ __('Hour') }}</option>
                            <option value="day">{{ __('Day') }}</option>
                            <option value="week">{{ __('Week') }}</option>
                            <option value="fortnight">{{ __('Fortnight') }}</option>
                            <option value="month">{{ __('Month') }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pays_per_year">{{ __('Pays Per Year') }}</label>
                        <input type="text" name="pays_per_year" class="form-control" value="">
                    </div>

                    <div class="form-group">
                        <label for="hours_per_day">{{ __('Hours Per Day') }}</label>
                        <input type="text" name="hours_per_day" class="form-control" value="">
                    </div>

                    <div class="form-group">
                        <label for="hours_per_pay">{{ __('Hours Per Pay') }}</label>
                        <input type="text" name="hours_per_pay" class="form-control" value="">
                    </div>

                    <div class="form-group">
                        <label for="days_per_pay">{{ __('Days per Pay') }}</label>
                        <input type="text" name="days_per_pay" class="form-control" value="">
                    </div>

                    <div class="form-group">
                        <label for="rate_per_pay_unit_hours">{{ __('Rate Per Pay Unit Hours') }}</label>
                        <input type="text" name="rate_per_pay_unit_hours" class="form-control" value="">
                    </div>

                    <div class="form-group">
                        <label for="overtime_rate_one">{{ __('Overtime Rate One') }}</label>
                        <input type="text" name="overtime_rate_one" class="form-control" value="">
                    </div>

                    <div class="form-group">
                        <label for="overtime_rate_two">{{ __('Overtime Rate Two') }}</label>
                        <input type="text" name="overtime_rate_two" class="form-control" value="">
                    </div>


                    <div class="form-group">
                        <label for="special_rate_one">{{ __('Special Rate One') }}</label>
                        <input type="text" name="special_rate_one" class="form-control" value="">
                    </div>

                    <div class="form-group">
                        <label for="special_rate_two">{{ __('Special Rate Two') }}</label>
                        <input type="text" name="special_rate_two" class="form-control" value="">
                    </div>

                    <div class="form-group">
                        <label for="annual_leave_flag">{{ __('Annual Leave Provide') }}</label>
                        <select name="annual_leave_flag" class="form-control">
                            <option value="0">{{ __('No') }}</option>
                            <option value="1">{{ __('Yes') }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="casual_leave_flag">{{ __('Casual Leave Provide') }}</label>
                        <select name="casual_leave_flag" class="form-control">
                            <option value="0">{{ __('No') }}</option>
                            <option value="1">{{ __('Yes') }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sick_leave_flag">{{ __('Sick/Medical Leave Provide') }}</label>
                        <select name="sick_leave_flag" class="form-control">
                            <option value="0">{{ __('No') }}</option>
                            <option value="1">{{ __('Yes') }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="accurate_type">{{ __('Accrual Type') }}</label>
                        <select name="accurate_type" class="form-control">
                            <option value="based_on_last_pay_date">{{ __('Based On Last Pay Date') }}</option>
                            <option value="based_on_work_pay_units">{{ __('Based On Work Pay Units') }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="salary_days_count">{{ __('Salary Days Count') }}</label>
                        <select name="salary_days_count" class="form-control">
                            <option value="14">14</option>
                            <option value="28">28</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">{{ __('Status') }}</label>
                        <select name="status" class="form-control">
                            <option value="1">{{ __('Active') }}</option>
                            <option value="0">{{ __('Inactive') }}</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
