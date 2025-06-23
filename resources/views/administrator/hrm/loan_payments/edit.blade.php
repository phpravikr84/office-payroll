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
            <h1>Edit Loan Payment</h1>

            <!-- Form to edit an existing loan payment -->
            <form action="{{ route('loan_payments.update', $loanManualPayment->id) }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="loan_id" value="{{ $loanManualPayment->id }}" />
                <input type="hidden" name="user_id" value="{{ $loanManualPayment->user_id }}" />
                <div class="form-group">
                    <label for="loan_code">Loan Code</label>
                    <input type="text" name="loan_code" class="form-control" value="{{ isset($loanManualPayment->loan_code) ?  $loanManualPayment->loan_code : '' }}" readonly>
                </div>

                <div class="form-group">
                    <label for="loan_name">Loan Name</label>
                    <input type="text" name="loan_name" class="form-control" value="{{ isset($loanManualPayment->loan_name) ? $loanManualPayment->loan_name : '' }}" readonly>
                </div>

                <div class="form-group">
                    <label for="loan_amount">Loan Amount</label>
                    <input type="number" name="loan_amount" class="form-control" value="{{ isset($loanManualPayment->loan_amount) ? $loanManualPayment->loan_amount : ''  }}" step="0.01" readonly>
                </div>

                <div class="form-group">
                    <label for="balance_amount">Balance Amount</label>
                    <input type="number" name="balance_amount" class="form-control" value="{{ isset($loanManualPayment->balance_amount) ? $loanManualPayment->balance_amount : $loanManualPayment->loan_amount }}" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="amount_to_pay">Amount to Pay</label>
                    <input type="number" name="amount_to_pay" class="form-control" value="" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="repayment_paid_on">Repayment Paid On</label>
                    <input type="date" name="repayment_paid_on" class="form-control" value="{{ isset($loanManualPayment->repayment_paid_on) ? $loanManualPayment->repayment_paid_on : '' }}">
                </div>

                @if(isset($loanManualPayment->payment_schedule))
                    <div class="form-group">
                        <label for="payment_schedule">Payment Schedule</label>
                        <select name="payment_schedule" class="form-control">
                            <option value="2" {{ $loanManualPayment->payment_schedule == 2 ? 'selected' : '' }}>Manual</option>
                        </select>
                    </div>
                @else
                <input type="hidden" name="payment_schedule" value="2" class="form-control">
                @endif
                @if(isset($loanManualPayment->payment_status))
                <div class="form-group">
                    <label for="payment_status">Payment Status</label>
                    <select name="payment_status" class="form-control">
                        <option value="1" {{ $loanManualPayment->payment_status == 1 ? 'selected' : '' }}>Success</option>
                        <option value="2" {{ $loanManualPayment->payment_status == 2 ? 'selected' : '' }}>Hold</option>
                        <option value="3" {{ $loanManualPayment->payment_status == 3 ? 'selected' : '' }}>Failure</option>
                    </select>
                </div>
                @else
                <div class="form-group">
                    <label for="payment_status">Payment Status</label>
                    <select name="payment_status" class="form-control">
                        <option value="1">Success</option>
                        <option value="2">Hold</option>
                        <option value="3">Failure</option>
                    </select>
                </div>
                @endif

                <button type="submit" class="btn btn-primary">Update Loan Payment</button>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection

