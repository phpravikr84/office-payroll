@extends('administrator.master')
@section('title', __('Loan Master'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Loan Master Management') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Settings') }}</a></li>
            <li class="active">{{ __('Loan Master') }}</li>
        </ol>
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
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('loan_master.create') }}" class="btn btn-primary">Add Loan</a>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Loan Code</th>
                            <th>Loan Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loans as $loan)
                            <tr>
                                <td>{{ $loan->id }}</td>
                                <td>{{ $loan->loan_code }}</td>
                                <td>{{ $loan->loan_name }}</td>
                                <td>
                                    <a href="{{ route('loan_master.edit', $loan->id) }}" class="btn btn-info">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection