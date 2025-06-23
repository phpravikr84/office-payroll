@extends('administrator.master')
@section('title', __('Edit Bank'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Edit Bank') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Bank Management') }}</a></li>
            <li class="active">{{ __('Edit Bank') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Edit Bank') }}</h3>
            </div>
            <form action="{{ route('banks.update', $bank->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="bank_code">{{ __('Bank Code') }}</label>
                        <input type="text" name="bank_code" class="form-control" value="{{ $bank->bank_code }}" required>
                    </div>
                    <div class="form-group">
                        <label for="bank_name">{{ __('Bank Name') }}</label>
                        <input type="text" name="bank_name" class="form-control" value="{{ $bank->bank_name }}" required>
                    </div>

                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }} has-feedback">
                        <label for="status">{{ __('Publication Status') }} <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control">
                            <option value="" disabled>{{ __('Select one') }}</option>
                            <option value="1" {{ $bank->status == 1 ? 'selected' : '' }}>{{ __('Published') }}</option>
                            <option value="0" {{ $bank->status == 0 ? 'selected' : '' }}>{{ __('Unpublished') }}</option>
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
