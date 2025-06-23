@extends('administrator.master')
@section('title', __('Create Pay Reference'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Create Pay Reference') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Payroll') }}</a></li>
            <li class="active">{{ __('Create Pay Reference') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Create Pay Reference') }}</h3>
            </div>
            <form action="{{ route('pay_references.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="row">
                        <!-- First Column -->
                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('pay_reference_name') ? ' has-error' : '' }}">
                                <label for="pay_reference_name">{{ __('Pay Reference Name') }} <span class="text-danger">*</span></label>
                                <input type="text" name="pay_reference_name" id="pay_reference_name" class="form-control" value="{{ old('pay_reference_name') }}" required>
                                @if ($errors->has('pay_reference_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pay_reference_name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <!-- <div class="form-group">
                                <label for="pay_period_start_date">{{ __('Pay Period Start Date') }} <span class="text-danger">*</span></label>
                                <input type="date" name="pay_period_start_date" id="pay_period_start_date" class="form-control datepicker" value="{{ old('pay_period_start_date') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="pay_period_end_date">{{ __('Pay Period End Date') }} <span class="text-danger">*</span></label>
                                <input type="date" name="pay_period_end_date" id="pay_period_end_date" class="form-control datepicker" value="{{ old('pay_period_end_date') }}" required>
                            </div> -->

                            <div class="form-group">
                                <label for="pay_period_start_date">{{ __('Pay Period Start Date') }} <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="pay_period_start_date" id="pay_period_start_date" class="form-control datepicker" value="{{ old('pay_period_start_date') }}" required readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text calendar-icon" id="start_date_icon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pay_period_end_date">{{ __('Pay Period End Date') }} <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="pay_period_end_date" id="pay_period_end_date" class="form-control datepicker" value="{{ old('pay_period_end_date') }}" required readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text calendar-icon" id="end_date_icon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="branch_id">{{ __('Branch') }} <span class="text-danger">*</span></label>
                                <select name="branch_id" id="branch_id" class="form-control" required>
                                    @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="payroll_number_id">{{ __('Payroll Number') }} <span class="text-danger">*</span></label>
                                <select name="payroll_number_id" id="payroll_number_id" class="form-control" required>
                                    @foreach($pay_batch_numbers as $pay_batch_number)
                                    <option value="{{ $pay_batch_number->id }}">{{ $pay_batch_number->pay_batch_number_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Second Column -->
                        <div class="col-md-4">
                            <h4>{{ __('Departments') }}</h4>
                            <div class="form-group">
                                <button type="button" class="btn btn-default btn-sm" id="select-all-departments">{{ __('Select All') }}</button>
                                <button type="button" class="btn btn-default btn-sm" id="clear-all-departments">{{ __('Clear') }}</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ __('ID') }}</th>
                                            <th>{{ __('Code') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Included') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($departments as $department)
                                        <tr>
                                            <td>{{ $department->id }}</td>
                                            <td>{{ $department->department }}</td>
                                            <td>{{ $department->department_description }}</td>
                                            <td><input type="checkbox" name="departments[]" value="{{ $department->id }}" checked></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Third Column -->
                        <div class="col-md-4">
                            <h4>{{ __('Pay Locations') }}</h4>
                            <div class="form-group">
                                <button type="button" class="btn btn-default btn-sm" id="select-all-locations">{{ __('Select All') }}</button>
                                <button type="button" class="btn btn-default btn-sm" id="clear-all-locations">{{ __('Clear') }}</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ __('ID') }}</th>
                                            <th>{{ __('Code') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Included') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pay_locations as $location)
                                        <tr>
                                            <td>{{ $location->id }}</td>
                                            <td>{{ $location->payroll_location_code }}</td>
                                            <td>{{ $location->payroll_location_name }}</td>
                                            <td><input type="checkbox" name="pay_locations[]" value="{{ $location->id }}" checked></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary">{{ __('Create Pay Reference') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
