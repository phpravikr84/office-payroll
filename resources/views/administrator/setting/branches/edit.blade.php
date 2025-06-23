@extends('administrator.master')
@section('title', __('Edit Branch'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Edit Branch') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Branch Management') }}</a></li>
            <li class="active">{{ __('Edit Branch') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Edit Branch') }}</h3>
            </div>
            <form action="{{ route('branches.update', $branch->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="branch_code">{{ __('Branch Code') }}</label>
                        <input type="text" name="branch_code" class="form-control" value="{{ $branch->branch_code }}" required>
                    </div>
                    <div class="form-group">
                        <label for="branch_name">{{ __('Branch Name') }}</label>
                        <input type="text" name="branch_name" class="form-control" value="{{ $branch->branch_name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="branch_address">{{ __('Branch Address') }}</label>
                        <textarea name="branch_address" class="form-control" rows="3" required>{{ $branch->branch_address }}</textarea>
                    </div>
                    
                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }} has-feedback">
                    <label for="status">{{ __('Publication Status') }} <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control">
                            <option value="" disabled>{{ __('Select one') }}</option>
                            <option value="1" {{ $branch->status==1 ? 'selected': ""}}>{{ __('Published') }}</option>
                            <option value="0" {{ $branch->status==0 ? 'selected': ""}}>{{ __('Unpublished') }}</option>
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
