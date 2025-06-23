@extends('administrator.master')
@section('title', __('Add Currency'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Add Currency') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Currency Management') }}</a></li>
            <li class="active">{{ __('Add Currency') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Add Currency') }}</h3>
            </div>
            <form action="{{ route('currencies.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="currency_code">{{ __('Currency Code') }}</label>
                        <input type="text" name="currency_code" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="currency_name">{{ __('Currency Name') }}</label>
                        <input type="text" name="currency_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="exchange_rate">{{ __('Exchange Rate') }}</label>
                        <input type="number" name="exchange_rate" class="form-control" step="0.000001" required>
                    </div>
                    <div class="form-group">
                        <label for="exchange_currency">{{ __('Exchange Currency') }}</label>
                        <input type="text" name="exchange_currency" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="last_er_update">{{ __('Last ER Update') }}</label>
                        <input type="date" name="last_er_update" class="form-control" required>
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
