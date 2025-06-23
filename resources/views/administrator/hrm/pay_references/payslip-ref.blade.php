@extends('administrator.master')
@section('title', __('Pay References'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Payslip References') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li class="active">{{ __('Payslip References') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <h3>{{ __('Manage Payslip References') }}</h3>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pay Reference Name</th>
                                <th>Pay Period Start Date</th>
                                <th>Pay Period End Date</th>
                                <th>Branch</th>
                                <th>Pay Batch</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pay_references as $pay_reference)
                                @php
                                    switch($pay_reference->payref_status){
                                        case 1:
                                            $status = "New";
                                            break;
                                        case 2:
                                            $status = "Processing";
                                            break;
                                        case 3:
                                            $status = "Complete";
                                            break;
                                        case 4:
                                            $status = "Cancel";
                                            break;
                                        default:
                                            $status = '';
                                    }
                                @endphp;
                                <tr>
                                    <td>{{ $pay_reference->id }}</td>
                                    <td>{{ $pay_reference->pay_reference_name }}</td>
                                    <td>{{ $pay_reference->pay_period_start_date }}</td>
                                    <td>{{ $pay_reference->pay_period_end_date }}</td>
                                    <td>{{ $pay_reference->branch_name }}</td>
                                    <td>{{ $status }}</td>
                                    <td>{{ $pay_reference->payroll_number }}</td>
                                    <td>
                                        @if($status!='Cancel')
                                            <a href="{{ route('pay_references.payref.allpayslips', $pay_reference->id) }}" class="btn btn-success btn-sm">{{ __('View all payslips') }}</a>
                                        @else
                                            <span class="badge badge-danger">Payref Rejected</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
