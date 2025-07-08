<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Payhours Admin</title>

  <!-- Plugins and styles -->
  <link rel="stylesheet" href="{{ asset('backend/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/css/vertical-layout-light/style.css') }}">
  <link rel="shortcut icon" href="{{ asset('backend/images/favicon.png') }}" />

  <!-- Custom CSS -->
  <style>
    body, html {
      height: 100%;
      margin: 0;
    }

    .loginBg {
      background: url('{{ asset("profile_picture/payroll_management-bg.png") }}') no-repeat center center;
      background-size: cover;
      height: 100vh;
      display: flex;
      justify-content: flex-end;
      align-items: center;
    }

    .auth-form-light {
      background: rgb(255 255 255 / 7%); /* white transparent */
      box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
      border-radius: 10px;
      padding: 0px 40px;
      width: 100%;
      max-width: 400px;
      margin-right: 60px;
    }

    .form-control {
      border-radius: 4px;
    }

    .btn-primary {
      background: linear-gradient(to right, #FF5541, #E55A53);
      border: none;
      color: #fff;
      font-weight: 600;
      transition: background 0.3s ease-in-out;
    }

    .btn-primary:hover {
      background: linear-gradient(to right, #E55A53, #FF5541);
    }

    .btn-link {
      color: #000;
      text-decoration: underline;
    }

    .help-block {
      color: red;
      font-size: 13px;
    }

    .brand-logo img {
      display: block;
      margin: 0 auto 20px;
    }

    h4 {
      text-align: center;
      margin-bottom: 25px;
      color: #0222A4;
    }
  </style>
</head>

<body>
  <div class="loginBg">
    <div class="auth-form-light text-left pt-5">
      <div class="brand-logo">
        <!-- <img src="{{ asset('backend/images/logo.svg') }}" width="150" alt="logo"/> -->
      </div>
      <h4>Sign In</h4>
      <form method="POST" action="{{ route('login') }}">
        @csrf

        @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <div class="form-group">
          <label for="email" class="text-dark">{{ __('E-Mail Address') }}</label>
          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
          @if ($errors->has('email'))
          <span class="help-block">{{ $errors->first('email') }}</span>
          @endif
        </div>

        <div class="form-group">
          <label for="password" class="text-dark">{{ __('Password') }}</label>
          <input id="password" type="password" class="form-control" name="password" required>
          @if ($errors->has('password'))
          <span class="help-block">{{ $errors->first('password') }}</span>
          @endif
        </div>

        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
          <label class="form-check-label text-dark" for="remember">{{ __('Remember Me') }}</label>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary w-100">{{ __('Login') }}</button>
        </div>

        <div class="text-center">
          <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('backend/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('backend/js/off-canvas.js') }}"></script>
  <script src="{{ asset('backend/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('backend/js/template.js') }}"></script>
  <script src="{{ asset('backend/js/settings.js') }}"></script>
  <script src="{{ asset('backend/js/todolist.js') }}"></script>
</body>

</html>
