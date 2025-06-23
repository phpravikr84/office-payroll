<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ url('/dashboard') }}">
            <img src="{{  asset('backend/images/logo.svg') }}" width="150" alt="logo"/>
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ url('/dashboard') }}">
            <img src="{{  asset('backend/images/logo-mini.svg') }}" alt="logo"/>
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block">
                <div class="input-group">
                    <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                        <span class="input-group-text" id="search">
                            <i class="icon-search"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
                </div>
            </li>
            <li class="nav-item dropdown">
                <!-- <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                    <i class="icon-bell mx-0"></i>
                    <span class="count"></span>
                </a> -->
                <!-- <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                    <p class="mb-0 font-weight-normal float-left dropdown-header">{{ __('Notifications') }}</p>
                   
                </div> -->
                <a href="{{ route('salary.calculator')}}" class="btn btn-primary flex pull-right">
                    <img src="{{ asset('backend/images/calculator_new.png') }}" alt="Calculator" style="width: 20px; height: 20px; margin-right: 5px;">
                    Salary Calculator
                </a>

            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown user user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="profileDropdown">
                    @if(!empty(auth()->user()->avatar))
                        <img src="{{ asset('profile_picture/' . auth()->user()->avatar) }}" class="user-image" width="50" alt="User Image">
                    @else
                        <img src="{{ asset('profile_picture/blank_profile_picture.png') }}" class="user-image" width="50" alt="User Image">
                    @endif
                    <span class="hidden-xs">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <div class="user-header">
                        @if(!empty(auth()->user()->avatar))
                            <img src="{{ asset('profile_picture/' . auth()->user()->avatar) }}" class="img-circle" width="50" alt="User Image">
                        @else
                            <img src="{{ asset('profile_picture/blank_profile_picture.png') }}" class="img-circle" width="50" alt="User Image">
                        @endif
                        <p>
                            {{ Auth::user()->name }}
                            <small>{{ __('Member Since') }} {{ date("d F Y", strtotime(Auth::user()->created_at)) }}</small>
                        </p>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('/profile/user-profile') }}">
                        <i class="ti-settings text-primary"></i>
                        {{ __('Profile') }}
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ti-power-off text-primary"></i>
                        {{ __('Sign out') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>
