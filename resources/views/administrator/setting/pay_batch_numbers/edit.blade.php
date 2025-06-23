@extends('administrator.master')
@section('title', __('Edit Pay Batch Number'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Edit Pay Batch Number') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Pay Batch Management') }}</a></li>
            <li class="active">{{ __('Edit Pay Batch Number') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Edit Pay Batch Number') }}</h3>
            </div>
            <form action="{{ route('pay_batch_numbers.update', $payBatchNumber->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="pay_batch_number_code">{{ __('Batch Number Code') }}</label>
                        <input type="text" name="pay_batch_number_code" class="form-control" value="{{ $payBatchNumber->pay_batch_number_code }}" required>
                    </div>
                    <div class="form-group">
                        <label for="pay_batch_number_name">{{ __('Batch Number Name') }}</label>
                        <input type="text" name="pay_batch_number_name" class="form-control" value="{{ $payBatchNumber->pay_batch_number_name }}" required>
                    </div>

                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }} has-feedback">
                        <label for="status">{{ __('Publication Status') }} <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{ $payBatchNumber->status == 1 ? 'selected' : '' }}>{{ __('Published') }}</option>
                            <option value="0" {{ $payBatchNumber->status == 0 ? 'selected' : '' }}>{{ __('Unpublished') }}</option>
                        </select>
                        @if ($errors->has('status'))
                        <span class="help-block">
                            <strong>{{ $errors->first('status') }}</strong>
                        </span>
                        @endif
                    </div>
                    
                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
