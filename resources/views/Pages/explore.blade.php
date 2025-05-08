<!-- resources/views/pages/explore.blade.php -->

@extends('layouts.Home.layout')
@section('content')
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <div class="flex items-center text-sm text-gray-600 mb-4">
                <a href="/" class="hover:text-blue-600">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('explore') }}" class="hover:text-blue-600">Explore</a>
            </div>
            <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-4 md:mb-0">
                    Discover Spaces
                </h1>

                <!-- Search Bar -->
                <div class="w-full md:w-2/5">
                    <form action="{{ route('explore') }}" method="GET">
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search for meeting spaces..."
                                class="w-full px-5 py-3 pl-12 border border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-700">

                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>

                            <button type="submit"
                                class="cursor-pointer absolute inset-y-0 right-0 flex items-center px-5 text-blue-600 hover:text-blue-800">
                                <span class="text-sm font-medium">Search</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Mobile Filter Toggle Button -->
                <div class="lg:hidden w-full mb-4">
                    <button id="filter-toggle"
                        class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg text-base font-medium hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 transition duration-150 ease-in-out flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Show Filters
                    </button>
                </div>

                <!-- Enhanced Filters Sidebar -->
                <div id="filters-container" class="w-full lg:w-1/4 hidden lg:block">
                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filters
                        </h2>

                        <form action="{{ route('explore') }}" method="GET" id="filter-form">
                            <!-- Keep search parameter if it exists -->
                            @if (request('search'))
                                <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif

                            <!-- Sort Filter -->
                            <div class="mb-6">
                                <label for="sort" class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                                <div class="relative">
                                    <select id="sort" name="sort"
                                        class="w-full pl-3 py-3 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-white appearance-none">
                                        <option value="">Default</option>
                                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
                                            Price: Low to High</option>
                                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                                            Price: High to Low</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                        <svg class="h-4 w-4 text-black" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Capacity Filter -->
                            <div class="mb-6">
                                <label for="capacity" class="block text-sm font-medium text-gray-700 mb-2">
                                    Capacity
                                </label>
                                <div class="relative">
                                    <select id="capacity" name="capacity"
                                        class="w-full pl-3 py-3 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-white appearance-none">
                                        <option value="">Any capacity</option>
                                        <option value="4" {{ request('capacity') == '4' ? 'selected' : '' }}>4+ people
                                        </option>
                                        <option value="8" {{ request('capacity') == '8' ? 'selected' : '' }}>8+ people
                                        </option>
                                        <option value="12" {{ request('capacity') == '12' ? 'selected' : '' }}>12+
                                            people</option>
                                        <option value="20" {{ request('capacity') == '20' ? 'selected' : '' }}>20+
                                            people</option>
                                        <option value="50" {{ request('capacity') == '50' ? 'selected' : '' }}>50+
                                            people</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                        <svg class="h-4 w-4 text-black" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Date Filter -->
                            <div class="mb-6">
                                <label for="date" class="block text-sm font-medium text-gray-700 mb-2">
                                    Date
                                </label>
                                <div class="relative">
                                    <input type="date" id="date" name="date"
                                        value="{{ request('date', date('Y-m-d')) }}"
                                        class="w-full pl-3 pr-3 py-3 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>

                            <!-- Time Range Filter -->
                            <div class="mb-6">
                                <fieldset>
                                    <legend class="block text-sm font-medium text-gray-700 mb-4">
                                        Time Range
                                    </legend>
                                    <div class="flex flex-col space-y-3">
                                        <div class="relative">
                                            <input type="time" id="start_time" name="start_time"
                                                class="w-full pl-3 pr-3 py-3 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                                                value="{{ request('start_time') }}" aria-label="Start time"
                                                placeholder="Start Time">
                                            <label for="start_time"
                                                class="absolute -top-2 left-2 bg-white px-1 text-xs text-gray-600">Start
                                                Time</label>
                                        </div>

                                        <div class="relative">
                                            <input type="time" id="end_time" name="end_time"
                                                class="w-full pl-3 pr-3 py-3 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                                                value="{{ request('end_time') }}" aria-label="End time"
                                                placeholder="End Time">
                                            <label for="end_time"
                                                class="absolute -top-2 left-2 bg-white px-1 text-xs text-gray-600">End
                                                Time</label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <!-- Amenities Filter with Icons -->
                            <div class="mb-6">
                                <span class="block text-sm font-medium text-gray-700 mb-3">Amenities</span>
                                <div class="grid grid-cols-1 gap-3">
                                    @foreach ($amenities as $amenity)
                                        <div class="flex items-center bg-gray-50 p-3 rounded-lg border border-gray-200">
                                            <input type="checkbox" id="{{ $amenity->id }}" name="amenities[]"
                                                value="{{ $amenity->id }}"
                                                class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                                {{ in_array($amenity->id, request('amenities', [])) ? 'checked' : '' }}>
                                            <label for="{{ $amenity->id }}" class="ml-2 text-sm text-gray-700"><span><i
                                                        class="{{ $amenity->icon }}"></i></span>
                                                {{ $amenity->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Location Filter -->
                            <div class="mb-6">
                                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                                    Location
                                </label>
                                <div class="relative">
                                    <select id="location" name="location"
                                        class="w-full pl-3 pr-10 py-3 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 appearance-none">
                                        <option value="">All Locations</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city }}"
                                                {{ request('location') == $city ? 'selected' : '' }}>
                                                {{ $city }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                        <svg class="h-4 w-4 text-black" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Price Range Filter -->
                            <div class="mb-6">
                                <label for="price_range" class="block text-sm font-medium text-gray-700 mb-2">
                                    Price Range ($/hour)
                                </label>
                                <div class="flex items-center space-x-4">
                                    <div class="w-1/2">
                                        <input type="number" id="min_price" name="min_price" placeholder="Min"
                                            value="{{ request('min_price') }}"
                                            class="w-full pl-3 py-3 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div class="w-1/2">
                                        <input type="number" id="max_price" name="max_price" placeholder="Max"
                                            value="{{ request('max_price') }}"
                                            class="w-full pl-3 py-3 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </div>

                            <!-- Filter Actions -->
                            <div class="flex flex-col space-y-3">
                                <button type="submit"
                                    class="cursor-pointer w-full bg-blue-600 text-white py-3 px-4 rounded-lg text-base font-medium hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-600 transition duration-150 ease-in-out">
                                    Apply Filters
                                </button>

                                <a href="{{ route('explore') }}"
                                    class="w-full text-center py-3 px-4 border border-gray-300 rounded-lg text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                                    Clear All
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Room Listings - Horizontal Cards -->
                <div class="w-full lg:w-3/4">
                    @if ($rooms->isEmpty())
                        <div class="bg-white p-8 rounded-xl shadow-md flex flex-col items-center justify-center h-80">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mb-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">No spaces found</h3>
                            <p class="text-gray-500 text-center">We couldn't find any meeting spaces matching your
                                criteria.<br>Try adjusting your filters to see more results.</p>
                        </div>
                    @else
                        <!-- Results Count -->
                        <div class="mb-6">
                            <p class="text-gray-600">Showing <span class="font-medium">{{ $rooms->firstItem() }}</span>
                                to <span class="font-medium">{{ $rooms->lastItem() }}</span> of <span
                                    class="font-medium">{{ $rooms->total() }}</span> spaces</p>
                        </div>


                        <!-- Horizontal Card Layout -->
                        <div class="space-y-6">
                            @foreach ($rooms as $room)
                                <div
                                    class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col md:flex-row transition">
                                    <!-- Left side - Image -->
                                    <div class="relative w-full md:w-1/3">
                                        @if ($room->images->isEmpty())
                                            <img src="https://www.svgrepo.com/show/508699/landscape-placeholder.svg"
                                                alt="{{ $room->title }}"
                                                class="object-cover w-full h-full min-h-48 md:min-h-full">
                                        @else
                                            <img src="{{ asset('storage/' . $room->images->first()->image_url) }}"
                                                alt="{{ $room->title }}"
                                                class="object-cover w-full h-full min-h-48 md:min-h-full">
                                        @endif

                                        @if ($room->is_active)
                                            <div class="absolute top-3 right-3">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <span class="w-2 h-2 mr-1 bg-green-500 rounded-full"></span>
                                                    Available
                                                </span>
                                            </div>
                                        @else
                                            <div class="absolute top-3 right-3">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <span class="w-2 h-2 mr-1 bg-red-500 rounded-full"></span>
                                                    Booked
                                                </span>
                                            </div>
                                        @endif

                                        <div class="absolute bottom-3 left-3">
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                ${{ number_format($room->hourly_rate, 2) }}/hour
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Right side - Details -->
                                    <div class="flex flex-col w-full md:w-2/3">
                                        <div class="p-5 flex-grow">
                                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $room->title }}</h3>

                                            <div class="flex items-center text-sm text-gray-600 mb-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                {{ $room->city ?? 'Main Building' }}
                                            </div>

                                            <div class="flex items-center text-sm text-gray-600 mb-3">
                                                <!-- user svg -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                                {{ $room->host->first_name }} {{ $room->host->last_name }}
                                            </div>

                                            <div class="flex items-center text-sm text-gray-600 mb-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                {{ $room->capacity }} People
                                            </div>

                                            <div class="mt-4 flex flex-wrap gap-2">
                                                @foreach ($room->amenities as $amenity)
                                                    <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">
                                                        <i class="{{ $amenity->icon }}"></i> {{ $amenity->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="px-5 py-4 bg-gray-50 border-t border-gray-100 mt-auto">
                                            <a href="{{ route('rooms.details', $room->slug) }}"
                                                class="block w-full text-center bg-blue-600 hover:bg-blue-800 text-white py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Modern Pagination -->
                        <div class="mt-8">
                            {{ $rooms->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-submit the form when select filters change
            const autoSubmitElements = [
                'capacity',
                'location',
                'date'
            ];

            autoSubmitElements.forEach(elementId => {
                const element = document.getElementById(elementId);
                if (element) {
                    element.addEventListener('change', function() {
                        document.getElementById('filter-form').submit();
                    });
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterToggle = document.getElementById('filter-toggle');
            const filtersContainer = document.getElementById('filters-container');

            filterToggle.addEventListener('click', function() {
                if (filtersContainer.classList.contains('hidden')) {
                    filtersContainer.classList.remove('hidden');
                    filterToggle.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Hide Filters
                    `;
                } else {
                    filtersContainer.classList.add('hidden');
                    filterToggle.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Show Filters
                    `;
                }
            });

            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    filtersContainer.classList.remove('hidden');
                } else if (!filterToggle.innerHTML.includes('Hide')) {
                    filtersContainer.classList.add('hidden');
                }
            });
        });
    </script>
@endsection
