@extends('administrator.master')
@section('title', __('Wpac Bank Transfer Setup'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Wpac Bank Transfer Setup') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Bank Management') }}</a></li>
            <li class="active">{{ __('Wpac Bank Transfer Setup') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row mb-3 mt-3">
                    <div class="col-12 col-xl-12 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('Wpac Bank Transfer Setup') }}</h3>
                    </div>
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col-12 col-xl-4 mb-4 mb-xl-0">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <h4 class="font-weight-bold">{{ __('Wpac Bank Transfer Settings') }}</h5>
                        <form action="{{ route('wpac_bank_transfer_setups.store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="box-tools pull-right">
                                <button type="button" id="wpac_modify_setting" class="btn btn-primary">{{ __('Modify Setting') }}</button>
                                <button type="button" id="wpac_save_setting" class="btn btn-success">{{ __('Save') }}</button>
                                <button type="button" id="wpac_cancel_setting" class="btn btn-cancel">{{ __('Cancel') }}</button>
                                <input type="hidden" id="wpac_id" name="id" />
                            </div>
                            <div class="box-body pt-4">
                                <div class="form-group">
                                    <label for="wpac_customer_reference">{{ __('Wpac Customer Reference') }}</label>
                                    <input type="text" name="wpac_customer_reference" id="wpac_customer_reference" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="wpac_folder_directory">{{ __('Folder Directory') }}</label>
                                    <input type="text" name="wpac_folder_directory" id="wpac_folder_directory" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="gl_code_id">{{ __('GL Account Code') }}</label>
                                    <select name="gl_code_id" id="gl_code_id" class="form-control">
                                        @if($glCodes)
                                            @foreach($glCodes as $glCode)
                                                <option value="{{ $glCode->id }}">{{ $glCode->gl_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-xl-8">
                        <h4 class="font-weight-bold">{{ __('Add New Bank') }}</h4>
                        <button class="btn btn-success" data-toggle="modal" data-target="#addBankModal">{{ __('Include New Bank') }}</button>
                        <div class="modal fade" id="addBankModal" tabindex="-1" role="dialog" aria-labelledby="addBankModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="addBankModalLabel">{{ __('Select a Bank') }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-bordered dataTable" id="dt-ref" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('Id') }}</th>
                                                    <th>{{ __('Code') }}</th>
                                                    <th>{{ __('Name') }}</th>
                                                    <th>{{ __('Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>{{ __('Id') }}</th>
                                                    <th>{{ __('Code') }}</th>
                                                    <th>{{ __('Name') }}</th>
                                                    <th>{{ __('Action') }}</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @foreach ($bankList as $bank)
                                                    <tr>
                                                        <td>{{ $bank->id }}</td>
                                                        <td>{{ $bank->bank_code }}</td>
                                                        <td>{{ $bank->bank_name }}</td>
                                                        <td>
                                                            <button class="btn btn-success wpacSelectedBank" 
                                                                    data-bank-id="{{ $bank->id }}" 
                                                                    data-bank-code="{{ $bank->bank_code }}" 
                                                                    data-bank-name="{{ $bank->bank_name }}">
                                                                {{ __('Select') }}
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Selected Banks -->
                        <div id="selectedWpacBanks">
                            <h4>{{ __('Selected Banks') }}</h4>
                            <table class="table table-bordered dataTable" id="dt-ref" width="100%" cellspacing="0">
                                <!-- Dynamically added selected banks will appear here -->
                                <thead>
                                    <tr>
                                        <th>{{ __('Bank Id') }}</th>
                                        <th>{{ __('Bank Name') }}</th>
                                        <th>{{ __('Transaction Fee') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($wpacSettingBanks && $wpacSettingBanks->count())
                                        @foreach($wpacSettingBanks as $wpacSettingBank)
                                            <tr data-bank-id="{{ $wpacSettingBank->bank_id }}">
                                                <td>{{ $wpacSettingBank->bank_id }}</td>
                                                <td>{{ $wpacSettingBank->bank_name }}</td>
                                                <td>{{ $wpacSettingBank->transaction_fee ? $wpacSettingBank->transaction_fee : 0 }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-primary pull-right wpac-edit-btn">Edit</a>
                                                    <a href="#" class="btn btn-sm btn-danger pull-right wpac-remove-btn">Remove</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <!-- <tr>
                                            <td colspan="4" class="text-center">{{ __('No records found') }}</td>
                                        </tr> -->
                                    @endif
                                </tbody>

                            </table>
                        </div>
                       
                    </div>
                </div>
            <div>
        </div>
    </section>
</div>
@endsection
