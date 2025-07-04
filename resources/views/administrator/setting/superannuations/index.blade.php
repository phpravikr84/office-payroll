@extends('administrator.master')
@section('title', __('Superannuation List'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Superannuation List') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Superannuation Management') }}</a></li>
            <li class="active">{{ __('Superannuation List') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row mb-3 mt-3">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('Superannuation List') }}</h3>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <a href="{{ route('superannuations.create') }}" class="btn btn-primary">{{ __('Add Superannuation') }}</a>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col-12">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('Code') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Employer Contribution (%)') }}</th>
                                    <th>{{ __('Employer Contribution (Fixed Amount)') }}</th>
                                    <th>{{ __('Bank Transfer Included') }}</th>
                                    <th>{{ __('Bank Account Number') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($superannuations as $superannuation)
                                    <tr>
                                        <td>{{ $superannuation->code }}</td>
                                        <td>{{ $superannuation->name }}</td>
                                        <td>{{ $superannuation->employer_contribution_percentage }}%</td>
                                        <td>{{ $superannuation->employer_contribution_fixed_amount }}</td>
                                        <td>{{ $superannuation->included_bank_transfer ? __('Yes') : __('No') }}</td>
                                        <td>{{ $superannuation->bank_account_number }}</td>
                                        <td>{{ $superannuation->status == 1 ? __('Active') : __('Inactive') }}</td>
                                        <td>
                                            <a href="{{ route('superannuations.edit', $superannuation->id) }}" class="btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('superannuations.destroy', $superannuation->id) }}" method="POST" style="display:inline;">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            <div>
        </div>
    </section>
</div>
@endsection
