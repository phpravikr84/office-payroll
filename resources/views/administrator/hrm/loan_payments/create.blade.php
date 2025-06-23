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
            <h1>Create Loan Payment</h1>

            <!-- Form to create a new loan payment -->
            <form action="{{ route('loan_payments.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="loan_code">Loan Code</label>
                    <input type="text" name="loan_code" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="loan_name">Loan Name</label>
                    <input type="text" name="loan_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="loan_amount">Loan Amount</label>
                    <input type="number" name="loan_amount" class="form-control" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="balance_amount">Balance Amount</label>
                    <input type="number" name="balance_amount" class="form-control" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="amount_to_pay">Amount to Pay</label>
                    <input type="number" name="amount_to_pay" class="form-control" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="repayment_paid_on">Repayment Paid On</label>
                    <input type="date" name="repayment_paid_on" class="form-control">
                </div>

                <div class="form-group">
                    <label for="payment_schedule">Payment Schedule</label>
                    <select name="payment_schedule" class="form-control">
                        <option value="1">Auto</option>
                        <option value="2">Manual</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="payment_status">Payment Status</label>
                    <select name="payment_status" class="form-control">
                        <option value="1">Success</option>
                        <option value="2">Hold</option>
                        <option value="3">Failure</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Create Loan Payment</button>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection

