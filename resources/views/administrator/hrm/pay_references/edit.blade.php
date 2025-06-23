@extends('administrator.master')
@section('title', __('Edit Pay Reference'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Edit Pay Reference') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Pay References') }}</a></li>
            <li class="active">{{ __('Edit Pay Reference') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Edit Pay Reference') }}</h3>
            </div>
            <form action="{{ route('pay_references.update', $payReference->id) }}" method="POST">
            {{ csrf_field() }}
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pay_reference_name">{{ __('Pay Reference Name') }} <span class="text-danger">*</span></label>
                                <input type="text" name="pay_reference_name" id="pay_reference_name" class="form-control" value="{{ $payReference->pay_reference_name }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pay_period_start_date">{{ __('Pay Period Start Date') }} <span class="text-danger">*</span></label>
                                <input type="date" name="pay_period_start_date" id="pay_period_start_date" class="form-control" value="{{ $payReference->pay_period_start_date }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pay_period_end_date">{{ __('Pay Period End Date') }} <span class="text-danger">*</span></label>
                                <input type="date" name="pay_period_end_date" id="pay_period_end_date" class="form-control" value="{{ $payReference->pay_period_end_date }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="branch_id">{{ __('Branch') }} <span class="text-danger">*</span></label>
                                <select name="branch_id" id="branch_id" class="form-control" required>
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}" {{ $branch->id == $payReference->branch_id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="payroll_number">{{ __('Payroll Number') }} <span class="text-danger">*</span></label>
                                <input type="text" name="payroll_number" id="payroll_number" class="form-control" value="{{ $payReference->payroll_number }}" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
