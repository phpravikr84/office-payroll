@extends('administrator.master')
@section('title', __('Pay Reference Details'))

@section('main_content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{ __('Pay Reference Details') }}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
            <li><a href="{{ route('pay_references.index') }}">{{ __('Pay References') }}</a></li>
            <li class="active">{{ __('Pay Reference Details') }}</li>
        </ol>
    </section>

    <table id="example1" id="example1" class="table table-bordered table-striped">
        <tbody>

                <tr>
                    <td>ID: {{ $pay_reference->id }}</td>
                    <td>{{ __('Pay Reference Name') }} : {{ $pay_reference->pay_reference_name }}</td>
                    <td>{{ __('Pay Period Start Date') }} : {{ $pay_reference->pay_period_start_date }}</td>
                    <td>{{ __('Pay Period End Date') }} : {{ $pay_reference->pay_period_end_date }}</td>
                    <td>{{ __('Branch') }} : {{ $pay_reference->branch_id }}</td>
                    <td>{{ __('Pay Batch') }} : {{ $pay_reference->payroll_number }}</td>
                </tr>

        </tbody>
    </table>


    <section class="content">
        <div class="box box-default">
            <div class="box-body">
            <ul class="nav nav-pills" id="payreftab">
                <li class="nav-item">
                    <a class="nav-link active" href="#" id="2" onclick="changeActive(event)">Include/Exclude Employees</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="3" onclick="changeActive(event)">Update Pay Advances</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="6" onclick="changeActive(event)">Update Leave Requests</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="4" onclick="changeActive(event)">Pay Variations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="5" onclick="changeActive(event)">Submit Pay</a>
                </li>
            </ul>
                <hr>

                <!-- Include/Exclude Employees Tab Content -->
                <div class="row tab-content" id="inc">
                    <div class="col-md-5">
                        <strong>Included Employees</strong>
                        <div class="table-responsive">
                            <table class="table table-bordered dataTable" id="included-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($includedEmployees as $employee)
                                        <tr data-id="{{ $employee->id }}">
                                            <td>{{ $employee->id }}</td>
                                            <td>{{ $employee->branch_id }}</td>
                                            <td>{{ $employee->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p id="included-msg" class="no-data" style="display: none;">No data available in table</p>
                        </div>
                    </div>

                    <div class="col-md-1 text-center">
                        <p>
                        <button class="btn btn-danger" onclick="excludeOneByOneEmp()"><i class="fa fa-fw fa-angle-right"></i></button>
                        <button class="btn btn-danger" onclick="excludeEmpAll()"><i class="fa fa-fw fa-angle-double-right"></i></button>
                        <button class="btn btn-success" onclick="includeOneByOneEmp()"><i class="fa fa-fw fa-angle-left"></i></button>
                        <button class="btn btn-success" onclick="includeEmpAll()"><i class="fa fa-fw fa-angle-double-left"></i></button>

                        </p>
                    </div>

                    <div class="col-md-5">
                        <strong>Excluded Employees</strong>
                        <div class="table-responsive">
                            <table class="table table-bordered dataTable" id="excluded-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($excludedEmployees as $employee)
                                        <tr data-id="{{ $employee->id }}">
                                            <td>{{ $employee->id }}</td>
                                            <td>{{ $employee->employee_id }}</td>
                                            <td>{{ $employee->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p id="excluded-msg" class="no-data" style="display: none;">No data available in table</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Pure JavaScript functions -->
<script>
    // Function to move selected rows from excluded table to included table
    function includeOneByOneEmp() {
        const selectedRows = document.querySelectorAll('#excluded-table tbody tr.selected');
        selectedRows.forEach(row => {
            document.querySelector('#included-table tbody').appendChild(row);
            row.classList.remove('selected');
        });
        checkEmptyTable('included-table', 'included-msg');
        checkEmptyTable('excluded-table', 'excluded-msg');
    }

    // Function to move selected rows from included table to excluded table
    function excludeOneByOneEmp() {
        const selectedRows = document.querySelectorAll('#included-table tbody tr.selected');
        selectedRows.forEach(row => {
            document.querySelector('#excluded-table tbody').appendChild(row);
            row.classList.remove('selected');
        });
        checkEmptyTable('included-table', 'included-msg');
        checkEmptyTable('excluded-table', 'excluded-msg');
    }

    // Function to move all rows from excluded table to included table
    function includeEmpAll() {
        const excludedRows = document.querySelectorAll('#excluded-table tbody tr');
        excludedRows.forEach(row => {
            document.querySelector('#included-table tbody').appendChild(row);
        });
        checkEmptyTable('excluded-table', 'excluded-msg');
        checkEmptyTable('included-table', 'included-msg');
    }

    // Function to move all rows from included table to excluded table
    function excludeEmpAll() {
        const includedRows = document.querySelectorAll('#included-table tbody tr');
        includedRows.forEach(row => {
            document.querySelector('#excluded-table tbody').appendChild(row);
        });
        checkEmptyTable('included-table', 'included-msg');
        checkEmptyTable('excluded-table', 'excluded-msg');
    }

    // Function to check if a table's tbody is empty, and show/hide the "No data" message
    function checkEmptyTable(tableId, messageId) {
        const tableBody = document.querySelector(`#${tableId} tbody`);
        const message = document.getElementById(messageId);
        if (tableBody.rows.length === 0) {
            message.style.display = 'block';
        } else {
            message.style.display = 'none';
        }
    }

    // Add click event to rows to toggle 'selected' class
    document.addEventListener('click', function(event) {
        if (event.target.closest('tbody tr')) {
            const row = event.target.closest('tr');
            row.classList.toggle('selected');
        }
    });

    // Initial check to show/hide "No data" message when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        checkEmptyTable('included-table', 'included-msg');
        checkEmptyTable('excluded-table', 'excluded-msg');
    });
</script>
@endsection
