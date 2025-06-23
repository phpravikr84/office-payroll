<div id="mainMenu">
    @if(Auth::user()->access_label == 1) 
    <ul class="sidebar-menu" data-widget="tree">
        <li><a href="{{ url('/dashboard')}}"><i class="fa fa-dashboard text-purple"></i> <span>{{ __('Dashboard') }}</span></a></li>

            <!-- Organization -->
            <li class="treeview">
            <a href="#">
                <i class="fa fa-building text-purple"></i> <span>{{ __('Organization') }}</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i>{{ __('Company Information') }}</a></li>
                <li><a href="{{ url('/setting/branches') }}"><i class="fa fa-circle-o"></i>{{ __('Branches') }}</a></li>
                <li><a href="{{ url('/setting/departments') }}"><i class="fa fa-circle-o"></i>{{ __('Department') }}</a></li>
            </ul>
        </li>

        <!-- Payroll Setting -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-money text-purple"></i> <span>{{ __('Payroll Setting') }}</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <!-- System Control Files -->
                <li class="treeview">
                    <a href="#"><i class="fa fa-cogs"></i>{{ __('System Control Files') }}
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/setting/departments') }}"><i class="fa fa-circle-o"></i>{{ __('System Control File') }}</a></li>
                        <li><a href="{{ url('/setting/bank_lists') }}"><i class="fa fa-circle-o"></i>{{ __('Bank Listing') }}</a></li>
                        <li><a href="{{ route('gl_interface_control_files.index') }}"><i class="fa fa-circle-o"></i>{{ __('GL Interface Control File') }}</a></li>
                        <li><a href="{{ route('bsp_bank_transfer_setups.index') }}"><i class="fa fa-circle-o"></i>{{ __('BSP Bank Transfer Setup') }}</a></li>
                        <li><a href="{{ route('anz_bank_transfer_setups.index') }}"><i class="fa fa-circle-o"></i>{{ __('ANZ Bank Transfer Setup') }}</a></li>
                        <li><a href="{{ route('wpac_bank_transfer_setups.index') }}"><i class="fa fa-circle-o"></i>{{ __('WPAC Bank Transfer Setup') }}</a></li>
                        <li><a href="{{ route('kina_bank_transfer_setups.index') }}"><i class="fa fa-circle-o"></i>{{ __('KINA Bank Transfer Setup') }}</a></li>
                        <li><a href="{{ url('/setting/holidays') }}"><i class="fa fa-circle-o"></i>{{ __('Holiday List') }} </a></li>
                        <li><a href="{{ url('/setting/working-days') }}"><i class="fa fa-circle-o"></i> {{ __('Set Working Day') }}</a></li>
                        <li><a href="{{ url('/setting/personal-events') }}"><i class="fa fa-circle-o"></i>{{ __('Personal Event') }} </a></li>
                    </ul>
                </li>

                <!-- Reference -->
                <li class="treeview">
                    <a href="#"><i class="fa fa-book"></i>{{ __('Reference') }}
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/setting/leave_categories') }}"><i class="fa fa-circle-o"></i>{{ __('Manage Leave') }}</a></li>
                        <li><a href="{{ url('/setting/pay_batch_numbers') }}"><i class="fa fa-circle-o"></i>{{ __('Pay Batch Number') }}</a></li>
                        <li><a href="{{ url('/setting/pay_locations') }}"><i class="fa fa-circle-o"></i>{{ __('Pay Location') }}</a></li>
                        <li><a href="{{ url('/setting/gl_codes') }}"><i class="fa fa-circle-o"></i>{{ __('GL Codes') }}</a></li>
                        <li><a href="{{ url('/setting/pay_accumulators') }}"><i class="fa fa-circle-o"></i>{{ __('Pay Accumulators') }}</a></li>
                        <li><a href="{{ url('/setting/superannuations') }}"><i class="fa fa-circle-o"></i>{{ __('Superannuation') }}</a></li>
                        <li><a href="{{ route('setting.bank_details.index') }}"><i class="fa fa-circle-o"></i>{{ __('Bank Details') }}</a></li>
                        <li><a href="{{ route('period_defination_rates.index') }}"><i class="fa fa-circle-o"></i>{{ __('Period Definition') }}</a></li>
                        <li><a href="{{ route('pay_items.index') }}"><i class="fa fa-circle-o"></i>{{ __('Pay Items') }}</a></li>
                        <li><a href="{{ route('currencies.index') }}"><i class="fa fa-circle-o"></i>{{ __('Currency') }}</a></li>
                    </ul>
                </li>
            </ul>
        </li>

        <!-- Employees -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-user text-purple"></i> <span>{{ __('Employees') }}</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ url('/people/employees/create') }}"><i class="fa fa-circle-o"></i>{{ __('Employee File Maintenance') }}</a></li>
                <li><a href="{{ url('/people/employees') }}"><i class="fa fa-circle-o"></i>{{ __('Approve Employee Changes') }}</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>{{ __('Employee Loans') }}</a></li>
                <li><a href="{{ url('/hrm/leave') }}"><i class="fa fa-circle-o"></i>{{ __('Leave Request') }}</a></li>
                <li><a href="{{ url('/hrm/leave') }}"><i class="fa fa-circle-o"></i>{{ __('Employee Attendance') }}</a></li>
            </ul>
        </li>

        <!-- Process Pay -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-credit-card text-purple"></i> <span>{{ __('Process Pay') }}</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i>{{ __('Pay Reference Status Enquiry') }}</a></li>
                <li><a href="{{ route('pay_references.create')}}"><i class="fa fa-circle-o"></i>{{ __('Create Pay') }}</a></li>
                <li><a href="{{ route('pay_references.index')}}"><i class="fa fa-circle-o"></i>{{ __('Manage Pay') }}</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>{{ __('Approve Process Pay') }}</a></li>
            </ul>
        </li>

        <!-- Reports -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-bar-chart text-purple"></i> <span>{{ __('Reports') }}</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i>{{ __('Payroll Reports') }}</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>{{ __('Payslips') }}</a></li>
            </ul>
        </li>
        <li><a href="{{ url('/profile/user-profile') }}"><i class="fa fa-user text-purple"></i> <span>{{ __('Profile') }}</span></a></li>
        <li><a href="{{ url('/profile/change-password') }}"><i class="fa fa-key text-purple"></i> <span>{{ __('Change Password') }}</span></a></li>
        <li><a href="{{ url('/public/uploaded_files/payhours-usermanual.pdf') }}" target="{{ url('/public/uploaded_files/payhours-usermanual.pdf') }}"><i class="fa fa-key text-purple"></i> <span>{{ __('User Manual') }}</span></a></li>
        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-lock text-purple"></i> <span>{{ __('Logout') }}</span></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
    @else
    <ul class="sidebar-menu" data-widget="tree">
        <li><a href="{{ url('/dashboard')}}"><i class="fa fa-dashboard text-purple"></i> <span>{{ __('Dashboard') }}</span></a></li>

        <!-- Employees -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-user text-purple"></i> <span>{{ __('Employees') }}</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ url('/hrm/leave') }}"><i class="fa fa-circle-o"></i>{{ __('Leave Request') }}</a></li>
                
            </ul>
        </li>
        <li><a href="{{ url('/profile/user-profile') }}"><i class="fa fa-user text-purple"></i> <span>{{ __('Profile') }}</span></a></li>
        <li><a href="{{ url('/profile/change-password') }}"><i class="fa fa-key text-purple"></i> <span>{{ __('Change Password') }}</span></a></li>
        <li><a href="{{ url('/public/uploaded_files/payhours-usermanual.pdf') }}" target="{{ url('/public/uploaded_files/payhours-usermanual.pdf') }}"><i class="fa fa-key text-purple"></i> <span>{{ __('User Manual') }}</span></a></li>
        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-lock text-purple"></i> <span>{{ __('Logout') }}</span></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
    @endif
</div>