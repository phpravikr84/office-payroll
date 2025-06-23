<!-- resources/views/loan_master/create.blade.php -->

@extends('administrator.master')

@section('title', __('Create Loan'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Loan Master Management') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Settings') }}</a></li>
            <li><a href="{{ route('loan_master.index') }}">{{ __('Loan Master') }}</a></li>
            <li class="active">{{ __('Create Loan') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <h3>Add New Loan</h3>
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
                                <p class="text-yellow">{{ __('Enter personal_event details. All field are required.') }} </p>
                            @endif

                <form action="{{ route('loan_master.store') }}" method="POST">
                {{ csrf_field() }}

                    <div class="form-group">
                        <label for="loan_code">{{ __('Loan Code') }}</label>
                        <input type="text" name="loan_code" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="loan_name">{{ __('Loan Name') }}</label>
                        <input type="text" name="loan_name" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Loan</button>
                    <a href="{{ route('loan_master.index') }}" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection