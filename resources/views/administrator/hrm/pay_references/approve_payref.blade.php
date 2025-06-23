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
                <h3 class="box-title">{{ __('Manage Pay References') }}</h3>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('Pay Reference Name') }}</th>
                            <th>{{ __('Pay Period Start Date') }}</th>
                            <th>{{ __('Pay Period End Date') }}</th>
                            <th>{{ __('Branch') }}</th>
                            <th>{{ __('Pay Batch') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($pay_references as $pay_reference)

                            <tr>
                                <td>{{ $pay_reference->id }}</td>
                                <td>{{ $pay_reference->pay_reference_name }}</td>
                                <td>{{ $pay_reference->pay_period_start_date }}</td>
                                <td>{{ $pay_reference->pay_period_end_date }}</td>
                                <td>{{ $pay_reference->branch_name }}</td>
                                <td>{{ $pay_reference->payroll_number }}</td>
                                <td>
                                    @if($pay_reference->payref_status!=4)
                                        @if($pay_reference->payref_finalStatus==0)
                                        <form id="waitingConfirmForm" action="{{ route('pay_references.pay_references_approved', $pay_reference->id) }}" method="GET">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="pay_ref_id" value="{{ $pay_reference->id }}" />
                                            <button data-id="{{ $pay_reference->id }}" class="btn btn-warning btn-sm waitingConfirm" data-payrefid="{{ $pay_reference->id }}">{{ __('Waiting for approve payref') }}</button>
                                        </form>
                                        @else
                                        <form id="rejectConfirmForm" action="{{ route('pay_references.pay_references_rejected', $pay_reference->id) }}" method="GET">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="pay_ref_id" value="{{ $pay_reference->id }}" />
                                            <button data-payrefid="{{ $pay_reference->id }}" class="btn btn-danger btn-sm rejectConfirm">{{ __('Do you want disapprove payref') }}</button>
                                        </form>
                                        @endif
                                    @else
                                    <span class="badge badge-danger">Payref Rejected</span>
                                    @endif
                                    <!-- Uncomment below form if you need delete functionality
                                    <form action="{{ route('pay_references.destroy', $pay_reference->id) }}" method="POST" style="display:inline-block;">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('Are you sure you want to delete this pay reference?') }}')">{{ __('Delete') }}</button>
                                    </form>
                                    -->
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
