<nav class="flex justify-between items-center py-4">
    <h1 class="text-3xl font-bold">P2P Rental Marketplace</h1>

    <ul class="flex justify-between">
        <li class="mr-6">
            <a href="/" class="text-gray-600 hover:text-gray-900">Home</a>
        </li>
        <li class="mr-6">
            <a href="/" class="text-gray-600 hover:text-gray-900">Explore</a>
        </li>
        <li class="mr-6">
            <a href="/" class="text-gray-600 hover:text-gray-900">Contact</a>
        </li>
        <li class="mr-6">
            <a href="/" class="text-gray-600 hover:text-gray-900">About</a>
        </li>
    </ul>
    
    <!-- Authentication Links -->
    @auth
        <ul class="flex justify-end">
            <form action="{{route('logout')}}" method="POST">
                @csrf
                <button type="submit" class="text-gray-600 hover:text-gray-900">Logout</button>
            </form>
        </ul>
    @endauth
    @guest
        <ul class="flex justify-end">
            <li class="mr-6">
                <a href="/login" class="text-gray-600 hover:text-gray-900">Login</a>
            </li>
            <li class="mr-6">
                <a href="/register" class="text-gray-600 hover:text-gray-900">Register</a>
            </li>
        </ul>    
    @endguest
</nav>