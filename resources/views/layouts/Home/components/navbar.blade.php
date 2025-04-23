<!-- Header -->
<header class="shadow-lg shadow-blue-500/5">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <div class="h-10 rounded-lg flex items-center justify-center">
                <a href="/">
                    <img src="{{ asset('assets/dashboard/images/team-room-dashboard.svg') }}" alt="Team Room" width="150">
                </a>
            </div>
        </div>
        <nav class="hidden md:flex space-x-8">
            <a href="/" class="text-gray-600 hover:text-blue-500">Home</a>
            <a href="/explore" class="text-gray-600 hover:text-blue-500">Explore</a>
        </nav>
        @auth
            <div class="flex items-center space-x-4">
                <a href="{{route('user.profile', Auth::user()->id)}}" class="text-blue-500 font-medium hover:text-blue-600">Profile</a>
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-600 transition cursor-pointer">Sign out</button>
                </form>
            </div>    
        @endauth
        @guest
            <div class="flex items-center space-x-4">
                <a href="{{route('login')}}" class="text-blue-500 font-medium hover:text-blue-600">Log in</a>
                <a href="{{route('register')}}" class="bg-blue-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-600 transition">Sign up</a>
            </div>    
        @endguest
        <button class="md:hidden text-gray-700">
            <i class="fas fa-bars text-xl"></i>
        </button>
    </div>
</header>