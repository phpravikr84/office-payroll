<nav class="sidebar sidebar-offcanvas loginBg" id="sidebar">
  @if(Auth::user()->access_label == 1) 
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/dashboard')}}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#organization" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">{{ __('Organization') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="organization">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('/setting/company') }}">{{ __('Company') }}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/setting/branches') }}">{{ __('Branches') }}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/setting/departments') }}">{{ __('Department') }}</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#payroll_setting" aria-expanded="false" aria-controls="form-elements">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">{{ __('Payroll Setting') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="payroll_setting">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                    <span class="text-light ml-4"> {{ __('System Control Files') }} </span>
                    <ul>
                        <li><a class="nav-link" href="{{ url('/setting/bank_lists') }}">{{ __('Bank Listing') }}</a></li>
                        <li><a class="nav-link" href="{{ route('gl_interface_control_files.index') }}">{{ __('GL Interface Setup') }}</a></li>
                        <li><a class="nav-link" href="{{ route('bsp_bank_transfer_setups.index') }}">{{ __('BSP Bank Setup') }}</a></li>
                        <li><a class="nav-link" href="{{ route('anz_bank_transfer_setups.index') }}">{{ __('ANZ Bank Setup') }}</a></li>
                        <li><a class="nav-link" href="{{ route('wpac_bank_transfer_setups.index') }}">{{ __('WPAC Bank Setup') }}</a></li>
                        <li><a class="nav-link" href="{{ route('kina_bank_transfer_setups.index') }}">{{ __('KINA Bank Setup') }}</a></li>
                        <li><a class="nav-link" href="{{ url('/setting/holidays') }}">{{ __('Holiday List') }} </a></li>
                        <li><a class="nav-link" href="{{ url('/setting/working-days') }}"> {{ __('Set Working Day') }}</a></li>
                        <li><a class="nav-link" href="{{ url('/setting/personal-events') }}">{{ __('Personal Event') }} </a></li>
                    </ul>
                </li>
                <li class="nav-item">
                  <span class="text-light ml-4"> {{ __('Reference') }}</span>
                    <ul>
                    <li><a  class="nav-link" href="{{ url('/setting/costcenters') }}"><i class="fa fa-circle-o"></i>{{ __('Cost Centers') }}</a></li>
                        <li><a  class="nav-link" href="{{ url('/setting/pay_batch_numbers') }}"><i class="fa fa-circle-o"></i>{{ __('Pay Batch Number') }}</a></li>
                        <li><a  class="nav-link" href="{{ url('/setting/pay_locations') }}"><i class="fa fa-circle-o"></i>{{ __('Pay Location') }}</a></li>
                        <li><a class="nav-link" href="{{ url('/setting/gl_codes') }}"><i class="fa fa-circle-o"></i>{{ __('GL Codes') }}</a></li>
                        <li><a  class="nav-link" href="{{ url('/setting/pay_accumulators') }}"><i class="fa fa-circle-o"></i>{{ __('Pay Accumulators') }}</a></li>
                        <li><a  class="nav-link"  href="{{ url('/setting/superannuations') }}"><i class="fa fa-circle-o"></i>{{ __('Superannuation') }}</a></li>
                        <li><a  class="nav-link" href="{{ route('setting.bank_details.index') }}"><i class="fa fa-circle-o"></i>{{ __('Bank Details') }}</a></li>
                        <li><a  class="nav-link" href="{{ route('period_defination_rates.index') }}"><i class="fa fa-circle-o"></i>{{ __('Period Definition') }}</a></li>
                        <li><a  class="nav-link" href="{{ route('pay_items.index') }}"><i class="fa fa-circle-o"></i>{{ __('Pay Items') }}</a></li>
                        <li><a  class="nav-link" href="{{ route('currencies.index') }}"><i class="fa fa-circle-o"></i>{{ __('Currency') }}</a></li>
                        <li><a  class="nav-link" href="{{ route('loan_master.index') }}"><i class="fa fa-circle-o"></i>{{ __('Loans') }}</a></li>
                        <li><a class="nav-link" href="{{ url('/setting/leave_categories') }}"><i class="fa fa-circle-o"></i>{{ __('Manage Leave') }}</a></li>
                    </ul>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#employees" aria-expanded="false" aria-controls="tables">
            <i class="icon-head menu-icon"></i>
              <span class="menu-title">{{ __('Employees') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="employees">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('/people/employees/manage') }}"><i class="fa fa-circle-o"></i>{{ __('Employee Management') }}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/people/employees') }}"><i class="fa fa-circle-o"></i>{{ __('Modify Employee') }}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('hrm/loans') }}"><i class="fa fa-circle-o"></i>{{ __('Employee Loans') }}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/hrm/leave') }}"><i class="fa fa-circle-o"></i>{{ __('Leave Request') }}</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#attendance" aria-expanded="false" aria-controls="tables">
            <i class="icon-columns menu-icon"></i>
              <span class="menu-title">{{ __('Attendance System') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="attendance">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('/hrm/attendance/manual_setting') }}"><i class="fa fa-circle-o"></i>{{ __('Manual Setting') }}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/hrm/attendance/') }}"><i class="fa fa-circle-o"></i>{{ __('Import Attendance') }}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/hrm/attendance/manage') }}"><i class="fa fa-circle-o"></i>{{ __('Attendance Manage') }}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('hrm/attendance/report') }}"><i class="fa fa-circle-o"></i>{{ __('Attendance Report') }}</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#processpay" aria-expanded="false" aria-controls="icons">
              <i class="icon-contract menu-icon"></i>
              <span class="menu-title">{{ __('Process Pay') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="processpay">
              <ul class="nav flex-column sub-menu">

                <li class="nav-item"> <a class="nav-link" href="{{ route('pay_references.payref.statusEnquiry') }}"><i class="fa fa-circle-o"></i>{{ __('Status Enquiry') }}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('pay_references.create')}}"><i class="fa fa-circle-o"></i>{{ __('Create Pay') }}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('pay_references.index')}}"><i class="fa fa-circle-o"></i>{{ __('Manage Pay') }}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/process_pay/pay_references/approve_pay') }}"><i class="fa fa-circle-o"></i>{{ __('Approve Process Pay') }}</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#payreports" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">{{ __('Reports') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="payreports">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link"  href="{{ route('pay_references.view_payslips') }}"><i class="fa fa-circle-o"></i>{{ __('Payslips') }}</a></li>
                <li class="nav-item"> <a class="nav-link"  href="{{ url('/report/superannuation-report') }}"><i class="fa fa-circle-o"></i>{{ __('Superannuation Report') }}</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#personalsetting" aria-expanded="false" aria-controls="auth">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Personal Setting</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="personalsetting">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('/profile/user-profile') }}"><i class="fa fa-user text-purple"></i> <span>{{ __('Profile') }}</span></a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/profile/change-password') }}"><i class="fa fa-key text-purple"></i> <span>{{ __('Change Password') }}</span></a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/public/uploaded_files/payhours-usermanual.pdf') }}" target="{{ url('/public/uploaded_files/payhours-usermanual.pdf') }}"><i class="fa fa-key text-purple"></i> <span>{{ __('User Manual') }}</span></a></li>
               </ul>
            </div>
          </li>
          <li class="nav-item">
                         <span class="menu-title"><a class="nav-link"  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-lock text-purple"></i> <span>{{ __('Logout') }}</span></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                {{ csrf_field() }}
            </form></span>
              <i class="menu-arrow"></i>

          </li>
        </ul>
  @else
  <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/dashboard')}}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#employees" aria-expanded="false" aria-controls="tables">
            <i class="icon-head menu-icon"></i>
              <span class="menu-title">{{ __('Employees') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="employees">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('/hrm/leave') }}"><i class="fa fa-circle-o"></i>{{ __('Leave Request') }}</a></li>
              </ul>
            </div>
          </li>  
        
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#personalsetting" aria-expanded="false" aria-controls="auth">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Personal Setting</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="personalsetting">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('/profile/user-profile') }}"><i class="fa fa-user text-purple"></i> <span>{{ __('Profile') }}</span></a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/profile/change-password') }}"><i class="fa fa-key text-purple"></i> <span>{{ __('Change Password') }}</span></a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/public/uploaded_files/payhours-usermanual.pdf') }}" target="{{ url('/public/uploaded_files/payhours-usermanual.pdf') }}"><i class="fa fa-key text-purple"></i> <span>{{ __('User Manual') }}</span></a></li>
               </ul>
            </div>
          </li>
          <li class="nav-item">
                         <span class="menu-title"><a class="nav-link"  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-lock text-purple"></i> <span>{{ __('Logout') }}</span></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                {{ csrf_field() }}
            </form></span>
              <i class="menu-arrow"></i>

          </li>
        </ul>
  @endif
      </nav>