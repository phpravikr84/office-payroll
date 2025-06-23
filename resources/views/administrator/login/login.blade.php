<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{ __('Admin Login') }}</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{  asset('backend/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{  asset('backend/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{  asset('backend/vendors/css/vendor.bundle.base.css') }}">
  <!-- inject:css -->
  <link rel="stylesheet" href="{{  asset('backend/css/vertical-layout-light/style.css') }}">
  <!-- favicon -->
  <link rel="shortcut icon" href="{{  asset('backend/images/favicon.png') }}" />
</head>

<body class="hold-transition login-page" style="
    background-image: url(public/profile_picture/bgold.jpg); background-size: cover;">
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="{{  asset('backend/images/logo.svg') }}" alt="logo">
              </div>
              <h4>{{ __('Hello! let\'s get started') }}</h4>
              <h6 class="font-weight-light">{{ __('Sign in to continue.') }}</h6>
              <form method="POST" action="{{ route('login') }}" class="pt-3">
              {{ csrf_field() }}
              
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                        <input type="email" name="email" class="form-control" placeholder="{{ __('email') }}">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                        <input type="password" name="password" class="form-control" placeholder="{{ __('Password') }}">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">{{ __('SIGN IN') }}</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Keep me signed in') }}
                    </label>
                  </div>
                  @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}" class="auth-link text-black">{{ __('Forgot password?') }}</a>
                  @endif
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- plugins:js -->
  <script src="{{  asset('backend/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- inject:js -->
  <script src="{{  asset('backend/js/off-canvas.js') }}"></script>
  <script src="{{  asset('backend/js/hoverable-collapse.js') }}"></script>
  <script src="{{  asset('backend/js/template.js') }}"></script>
  <script src="{{  asset('backend/js/settings.js') }}"></script>
  <script src="{{  asset('backend/js/todolist.js') }}"></script>
</body>

</html>
