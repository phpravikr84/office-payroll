@extends('administrator.master')
@section('title', __('Salary Calculator'))

@section('main_content')
<style>
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
        padding: 1.25rem;
        border-radius: 10px 10px 0 0;
    }
    .card-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2c3e50;
    }
    .form-control, .form-select {
        border-radius: 6px;
        border: 1px solid #d1d9e6;
        padding: 0.5rem 0.75rem;
    }
    .form-control:focus, .form-select:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.2rem rgba(52,152,219,0.25);
    }
    .table {
        margin-bottom: 0;
        background-color: #fff;
    }
    .table th, .table td {
        vertical-align: middle;
        padding: 0.75rem;
    }
    .table thead th {
        background-color: #3498db;
        color: white;
        border: none;
    }
    .btn-primary, .btn-secondary {
        border-radius: 6px;
        padding: 0.5rem 1.25rem;
        font-weight: 500;
    }
    .error-feedback {
        color: #e74c3c;
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }
    .form-check-input:checked {
        background-color: #3498db;
        border-color: #3498db;
    }
    #resultBox .table {
        border-radius: 6px;
        overflow: hidden;
    }
    .hidden-field {
        display: none;
    }
    @media (max-width: 768px) {
        .card-header.d-flex {
            flex-direction: column;
            align-items: flex-start !important;
        }
        .card-header .text-end {
            margin-top: 1rem;
            width: 100%;
        }
        .table-responsive {
            border: none;
        }
    }
</style>

