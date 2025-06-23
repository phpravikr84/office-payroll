@extends('administrator.master') 
@section('title', __('Employee Superannuation Report'))

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ __('Employee Superannuation Report') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a>{{ __('Employee Superannuation Report') }}</a></li>
            <li class="active">{{ __('Superannuation Report') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Employee Superannuation Report') }}</h3>
            </div>
            <div class="card-body">
                <!-- Action Buttons -->
                <div class="row mb-3">
                    <div class="col-md-8">
                        <form name="employee_superannuation_report" method="post" action="{{ route('superannuation.report_show') }}" class="row g-2 align-items-center">
                            {{ csrf_field() }}
                            <div class="col-md-8">
                                <select name="user_id" class="form-control">
                                    <option selected disabled>{{ __('Select One') }}</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ $employee->id == $selectedEmployee ? 'selected' : '' }}>{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="icon fa fa-arrow-right"></i>
                                    <span>{{ __('Go') }}</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-4 text-end">
                        <button type="button" class="btn btn-primary" title="{{ __('Print') }}" onclick="printDiv('printable_area')">
                            <i class="fa fa-print"></i>
                            <span>{{ __('Print') }}</span>
                        </button>
                    </div>
                </div>


                <!-- Employee Table -->
                <div id="printable_area" class="table-responsive">
                    <table class="datatable table table-bordered table-striped">
                        <thead class="table-primary">
                            <tr>
                                <th>{{ __('SL#') }}</th>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Employee Name') }}</th>
                                <th>{{ __('Employee Superannuation Name') }}</th>
                                <th>{{ __('Employee Contribution Amount') }}</th>
                                <th>{{ __('Employer Contribution Amount') }}</th>
                                <th class="text-center">{{ __('Date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $sl = 1; @endphp
                            @if($superannuationData)
                                @foreach($superannuationData as $superannuation)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>EMPID{{ $superannuation->employee_id }}</td>
                                        <td>{{ $superannuation->employee_name }}</td>
                                        <td>{{ $superannuation->superannuation_name }}</td>
                                        <td>{{ $superannuation->super_employee_amount }}</td>
                                        <td>{{ $superannuation->super_employer_amount }}</td>
                                        <td class="text-center">{{ date("d F Y", strtotime($superannuation->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">{{ __('No Report record found!') }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
