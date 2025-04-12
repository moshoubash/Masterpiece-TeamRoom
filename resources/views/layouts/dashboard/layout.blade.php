<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'Admin Dashboard')</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="Mohammad Shoubash">

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('assets/dashboard/images/favicon.svg') }}" type="image/x-icon">
    <!-- [Google Font] Family -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&amp;display=swap"
        id="main-font-link">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/fonts/tabler-icons.min.css') }}">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/fonts/feather.css') }}">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <script src="https://kit.fontawesome.com/d890c03bb3.js" crossorigin="anonymous"></script>
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/fonts/material.css') }}">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/style-preset.css') }}">
</head>

<body>
    <div class="wrapper">
        <!-- [ Sidebar Menu ] start -->
        @include('layouts.dashboard.components.sidebar')
        <!-- [ Sidebar Menu ] end -->

        <!-- [ Header Topbar ] start -->
        @include('layouts.dashboard.components.navbar')
        <!-- [ Header ] end -->


        <!-- [ Main Content ] start -->
        <div class="pc-container">
            <div class="pc-content">
              <!-- [ breadcrumb ] start -->
              
              <!-- [ breadcrumb ] end -->
              <!-- [ Main Content ] start -->
              @yield('content')
            </div>
          </div>
        <!-- [ Main Content ] end -->
        
        <!-- [ Footer ] start -->
        @include('layouts.dashboard.components.footer')
        <!-- [ Footer ] start -->

    </div>

    @yield('scripts')

    <script src="{{ asset('assets/dashboard/js/plugins/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/pages/dashboard-default.js') }}"></script>
    <!-- [Page Specific JS] end -->
    <!-- Required Js -->
    <script src="{{ asset('assets/dashboard/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/pcoded.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/plugins/feather.min.js') }}"></script>
</body>

</html>
