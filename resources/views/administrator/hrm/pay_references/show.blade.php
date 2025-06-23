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

                <div class="row tab-content" id="inc">
                    <div class="col-md-6">
                        <div class="text-left">
                            <strong>Included Employees</strong>
                            <span class="text-left"><button id="save-button-payref" data-payref-id="{{ $pay_reference->id }}" class="btn btn-primary">Save</button></span>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="included-table">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select-all-included" /></th>
                                        <th>Code</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($includedEmployees as $employee)
                                    <tr data-id="{{ $employee->id }}">
                                        <td><input type="checkbox" class="included-checkbox" /></td>
                                        <td>{{ $employee->employee_id }}</td>
                                        <td>{{ $employee->name }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p id="included-msg" class="no-data" style="display: none;">No data available in table</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <strong>Excluded Employees</strong>
                        <div class="table-responsive">
                            <table class="table" id="excluded-table">
                                <thead>
                                    <tr>
                                    <th><input type="checkbox" id="select-all-excluded" /></th>
                                        <th>Code</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($excludedEmployees as $employee)
                                    <tr data-id="{{ $employee->id }}">
                                    <td><input type="checkbox" class="excluded-checkbox" /></td>
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
                 <!-- Other tabs content should be added here with similar structure -->
                 <div class="row tab-content" id="advances" style="display: none;">
                            <!-- Content for Update Pay Advances -->
                            <!-- Add your content here -->
                            <div class="col-6">
                                <div class="text-left">
                                    <strong>Employees Included in Pay</strong>
                                </div>
                                <div class="table-responsive">
                                    <table class="table" id="included-table">
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($includedEmployees)
                                                @foreach($includedEmployees as $employee)
                                                    <tr data-id="{{ $employee->id }}">
                                                        <td>{{ $employee->employee_id }}</td>
                                                        <td>{{ $employee->name }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="3">No data available in table</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-6">
                                <h5>UPDATE PAY REFERENCES FROM EMPLOYEE LOANS</h5>
                                <p>No employee loans to update on this Pay Reference.</p>
                                <button name="add_loans_payref" id="add_loans_payref" type="button" class="btn btn-primary" data-payref-id="{{$pay_reference->id}}"> Add Loans
</button>
                            </div>
                        </div>
                        <div class="row tab-content" id="leave" style="display: none;">
                            <!-- Content for Update Leave Requests -->
                            <!-- Add your content here -->
                            <div class="col-6">
                                <div class="text-left">
                                    <strong>Employees Included in Pay</strong>
                                </div>
                                <div class="table-responsive">
                                    <table class="table" id="included-table">
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($includedEmployees)
                                                @foreach($includedEmployees as $employee)
                                                    <tr data-id="{{ $employee->id }}">
                                                        <td>{{ $employee->employee_id }}</td>
                                                        <td>{{ $employee->name }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="3">No data available in table</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-6">
                                <h5>UPDATE PAY REFERENCES FROM EMPLOYEE LEAVE REQUESTS</h5>
                                @if(!$addLeaveButtonExist)
                                    <p>No employee leaves to update on this Pay Reference.</p>
                                @else
                                    <p>Selected employee leaves to update on this Pay Reference.</p>
                                @endif
                                <button name="add_leave_payref" id="add_leave_payref" type="button" class="btn btn-primary" data-payref-id="{{$pay_reference->id}}" data-employee-id="57"> Add Leave
</button>
                            </div>
                        </div>
                        <div class="row tab-content" id="variations" style="display: none;">
                            <!-- Content for Pay Variations -->
                            <!-- Add your content here -->
                                <div class="col-5">
                                    <div class="text-left">
                                        <strong>Employees Included in Pay</strong>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table" id="included-table">
                                            <thead>
                                                <tr>
                                                    <th>Code</th>
                                                    <th>Name</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($includedEmployees)
                                                    @foreach($includedEmployees as $employee)
                                                        <tr data-id="{{ $employee->id }}">
                                                            <td>{{ $employee->employee_id }}</td>
                                                            <td>{{ $employee->name }}</td>
                                                            <td>
                                                                <button type="button" class="btn btn-secondary view-payslip" data-emp-id="{{ $employee->employee_id }}" data-pay-ref-id="{{ $pay_reference->id }}" >View Slip</button>
                                                                <button name="add_payitem_payref" id="add_payitem_payref" data-emp-id="{{ $employee->employee_id }}" data-pay-ref-id="{{ $pay_reference->id }}"  type="button" class="btn btn-primary add-payitem-payref" data-toggle="modal" data-target="#addPayRefPayItem"> Add PayItem
</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="3">No data available in table</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-7" id="payvars">
                                        <!-- Card Structure -->
                                </div>
                        </div>
                        <div class="row tab-content" id="submit" style="display: none;">
                            <!-- Content for Submit Pay -->
                            <div class="row">
                                <!-- Add your content here -->
                                <div class="col-6">
                                    <div class="text-left">
                                        <strong>Employees Included in Pay</strong>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table" id="included-table">
                                            <thead>
                                                <tr>
                                                    <th>Code</th>
                                                    <th>Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($includedEmployees)
                                                    @foreach($includedEmployees as $employee)
                                                        <tr data-id="{{ $employee->id }}">
                                                            <td>{{ $employee->employee_id }}</td>
                                                            <td>{{ $employee->name }}</td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="3">No data available in table</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-6">
                                    @if($payrefPayslipExist)
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>Payslip generated of this reference.</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <form action="{{ route('pay_references.pay_reference_submit', $pay_reference->id) }}" method="post">
                                            {{ csrf_field() }}
                                        <button type="submit" name="submit_pay_salary" id="submit_pay_salary" class="btn btn-success">Submit Pay</button>
                                    </form>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </section>
</div>

<!-- Add Modal Pop for Pay Reference Add Pay Items -->
<div class="modal fade" id="addPayRefPayItem" tabindex="-1" role="dialog" aria-labelledby="addPayRefPayItemLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addPayRefPayItemLabel">{{ __('Add Pay Items') }}</h4>
            </div>
            <div class="modal-body">
                <form id="payItemForm" action="{{ route('pay_references.add_payitem_payref') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="payrefid" id="payrefid" value="{{$pay_reference->id}}"/>
                    <input type="hidden" name="empid" id="payrefempid" />
                    <div class="form-group">
                        <label for="payref_payitems">{{ __('Select Pay Items') }} <span class="text-danger">*</span></label>
                        <select name="payref_payitems" id="payref_payitems" class="form-control" required>
                            @foreach($payItems as $payItem)
                            <option value="{{ $payItem->id }}" data-code="{{ $payItem->code }}">{{ $payItem->code.'-'.$payItem->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="payref_payitem_unit">{{ __('Pay Period Unit') }} <span class="text-danger">*</span></label>
                        <select name="payref_payitem_unit" id="payref_payitem_unit" class="form-control" required>
                            @for($i=1; $i<100; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pay_item_amount">{{ __('Pay Item Amount') }} <span class="text-danger">*</span></label>
                        <input type="number" name="pay_item_amount" id="pay_item_amount" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="paid_on">{{ __('Paid On') }} <span class="text-danger">*</span></label>
                        <input type="date" name="paid_on" id="paid_on" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="pay_item_summary">{{ __('Pay Item Summary') }} <span class="text-danger">*</span></label>
                        <input type="text" name="pay_item_summary" id="pay_item_summary" class="form-control" required>
                    </div>
                    <button type="submit" id="submit_pay_ref_payitem" class="btn btn-success">Submit Pay</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- End -->

<!-- End -->

<!-- JavaScript for moving rows and checkboxes -->
<script>
      function changeActive(event) {
        // Remove 'active' class from all tabs
        document.querySelectorAll('.nav-link').forEach(tab => {
            tab.classList.remove('active');
        });

        // Add 'active' class to the clicked tab
        event.target.classList.add('active');

        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.style.display = 'none';
        });

        // Show the selected tab content based on the tab id
        let selectedTabId = event.target.id;
        if (selectedTabId === "2") {
            document.getElementById('inc').style.display = 'flex';
        } else if (selectedTabId === "3") {
            document.getElementById('advances').style.display = 'flex';
        } else if (selectedTabId === "6") {
            document.getElementById('leave').style.display = 'flex';
        } else if (selectedTabId === "4") {
            document.getElementById('variations').style.display = 'flex';
        } else if (selectedTabId === "5") {
            document.getElementById('submit').style.display = 'flex';
        }
    }

    // Initialize the default active tab on page load
    document.addEventListener('DOMContentLoaded', function() {
        changeActive({ target: document.getElementById('2') });
    });

document.addEventListener('DOMContentLoaded', function () {
    const includedTable = document.getElementById('included-table').getElementsByTagName('tbody')[0];
    const excludedTable = document.getElementById('excluded-table').getElementsByTagName('tbody')[0];
    const selectAllIncluded = document.getElementById('select-all-included');
    const selectAllExcluded = document.getElementById('select-all-excluded');

    // Function to check if tables are empty and show the "No data" message accordingly
    function checkEmptyTables() {
        const includedMsg = document.getElementById('included-msg');
        const excludedMsg = document.getElementById('excluded-msg');

        includedMsg.style.display = includedTable.rows.length === 0 ? 'block' : 'none';
        excludedMsg.style.display = excludedTable.rows.length === 0 ? 'block' : 'none';

        // Enable/Disable select all checkboxes based on table content
        selectAllIncluded.disabled = includedTable.rows.length === 0;
        selectAllExcluded.disabled = excludedTable.rows.length === 0;
    }

    // Function to check all checkboxes in the given table body
    function checkAllCheckboxes(tableBody, checkboxClass) {
        const checkboxes = tableBody.querySelectorAll('.' + checkboxClass);
        checkboxes.forEach(checkbox => {
            checkbox.checked = true; // Make sure all checkboxes are checked by default
        });
    }

    // Move row from Included to Excluded
    function moveRowToExcluded(checkbox) {
        const row = checkbox.closest('tr');
        checkbox.checked = true; // Ensure checkbox is checked when moving
        checkbox.classList.remove('included-checkbox');
        checkbox.classList.add('excluded-checkbox');
        excludedTable.appendChild(row);
        checkEmptyTables();
    }

    // Move row from Excluded to Included
    function moveRowToIncluded(checkbox) {
        const row = checkbox.closest('tr');
        checkbox.checked = true; // Ensure checkbox is checked when moving
        checkbox.classList.remove('excluded-checkbox');
        checkbox.classList.add('included-checkbox');
        includedTable.appendChild(row);
        checkEmptyTables();
    }

    // Select/Deselect all checkboxes for Included employees
    selectAllIncluded.addEventListener('change', function () {
        const checkboxes = includedTable.querySelectorAll('.included-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
            if (!this.checked) {
                moveRowToExcluded(checkbox);
            }
        });
    });

    // Select/Deselect all checkboxes for Excluded employees
    selectAllExcluded.addEventListener('change', function () {
        const checkboxes = excludedTable.querySelectorAll('.excluded-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
            if (!this.checked) {
                moveRowToIncluded(checkbox);
            }
        });
    });

    // Handle individual checkbox unchecking in Included table
    includedTable.addEventListener('change', function (e) {
        if (e.target.classList.contains('included-checkbox') && !e.target.checked) {
            moveRowToExcluded(e.target);
        }
    });

    // Handle individual checkbox unchecking in Excluded table
    excludedTable.addEventListener('change', function (e) {
        if (e.target.classList.contains('excluded-checkbox') && !e.target.checked) {
            moveRowToIncluded(e.target);
        }
    });

    // On page load, check all checkboxes and check table status
    checkEmptyTables(); // Check if tables are empty and handle messages and button states
    checkAllCheckboxes(includedTable, 'included-checkbox'); // Check all checkboxes in Included table by default
    checkAllCheckboxes(excludedTable, 'excluded-checkbox'); // Check all checkboxes in Excluded table by default
});

</script>
@endsection
