<!-- Header -->
<header class="shadow-lg shadow-blue-500/5 bg-white sticky top-0 left-0 w-full z-100">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <div class="h-10 rounded-lg flex items-center justify-center">
                <a href="/">
                    <img src="{{ asset('assets/dashboard/images/team-room-dashboard.svg') }}" alt="Team Room" width="150">
                </a>
            </div>
        </div>
        <nav id="desktop-menu" class="hidden md:flex space-x-8">
            <a href="/" class="text-gray-600 hover:text-blue-500">Home</a>
            <a href="/explore" class="text-gray-600 hover:text-blue-500">Explore</a>
            <a href="/about" class="text-gray-600 hover:text-blue-500">About</a>
            <a href="/contact" class="text-gray-600 hover:text-blue-500">Contact</a>
        </nav>
        @auth
            <div class="hidden md:flex items-center space-x-4">
                @if(Auth::user()->roles[0]->name == 'admin')
                    <a href="/dashboard" class="text-blue-500 font-medium hover:text-blue-600">Dashboard</a>
                @else
                    <a href="{{route('user.profile', Auth::user()->slug)}}" class="text-blue-500 font-medium hover:text-blue-600">Profile</a>
                @endif
                
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-600 transition cursor-pointer">Sign out</button>
                </form>
            </div>    
        @endauth
        @guest
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{route('login')}}" class="text-blue-500 font-medium hover:text-blue-600">Log in</a>
                <a href="{{route('register')}}" class="bg-blue-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-600 transition">Sign up</a>
            </div>    
        @endguest
        <button id="mobile-menu-button" class="md:hidden text-gray-700 focus:outline-none">
            <i class="fas fa-bars text-xl"></i>
        </button>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-100 shadow-md">
        <div class="container mx-auto px-4 py-3 space-y-2">
            <a href="/" class="block py-2 text-gray-600 hover:text-blue-500">Home</a>
            <a href="/explore" class="block py-2 text-gray-600 hover:text-blue-500">Explore</a>
            <a href="/about" class="block py-2 text-gray-600 hover:text-blue-500">About</a>
            <a href="/contact" class="block py-2 text-gray-600 hover:text-blue-500">Contact</a>
            
            @auth
                <div class="pt-2 border-t border-gray-100">
                    @if(Auth::user()->roles[0]->name == 'admin')
                        <a href="/dashboard" class="block py-2 text-blue-500 font-medium hover:text-blue-600">Dashboard</a>
                    @else
                        <a href="{{route('user.profile', Auth::user()->slug)}}" class="block py-2 text-blue-500 font-medium hover:text-blue-600">Profile</a>
                    @endif
                    
                    <form action="{{route('logout')}}" method="POST" class="py-2">
                        @csrf
                        <button class="w-full text-left bg-blue-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-600 transition cursor-pointer">Sign out</button>
                    </form>
                </div>
            @endauth
            @guest
                <div class="pt-2 border-t border-gray-100">
                    <a href="{{route('login')}}" class="block py-2 text-blue-500 font-medium hover:text-blue-600">Log in</a>
                    <a href="{{route('register')}}" class="block py-2 mt-2 text-center bg-blue-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-600 transition">Sign up</a>
                </div>
            @endguest
        </div>
    </div>
</header>