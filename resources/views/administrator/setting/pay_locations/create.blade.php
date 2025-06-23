@extends('administrator.master')
@section('title', __('Add Pay Location'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Add Pay Location') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Pay Location Management') }}</a></li>
            <li class="active">{{ __('Add Pay Location') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Add Pay Location') }}</h3>
            </div>
            <form action="{{ route('pay_locations.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="payroll_location_code">{{ __('Location Code') }}</label>
                        <input type="text" name="payroll_location_code" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="payroll_location_name">{{ __('Location Name') }}</label>
                        <input type="text" name="payroll_location_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="bank_id">{{ __('Bank Name') }}</label>
                        @if($bankLists)
                            <select name="bank_id" id="payroll_bank_id" class="form-control payrollBankId">
                                @foreach($bankLists as $bankList)
                                    <option value="{{ $bankList->id }}">{{ $bankList->bank_name }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>

                    <div class="form-group payrollBdtls">
                        <label for="bank_detail_id">{{ __('Bank Detail') }}</label>
                        <select name="bank_detail_id" id="payroll_bank_detail_id" class="form-control">
                        </select>
                    </div>

                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }} has-feedback">
                        <label for="status">{{ __('Publication Status') }} <span class="text-danger">*</span></label>
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
                    
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
