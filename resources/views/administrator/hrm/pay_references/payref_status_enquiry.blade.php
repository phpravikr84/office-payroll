@extends('administrator.master')
@section('title', __('Pay References'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Pay References') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li class="active">{{ __('Pay References') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Payref Status Enquiry') }}</h3>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="box-body">
                <table id="payReferencesTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('Pay Reference Name') }}</th>
                            <th>{{ __('Pay Period Start Date') }}</th>
                            <th>{{ __('Pay Period End Date') }}</th>
                            <th>{{ __('Branch') }}</th>
                            <th>{{ __('Pay Batch') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Payroll Year') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pay_references as $pay_reference)
                            @php
                                switch($pay_reference->payref_status){
                                    case 1:
                                        $status = 'New';
                                        break;
                                    case 2:
                                        $status = 'Processing';
                                        break;
                                    case 3:
                                        $status = 'Complete';
                                        break;
                                    case 4:
                                        $status = 'Cancel';
                                        break;
                                    default:
                                        $status = '';
                                }
                            @endphp
                            <tr>
                                <td>{{ $pay_reference->id }}</td>
                                <td>{{ $pay_reference->pay_reference_name }}</td>
                                <td>{{ $pay_reference->pay_period_start_date }}</td>
                                <td>{{ $pay_reference->pay_period_end_date }}</td>
                                <td>{{ $pay_reference->branch_name }}</td>
                                <td>{{ $pay_reference->payroll_number }}</td>
                                <td>{{ $status }}</td>
                                <td>{{ \Carbon\Carbon::parse($pay_reference->pay_period_end_date)->format('Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!-- DataTables Scripts -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#payReferencesTable').DataTable({
            "paging": true,      // Enable pagination
            "searching": true,   // Enable searching
            "order": [[0, "asc"]] // Optional: default order by ID
        });
    });
</script>
@endsection
