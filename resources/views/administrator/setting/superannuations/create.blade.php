@extends('administrator.master')
@section('title', __('Add Superannuation'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Add Superannuation') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Superannuation Management') }}</a></li>
            <li class="active">{{ __('Add Superannuation') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Add Superannuation') }}</h3>
            </div>
            <form action="{{ route('superannuations.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="code">{{ __('Code') }}</label>
                        <input type="text" name="code" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="employer_contribution_percentage">{{ __('Employer Contribution (%)') }}</label>
                        <input type="number" name="employer_contribution_percentage" class="form-control" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="employer_contribution_fixed_amount">{{ __('Employer Contribution (Fixed Amount)') }}</label>
                        <input type="number" name="employer_contribution_fixed_amount" class="form-control" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="tax_method_for_employee_contribution">{{ __('Tax Method for Employee Contribution') }}</label>
                        <select name="tax_method_for_employee_contribution" class="form-control">
                            <option value="after_tax">{{ __('After Tax') }}</option>
                            <option value="before_tax">{{ __('Before Tax') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="included_bank_transfer">{{ __('Included in Bank Transfer') }}</label>
                        <select name="included_bank_transfer" class="form-control">
                            <option value="0">{{ __('No') }}</option>
                            <option value="1">{{ __('Yes') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bank_account_number">{{ __('Bank Account Number') }}</label>
                        <input type="text" name="bank_account_number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="account_name">{{ __('Account Name') }}</label>
                        <input type="text" name="account_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="bank_name">{{ __('Bank Name') }}</label>
                        <select name="bank_name" id="bank_name" class="form-control">
                            <option value="" selected disabled>{{ __('Select one') }}</option>
                            @if($banks)
                                @foreach($banks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->id.'-'.$bank->bank_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="employer_name">{{ __('Employer Name') }}</label>
                        <input type="text" name="employer_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="employer_superannuation_no">{{ __('Employer Superannuation No') }}</label>
                        <input type="text" name="employer_superannuation_no" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="registration_date">{{ __('Registration Date') }}</label>
                        <input type="date" name="registration_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="status">{{ __('Status') }}</label>
                        <select name="status" class="form-control">
                            <option value="1">{{ __('Active') }}</option>
                            <option value="0">{{ __('Inactive') }}</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
