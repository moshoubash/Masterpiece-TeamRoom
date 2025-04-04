<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Admin &amp; Dashboard for MeetSpace">
	<meta name="author" content="Mohammad Shoubash">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{asset('assets/dashboard/img/icons/icon-48x48.png')}}" />

	<title>@yield('title', 'Admin Dashboard')</title>

	<link href="{{asset('assets/dashboard/css/app.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
        @include('layouts.dashboard.components.sidebar')


        <div class="main">
            @include('layouts.dashboard.components.navbar')

            <main class="content">
                <div class="container-fluid p-0">
                    @yield('content')
                </div>
            </main>

            @include('layouts.dashboard.components.footer')
        </div>
    </div>

	<script src="{{asset('assets/dashboard/js/app.js')}}"></script>

    @yield('scripts')
</body>
</html>