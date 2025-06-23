@extends('administrator.master')
@section('title', 'Edit Company')

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Company</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Edit Company</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Company Information</h3>
            </div>
            
            <form action="{{ route('company.update', $company->id) }}" method="POST">
            {{ csrf_field() }}
                <!-- Company Information Card -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-building"></i> Company Information
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Company Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $company->name) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="trading_name">Trading Name</label>
                            <input type="text" class="form-control" id="trading_name" name="trading_name" value="{{ old('trading_name', $company->trading_name) }}">
                        </div>
                        <div class="form-group">
                            <label for="tax_number">Tax Number</label>
                            <input type="text" class="form-control" id="tax_number" name="tax_number" value="{{ old('tax_number', $company->tax_number) }}">
                        </div>
                        <div class="form-group">
                            <label for="business_number">Business Number</label>
                            <input type="text" class="form-control" id="business_number" name="business_number" value="{{ old('business_number', $company->business_number) }}">
                        </div>
                        <div class="form-group">
                            <label for="initial_payroll_year">Initial Payroll Year</label>
                            <input type="number" class="form-control" id="initial_payroll_year" name="initial_payroll_year" value="{{ old('initial_payroll_year', $company->initial_payroll_year) }}">
                        </div>
                        <div class="form-group">
                            <label for="current_payroll_year">Current Payroll Year</label>
                            <input type="number" class="form-control" id="current_payroll_year" name="current_payroll_year" value="{{ old('current_payroll_year', $company->current_payroll_year) }}">
                        </div>
                        <div class="form-group">
                            <label for="employee_limit">Employee Limit</label>
                            <input type="number" class="form-control" id="employee_limit" name="employee_limit" value="{{ old('employee_limit', $company->employee_limit) }}">
                        </div>
                    </div>
                </div>

                <!-- Contact Information Card -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-phone"></i> Contact Information
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="contact_person">Contact Person</label>
                            <input type="text" class="form-control" id="contact_person" name="contact_person" value="{{ old('contact_person', $company->contact_person) }}">
                        </div>
                        <div class="form-group">
                            <label for="phone1">Primary Phone</label>
                            <input type="text" class="form-control" id="phone1" name="phone1" value="{{ old('phone1', $company->phone1) }}">
                        </div>
                        <div class="form-group">
                            <label for="phone2">Secondary Phone</label>
                            <input type="text" class="form-control" id="phone2" name="phone2" value="{{ old('phone2', $company->phone2) }}">
                        </div>
                        <div class="form-group">
                            <label for="fax1">Primary Fax</label>
                            <input type="text" class="form-control" id="fax1" name="fax1" value="{{ old('fax1', $company->fax1) }}">
                        </div>
                        <div class="form-group">
                            <label for="fax2">Secondary Fax</label>
                            <input type="text" class="form-control" id="fax2" name="fax2" value="{{ old('fax2', $company->fax2) }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $company->email) }}">
                        </div>
                    </div>
                </div>

                <!-- Address Information Card -->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-map-marker"></i> Address Information
                    </div>
                    <div class="card-body">
                        <!-- Physical Address -->
                        <h5>Physical Address</h5>
                        <div class="form-group">
                            <label for="address_street_no">Street Number</label>
                            <input type="text" class="form-control" id="address_street_no" name="address_street_no" value="{{ old('address_street_no', $company->address_street_no) }}">
                        </div>
                        <div class="form-group">
                            <label for="address_street_name">Street Name</label>
                            <input type="text" class="form-control" id="address_street_name" name="address_street_name" value="{{ old('address_street_name', $company->address_street_name) }}">
                        </div>
                        <div class="form-group">
                            <label for="address_city">City</label>
                            <input type="text" class="form-control" id="address_city" name="address_city" value="{{ old('address_city', $company->address_city) }}">
                        </div>
                        <div class="form-group">
                            <label for="address_state">State</label>
                            <input type="text" class="form-control" id="address_state" name="address_state" value="{{ old('address_state', $company->address_state) }}">
                        </div>
                        <div class="form-group">
                            <label for="address_postcode">Postcode</label>
                            <input type="text" class="form-control" id="address_postcode" name="address_postcode" value="{{ old('address_postcode', $company->address_postcode) }}">
                        </div>
                        <div class="form-group">
                            <label for="address_country">Country</label>
                            <input type="text" class="form-control" id="address_country" name="address_country" value="{{ old('address_country', $company->address_country) }}">
                        </div>
                        
                        <!-- Mailing Address -->
                        <h5>Mailing Address</h5>
                        <div class="form-group">
                            <label for="mailing_street_no">Street Number</label>
                            <input type="text" class="form-control" id="mailing_street_no" name="mailing_street_no" value="{{ old('mailing_street_no', $company->mailing_street_no) }}">
                        </div>
                        <div class="form-group">
                            <label for="mailing_street_name">Street Name</label>
                            <input type="text" class="form-control" id="mailing_street_name" name="mailing_street_name" value="{{ old('mailing_street_name', $company->mailing_street_name) }}">
                        </div>
                        <div class="form-group">
                            <label for="mailing_city">City</label>
                            <input type="text" class="form-control" id="mailing_city" name="mailing_city" value="{{ old('mailing_city', $company->mailing_city) }}">
                        </div>
                        <div class="form-group">
                            <label for="mailing_state">State</label>
                            <input type="text" class="form-control" id="mailing_state" name="mailing_state" value="{{ old('mailing_state', $company->mailing_state) }}">
                        </div>
                        <div class="form-group">
                            <label for="mailing_postcode">Postcode</label>
                            <input type="text" class="form-control" id="mailing_postcode" name="mailing_postcode" value="{{ old('mailing_postcode', $company->mailing_postcode) }}">
                        </div>
                        <div class="form-group">
                            <label for="mailing_country">Country</label>
                            <input type="text" class="form-control" id="mailing_country" name="mailing_country" value="{{ old('mailing_country', $company->mailing_country) }}">
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-briefcase"></i> Bank Details
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="bank_id">Bank Name</label>
                            <select class="form-control" id="company_bank_id" name="bank_id">
                                <option value="">Select Bank</option>
                                @if($banks)
                                    @foreach( $banks as $bank )
                                        <option value="{{$bank->id}}" {{ $bank->id == $company->bank_id ? 'selected' : '' }}>{{ $bank->bank_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="bank_id">Bank Detail</label>
                            <select class="form-control" id="comp_bank_detail_id" name="bank_detail_id">
                                <option value="">Select Bank detail</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <!-- <label for="bank_setting_id">Bank Setting Id</label> -->
                            <input type="hidden" class="form-control" id="comp_setting_table_name" name="setting_table_name" value="">
                            <input type="hidden" class="form-control" id="comp_bank_setting_id" name="bank_setting_id" value="">
                        </div>
                        <div class="form-group">
                            <!-- <label for="transaction_fee">Transaction Fee</label> -->
                            <input type="hidden" class="form-control" id="comp_transaction_fee" name="transaction_fee" value="">
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-briefcase"></i> Superannuation Details
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="superannuation_id">Superannuation ID</label>
                            <select class="form-control" id="superannuation_id" name="superannuation_id">
                                <option value="">Select Superannuation</option>
                                @if($superannuation)
                                    @foreach( $superannuation as $super )
                                        <option value="{{$super->id}}" {{ $super->id== $company->superannuation_id ? 'selected' : '' }}>{{$super->code}} - {{$super->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="superannuation_fund">Superannuation Fund</label>
                            <input type="text" class="form-control" id="superannuation_fund" name="superannuation_fund" value="{{ old('superannuation_fund', $company->superannuation_fund ?? '') }}">
                        </div>
                        <div class="form-group">
                            <label for="superannuation_number">Superannuation Number</label>
                            <input type="text" class="form-control" id="superannuation_number" name="superannuation_number" value="{{ old('superannuation_number', $company->superannuation_number ?? '') }}">
                        </div>
                        <div class="form-group">
                            <label for="ncsl_number">NCSL Number</label>
                            <input type="text" class="form-control" id="ncsl_number" name="ncsl_number" value="{{ old('ncsl_number', $company->ncsl_number ?? '') }}">
                        </div>
                    </div>
                </div>
                <!-- Form Submit -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Company</button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
