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

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Manage Pay Reference Details') }}</h3>
            </div>

            <table class="table table-bordered table-striped">
                <tbody>
                    @foreach($pay_references as $pay_reference)
                        <tr>
                            <td>ID: {{ $pay_reference->id }}</td>
                            <td>{{ __('Pay Reference Name') }} : {{ $pay_reference->pay_reference_name }}</td>
                            <td>{{ __('Pay Period Start Date') }} : {{ $pay_reference->pay_period_start_date }}</td>
                            <td>{{ __('Pay Period End Date') }} : {{ $pay_reference->pay_period_end_date }}</td>
                            <td>{{ __('Branch') }} : {{ $pay_reference->branch_name }}</td>
                            <td>{{ __('Pay Batch') }} : {{ $pay_reference->payroll_number }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="box-body">
                <div class="col-xl-12">
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
                    <div id="refdata">
                        <!-- Include/Exclude Employees Tab Content -->
                        <div class="row tab-content" id="inc">
                            <div class="col-md-5">
                                <strong>Included Employees</strong>
                                <div class="table-responsive">
                                    <table class="table table-bordered dataTable no-footer" id="dt-exc" width="100%" cellspacing="0" role="grid" aria-describedby="dt-exc_info" style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th>Id</th>
                                                <th>Code</th>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr><td>1</td><td>E-1</td><td>S Mathew</td></tr>
                                            <tr><td>2</td><td>E-2</td><td>S Jon</td></tr>
                                            <tr><td>5</td><td>004</td><td>Tina Malu</td></tr>
                                            <tr><td>6</td><td>005</td><td>Shane Bon</td></tr>
                                            <tr><td>7</td><td>006</td><td>Joycelyn Ben</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-1 text-center">
                                <p>
                                    <button style="width:100%;" class="btn btn-danger" onclick="excludeEmp()"><i class="fa fa-fw fa-angle-right"></i></button>
                                    <br><br>
                                    <button style="width:100%;" class="btn btn-danger" onclick="excludeEmpAll()"><i class="fa fa-fw fa-angle-double-right"></i></button>
                                    <br><br>
                                    <button style="width:100%;" class="btn btn-success" onclick="includeEmp()"><i class="fa fa-fw fa-angle-left"></i></button>
                                    <br><br>
                                    <button style="width:100%;" class="btn btn-success" onclick="includeEmpAll()"><i class="fa fa-fw fa-angle-double-left"></i></button>
                                </p>
                                <p><button style="width:100%;" class="btn btn-primary" onclick="onSaveIncluded('Ref Code 1')">Save</button></p>
                            </div>
                            <div class="col-md-5">
                                <strong>Excluded Employees</strong>
                                <div class="table-responsive">
                                    <table class="table table-bordered dataTable no-footer" id="dt-exc" width="100%" cellspacing="0" role="grid" aria-describedby="dt-exc_info" style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th>Id</th>
                                                <th>Code</th>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr><td>1</td><td>E-1</td><td>S Mathew</td></tr>
                                            <tr><td>2</td><td>E-2</td><td>S Jon</td></tr>
                                            <tr><td>5</td><td>004</td><td>Tina Malu</td></tr>
                                            <tr><td>6</td><td>005</td><td>Shane Bon</td></tr>
                                            <tr><td>7</td><td>006</td><td>Joycelyn Ben</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Other tabs content should be added here with similar structure -->
                        <div class="row tab-content" id="advances" style="display: none;">
                            <!-- Content for Update Pay Advances -->
                            <!-- Add your content here -->
                            <div class="col-md-6">
                                <strong>Included Employees</strong>
                                <div class="table-responsive">
                                    <table class="table table-bordered dataTable no-footer" id="dt-exc" width="100%" cellspacing="0" role="grid" aria-describedby="dt-exc_info" style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th>Id</th>
                                                <th>Code</th>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr><td>1</td><td>E-1</td><td>S Mathew</td></tr>
                                            <tr><td>2</td><td>E-2</td><td>S Jon</td></tr>
                                            <tr><td>5</td><td>004</td><td>Tina Malu</td></tr>
                                            <tr><td>6</td><td>005</td><td>Shane Bon</td></tr>
                                            <tr><td>7</td><td>006</td><td>Joycelyn Ben</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong>Excluded Employees</strong>
                                <p> No data </p>
                            </div>
                        </div>
                        <div class="row tab-content" id="leave" style="display: none;">
                            <!-- Content for Update Leave Requests -->
                            <!-- Add your content here -->
                            <div class="col-md-6">
                                <strong>Included Employees</strong>
                                <div class="table-responsive">
                                    <table class="table table-bordered dataTable no-footer" id="dt-exc" width="100%" cellspacing="0" role="grid" aria-describedby="dt-exc_info" style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th>Id</th>
                                                <th>Code</th>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr><td>1</td><td>E-1</td><td>S Mathew</td></tr>
                                            <tr><td>2</td><td>E-2</td><td>S Jon</td></tr>
                                            <tr><td>5</td><td>004</td><td>Tina Malu</td></tr>
                                            <tr><td>6</td><td>005</td><td>Shane Bon</td></tr>
                                            <tr><td>7</td><td>006</td><td>Joycelyn Ben</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong>Excluded Employees</strong>
                                <p> No data </p>
                            </div>
                        </div>
                        <div class="row tab-content" id="variations" style="display: none;">
                            <!-- Content for Pay Variations -->
                            <!-- Add your content here -->
                            <div class="col-md-6">
                                <strong>Included Employees</strong>
                                <div class="table-responsive">
                                    <table class="table table-bordered dataTable no-footer" id="dt-exc" width="100%" cellspacing="0" role="grid" aria-describedby="dt-exc_info" style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th>Id</th>
                                                <th>Code</th>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr><td>1</td><td>E-1</td><td>S Mathew</td></tr>
                                            <tr><td>2</td><td>E-2</td><td>S Jon</td></tr>
                                            <tr><td>5</td><td>004</td><td>Tina Malu</td></tr>
                                            <tr><td>6</td><td>005</td><td>Shane Bon</td></tr>
                                            <tr><td>7</td><td>006</td><td>Joycelyn Ben</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong>Excluded Employees</strong>
                                <p> No data </p>
                            </div>
                        </div>
                        <div class="row tab-content" id="submit" style="display: none;">
                            <!-- Content for Submit Pay -->
                            <!-- Add your content here -->
                            <div class="col-md-6">
                                <strong>Included Employees</strong>
                                <div class="table-responsive">
                                    <table class="table table-bordered dataTable no-footer" id="dt-exc" width="100%" cellspacing="0" role="grid" aria-describedby="dt-exc_info" style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th>Id</th>
                                                <th>Code</th>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr><td>1</td><td>E-1</td><td>S Mathew</td></tr>
                                            <tr><td>2</td><td>E-2</td><td>S Jon</td></tr>
                                            <tr><td>5</td><td>004</td><td>Tina Malu</td></tr>
                                            <tr><td>6</td><td>005</td><td>Shane Bon</td></tr>
                                            <tr><td>7</td><td>006</td><td>Joycelyn Ben</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <strong>Excluded Employees</strong>
                                <p> No data </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

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
            document.getElementById('advances').style.display = 'block';
        } else if (selectedTabId === "6") {
            document.getElementById('leave').style.display = 'block';
        } else if (selectedTabId === "4") {
            document.getElementById('variations').style.display = 'block';
        } else if (selectedTabId === "5") {
            document.getElementById('submit').style.display = 'block';
        }
    }

    // Initialize the default active tab on page load
    document.addEventListener('DOMContentLoaded', function() {
        changeActive({ target: document.getElementById('2') });
    });

    function includeEmp() {
        // Add your logic to move selected employees from excluded to included table
    }

    function excludeEmp() {
        // Add your logic to move selected employees from included to excluded table
    }

    function includeEmpAll() {
        // Add your logic to move all employees from excluded to included table
    }

    function excludeEmpAll() {
        // Add your logic to move all employees from included to excluded table
    }

    function onSaveIncluded(refCode) {
        // Add your logic to save the included employees
    }
</script>
@endsection
