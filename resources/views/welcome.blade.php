@extends('layouts.Home.layout')
@section('styles')
    <style>
        #hero {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url("{{ asset('https://www.renderhub.com/archcorners/modern-meeting-room/modern-meeting-room-01.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
@endsection
@section('content')
    <!-- Alert if there is an message -->
    @if (session('message'))
        <div class="z-999999 fixed top-20 left-1/2 transform -translate-x-1/2 p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
            role="alert">
            {{ session('message') }}
        </div>
    @endif

    <!-- Hero Section -->
    <div id="hero"
        class="relative z-10 flex flex-col items-center justify-center min-h-screen text-center p-4 md:p-8 bg-gradient-to-r from-indigo-900 to-blue-800">
        <!-- Background Pattern Overlay -->
        <div class="absolute inset-0 bg-black opacity-50 z-0"></div>
        <div class="relative z-10 max-w-5xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 tracking-tight">
                Find the Perfect <span class="italic text-blue-400 relative inline-block">
                    <span class="relative z-10">Meeting Room</span>
                    <span class="absolute -bottom-1 left-0 w-full h-3 bg-blue-600 opacity-30 rounded"></span>
                </span>
            </h1>
            <p class="text-lg md:text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Book professional meeting rooms from local businesses and individuals at competitive rates
            </p>

            <form
                class="flex flex-col md:flex-row bg-white/95 max-w-4xl mx-auto rounded-xl shadow-2xl overflow-hidden border-2 border-blue-100/20 p-3 gap-3 md:gap-0 md:p-2 backdrop-blur-sm transition-all hover:shadow-blue-500/20"
                action="{{ route('explore') }}" method="get">

                <!-- Location Select -->
                <div
                    class="flex flex-col px-4 py-2 md:border-r border-gray-200 flex-1 min-w-[150px] group transition duration-300">
                    <label
                        class="text-xs text-gray-500 font-medium group-hover:text-blue-600 transition-colors">Location</label>
                    <select class="outline-none text-gray-800 bg-transparent cursor-pointer font-medium" name="location">
                        <option value="amman" {{ request('location') == 'amman' ? 'selected' : '' }}>Amman</option>
                        <option value="irbid" {{ request('location') == 'irbid' ? 'selected' : '' }}>Irbid</option>
                    </select>
                </div>

                <!-- Date Input -->
                <div
                    class="flex flex-col px-4 py-2 md:border-r border-gray-200 flex-1 min-w-[150px] group transition duration-300">
                    <label
                        class="text-xs text-gray-500 font-medium group-hover:text-blue-600 transition-colors">Date</label>
                    <input type="date" class="outline-none text-gray-800 bg-transparent cursor-pointer font-medium"
                        name="date" value="{{ request('date', now()->format('Y-m-d')) }}">
                </div>

                <!-- Check-in Time -->
                <div
                    class="flex flex-col px-4 py-2 md:border-r border-gray-200 flex-1 min-w-[150px] group transition duration-300">
                    <label
                        class="text-xs text-gray-500 font-medium group-hover:text-blue-600 transition-colors">Check-in</label>
                    <input type="time" class="outline-none text-gray-800 bg-transparent cursor-pointer font-medium"
                        name="start_time" value="{{ request('start_time', '09:00') }}">
                </div>

                <!-- Capacity -->
                <div
                    class="flex flex-col px-4 py-2 md:border-r border-gray-200 flex-1 min-w-[150px] group transition duration-300">
                    <label
                        class="text-xs text-gray-500 font-medium group-hover:text-blue-600 transition-colors">Capacity</label>
                    <select name="capacity" class="outline-none text-gray-800 bg-transparent cursor-pointer font-medium">
                        <option value="">Any capacity</option>
                        @foreach ([4, 8, 12, 20, 50] as $size)
                            <option value="{{ $size }}" {{ request('capacity') == $size ? 'selected' : '' }}>
                                {{ $size }}+ people</option>
                        @endforeach
                    </select>
                </div>

                <!-- Search Button -->
                <button type="submit"
                    class="cursor-pointer bg-blue-600 hover:bg-blue-700 active:bg-blue-800 transition-all text-white px-6 py-3 md:py-0 flex items-center justify-center rounded-lg md:rounded-full ml-0 md:ml-2 font-medium shadow-lg hover:shadow-xl hover:shadow-blue-600/20 transform hover:-translate-y-0.5 active:translate-y-0">
                    <span class="mr-2 md:hidden lg:inline">Search</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-20 bg-gradient-to-b from-white to-blue-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-1 rounded-full bg-blue-100 text-blue-700 font-medium text-sm mb-3">Simple
                    Process</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">How it <span
                        class="text-blue-600">works</span></h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Get started in minutes with our simple setup process.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                @php
                    $steps = [
                        [
                            'number' => 1,
                            'title' => 'Create your account',
                            'description' => 'Sign up and configure your workspace details and meeting rooms.',
                            'icon' => 'user-plus',
                        ],
                        [
                            'number' => 2,
                            'title' => 'Invite your team',
                            'description' => 'Add team members to start collaborating on room bookings.',
                            'icon' => 'users',
                        ],
                        [
                            'number' => 3,
                            'title' => 'Start booking',
                            'description' => 'Reserve rooms, manage resources, and optimize your workspace.',
                            'icon' => 'calendar',
                        ],
                    ];
                @endphp

                @foreach ($steps as $step)
                    <div class="text-center group">
                        <div class="relative">
                            <!-- Step Number -->
                            <div
                                class="w-20 h-20 bg-blue-600 group-hover:bg-blue-700 transition-all duration-300 rounded-2xl rotate-45 flex items-center justify-center mx-auto mb-8 shadow-lg group-hover:shadow-xl group-hover:shadow-blue-300">
                                <span class="text-white font-bold text-2xl -rotate-45">{{ $step['number'] }}</span>
                            </div>

                            <!-- Connector Line (except for last item) -->
                            @if (!$loop->last)
                                <div class="hidden md:block absolute top-10 left-[55%] w-full h-1 bg-blue-200"></div>
                            @endif
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
                            {{ $step['title'] }}</h3>
                        <p class="text-gray-600 px-6">{{ $step['description'] }}</p>

                        <!-- Animated Button -->
                        @if ($step['number'] === 1)
                            <a href="{{ route('register') }}"
                                class="inline-block mt-4 px-6 py-2 bg-blue-100 text-blue-700 rounded-lg font-medium hover:bg-blue-200 transition-colors">
                                Get Started
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-white">
        <div class="container mx-auto px-4 py-8">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-12">
                <div class="mb-6 md:mb-0">
                    <span
                        class="inline-block px-4 py-1 rounded-full bg-blue-100 text-blue-700 font-medium text-sm mb-3">Curated
                        Spaces</span>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Latest Meeting Spaces</h2>
                    <p class="text-gray-600 max-w-2xl">Discover our hosts latest meeting rooms</p>
                </div>

                <!-- Navigation Controls with Blade Component -->
                <div class="flex space-x-3">
                    @php
                        $buttonClasses =
                            'flex items-center justify-center w-12 h-12 rounded-full border-2 border-gray-200 hover:border-blue-500 hover:text-blue-600 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50';
                    @endphp

                    <button id="prev-spaces" class="{{ $buttonClasses }}" aria-label="Previous spaces">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button id="next-spaces" class="{{ $buttonClasses }}" aria-label="Next spaces">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Meeting Spaces Cards Carousel -->
            <div class="relative overflow-hidden">
                <div id="spaces-carousel" class="flex transition-transform duration-500 ease-in-out">
                    @foreach ($meetingRooms as $index => $room)
                        <div class="w-full md:w-1/2 lg:w-1/3 flex-shrink-0 px-4">
                            <div
                                class="group rounded-xl overflow-hidden bg-white shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 hover:shadow-blue-100 relative">
                                <!-- New Badge (if applicable) -->
                                <div
                                    class="absolute top-4 right-4 z-10 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                                    New
                                </div>

                                <!-- Room Image with Hover Effect -->
                                <div class="relative overflow-hidden h-56">
                                    @if (asset('storage/' . $room->images->first()->image_url) != null)
                                        <img src="{{ asset('storage/' . $room->images->first()->image_url) }}"
                                            alt="{{ $room->title }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    @endif
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>

                                    <!-- Quick Actions (visible on hover) -->
                                    <div
                                        class="absolute bottom-4 left-4 right-4 flex justify-between opacity-0 transform translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300">
                                        <a href="{{ route('rooms.details', $room->slug) }}"
                                            class="bg-white/90 hover:bg-white text-blue-600 px-3 py-1.5 rounded-lg text-sm font-medium shadow-lg">
                                            View Details
                                        </a>
                                    </div>
                                </div>

                                <!-- Room Info -->
                                <div class="p-5">
                                    <div class="flex justify-between items-start">
                                        <h3
                                            class="font-bold text-lg text-gray-900 group-hover:text-blue-600 transition-colors">
                                            {{ $room->title }}</h3>
                                        <div class="flex items-center bg-blue-50 rounded-lg px-2 py-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <span class="ml-1 font-medium">{{ '0.0' }}</span>
                                        </div>
                                    </div>

                                    <div class="flex items-center mt-3 text-sm text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-1">{{ $room->city }}</span>

                                        <span class="mx-2">•</span>

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-1">Up to {{ $room->capacity }} people</span>
                                    </div>

                                    <!-- Amenities -->
                                    <div class="mt-3 flex flex-wrap gap-1">
                                        @foreach ($room->amenities as $amenity)
                                            <span
                                                class="inline-block bg-gray-100 rounded-full px-2 py-0.5 text-xs text-gray-700">
                                                {{ $amenity->name }}
                                            </span>
                                        @endforeach
                                    </div>

                                    <!-- Price with Book Button -->
                                    <div class="mt-4 flex justify-between items-center">
                                        <div>
                                            <span class="font-bold text-xl text-gray-900">${{ $room->hourly_rate }}</span>
                                            <span class="text-gray-600 text-sm">/hr</span>
                                        </div>

                                        <a href="/explore"
                                            class="text-blue-600 hover:text-blue-800 font-medium text-sm transition-colors">
                                            Check Availability
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- View All Button -->
            <div class="text-center mt-12">
                <a href="{{ route('explore') }}"
                    class="inline-block px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                    View All Meeting Spaces
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="container mx-auto px-4 md:px-8">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">What Our Users Say</h2>
                <div class="w-24 h-1 bg-blue-500 mx-auto my-4 rounded-full"></div>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Don't just take our word for it - see what our community
                    has to say about their experience</p>
            </div>

            <!-- Testimonials Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8 max-w-6xl mx-auto">
                @php
                    $testimonials = [
                        [
                            'name' => 'Hanif Kazemi',
                            'position' => 'Office Manager',
                            'image' => 'images/profile-pictures/1.jpg',
                            'quote' =>
                                "We've been renting out our extra conference room through SpaceMeet, and it's generated over $2,000 in additional revenue each month. The process is hassle-free and the support team is fantastic!",
                            'rating' => 5,
                        ],
                        [
                            'name' => 'Abdullahi Hatem',
                            'position' => 'Marketing Director',
                            'image' => 'images/profile-pictures/2.jpg',
                            'quote' =>
                                'TeamRoom saved us when we needed a last-minute meeting space for an important client presentation, as we got the perfect space with the perfect host.',
                            'rating' => 5,
                        ],
                        [
                            'name' => 'Mashal Hosein',
                            'position' => 'Freelance Consultant',
                            'image' => 'images/profile-pictures/3.jpg',
                            'quote' =>
                                'I needed a quiet, well-equipped meeting room for a client presentation, and I found the perfect one in just a few clicks.',
                            'rating' => 5,
                        ],
                        [
                            'name' => 'Rahim Emami',
                            'position' => 'Startup Founder',
                            'image' => 'images/profile-pictures/4.jpg',
                            'quote' =>
                                "As a small business, we can't afford permanent office space yet. TeamRoom allows us to book professional meeting rooms only when we need them, saving us thousands in overhead costs.",
                            'rating' => 5,
                        ],
                    ];
                @endphp

                @foreach ($testimonials as $testimonial)
                    <div
                        class="bg-white p-8 rounded-xl shadow-lg border border-gray-100 transition-transform duration-300 hover:shadow-xl hover:-translate-y-1">
                        <div class="flex items-start mb-6">
                            <div class="relative">
                                <img src="{{ asset($testimonial['image']) }}" alt="{{ $testimonial['name'] }}"
                                    class="w-16 h-16 rounded-full object-cover mr-4 border-2 border-blue-400">
                            </div>
                            <div>
                                <h3 class="font-bold text-xl text-gray-900">{{ $testimonial['name'] }}</h3>
                                <p class="text-blue-600 font-medium">{{ $testimonial['position'] }}</p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <p class="text-gray-700 text-lg leading-relaxed">{{ $testimonial['quote'] }}</p>
                        </div>

                        <div class="flex items-center">
                            <div class="flex mr-4">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 {{ $i <= $testimonial['rating'] ? 'text-yellow-500' : 'text-gray-300' }}"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            <p class="text-gray-500 text-sm">Verified Customer</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-500 to-blue-700 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-6">Ready to optimize your workspace?</h2>
            <p class="text-xl mb-10 max-w-2xl mx-auto opacity-90">Join thousands of companies already using MeetSpace to
                streamline their meeting room bookings.</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="/explore"
                    class="bg-white text-blue-600 px-8 py-4 rounded-full font-medium hover:bg-opacity-90 transition-all shadow-lg transform hover:-translate-y-1">
                    Find a Space
                </a>
                <a href="{{ route('room.create') }}"
                    class="border-2 border-white text-white px-8 py-4 rounded-full font-medium hover:bg-white hover:text-blue-600 transition-all shadow-lg transform hover:-translate-y-1">
                    List your space
                </a>
            </div>
        </div>
    </section>

    {{-- <section class="bg-gradient-to-b from-gray-50 to-gray-100 py-24 px-4 sm:px-6 text-center">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-800">List Your First Room for Free</h2>
            <p class="text-gray-600 mb-12 max-w-2xl mx-auto text-lg">
                Start earning by listing your first room at no cost. Want to add more listings? Upgrade for unlimited space
                visibility and better exposure.
            </p>
    
            <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <!-- Free Tier -->
                <div class="border border-gray-200 rounded-2xl p-8 bg-white shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col h-full">
                    <div class="mb-6">
                        <span class="inline-block px-4 py-1 rounded-full bg-gray-100 text-gray-700 text-sm font-medium mb-4">CURRENT PLAN</span>
                        <h3 class="text-2xl font-bold mb-2 text-gray-800">Free Plan</h3>
                        <p class="text-gray-600 mb-2">Perfect for first-time hosts</p>
                        <div class="border-t border-gray-100 w-full my-6"></div>
                    </div>
                    
                    <ul class="text-left space-y-4 mb-8 flex-grow">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>1 free listing</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Basic support</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Host dashboard access</span>
                        </li>
                    </ul>
                    
                    <button class="w-full bg-gray-200 text-gray-600 font-semibold py-3 px-6 rounded-lg cursor-not-allowed" disabled>
                        You're on this plan
                    </button>
                </div>
    
                <!-- Paid Tier -->
                <div class="border-2 border-blue-500 rounded-2xl p-8 bg-white shadow-lg relative flex flex-col h-full transform hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute -top-4 right-6">
                        <span class="bg-blue-500 text-white text-xs font-bold px-4 py-1 rounded-full uppercase">Recommended</span>
                    </div>
                    
                    <div class="mb-6">
                        <span class="inline-block px-4 py-1 rounded-full bg-blue-50 text-blue-700 text-sm font-medium mb-4">PREMIUM</span>
                        <h3 class="text-2xl font-bold mb-2 text-gray-800">Premium Plan</h3>
                        <p class="text-gray-600 mb-2">For serious hosts with multiple spaces</p>
                        <div class="border-t border-gray-100 w-full my-6"></div>
                    </div>
                    
                    <ul class="text-left space-y-4 mb-8 flex-grow">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span><strong>Unlimited</strong> listings</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span><strong>Priority</strong> support</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Advanced analytics & insights</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Featured listings</span>
                        </li>
                    </ul>
                    
                    <a href="#pricing"
                        class="w-full bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors duration-300 flex items-center justify-center">
                        Upgrade Now
                        <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section> --}}
