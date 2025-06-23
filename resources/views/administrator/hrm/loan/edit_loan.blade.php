@extends('administrator.master')
@section('title', __('Edit Loan'))

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           {{ __('LOAN') }} 
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a href="{{ url('/hrm/loans') }}">{{ __('Manage Loans') }}</a></li>
            <li class="active">{{ __('Edit Loan') }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Edit Loan') }}</h3>
            </div>
            <!-- /.box-header -->
            <form action="{{ url('/hrm/loans/update/' . $loan['id']) }}" method="post" name="loan_edit_form">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="row">
                        <!-- Notification Box -->
                        <div class="col-md-12">
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
                                <p class="text-yellow">{{ __('Enter loan details. All field are required.') }} </p>
                            @endif
                        </div>
                        <!-- /.Notification Box -->

                        <div class="col-md-6">
                            <!-- Employee Name -->
                            <label for="user_id">{{ __('Employee Name') }} <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }} has-feedback">
                                <select name="user_id" id="user_id" class="form-control">
                                    <option value="" selected disabled>{{ __('Select one') }}</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user['id'] }}" {{ $loan['user_id'] == $user['id'] ? 'selected' : '' }}>
                                            {{ $user['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('user_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('user_id') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

                            <!-- Loan Name -->
                            <label for="loan_name">{{ __('Loan Name') }} <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('loan_name') ? ' has-error' : '' }} has-feedback">
                                <select name="loan_name" id="loan_name" class="form-control">
                                    <option value="" selected disabled>{{ __('Select one') }}</option>
                                    @foreach($loan_masters as $loan_master)
                                        <option value="{{ $loan_master->id }}" {{ $loan['loan_master_id'] == $loan_master->id ? 'selected' : '' }}>
                                            {{ $loan_master->loan_code }} - {{ $loan_master->loan_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('loan_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('loan_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

                            <label for="loan_date">{{ __('Loan Date') }} <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('loan_date') ? ' has-error' : '' }} has-feedback">
                                    <input type="date" name="loan_date" class="form-control pull-right" value="{{ $loan['loan_date'] }}" id="loan_date" placeholder="{{ __('Enter loan date') }}">
                                @if ($errors->has('number_of_installments'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('number_of_installments') }}</strong>
                                </span>
                                @endif
                            </div>
                           
                            <!-- Deduction Start Date -->
                            <label for="deduction_start_date">{{ __('Deduction Start Date') }} <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('deduction_start_date') ? ' has-error' : '' }} has-feedback">
                                <input type="date" name="deduction_start_date" class="form-control pull-right" value="{{ $loan['deduction_start_date'] }}" id="deduction_start_date" placeholder="{{ __('Enter deduction start date') }}">
                                @if ($errors->has('deduction_start_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('deduction_start_date') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

                             <!-- Loan Amount -->
                             <label for="loan_amount">{{ __('Loan Amount') }} <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('loan_amount') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="loan_amount" id="loan_amount" class="form-control" value="{{ $loan['loan_amount'] }}" placeholder="{{ __('Enter loan amount') }}">
                                @if ($errors->has('loan_amount'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('loan_amount') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->


                            <!-- Deduction Amount -->
                            <label for="deduction_amount">{{ __('Deduction Amount ') }}<span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('deduction_amount') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="deduction_amount" id="deduction_amount"  onmouseout="outstandingAmount()" class="form-control" value="{{ $loan['deduction_amount'] }}" placeholder="{{ __('Enter Deduction loan amount..') }}">
                                @if ($errors->has('deduction_amount'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('deduction_amount') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

                            <!-- Outstanding Amount -->
                            <label for="outstanding_amount">{{ __('Outstanding Amount') }} <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('outstanding_amount') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="outstanding_amount" id="outstanding_amount" class="form-control" value="{{ $loan['outstanding_amount'] }}" placeholder="{{ __('Enter outstanding amount') }}">
                                @if ($errors->has('outstanding_amount'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('outstanding_amount') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

                            <!-- Number of Installments -->
                            <label for="number_of_installments">{{ __('Number of Installments') }} <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('number_of_installments') ? ' has-error' : '' }} has-feedback">
                                <input type="text" name="number_of_installments" class="form-control" value="{{ $loan['number_of_installments'] }}" id="number_of_installments">
                                @if ($errors->has('number_of_installments'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('number_of_installments') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->

                            <!-- Loan Description -->
                            <label for="loan_description">{{ __('Loan Description') }} <span class="text-danger">*</span></label>
                            <div class="form-group{{ $errors->has('loan_description') ? ' has-error' : '' }} has-feedback">
                                <textarea class="form-control" name="loan_description" id="loan_description" placeholder="{{ __('Enter loan description') }}">{{ $loan['loan_description'] }}</textarea>
                                @if ($errors->has('loan_description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('loan_description') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ url('/hrm/loans') }}" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i> {{ __('Cancel') }}</a>
                    <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-save"></i> {{ __('Update Loan') }}</button>
                </div>
            </form>

        </div>
        <!-- /.box -->


    </section>
    <!-- /.content -->
</div>
<script type="text/javascript">
    document.forms['loan_add_form'].elements['user_id'].value = "{{ $loan['user_id'] }}";

    // Get Outstanding Amount
    function outstandingAmount() {
        // Get Loan Amount and Deduction Amount
        var loanAmt = document.getElementById('loan_amount').value;
        var deductionAmt = document.getElementById('deduction_amount').value;

        // Check if both values are provided and are numbers
        if (loanAmt && deductionAmt) {
            let outstandingAmt = parseFloat(loanAmt) - parseFloat(deductionAmt);

            // Check if the result is a valid number before assigning
            if (!isNaN(outstandingAmt)) {
                document.getElementById('outstanding_amount').value = outstandingAmt.toFixed(2);
            }

            //Get No of installment
            var numOfInstallments = loanAmt / deductionAmt;
            //console.log('No of Installments'+numOfInstallments);
            // Check if the result is a valid number before assigning
            if (!isNaN(numOfInstallments)) {
                document.getElementById('number_of_installments').value = Math.floor(numOfInstallments);
                document.getElementById('number_of_installments').selectedIndex = Math.floor(numOfInstallments);
            }
        }
    } 
</script>
@endsection
