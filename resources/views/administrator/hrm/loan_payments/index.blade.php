@extends('administrator.master')
@section('title', __('Manage Loan Payment'))

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           {{ __('Loan Payment/Loan') }} 
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i>{{ __('Dashboard') }} </a></li>
            <li><a>{{ __('Loan Payment') }}</a></li>
            <li class="active">{{ __('Manage Loan Payment') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <h1>Loan Payments</h1>
            <a href="{{ route('loan_payments.create') }}" class="btn btn-primary">Create Loan Payment</a>
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Loan Code</th>
                        <th>Loan Name</th>
                        <th>Loan Amount</th>
                        <th>Balance Amount</th>
                        <th>Amount to Pay</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loanPayments as $loanPayment)
                        <tr>
                            <td>{{ $loanPayment->id }}</td>
                            <td>{{ $loanPayment->loan_code }}</td>
                            <td>{{ $loanPayment->loan_name }}</td>
                            <td>{{ $loanPayment->loan_amount }}</td>
                            <td>{{ $loanPayment->balance_amount }}</td>
                            <td>{{ $loanPayment->amount_to_pay }}</td>
                            <td>
                                <a href="{{ route('loan_payments.edit', $loanPayment->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('loan_payments.destroy', $loanPayment->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