@endsection
@section('scripts')
    <script>
        const dateInput = document.querySelector('input[type="date"]');

        if (!dateInput.value) {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            dateInput.value = `${year}-${month}-${day}`;
        }
    </script>

    <!-- Add JavaScript for carousel functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('spaces-carousel');
            const prevButton = document.getElementById('prev-spaces');
            const nextButton = document.getElementById('next-spaces');

            // Get all carousel items
            const carouselItems = carousel.children;
            const totalItems = carouselItems.length;

            // Show 3 cards per page
            const itemsPerPage = 3;
            const totalPages = Math.ceil(totalItems / itemsPerPage);

            let currentPage = 0;

            // Function to update carousel position
            function updateCarouselPosition() {
                // Calculate translateX value based on current page
                const translateValue = -currentPage * (100 / itemsPerPage);
                carousel.style.transform = `translateX(${translateValue}%)`;

                // Update button states
                prevButton.disabled = currentPage === 0;
                nextButton.disabled = currentPage === totalPages - 1;

                // Visual feedback for disabled buttons
                if (prevButton.disabled) {
                    prevButton.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    prevButton.classList.remove('opacity-50', 'cursor-not-allowed');
                }

                if (nextButton.disabled) {
                    nextButton.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    nextButton.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            }

            // Initialize carousel
            updateCarouselPosition();

            // Previous button click handler
            prevButton.addEventListener('click', function() {
                if (currentPage > 0) {
                    currentPage--;
                    updateCarouselPosition();
                }
            });

            // Next button click handler
            nextButton.addEventListener('click', function() {
                if (currentPage < totalPages - 1) {
                    currentPage++;
                    updateCarouselPosition();
                }
            });

            // Update on window resize to handle responsive layout changes
            window.addEventListener('resize', updateCarouselPosition);
        });
    </script>
@endsection