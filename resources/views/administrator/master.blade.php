<!DOCTYPE html>
<html>
    <!-- head -->
    @include('administrator.layouts.head')
    <!-- /head -->
    <body class="hold-transition skin-purple-light sidebar-mini">
        <!-- Site wrapper -->
        <div class="container-scroller">

            <!-- header -->
            @include('administrator.layouts.header')
            <!-- /header -->
            <div class="container-fluid page-body-wrapper">
                <!-- Left side column. contains the side bar -->
                @include('administrator.layouts.left_side_bar')
                <!-- /Left Side Bar -->
                <div class="main-panel">

                        <!-- Content Wrapper. Contains page content -->
                        @yield('main_content')
                        <!-- /content-wrapper -->

                        <!-- Footer. contains the footer -->
                        @include('administrator.layouts.footer')
                        <!-- /Footer -->
                        </div>
                <!-- main-panel ends -->
                </div>
                <!-- page-body-wrapper ends -->
            </div>
            <!-- container-scroller -->

        <!-- Scripts. contains the script -->
        @include('administrator.layouts.scripts')
        <!-- /Scripts -->

        
    </body>


</html>
