<!-- Header -->
<header class="bg-white shadow-lg shadow-blue-500/10 sticky top-0 left-0 w-full z-50 transition-all duration-300">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center">
            <a href="/" class="focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-lg" aria-label="Team Room Home">
                <img src="{{ asset('assets/dashboard/images/team-room-dashboard.svg') }}" alt="Team Room" width="150" class="h-10 w-auto">
            </a>
        </div>

        <!-- Desktop Navigation -->
        <nav id="desktop-menu" class="hidden md:flex items-center space-x-8">
            @php
                $navItems = [
                    ['url' => '/', 'label' => 'Home'],
                    ['url' => '/explore', 'label' => 'Explore'],
                    ['url' => '/about', 'label' => 'About'],
                    ['url' => '/contact', 'label' => 'Contact'],
                ];
                $currentRoute = Route::currentRouteName();
            @endphp

            @foreach ($navItems as $item)
                <a href="{{ $item['url'] }}" 
                   class="text-gray-700 hover:text-blue-600 font-medium relative py-2 group transition-colors duration-200
                       {{ request()->is(trim($item['url'], '/')) ? 'text-blue-600' : '' }}">
                    {{ $item['label'] }}
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-500 group-hover:w-full transition-all duration-300
                          {{ request()->is(trim($item['url'], '/')) ? 'w-full' : '' }}"></span>
                </a>
            @endforeach
        </nav>

        <!-- Desktop Auth Buttons -->
        <div class="hidden md:flex items-center space-x-5">
            @auth
                <div class="flex items-center space-x-4">
                    <div class="relative group">
                        <button id="user-menu-button" class="flex items-center space-x-2 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-lg p-1">
                            <img src="{{ Auth::user()->profile_photo ?? asset('images/profile-pictures/default-avatar.svg') }}" alt="Profile" 
                                 class="h-9 w-9 rounded-full object-cover border-2 border-gray-200">
                            <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div id="user-dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden group-focus-within:block">
                            @if(Auth::user()->roles[0]->name == 'admin')
                                <a href="/dashboard" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                    <i class="h-5 w-5 mr-2 fa-solid fa-gauge"></i>
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('user.profile', Auth::user()->slug) }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                    Profile
                                </a>
                            @endif
                            
                            <a href="/bookings" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                Profile
                            </a>
                            
                            <div class="border-t border-gray-100 my-1"></div>
                            
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V4a1 1 0 00-1-1H3zm11 4a1 1 0 10-2 0v4a1 1 0 102 0V7z" clip-rule="evenodd" />
                                        <path d="M4 9a1 1 0 011-1h4a1 1 0 110 2H5a1 1 0 01-1-1z" />
                                    </svg>
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth
            
            @guest
                <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:text-blue-700 transition-colors duration-200 px-3 py-2 rounded-md hover:bg-blue-50">
                    Log in
                </a>
                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-5 py-2.5 rounded-lg font-medium hover:bg-blue-700 transition-colors duration-200 shadow-sm hover:shadow focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Sign up
                </a>
            @endguest
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-button" class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-blue-600 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg id="menu-icon" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg id="close-icon" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-100 shadow-md">
        <div class="px-2 pt-2 pb-4 space-y-1 sm:px-3">
            @foreach ($navItems as $item)
                <a href="{{ $item['url'] }}" 
                   class="block px-3 py-2.5 rounded-md font-medium transition-colors duration-200
                       {{ request()->is(trim($item['url'], '/')) ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50 hover:text-blue-600' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </div>
        
        <div class="pt-4 pb-3 border-t border-gray-100">
            @auth
                <div class="flex items-center px-5 mb-3">
                    <div class="flex-shrink-0">
                        <img src="
                            @if (Auth::user()->profile_picture_url)
                                {{ asset(Auth::user()->profile_picture_url) }}
                            @else
                                {{ asset('/images/profile-pictures/default-avatar.svg') }}
                            @endif
                        " alt="Profile" class="h-10 w-10 rounded-full">
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="space-y-1 px-2">
                    @if(Auth::user()->roles[0]->name == 'admin')
                        <a href="/dashboard" class="block px-3 py-2.5 rounded-md text-gray-700 font-medium hover:bg-gray-50 hover:text-blue-600 transition-colors duration-200">Dashboard</a>
                    @else
                        <a href="{{ route('user.profile', Auth::user()->slug) }}" class="block px-3 py-2.5 rounded-md text-gray-700 font-medium hover:bg-gray-50 hover:text-blue-600 transition-colors duration-200">Profile</a>
                    @endif
                    
                    <a href="/bookings" class="block px-3 py-2.5 rounded-md text-gray-700 font-medium hover:bg-gray-50 hover:text-blue-600 transition-colors duration-200">My Bookings</a>
                    
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2.5 rounded-md text-red-600 font-medium hover:bg-red-50 transition-colors duration-200">Sign out</button>
                    </form>
                </div>
            @endauth
            
            @guest
                <div class="space-y-3 px-4 py-2">
                    <a href="{{ route('login') }}" class="block text-center w-full px-4 py-2.5 rounded-md border border-blue-600 text-blue-600 font-medium hover:bg-blue-50 transition-colors duration-200">Log in</a>
                    <a href="{{ route('register') }}" class="block text-center w-full px-4 py-2.5 rounded-md bg-blue-600 text-white font-medium hover:bg-blue-700 transition-colors duration-200">Sign up</a>
                </div>
            @endguest
        </div>
    </div>
</header>