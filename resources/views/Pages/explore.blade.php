<!-- resources/views/pages/explore.blade.php -->

@extends('layouts.Home.layout')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4 md:mb-0">
                Discover Spaces
            </h1>
            
            <!-- Search Bar -->
            <div class="w-full md:w-2/5">
                <form action="{{ route('explore') }}" method="GET">
                    <div class="relative">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Search for meeting spaces..." 
                               class="w-full px-5 py-3 pl-12 border border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                        
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        
                        <button type="submit" class="absolute inset-y-0 right-0 flex items-center px-5 text-blue-600 hover:text-blue-800">
                            <span class="text-sm font-medium">Search</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Enhanced Filters Sidebar -->
            <div class="w-full lg:w-1/4">
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Filters
                    </h2>
                    
                    <form action="{{ route('explore') }}" method="GET" id="filter-form">
                        <!-- Keep search parameter if it exists -->
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        
                        <!-- Capacity Filter -->
                        <div class="mb-6">
                            <label for="capacity" class="block text-sm font-medium text-gray-700 mb-2">
                                Capacity
                            </label>
                            <div class="relative">
                                <select id="capacity" name="capacity" class="w-full pl-3 py-3 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-white appearance-none">
                                    <option value="">Any capacity</option>
                                    <option value="4" {{ request('capacity') == '4' ? 'selected' : '' }}>4+ people</option>
                                    <option value="8" {{ request('capacity') == '8' ? 'selected' : '' }}>8+ people</option>
                                    <option value="12" {{ request('capacity') == '12' ? 'selected' : '' }}>12+ people</option>
                                    <option value="20" {{ request('capacity') == '20' ? 'selected' : '' }}>20+ people</option>
                                    <option value="50" {{ request('capacity') == '50' ? 'selected' : '' }}>50+ people</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                    <svg class="h-4 w-4 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
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
                        
                        <!-- Time Range Filter with Slider -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Time Range
                            </label>
                            <div class="flex items-center space-x-4">
                                <div class="w-1/2">
                                    <select id="start_time" name="start_time" class="w-full pl-3 pr-10 py-3 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">From</option>
                                        @foreach(['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'] as $time)
                                            <option value="{{ $time }}" {{ request('start_time') == $time ? 'selected' : '' }}>{{ $time }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-1/2">
                                    <select id="end_time" name="end_time" class="w-full pl-3 pr-10 py-3 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">To</option>
                                        @foreach(['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'] as $time)
                                            <option value="{{ $time }}" {{ request('end_time') == $time ? 'selected' : '' }}>{{ $time }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Features Filter with Icons -->
                        <div class="mb-6">
                            <span class="block text-sm font-medium text-gray-700 mb-3">Amenities</span>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="flex items-center bg-gray-50 p-3 rounded-lg border border-gray-200">
                                    <input type="checkbox" id="projector" name="features[]" value="projector"
                                           {{ in_array('projector', request('features', [])) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="projector" class="ml-2 text-sm text-gray-700">Projector</label>
                                </div>
                                <div class="flex items-center bg-gray-50 p-3 rounded-lg border border-gray-200">
                                    <input type="checkbox" id="whiteboard" name="features[]" value="whiteboard"
                                           {{ in_array('whiteboard', request('features', [])) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="whiteboard" class="ml-2 text-sm text-gray-700">Whiteboard</label>
                                </div>
                                <div class="flex items-center bg-gray-50 p-3 rounded-lg border border-gray-200">
                                    <input type="checkbox" id="videoconference" name="features[]" value="videoconference"
                                           {{ in_array('videoconference', request('features', [])) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="videoconference" class="ml-2 text-sm text-gray-700">Video Conf</label>
                                </div>
                                <div class="flex items-center bg-gray-50 p-3 rounded-lg border border-gray-200">
                                    <input type="checkbox" id="accessibility" name="features[]" value="accessibility"
                                           {{ in_array('accessibility', request('features', [])) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="accessibility" class="ml-2 text-sm text-gray-700">Accessible</label>
                                </div>
                                <div class="flex items-center bg-gray-50 p-3 rounded-lg border border-gray-200">
                                    <input type="checkbox" id="coffee" name="features[]" value="coffee"
                                           {{ in_array('coffee', request('features', [])) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="coffee" class="ml-2 text-sm text-gray-700">Coffee</label>
                                </div>
                                <div class="flex items-center bg-gray-50 p-3 rounded-lg border border-gray-200">
                                    <input type="checkbox" id="wifi" name="features[]" value="wifi"
                                           {{ in_array('wifi', request('features', [])) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="wifi" class="ml-2 text-sm text-gray-700">WiFi</label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Location Filter -->
                        <div class="mb-6">
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                                Location
                            </label>
                            <div class="relative">
                                <select id="location" name="location" class="w-full pl-3 pr-10 py-3 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">All Locations</option>
                                    <option value="main" {{ request('location') == 'main' ? 'selected' : '' }}>Main Building</option>
                                    <option value="east" {{ request('location') == 'east' ? 'selected' : '' }}>East Wing</option>
                                    <option value="west" {{ request('location') == 'west' ? 'selected' : '' }}>West Wing</option>
                                    <option value="north" {{ request('location') == 'north' ? 'selected' : '' }}>North Wing</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
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
                                    <input type="number" 
                                           id="min_price" 
                                           name="min_price" 
                                           placeholder="Min"
                                           value="{{ request('min_price') }}"
                                           class="w-full pl-3 py-3 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div class="w-1/2">
                                    <input type="number" 
                                           id="max_price" 
                                           name="max_price" 
                                           placeholder="Max"
                                           value="{{ request('max_price') }}"
                                           class="w-full pl-3 py-3 text-base border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Filter Actions -->
                        <div class="flex flex-col space-y-3">
                            <button type="submit" class="w-full bg-blue-500 text-white py-3 px-4 rounded-lg text-base font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                                Apply Filters
                            </button>
                            
                            <a href="{{ route('explore') }}" class="w-full text-center py-3 px-4 border border-gray-300 rounded-lg text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                                Clear All
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Room Listings - 3 Cards Per Row -->
            <div class="w-full lg:w-3/4">
                @if($rooms->isEmpty())
                    <div class="bg-white p-8 rounded-xl shadow-md flex flex-col items-center justify-center h-80">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">No spaces found</h3>
                        <p class="text-gray-500 text-center">We couldn't find any meeting spaces matching your criteria.<br>Try adjusting your filters to see more results.</p>
                    </div>
                @else
                    <!-- Results Count -->
                    <div class="mb-6">
                        <p class="text-gray-600">Showing <span class="font-medium">{{ $rooms->firstItem() }}</span> to <span class="font-medium">{{ $rooms->lastItem() }}</span> of <span class="font-medium">{{ $rooms->total() }}</span> spaces</p>
                    </div>
                    
                    <!-- Modern Card Grid - 3 cards per row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($rooms as $room)
                            <div class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col transition">
                                <div class="relative h-48">
                                    <img src="{{ asset('storage/' . $room->images->first()->image_url) }}" 
                                         alt="{{ $room->name }}" 
                                         class="object-cover w-full h-full">
                                    
                                    @if($room->is_active)
                                        <div class="absolute top-3 right-3">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <span class="w-2 h-2 mr-1 bg-green-500 rounded-full"></span>
                                                Available
                                            </span>
                                        </div>
                                    @else
                                        <div class="absolute top-3 right-3">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <span class="w-2 h-2 mr-1 bg-red-500 rounded-full"></span>
                                                Booked
                                            </span>
                                        </div>
                                    @endif
                                    
                                    <div class="absolute bottom-3 left-3">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            ${{ number_format($room->hourly_rate ?? rand(20, 100), 2) }}/hour
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="p-5 flex-grow">
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $room->name ?? 'Meeting Room ' . $loop->iteration }}</h3>
                                    
                                    <div class="flex items-center text-sm text-gray-600 mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $room->location ?? 'Main Building' }}
                                    </div>
                                    
                                    <div class="flex items-center text-sm text-gray-600 mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        {{ $room->capacity ?? rand(4, 30) }} People
                                    </div>
                                    
                                    <div class="mt-4 flex flex-wrap gap-2">
                                        @foreach($room->features ?? ['projector', 'whiteboard', 'wifi'] as $feature)
                                            <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">
                                                {{ ucfirst($feature) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                                
                                <div class="px-5 py-4 bg-gray-50 border-t border-gray-100">
                                    <a href="{{route('rooms.details', $room->slug)}}" 
                                       class="block w-full text-center bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Modern Pagination -->
                    <div class="mt-8">
                        {{ $rooms->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

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
@endsection