@extends('administrator.master')
@section('title', __('Generate Payslip'))

@section('main_content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     {{ __('GENERATE PAYSLIP') }} 
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i>{{ __('Dashboard') }} </a></li>
      <li><a>{{ __('Salary') }}</a></li>
      <li class="active">{{ __('Generate Payslip') }}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">

      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">{{ __('Manage Salary Payment') }}</h3>
          </div>
          <div class="box-body">
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
              @endif
            </div>
            <!-- /.Notification Box -->
            <div class="col-md-12">
              <form class="form-horizontal" action="{{ url('/hrm/generate-payslips/') }}" method="post">
                {{ csrf_field() }}

                <!-- /.end group -->
                <div class="form-group{{ $errors->has('salary_month') ? ' has-error' : '' }}">
                  <!-- <label for="salary_month" class="col-sm-3 control-label">{{ __('Select Month') }}</label> -->
                  <div class="col-sm-6">
                    <div class="input-group date">
                      <!-- <div class="input-group-addon"><i class="fa fa-calendar"></i></div> -->
                      <input type="hidden" name="salary_month" id="monthpicker2" class="form-control pull-right" value="{{ $salary_month }}">
                      @if ($errors->has('salary_month'))
                      <span class="help-block">
                        <!-- <strong>{{ $errors->first('salary_month') }}</strong> -->
                      </span>
                      @endif
                    </div>
                  </div>
                </div>
                <!-- /.end group -->
                <div class="form-group">
                  <!-- <div class="col-sm-offset-3 col-sm-10">
                    <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-arrow-right"></i> {{ __('GO') }}</button>
                  </div> -->
                </div>
                <!-- /.end group -->
              </form>
              <!-- /. end form -->
            </div>
            <!-- /. end col -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix"></div>
          <!-- /.box-footer -->
        </div>
        <!-- /.box -->
      </div>

      <div class="col-md-12">
        <!-- Default box -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">{{ __('Employee Details') }}</h3>
          </div>
          <div class="box-body">
            <!-- Notification Box -->
            <div class="col-md-12">
              <table id="example1" class="table table-bordered">
               <tr class="bg-info">
                <th>{{ __('sl#') }}</th>
                <th>{{ __('Employee Name') }}</th>
                <th>{{ __('Designation') }}</th>
                <th>{{ __('Salary Month') }}</th>
                <th>{{ __('Gross Salary') }}</th>
                <th>{{ __('Total Deduction') }}</th>
                <th>{{ __('Net Salary') }}</th>
                <th>{{ __('Provident Fund') }}</th>
                <th>{{ __('Payment Status') }}</th>
              </tr>
              @php($sl = 1)
              @foreach($employees as $employee)
              <tr>
                <td>{{ $sl++ }}</td>
                <td>{{ $employee['name'] }}</td>
                <td>{{ $employee['designation'] }}</td>
                <td>{{ date("F Y", strtotime($salary_month)) }}</td>
                @php($debits = 0)
                @php($credits = 0)

                @php($credits += ($employee['basic_salary'] + $employee['house_rent_allowance'] + $employee['medical_allowance'] + $employee['special_allowance'] + $employee['other_allowance']))
                @php($debits += $employee['tax_deduction_a'] + $employee['provident_fund_deduction'] + $employee['other_deduction'])

                @foreach($bonuses as $bonus)
                @if($employee['user_id'] == $bonus['user_id'])
                @php($credits += $bonus['bonus_amount'])
                @endif
                @endforeach

                @foreach($deductions as $deduction)
                @if($employee['user_id'] == $deduction['user_id'])
                @php($debits += $deduction['deduction_amount'])
                @endif
                @endforeach

                @foreach($loans as $loan)
                @if($employee['user_id'] == $loan['user_id'])
                @php($installment = $loan['loan_amount'] / $loan['remaining_installments'])
                @php($debits += $installment)
                @endif
                @endforeach

                <td>{{ number_format($credits, 2, '.', ',') }}</td>
                <td>{{ number_format($debits, 2, '.', ',') }}</td>
                <td>{{ number_format($credits - $debits, 2, '.', ',') }}</td>
                <td>{{ number_format($employee['provident_fund_contribution'] + $employee['provident_fund_deduction'], 2, '.', ',') }}</td>

                <td>
                  @if(!empty($salary_payments))
                    @php($status = 0)
                    @foreach($salary_payments as $salary_payment)
                      @if($salary_payment['user_id'] == $employee['user_id'])
                        @php($status = 1)
                      @endif
                    @endforeach
                    @if($status == 1)
                      <p class="text-success">{{ __('Paid') }}</p>
                    @else
                      <a href="{{ url('hrm/salary-payments/manage-salary/' . $employee['user_id'] . '/' . $salary_month) }}"><p class="text-danger">{{ __('Make payment') }}</p></a>
                    @endif
                  @else
                    <a href="{{ url('hrm/salary-payments/manage-salary/' . $employee['user_id'] . '/' . $salary_month) }}"><p class="text-danger">{{ __('Make payment') }}</p></a>
                  @endif
                </td>
              </tr>
              @endforeach
            </table>
          </div>
          <!-- /. end col -->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.end.col -->
  </div>
  <!-- /.end.row -->
</section>
<!-- /.content -->
</div>
@endsection