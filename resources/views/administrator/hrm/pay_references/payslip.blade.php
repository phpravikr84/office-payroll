
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3>Payment Slip</h3>
                                                </div>
                                                <div class="card-body">
                                                    <!-- Employee Info -->
                                                    <div class="row">
                                                        <span class="col-md-6" id="recordid">
                                                            <strong>Employee ID:</strong> {{ $employee_id }}
                                                        </span>
                                                        <h3>{{ $employee_name }}</h3>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p><strong>Salary Month:</strong> {{ $pay_period_start }} to {{ $pay_period_end }}</p>
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
                                                                        <td>Total Working Days</td>
                                                                        <!-- <td>{{ $daysRounded }} {{ $daysRounded > 1 ? 'days (approx)' : 'day (approx)' }} <em>( {{ $totalHoursFormatted }} hours )</em></td> -->
                                                                        <td>{{ $daysRounded }} {{ $daysRounded > 1 ? 'days' : 'day' }} </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Salary Calculated (before deductions)</td>
                                                                        <td>{{ $totalSalaryFormatted }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Benefits</strong></td>
                                                                        <td></td>
                                                                    </tr>

                                                                    <!-- Benefits section with conditional rendering and rounding -->
                                                                    @if(!empty($house_rent_allowance) && $house_rent_allowance != 0)
                                                                        <tr>
                                                                            <td>House Rent Allowance</td>
                                                                            <td>{{ round($house_rent_allowance, 2) }}</td>
                                                                        </tr>
                                                                    @endif
                                                                    @if(!empty($medical_allowance) && $medical_allowance != 0)
                                                                        <tr>
                                                                            <td>Medical Allowance</td>
                                                                            <td>{{ round($medical_allowance, 2) }}</td>
                                                                        </tr>
                                                                    @endif
                                                                    @if(!empty($special_allowance) && $special_allowance != 0)
                                                                        <tr>
                                                                            <td>Special Allowance</td>
                                                                            <td>{{ round($special_allowance, 2) }}</td>
                                                                        </tr>
                                                                    @endif
                                                                    @if(!empty($other_allowance) && $other_allowance != 0)
                                                                        <tr>
                                                                            <td>Other Allowance</td>
                                                                            <td>{{ round($other_allowance, 2) }}</td>
                                                                        </tr>
                                                                    @endif
                                                                    @if(!empty($electricity_allowance) && $electricity_allowance != 0)
                                                                        <tr>
                                                                            <td>Electricity Allowance</td>
                                                                            <td>{{ round($electricity_allowance, 2) }}</td>
                                                                        </tr>
                                                                    @endif
                                                                    @if(!empty($security_allowance) && $security_allowance != 0)
                                                                        <tr>
                                                                            <td>Security Allowance</td>
                                                                            <td>{{ round($security_allowance, 2) }}</td>
                                                                        </tr>
                                                                    @endif
                                                                    @if(!empty($totalVechileAllowance) && $totalVechileAllowance != 0)
                                                                        <tr>
                                                                            <td>Total Vehicle Allowance</td>
                                                                            <td>{{ round($totalVechileAllowance, 2) }}</td>
                                                                        </tr>
                                                                    @endif
                                                                    @if(!empty($meals_allowance) && $meals_allowance != 0)
                                                                        <tr>
                                                                            <td>Meals Allowance</td>
                                                                            <td>{{ round($meals_allowance, 2) }}</td>
                                                                        </tr>
                                                                    @endif

                                                                    <tr>
                                                                        <td><strong>Total Benefits</strong></td>
                                                                        <td><strong>{{ round($totalBenefits, 2) }}</strong></td>
                                                                    </tr>

                                                                    <!-- Additional pay items if available -->
                                                                    @if($payItems)
                                                                        @foreach($payItems as $payItem)
                                                                            <tr>
                                                                                <td>{{ $payItem->code . '-' . $payItem->name }}</td>
                                                                                <td>{{ round($payItem->payitem_amount, 2) }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endif

                                                                    @if(!empty($lateDeduction) && $lateDeduction != 0)
                                                                        <tr>
                                                                            <td><strong>Late Deduction</strong></td>
                                                                            <td><strong>-{{ round($lateDeduction, 2) }}</strong></td>
                                                                        </tr>
                                                                    @endif
                                                                       <!-- Deductions section with conditional rendering and rounding -->
                                                                       @if(!empty($sandwichLeaveDeduction) && $sandwichLeaveDeduction != 0)
                                                                        <tr>
                                                                            <td>Sandwich Leave Deduction</td>
                                                                            <td>-{{ round($sandwichLeaveDeduction, 2) }}</td>
                                                                        </tr>
                                                                    @endif
                                                                    @if(!empty($unpaidLeaveDeduction) && $unpaidLeaveDeduction != 0)
                                                                        <tr>
                                                                            <td>Unpaid Leave Deduction</td>
                                                                            <td>-{{ round($unpaidLeaveDeduction, 2) }}</td>
                                                                        </tr>
                                                                    @endif
                                                                    <tr>
                                                                        <td><strong>Taxable Income</strong></td>
                                                                        <td><strong>{{ round($grossSalary, 2) }}</strong></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td><strong>Deductions</strong></td>
                                                                        <td></td>
                                                                    </tr>

                                                                 
                                                                    @if(!empty($grossTaxAmount) && $grossTaxAmount != 0)
                                                                        <tr>
                                                                            <td><strong>Gross Tax Amount</strong></td>
                                                                            <td><strong>{{ round($grossTaxAmount, 2) }}</strong></td>
                                                                        </tr>
                                                                    @endif
                                                                    @if(!empty($dependents) && $dependents != 0)
                                                                        <tr>
                                                                            <td><strong>Dependents  - {{ $dependents }} Rebate  <br/><em>*Amount deducted in calculated tax.</em></strong></td>
                                                                            <td><strong>{{ round($dependentRebate, 2) }}</strong></td>
                                                                        </tr>
                                                                    @endif
                                                                    @if(!empty($totalCalculatedTax) && $totalCalculatedTax != 0)
                                                                        <tr>
                                                                            <td>Net Tax</td>
                                                                            <td>{{ round($totalCalculatedTax, 2) }}</td>
                                                                        </tr>
                                                                    @endif
                                                                    @if(!empty($loan_deduction_installment) && $loan_deduction_installment != 0)
                                                                        <tr>
                                                                            <td>Loan Installment (If any)</td>
                                                                            <td>{{ round($loan_deduction_installment, 2) }}</td>
                                                                        </tr>
                                                                    @endif

                                                                    @if(!empty($employee_contribution) && $employee_contribution!=0)
                                                                    <tr>
                                                                            <td>Superannuation: {{ $superannuationDtls }}<br/>
                                                                                <br/><em>(excluding overtime, bonus, and <br/>commission for superannaution contribution)</em>
                                                                            </td>
                                                                            <td>{{ round($employee_contribution, 2) }}</td>
                                                                        </tr>
                                                                    @endif

                                                                    @if(!empty($employer_contribution) && $employer_contribution!=0)
                                                                    <tr>
                                                                            <td>Superannuation: Employer Contribution<br/>
                                                                                <br/><em>*Amount not be adjust in payslip.</em>
                                                                            </td>
                                                                            <td>{{ round($employer_contribution, 2) }}</td>
                                                                        </tr>
                                                                    @endif

                                                                    

                                                                    <tr>
                                                                        <td><strong>Net Payable</strong></td>
                                                                        <td>
                                                                            <strong>{{ round($totalPayable, 2) }}</strong>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
