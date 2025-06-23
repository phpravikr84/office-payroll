@extends('administrator.master')
@section('title', __('Bank Details'))

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ __('BANK DETAILS') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Bank Details') }}</a></li>
            <li><a>{{ __('Setting') }}</a></li>
            <li><a href="{{ url('/setting/departments') }}">{{ __('Bank Details') }}</a></li>
            <li class="active">{{ __('Add Bank Details') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Add Bank Details') }}</h3>
            </div>
            <!-- /.box-header -->
            <form action="{{ url('setting/bank_details/store') }}" method="post" name="bank_details_add_form">
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
                                <p class="text-yellow">{{ __('Enter bank details. All field are required.') }} </p>
                            @endif
                        </div>
                        <!-- /.Notification Box -->

                        <div class="col-md-6">
                            <label for="bank_detail_code">{{ __('Bank Code') }} <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('bank_detail_code') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="bank_detail_code" id="bank_detail_code" class="form-control" value="{{ old('bank_detail_code') }}" placeholder="{{ __('Enter bank details code..') }}">
                                @if ($errors->has('bank_detail_code'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('bank_detail_code') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label for="bank_detail_name">{{ __('Bank Name') }} <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('bank_detail_name') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="bank_detail_name" id="bank_detail_name" class="form-control" value="{{ old('bank_detail_name') }}" placeholder="{{ __('Enter bank name..') }}">
                                @if ($errors->has('bank_detail_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('bank_detail_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label for="bsb_number">{{ __('BSB Number') }} <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('bsb_number') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="bsb_number" id="bsb_number" class="form-control" value="{{ old('bsb_number') }}" placeholder="{{ __('Enter bsb number..') }}">
                                @if ($errors->has('bsb_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('bsb_number') }}</strong>
                                </span>
                                @endif
                            </div>
                            <label for="bank_type">{{ __('Bank Type') }} <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('bank_type') ? ' has-error' : '' }} has-feedback">
                                <select name="bank_type" id="bank_type" class="form-control">
                                    <option value="" selected disabled>{{ __('Select one') }}</option>
                                    @if($banks)
                                        @foreach($banks as $bank)
                                            <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('bank_type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('bank_type') }}</strong>
                                </span>
                                @endif
                            </div>

                            <label for="bank_phone">{{ __('Phone') }} <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('bank_phone') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="bank_phone" id="bank_phone" class="form-control" value="{{ old('bank_phone') }}" placeholder="{{ __('Enter bank phone..') }}">
                                @if ($errors->has('bank_phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('bank_phone') }}</strong>
                                </span>
                                @endif
                            </div>

                            <label for="employment_account_number">{{ __('Employement Account Number') }} <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('employment_account_number') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="employment_account_number" id="employment_account_number" class="form-control" value="{{ old('employment_account_number') }}" placeholder="{{ __('Enter employment account number..') }}">
                                @if ($errors->has('employment_account_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('employment_account_number') }}</strong>
                                </span>
                                @endif
                            </div>

                            <label for="account_suffix">{{ __('Account Suffix') }} <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('account_suffix') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="account_suffix" id="account_suffix" class="form-control" value="{{ old('account_suffix') }}" placeholder="{{ __('Enter account suffix..') }}">
                                @if ($errors->has('account_suffix'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('account_suffix') }}</strong>
                                </span>
                                @endif
                            </div>
                            
                            <!-- /.form-group -->
                            <label for="status">{{ __('Publication Status') }} <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }} has-feedback">
                                <select name="status" id="status" class="form-control">
                                    <option value="" selected disabled>{{ __('Select one') }}</option>
                                    <option value="1">{{ __('Published') }}</option>
                                    <option value="0">{{ __('Unpublished') }}</option>
                                </select>
                                @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-12">
                            <label for="bank_address">{{ __('Bank Address') }} <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('bank_address') ? ' has-error' : '' }} has-feedback">
                                <textarea class="form-control" rows="8" name="bank_address" id="bank_address" placeholder="{{ __('Enter bank address..') }}">{{ old('bank_address') }}</textarea>
                                @if ($errors->has('bank_address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('bank_address') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ url('/setting/bank_details') }}" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i> {{ __('Cancel') }}</a>
                    <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-plus"></i> {{ __('Add Bank Details') }}t</button>
                </div>
            </form>
        </div>
        <!-- /.box -->


    </section>
    <!-- /.content -->
</div>
<script type="text/javascript">
    document.forms['bank_details_add_form'].elements['status'].value = "{{ old('status') }}";
</script>
@endsection
