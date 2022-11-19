<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> @yield('title', 'Dashboard') </title>
    <meta name="robots" content="noindex">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    @yield('style')
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="shortcut icon" href="/assets/images/favicon.png" />
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('includes.sidebar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
       @include('includes.navbar')
        <!-- partial -->
        <div class="main-panel">
            @include('includes.error')
            <div class="content-wrapper">
                @yield('content')
            </div>
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Mottolial Store 2022</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Công ty TNHH Amora Việt Nam</span>
                </div>
            </footer>
            <!-- partial -->
        </div>

        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>




<script src="/assets/vendors/js/vendor.bundle.base.js"></script>
<script src="/assets/vendors/chart.js/Chart.min.js"></script>
<script src="/assets/vendors/progressbar.js/progressbar.min.js"></script>
<script src="/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
<script src="/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<script src="/assets/js/off-canvas.js"></script>
<script src="/assets/js/hoverable-collapse.js"></script>
<script src="/assets/js/misc.js"></script>
<script src="/assets/js/settings.js"></script>
<script src="/assets/js/todolist.js"></script>

@yield('script')

<script src="/assets/js/dashboard.js"></script>
<!-- End custom js for this page -->
</body>
</html>
