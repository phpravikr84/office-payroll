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
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td>ID: {{ $pay_reference->id }}</td>
                        <td>{{ __('Pay Reference Name') }} : {{ $pay_reference->pay_reference_name }}</td>
                        <td>{{ __('Pay Period Start Date') }} : {{ $pay_reference->pay_period_start_date }}</td>
                        <td>{{ __('Pay Period End Date') }} : {{ $pay_reference->pay_period_end_date }}</td>
                        <td>{{ __('Branch') }} : {{ $pay_reference->branch_name }}</td>
                        <td>{{ __('Pay Batch') }} : {{ $pay_reference->pay_batch_number_name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="content">
        <!-- Print All Button -->
        <div class="row">
            <div class="col-12 mb-4 mt-4">
                <h3>{{ __('Manage Payslip References') }}</h3>
                <button class="btn btn-primary mb-3" onclick="printAllPayslips()">Print All Payslips</button>
                <button class="btn btn-primary mb-3" onclick="window.location.href='{{ route('pay_references.export.payslips', ['pay_reference_id' => $pay_reference->id]) }}'">Export Payslips </button>
            </div>

            <div class="col-12">
                @foreach ($payrefEmplPayslips as $payslip)
                <div class="card mb-4" id="payslip-{{ $payslip['employee_id'] }}" style="border: none; border-bottom: 2px dotted #ccc; padding-bottom: 20px;">
                    <!-- Payslip Header -->
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="http://localhost/payhours_new/public/backend/images/logo.svg" alt="Logo" width="150">
                            </div>
                            <div class="col-md-6 text-right">
                                <strong>Adzguru (PNG) Ltd</strong><br>
                                Level 2, Crown Hotel, Port Moresby,<br>
                                Papua New Guinea<br>
                                +675 81396890, +675 81396891<br>
                                reachus@adzguru.co
                            </div>
                        </div>
                        <hr>
                        <h3>Payment Slip for {{ $payslip['employee_name'] }}</h3>
                        <p><strong>Pay Period:</strong> {{ $payslip['pay_period_start'] }} to {{ $payslip['pay_period_end'] }} ({{ \Carbon\Carbon::parse($payslip['pay_period_start'])->format('F') }})</p>
                    </div>

                    <!-- Payslip Body -->
                    <div class="card">
                        <div class="card-header">
                            <h3>Payment Slip</h3>
                        </div>
                        <div class="card-body">
                            <!-- Employee Info -->
                            <div class="row">
                                <span class="col-md-6" id="recordid">
                                    <strong>Employee ID:</strong> {{ $payslip['employee_id'] }}
                                </span>
                                <h3>{{ $payslip['employee_name'] }}</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Salary Month:</strong> {{ $payslip['pay_period_start'] }} to {{ $payslip['pay_period_end'] }}</p>
                                </div>
                            </div>

                            <!-- Payment Table -->
                            <div class="col-md-12" id="div_pay">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Total Working Hours</td>
                                                <td>{{ $payslip['total_working_days'] }} {{ $payslip['total_working_days'] > 1 ? 'days' : 'day' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Salary Calculated (before deductions)</td>
                                                <td>{{ $payslip['totalSalaryFormatted'] }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Benefits</strong></td>
                                                <td></td>
                                            </tr>

                                            <!-- Benefits section with conditional rendering and rounding -->
                                            @if(!empty($payslip['house_rent_allowance']) && $payslip['house_rent_allowance'] != 0)
                                                <tr>
                                                    <td>House Rent Allowance</td>
                                                    <td>{{ round($payslip['house_rent_allowance'], 2) }}</td>
                                                </tr>
                                            @endif
                                            @if(!empty($payslip['medical_allowance']) && $payslip['medical_allowance'] != 0)
                                                <tr>
                                                    <td>Medical Allowance</td>
                                                    <td>{{ round($payslip['medical_allowance'], 2) }}</td>
                                                </tr>
                                            @endif
                                            @if(!empty($payslip['special_allowance']) && $payslip['special_allowance'] != 0)
                                                <tr>
                                                    <td>Special Allowance</td>
                                                    <td>{{ round($payslip['special_allowance'], 2) }}</td>
                                                </tr>
                                            @endif
                                            @if(!empty($payslip['other_allowance']) && $payslip['other_allowance'] != 0)
                                                <tr>
                                                    <td>Other Allowance</td>
                                                    <td>{{ round($payslip['other_allowance'], 2) }}</td>
                                                </tr>
                                            @endif
                                            @if(!empty($payslip['electricity_allowance']) && $payslip['electricity_allowance'] != 0)
                                                <tr>
                                                    <td>Electricity Allowance</td>
                                                    <td>{{ round($payslip['electricity_allowance'], 2) }}</td>
                                                </tr>
                                            @endif
                                            @if(!empty($payslip['security_allowance']) && $payslip['security_allowance'] != 0)
                                                <tr>
                                                    <td>Security Allowance</td>
                                                    <td>{{ round($payslip['security_allowance'], 2) }}</td>
                                                </tr>
                                            @endif
                                            @if(!empty($payslip['totalVehicleAllowance']) && $payslip['totalVehicleAllowance'] != 0)
                                                <tr>
                                                    <td>Total Vehicle Allowance</td>
                                                    <td>{{ round($payslip['totalVehicleAllowance'], 2) }}</td>
                                                </tr>
                                            @endif
                                            @if(!empty($payslip['meals_allowance']) && $payslip['meals_allowance'] != 0)
                                                <tr>
                                                    <td>Meals Allowance</td>
                                                    <td>{{ round($payslip['meals_allowance'], 2) }}</td>
                                                </tr>
                                            @endif

                                            <tr>
                                                <td><strong>Total Benefits</strong></td>
                                                <td><strong>{{ round($payslip['totalBenefits'], 2) }}</strong></td>
                                            </tr>

                                            <!-- Additional pay items if available -->
                                            @if($payslip['payItems'])
                                                @foreach($payslip['payItems'] as $payItem)
                                                    <tr>
                                                        <td>{{ $payItem->code . '-' . $payItem->name }}</td>
                                                        <td>{{ round($payItem->payitem_amount, 2) }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                              <!-- Deductions section with conditional rendering and rounding -->
                                              @if(!empty($payslip['lateDeduction']) && $payslip['lateDeduction'] != 0)
                                                <tr>
                                                    <td><strong>Late Deduction</strong></td>
                                                    <td><strong>-{{ round($payslip['lateDeduction'], 2) }}</strong></td>
                                                </tr>
                                            @endif

                                            @if(!empty($payslip['sandwichLeaveDeduction']) && $payslip['sandwichLeaveDeduction'] != 0)
                                                <tr>
                                                    <td>Sandwich Leave Deduction</td>
                                                    <td>-{{ round($payslip['sandwichLeaveDeduction'], 2) }}</td>
                                                </tr>
                                            @endif
                                            @if(!empty($payslip['unpaidLeaveDeduction']) && $payslip['unpaidLeaveDeduction'] != 0)
                                                <tr>
                                                    <td>Unpaid Leave Deduction</td>
                                                    <td>-{{ round($payslip['unpaidLeaveDeduction'], 2) }}</td>
                                                </tr>
                                            @endif

                                            <tr>
                                                <td><strong>Taxable Income</strong></td>
                                                <td><strong>{{ round($payslip['grossSalary'], 2) }}</strong></td>
                                            </tr>

                                            <tr>
                                                <td><strong>Deductions</strong></td>
                                                <td></td>
                                            </tr>

                                          
                                           
                                            @if(!empty($payslip['dependents']) && $payslip['dependents'] != 0)
                                                <tr>
                                                    <td><strong>Dependents  - {{ $payslip['dependents'] }} Rebate  <br/><em>*Amount deducted in calculated tax.</em></strong></td>
                                                    <td><strong>{{ round($payslip['dependentRebate'], 2) }}</strong></td>
                                                </tr>
                                            @endif
                                            @if(!empty($payslip['totalCalculatedTax']) && $payslip['totalCalculatedTax'] != 0)
                                                <tr>
                                                    <td>Net Tax</td>
                                                    <td>{{ round($payslip['totalCalculatedTax'], 2) }}</td>
                                                </tr>
                                            @endif
                                            @if(!empty($payslip['loan_deduction_installment']) && $payslip['loan_deduction_installment'] != 0)
                                                <tr>
                                                    <td>Loan Installment (If any)</td>
                                                    <td>{{ round($payslip['loan_deduction_installment'], 2) }}</td>
                                                </tr>
                                            @endif

                                            @if(!empty($payslip['super_employee_amount']) && $payslip['super_employee_amount'] != 0)
                                                <tr>
                                                    <td>Superannuation: {{ $payslip['superannuationDtls'] }}<br/>
                                                        <br/><em>(excluding overtime, bonus, and <br/>commission for superannuation contribution)</em>
                                                    </td>
                                                    <td>{{ round($payslip['super_employee_amount'], 2) }}</td>
                                                </tr>
                                            @endif

                                            @if(!empty($payslip['super_employer_amount']) && $payslip['super_employer_amount']!=0)
                                            <tr>
                                                    <td>Superannuation: Employer Contribution<br/>
                                                        <br/><em>*Amount not be adjust in payslip.</em>
                                                    </td>
                                                    <td>{{ round($payslip['super_employer_amount'], 2) }}</td>
                                                </tr>
                                            @endif

                                            <tr>
                                                <td><strong>Net Payable</strong></td>
                                                <td>
                                                    <strong>{{ round($payslip['totalPayable'], 2) }}</strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Print Individual Payslip Button -->
                                <button class="btn btn-primary mt-3 d-print-none" onclick="printPayslip('{{ $payslip['employee_id'] }}')">
                                    Print Payslip
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

<!-- JavaScript to handle individual and "Print All" functionality -->
<script>
    function printPayslip(employeeId) {
        var printContents = document.getElementById('payslip-' + employeeId).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }

    function printAllPayslips() {
        var printContents = '';
        @foreach ($payrefEmplPayslips as $payslip)
            printContents += document.getElementById('payslip-{{ $payslip['employee_id'] }}').innerHTML + '<hr>';
        @endforeach

        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>
@endsection
