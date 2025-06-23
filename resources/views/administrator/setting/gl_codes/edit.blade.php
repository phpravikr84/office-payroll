@extends('administrator.master')
@section('title', __('Edit GL Code'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Edit GL Code') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('GL Code Management') }}</a></li>
            <li class="active">{{ __('Edit GL Code') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Edit GL Code') }}</h3>
            </div>
            <form action="{{ route('gl_codes.update', $glCode->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="gl_code">{{ __('GL Code') }}</label>
                        <input type="text" name="gl_code" class="form-control" value="{{ $glCode->gl_code }}" required>
                    </div>
                    <div class="form-group">
                        <label for="gl_name">{{ __('GL Name') }}</label>
                        <input type="text" name="gl_name" class="form-control" value="{{ $glCode->gl_name }}" required>
                    </div>

                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }} has-feedback">
                        <label for="status">{{ __('Status') }} <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{ $glCode->status == 1 ? 'selected' : '' }}>{{ __('Active') }}</option>
                            <option value="0" {{ $glCode->status == 0 ? 'selected' : '' }}>{{ __('Inactive') }}</option>
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