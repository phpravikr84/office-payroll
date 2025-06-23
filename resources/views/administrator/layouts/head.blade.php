<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- New CSS -->
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('backend/vendors/feather/feather.css') }}">
      <link rel="stylesheet" href="{{ asset('backend/vendors/ti-icons/css/themify-icons.css') }}">
      <link rel="stylesheet" href="{{ asset('backend/vendors/css/vendor.bundle.base.css') }}">
      <!-- endinject -->
      <!-- Plugin css for this page -->
      <link rel="stylesheet" href="{{ asset('backend/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
      <link rel="stylesheet" href="{{ asset('backend/vendors/ti-icons/css/themify-icons.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('backend/js/select.dataTables.min.css') }}">
      <!-- End plugin css for this page -->
      <!-- inject:css -->
      <link rel="stylesheet" href="{{ asset('backend/css/vertical-layout-light/style.css') }}">
      <!-- Custom Css -->
      <link rel="stylesheet" href="{{ asset('backend/css/layout.css') }}">
      <!-- endinject -->
      <link rel="shortcut icon" href="{{ asset('backend/images/favicon.png') }}" />
      

      <!-- Font Awesome for calendar icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    .loginBg{
    background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
	background-size: 400% 400%;
	animation: gradient 15s ease infinite;
	height: auto;
  color: #fff !important;
}

.sidebar .nav .nav-item .nav-link i.menu-icon {
    font-size: 1rem;
    line-height: 1;
    margin-right: 1rem;
    color: #fff !important;
}
.sidebar .nav .nav-item .nav-link { color: #fff; }
.sidebar-mini .sidebar .nav .nav-item .nav-link .menu-title{ color: #fff; }

@keyframes gradient {
	0% {
		background-position: 0% 50%;
	}
	50% {
		background-position: 100% 50%;
	}
	100% {
		background-position: 0% 50%;
	}
}
.expandable-table thead tr th { color: #5A5A5A; }
  </style>
</head>