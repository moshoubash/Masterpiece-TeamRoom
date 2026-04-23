<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="title" content="Team Room" />
    <meta name="description" content="Best P2P Rental Marketplace for meeting rooms" />
    <meta name="keywords"
        content="Meeting Room, P2P Rental Marketplace, Team Room, Meeting Room Booking, Meeting Room Booking Platform, Meeting Room Booking App" />
    <title>Team Room - Meeting rooms Booking Platform</title>

    <link rel="icon" href="{{ asset('assets/dashboard/images/team-room-logo-dashboard.svg') }}" type="image/x-icon">

    <!-- Styles / Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    @vite('resources/js/app.js')

    @yield('styles')

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    {!! ToastMagic::styles() !!}

    <style>
        .toast-container {
            z-index: 9999999 !important;
            margin-top: 80px;
        }
    </style>
</head>

<body style="font-family: 'Inter', sans-serif; margin: 0 auto">
    @include('layouts.home.components.navbar')

    @yield('content')

    @include('layouts.home.components.footer')

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    @yield('scripts')

    <!-- Mobile Menu -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            function toggleMobileMenu() {
                if (mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.remove('hidden');
                } else {
                    mobileMenu.classList.add('hidden');
                }
            }

            mobileMenuButton.addEventListener('click', toggleMobileMenu);

            window.addEventListener('resize', function () {
                if (window.innerWidth >= 768) {
                    mobileMenu.classList.add('hidden');
                }
            });
        });

        const button = document.getElementById('notification-button');
        const dropdown = document.getElementById('notification-dropdown');

        button.addEventListener('click', () => {
            dropdown.classList.toggle('hidden');
        });

        // Optional: Hide dropdown when clicking outside
        document.addEventListener('click', (event) => {
            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

    @auth
        <script type="module">
            window.addEventListener('load', () => {
                if (window.Echo) {
                    Echo.private(`App.Models.User.` + @json(auth()->id()))
                        .listen('NewNotification', (e) => {
                            const badgeContainer = document.getElementById('notification-badge-container');
                            const countSpan = document.getElementById('notification-unread-count');

                            if (countSpan) {
                                let currentCount = parseInt(countSpan.innerText.trim()) || 0;
                                countSpan.innerText = currentCount + 1;
                            }

                            if (badgeContainer) {
                                badgeContainer.classList.remove('hidden');
                            }

                            const noNotificationsMessage = document.getElementById('no-notifications-message');
                            if (noNotificationsMessage) {
                                noNotificationsMessage.remove();
                            }

                            const notificationList = document.getElementById('notification-list');
                            if (notificationList) {
                                const newNotificationHtml = `
                                                                        <div class="px-4 py-3 hover:bg-gray-50 border-b border-gray-100 bg-blue-50">
                                                                            <div class="flex justify-between items-start">
                                                                                <div class="flex items-start space-x-3">
                                                                                    <div class="bg-blue-100 p-2 rounded-full text-blue-500">
                                                                                        <i class="fa-solid fa-comment-dots"></i>
                                                                                    </div>
                                                                                    <div>
                                                                                        <h4 class="font-medium text-gray-800">${e.notification.title}</h4>
                                                                                        <p class="text-sm text-gray-600 mt-1">${e.notification.message}</p>
                                                                                        <span class="text-xs text-gray-500 mt-1 block">
                                                                                            Just now
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                                                            </div>
                                                                        </div>
                                                                    `;
                                notificationList.insertAdjacentHTML('afterbegin', newNotificationHtml);
                            }
                        });
                }
            });
        </script>
    @endauth

    {!! ToastMagic::scripts() !!}
</body>

</html>