<div class="content-wrapper py-4">
    <section class="content-header mb-4">
        <h1 class="h3 mb-2">{{ __('Salary Calculator') }}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Salary Calculator') }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <!-- Left: Input Form -->
            <div class="col-md-7 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Salary & Tax Calculator') }}</h3>
                    </div>
                    <div class="card-body">
                        <form id="salaryCalcForm">
                            {{ csrf_field() }}
                            <input type="hidden" name="employee_type" value="0"/>
                            <input type="hidden" name="resident_status" id="resident_status"/>
                            <input type="hidden" name="no_of_dependent" id="no_of_dependent"/>

                            <!-- Basic Salary -->
                            <div class="card mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">{{ __('Basic Salary') }}</h5>
                                    <div class="text-end">
                                        <label for="tax_residency" class="form-label mb-1">Tax Residency</label>
                                        <select name="tax_residency" id="tax_residency" class="form-control" required>
                                            <option value="" disabled selected>Select option</option>
                                            <option value="1">Residential</option>
                                            <option value="2">Non-Resident</option>
                                        </select>
                                        <div class="error-feedback" id="errors_tax_residency"></div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-dark">Period Definition</th>
                                                    <th class="text-dark">Annual Salary</th>
                                                    <th class="text-dark">Fortnight Salary</th>
                                                    <th class="text-dark">Hourly Rate</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="text" name="period_definition" class="form-control" id="period_definition" value="FN - Fortnightly 80 Hours" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="annual_salary" class="form-control" id="annual_salary" placeholder="Enter annual salary" step="0.01">
                                                        <div class="error-feedback" id="errors_annual_salary"></div>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="basic_salary" class="form-control" id="basic_salary" placeholder="Enter fortnight salary" step="0.01" required>
                                                        <div class="error-feedback" id="errors_basic_salary"></div>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="hrly_salary_rate" class="form-control" id="hrly_salary_rate" placeholder="Enter hourly rate" step="0.01">
                                                        <div class="error-feedback" id="errors_hrly_salary_rate"></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Allowances -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title">{{ __('Allowances') }}</h5>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-bordered">
                                            <thead>
                                                <tr><th colspan="2" class="text-dark">House Allowances</th></tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><label for="hr_place_salcal" class="form-label">Place Name</label></td>
                                                    <td>
                                                        <select name="hr_place" id="hr_place_salcal" class="form-select" required>
                                                            <option value="" selected disabled>Select place</option>
                                                            @foreach($loca_places as $place)
                                                                <option value="{{ $place->id }}">{{ $place->places }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="error-feedback" id="errors_hr_place"></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="hr_area" class="form-label">Area Name</label></td>
                                                    <td>
                                                        <input type="text" name="hr_area" class="form-control" id="hr_area" readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="hra_type" class="form-label">Housing Allowance Type</label></td>
                                                    <td>
                                                        <select name="hra_type" id="hra_type" class="form-select" required>
                                                            <option value="" selected disabled>Select option</option>
                                                            <option value="1">Rental</option>
                                                            <option value="2">Kind</option>
                                                            <option value="3">Not Applicable</option>
                                                        </select>
                                                        <div class="error-feedback" id="errors_hra_type"></div>
                                                    </td>
                                                </tr>
                                                <tr id="hra_amount_per_week_row">
                                                    <td><label for="hra_amount_per_week" class="form-label">House Rent/Purchase Amount</label></td>
                                                    <td>
                                                        <input type="number" name="hra_amount_per_week" class="form-control" id="hra_amount_per_week" placeholder="Enter amount" step="0.01">
                                                        <div class="error-feedback" id="errors_hra_amount_per_week"></div>
                                                    </td>
                                                </tr>
                                                <tr id="house_rent_allowance_row">
                                                    <td><label for="house_rent_allowance" class="form-label">Housing Allowance</label></td>
                                                    <td>
                                                        <input type="number" name="house_rent_allowance" class="form-control" id="house_rent_allowance" readonly>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <thead>
                                                <tr><th colspan="2" class="text-dark">Vehicle Allowances</th></tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><label for="va_type" class="form-label">Vehicle Allowance Type</label></td>
                                                    <td>
                                                        <select name="va_type" id="va_type" class="form-select" required>
                                                            <option value="" selected disabled>Select option</option>
                                                            <option value="1">With Fuel</option>
                                                            <option value="2">Without Fuel</option>
                                                            <option value="3">Not Applicable</option>
                                                        </select>
                                                        <div class="error-feedback" id="errors_va_type"></div>
                                                    </td>
                                                </tr>
                                                <tr id="vehicle_allowance_row">
                                                    <td><label for="vehicle_allowance" class="form-label">Vehicle Allowance</label></td>
                                                    <td>
                                                        <input type="number" name="vehicle_allowance" class="form-control" id="vehicle_allowance" readonly>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <thead>
                                                <tr><th colspan="2" class="text-dark">Other Allowances</th></tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><label for="meals_allowance" class="form-label">Meals Allowance</label></td>
                                                    <td>
                                                        <div class="form-check mb-2">
                                                            <input type="checkbox" name="meals_tag" id="meals_tag" value="1" class="form-check-input">
                                                            <label for="meals_tag" class="form-check-label">Enable</label>
                                                        </div>
                                                        <input type="number" name="meals_allowance" class="form-control" id="meals_allowance" readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="medical_allowance" class="form-label">Medical Allowance</label></td>
                                                    <td>
                                                        <input type="number" name="medical_allowance" class="form-control" id="medical_allowance" placeholder="Enter medical allowance" step="0.01">
                                                        <div class="error-feedback" id="errors_medical_allowance"></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="special_allowance" class="form-label">Telephone Allowance</label></td>
                                                    <td>
                                                        <input type="number" name="special_allowance" class="form-control" id="special_allowance" placeholder="Enter telephone allowance" step="0.01">
                                                        <div class="error-feedback" id="errors_special_allowance"></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="other_allowance" class="form-label">Servant Allowance</label></td>
                                                    <td>
                                                        <input type="number" name="other_allowance" class="form-control" id="other_allowance" placeholder="Enter servant allowance" step="0.01">
                                                        <div class="error-feedback" id="errors_other_allowance"></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="electricity_allowance" class="form-label">Electricity Allowance</label></td>
                                                    <td>
                                                        <input type="number" name="electricity_allowance" class="form-control" id="electricity_allowance" placeholder="Enter electricity allowance" step="0.01">
                                                        <div class="error-feedback" id="errors_electricity_allowance"></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="security_allowance" class="form-label">Security Allowance</label></td>
                                                    <td>
                                                        <input type="number" name="security_allowance" class="form-control" id="security_allowance" placeholder="Enter security allowance" step="0.01">
                                                        <div class="error-feedback" id="errors_security_allowance"></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Deductions -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title" class="text-dark">{{ __('Deductions') }}</h5>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-bordered">
                                            <thead>
                                                <tr><th colspan="2" class="text-dark">Deductions & Rebate</th></tr>
                                            </thead>
                                            <tbody>
                                                <tr style="display:none;">
                                                    <td><label for="tax_deduction_a" class="form-label">Tax Deduction</label></td>
                                                    <td>
                                                        <input type="number" name="tax_deduction_a" class="form-control" id="tax_deduction_a" readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="no_of_dependent_frm" class="form-label">Dependents</label></td>
                                                    <td>
                                                        <select name="no_of_dependent_frm" class="form-select" id="no_of_dependent_frm" required>
                                                            <option value="0">0</option>
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <option value="{{ $i }}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                        <div class="error-feedback" id="errors_no_of_dependent_frm"></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="text-dark"><strong>Superannuation Fund</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="superannuation_id" class="form-label">Superannuation</label></td>
                                                    <td>
                                                        <select class="form-select" id="superannuation_id" name="superannuation_id" required>
                                                            <option value="" selected disabled>Select option</option>
                                                            @foreach($superannuations as $superannuation)
                                                                <option value="{{ $superannuation->id }}" 
                                                                        data-contribution-empy="{{ $superannuation->employer_contribution_percentage }}"
                                                                        data-contribution-empl="{{ $superannuation->employee_contrib_percent }}"
                                                                        data-tax-method="{{ $superannuation->tax_method_for_employee_contribution }}">
                                                                    {{ $superannuation->name }} ({{ $superannuation->code }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="error-feedback" id="errors_superannuation_id"></div>
                                                        <label for="superannuation_contrib_percentage" class="form-label mt-2">Employer Contribution Percentage</label>
                                                        <input type="text" id="employer_contribution_percentage" name="employer_contribution_percentage" class="form-control mt-2" readonly placeholder="Contribution %">
                                                        <label for="superannuation_contrib_percentage" class="form-label mt-2">Employer Contribution Percentage</label>
                                                        <input type="text" id="employee_contribution_percentage" name="employee_contribution_percentage" class="form-control mt-2" readonly placeholder="Contribution %">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="provident_fund_deduction" class="form-label">Superannuation Deduction</label></td>
                                                    <td>
                                                        <input type="number" name="provident_fund_deduction" class="form-control" id="provident_fund_deduction" placeholder="Enter deduction" step="0.01">
                                                        <div class="error-feedback" id="errors_provident_fund_deduction"></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-calculator me-1"></i> Calculate</button>
                                <a href="{{ url('/dashboard') }}" class="btn btn-secondary"><i class="fa fa-arrow-left me-1"></i> Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right: Output Display -->
            <div class="col-md-5 mb-4">
                <div id="resultBox" class="card" style="display:none;">
                    <div class="card-header">
                        <h4 class="card-title" class="text-dark">{{ __('Salary Slip (Estimated)') }}</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="payslipTable">
                                <thead>
                                    <tr><th class="text-dark">Description</th><th class="text-dark">Amount (K)</th></tr>
                                </thead>
                                <tbody>
                                    <tr><td>Basic Salary (Fortnight)</td><td id="slip_basic_salary"></td></tr>
                                    <tr><td>Housing Allowance</td><td id="slip_house_rent_allowance"></td></tr>
                                    <tr><td>Vehicle Allowance</td><td id="slip_vehicle_allowance"></td></tr>
                                    <tr><td>Meals Allowance</td><td id="slip_meals_allowance"></td></tr>
                                    <tr><td>Medical Allowance</td><td id="slip_medical_allowance"></td></tr>
                                    <tr><td>Telephone Allowance</td><td id="slip_special_allowance"></td></tr>
                                    <tr><td>Servant Allowance</td><td id="slip_other_allowance"></td></tr>
                                    <tr><td>Electricity Allowance</td><td id="slip_electricity_allowance"></td></tr>
                                    <tr><td>Security Allowance</td><td id="slip_security_allowance"></td></tr>
                                    <tr><td><strong>Gross Salary (Fortnight)</strong></td><td id="gross_salary"></td></tr>
                                    <tr><td>Tax Deduction (Fortnight) A </td><td id="tax_deduction_new"></td></tr>
                                    <tr><td>Tax Deduction After Rebate (Fortnight) A </td><td id="tax_after_rebate"></td></tr>
                                    <tr><td>Tax Deduction (Fortnight) B </td><td id="tax_deduction"></td></tr>
                                    <tr><td>Superannuation Deduction</td><td id="slip_provident_fund_deduction"></td></tr>
                                    <tr><td>Rebate for Dependents A </td><td id="rebate_new"></td></tr>
                                    <tr><td>Rebate for Dependents B </td><td id="rebate"></td></tr>
                                    <tr><td><strong>Total Deduction</strong></td><td id="total_deduction"></td></tr>
                                    <tr><td><strong>Net Salary (Fortnight)</strong></td><td id="net_salary"></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
