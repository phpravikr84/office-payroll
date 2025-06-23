@extends('administrator.master')
@section('title', __('Edit Pay Accumulator'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Edit Pay Accumulator') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Pay Accumulator Management') }}</a></li>
            <li class="active">{{ __('Edit Pay Accumulator') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Edit Pay Accumulator') }}</h3>
            </div>
            <form action="{{ route('pay_accumulators.update', $payAccumulator->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="pay_accumulator_code">{{ __('Pay Accumulator Code') }}</label>
                        <input type="text" name="pay_accumulator_code" class="form-control" value="{{ $payAccumulator->pay_accumulator_code }}" required>
                    </div>
                    <div class="form-group">
                        <label for="pay_accumulator_name">{{ __('Pay Accumulator Name') }}</label>
                        <input type="text" name="pay_accumulator_name" class="form-control" value="{{ $payAccumulator->pay_accumulator_name }}" required>
                    </div>

                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }} has-feedback">
                        <label for="status">{{ __('Status') }} <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{ $payAccumulator->status == 1 ? 'selected' : '' }}>{{ __('Active') }}</option>
                            <option value="0" {{ $payAccumulator->status == 0 ? 'selected' : '' }}>{{ __('Inactive') }}</option>
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
