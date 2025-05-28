@extends('layouts.Home.layout')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endsection

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Breadcrumbs -->
        <div class="flex items-center text-sm text-gray-600 mb-4">
            <a href="/" class="hover:text-blue-600">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('explore') }}" class="hover:text-blue-600">Explore</a>
            <span class="mx-2">/</span>
            <span class="font-medium text-gray-900">{{ $space->title }}</span>
        </div>

        <!-- Room Title and Actions -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $space->title }}</h1>
                <div class="flex flex-wrap items-center mt-2 gap-y-2">
                    <div class="flex items-center text-yellow-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="ml-1 text-gray-700">{{ number_format($avgReview, 1) }} ({{ $reviewsCount }}
                            reviews)</span>
                    </div>
                    <div class="flex items-center ml-0 md:ml-4 mt-1 md:mt-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="ml-1 text-gray-700">{{ $space->city }}</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-4 md:mt-0">
                <form action="{{ route('wishlist.add', $space->id) }}" method="post">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="space_id" value="{{ $space->id }}">
                    <button class="cursor-pointer flex items-center text-gray-600 hover:text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                clip-rule="evenodd" />
                        </svg>
                        Save
                    </button>
                </form>
                <div class="relative">
                    <button id="share-button" class="cursor-pointer flex items-center text-gray-600 hover:text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                        </svg>
                        Share
                    </button>
                    
                    <div id="share-dropdown" class="hidden absolute right-0 md:right-10 left-0 md:left-auto mt-2 w-48 bg-white rounded-md shadow-lg z-10 border border-gray-200">
                        <div class="p-3 text-center">
                            <p class="text-sm font-medium text-gray-700 mb-2">Share this space</p>
                            <div class="flex flex-wrap gap-3 mb-3 justify-center">
                                <!-- Facebook -->
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                                <!-- Twitter/X -->
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode('Check out this amazing space: ' . $space->title) }}" target="_blank" class="text-gray-800 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path>
                                    </svg>
                                </a>
                                <!-- LinkedIn -->
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" class="text-blue-700 hover:text-blue-900">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                                <!-- WhatsApp -->
                                <a href="https://wa.me/?text={{ urlencode('Check out this amazing space: ' . $space->title . ' ' . request()->url()) }}" target="_blank" class="text-green-600 hover:text-green-800">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Handle error and success messages -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative my-3" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Room Images Grid -->
        <div class="grid grid-cols-3 gap-4 mb-8">
            <div class="col-span-2 row-span-2">
                @if ($space->images->isEmpty())
                    <img src="https://www.svgrepo.com/show/508699/landscape-placeholder.svg" alt="Place Holder image"
                        class="w-full h-full object-cover rounded-lg">
                @else
                    <img src="{{ asset('storage/' . $space->images->first()->image_url) }}" alt="Executive Meeting Room"
                        class="w-full h-full object-cover rounded-lg">
                @endif
            </div>
            @foreach ($space->images as $image)
                <div>
                    @if ($image->image_url != null)
                        <img src="{{ asset('storage/' . $image->image_url) }}" alt="Room Image"
                            class="w-full h-full object-cover rounded-lg">
                    @else
                        <img src="https://www.svgrepo.com/show/508699/landscape-placeholder.svg" alt="Room Image"
                            class="w-full h-full object-cover rounded-lg">
                    @endif
                </div>
            @endforeach
        </div>

        <div class="flex flex-wrap -mx-4">
            <!-- Left Column: Room Details -->
            <div class="w-full lg:w-2/3 px-4">
                <!-- About this space -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">About this space</h2>
                    <p class="text-gray-700">
                        {{ $space->description }}
                    </p>
                </div>

                <!-- Amenities -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Amenities</h2>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($space->amenities->chunk(ceil($space->amenities->count() / 2)) as $amenitiesChunk)
                            <ul class="space-y-3">
                                @foreach ($amenitiesChunk as $amenity)
                                    <li class="flex items-center">
                                        <i class="{{ $amenity->icon }} mr-2"></i>
                                        {{ $amenity->name }}
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div>

                <!-- Location -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Location</h2>
                    <div class="mb-4 rounded-lg overflow-hidden">
                        <div class="bg-gray-200 h-64 relative">
                            <!-- Map placeholder - in a real app this would be an interactive map -->
                            <div id="map" class="w-full h-full rounded-lg shadow-md mt-6"></div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h3 class="font-semibold text-gray-800 mb-2">{{ $space->city }}, {{ $space->street_address }}
                        </h3>
                    </div>
                </div>

                <!-- Reviews -->
                <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Reviews</h2>
                        @if ($space->reviews->count() > 0)
                            <div class="flex items-center">
                                <div class="flex items-center mr-2">
                                    <i class="fas fa-star text-yellow-500"></i>
                                    <span
                                        class="ml-1 font-semibold">{{ number_format($space->reviews->avg('rating'), 1) }}</span>
                                </div>
                                <span class="text-gray-600">({{ $space->reviews->count() }}
                                    {{ Str::plural('review', $space->reviews->count()) }})</span>
                            </div>
                        @endif
                    </div>

                    @forelse ($space->reviews as $review)
                        <div class="border-b border-gray-200 pb-4 mb-4 last:border-0 last:pb-0 last:mb-0">
                            <div class="flex items-start mb-3">
                                <div class="mr-3">
                                    @if ($review->user && $review->reviewee->profile_photo_url)
                                        <img src="{{ Storage::url($review->reviewee->profile_photo_url) }}"
                                            alt="{{ $review->reviewee->first_name }} {{ $review->reviewee->last_name }}"
                                            class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        <div
                                            class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="font-semibold text-gray-900">{{ $review->reviewee->first_name }}
                                                {{ $review->reviewee->last_name }}
                                            </h4>
                                            <p class="text-xs text-gray-500">{{ $review->created_at->format('M d, Y') }}
                                            </p>
                                        </div>
                                        <div class="flex items-center">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->rating)
                                                    <i class="fas fa-star text-yellow-500 text-sm"></i>
                                                @else
                                                    <i class="far fa-star text-gray-300 text-sm"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    @if ($review->review_text)
                                        <p class="text-gray-700 mt-2">{{ $review->review_text }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <i class="far fa-comment-dots text-gray-300 text-4xl mb-2"></i>
                            <p class="text-gray-500">No reviews yet.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Room Availability -->
                <div class="bg-white rounded-lg shadow-sm p-6 mb-8" id="availability">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Availability</h2>
                    <p class="text-gray-700 mb-4">This space is available for booking on the following days and times:</p>
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 rounded-lg">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="py-2 px-4 text-left font-semibold text-gray-700">Day</th>
                                    <th class="py-2 px-4 text-left font-semibold text-gray-700">Start Time</th>
                                    <th class="py-2 px-4 text-left font-semibold text-gray-700">End Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($space_availability as $availability)
                                    <tr class="@if($loop->odd) bg-white @else bg-gray-50 @endif">
                                        <td class="py-2 px-4">{{ $availability->day_of_week }}</td>
                                        <td class="py-2 px-4">{{ \Carbon\Carbon::createFromFormat('H:i:s', $availability->start_time)->format('g:i A') }}</td>
                                        <td class="py-2 px-4">{{ \Carbon\Carbon::createFromFormat('H:i:s', $availability->end_time)->format('g:i A') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-4 px-4 text-center text-gray-500">No availability set for this space.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- About the Host -->
                <div class="w-full lg:w-3/3 ">
                    <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">About the Host</h2>
                        <div class="flex items-center mb-4">
                            <img src="
                            @if ($space->host->profile_picture_url) {{ asset($space->host->profile_picture_url) }}
                            @else
                                {{ asset('images/profile-pictures/default-avatar.svg') }} @endif
                        "
                                alt="Profile Picture" class="w-12 h-12 rounded-full object-contain shadow-md mr-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">
                                    <a href="{{ route('user.profile', $space->host->slug) }}">{{ $space->host->first_name }}
                                        {{ $space->host->last_name }}
                                </h3>
                                </a>
                                <p class="text-gray-600">Host</p>
                            </div>
                        </div>
                        <p class="text-gray-700">{{ $space->host->bio }}</p>

                        <div class="mt-4">
                            <h3 class="text-lg font-semibold text-gray-800">Contact Information</h3>
                            <p class="text-gray-700">Email: {{ $space->host->email }}</p>
                            <p class="text-gray-700">Phone: {{ $space->host->phone_number ?? 0 }}</p>
                        </div>

                        <!-- Host Spaces -->
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold text-gray-800">Hosted Spaces</h3>
                            <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mt-4">
                                @foreach ($hostSpaces->sortByDesc('created_at')->take(3) as $hostedSpace)
                                    <div
                                        class="bg-white rounded-lg shadow overflow-hidden flex flex-col md:flex-row border border-gray-200">
                                        <!-- Left side - Image -->
                                        <div class="relative w-full md:w-1/3">
                                            @if ($hostedSpace->images->isEmpty())
                                                <img src="https://www.svgrepo.com/show/508699/landscape-placeholder.svg"
                                                    alt="{{ $hostedSpace->title }}"
                                                    class="object-cover w-full h-full min-h-48 md:h-full">
                                            @else
                                                <img src="{{ asset('storage/' . $hostedSpace->images->first()->image_url) }}"
                                                    alt="{{ $hostedSpace->title }}"
                                                    class="object-cover w-full h-full min-h-48 md:h-full">
                                            @endif
                                        </div>

                                        <!-- Right side - Details -->
                                        <div class="w-full md:w-2/3 p-6">
                                            <h4 class="text-lg font-semibold text-gray-800">{{ $hostedSpace->title }}</h4>
                                            <p class="text-gray-600 mt-2">${{ $hostedSpace->hourly_rate }} per hour</p>
                                            <p class="text-gray-600 mt-1 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />

                                                </svg>{{ $hostedSpace->capacity }} People
                                            </p>

                                            @if (isset($hostedSpace->city))
                                                <p class="text-gray-600 mt-1">
                                                    <span class="flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        </svg>
                                                        {{ $hostedSpace->city }}
                                                    </span>
                                                </p>
                                            @endif

                                            @if (isset($hostedSpace->amenities) && count($hostedSpace->amenities) > 0)
                                                <div class="mt-3 flex flex-wrap gap-2">
                                                    @foreach ($hostedSpace->amenities as $amenity)
                                                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">
                                                            {{ ucfirst($amenity->name) }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @endif

                                            <div class="mt-4">
                                                <a href="{{ route('rooms.details', $hostedSpace->slug) }}"
                                                    class="inline-block bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded transition duration-150 ease-in-out">
                                                    View Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Booking Widget -->
            <div class="w-full lg:w-1/3 px-4">
                <div class="bg-white rounded-lg shadow p-6 border border-gray-200 sticky top-4">
                    <div class="flex justify-between items-center mb-6">
                        <div class="text-2xl font-bold">${{ $space->hourly_rate }}<span
                                class="text-gray-500 text-base font-normal">/hour</span></div>
                        <div class="flex items-center text-yellow-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="ml-1">{{ number_format($avgReview, 1) }} ({{ $reviewsCount }})</span>
                        </div>
                    </div>

                    <!-- show session('availability') -->
                    @if (session('availability'))
                        <div class="bg-blue-100 text-blue-800 p-3 rounded mb-4">
                            {{ session('availability') }}
                        </div>
                    @endif

                    <form action="{{ route('booking.checkout') }}" method="POST">
                        @csrf
                        @method('POST')

                        <input type="hidden" name="space_id" value="{{ $space->id }}">

                        <!-- Date -->
                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                            <div class="relative">
                                <input type="date" id="date" name="date" min="{{ date('Y-m-d') }}"
                                    value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                    class="p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>

                        <!-- Time Range -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Start
                                    Time</label>
                                <select id="start_time" name="start_time"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-2 py-2">
                                    @php
                                        $start = strtotime('08:00');
                                        $end = strtotime('20:00');
                                        $interval = 60 * 60;
                                    @endphp

                                    @for ($time = $start; $time <= $end; $time += $interval)
                                        <option value="{{ date('H:i', $time) }}"
                                            {{ isset($availability) && $availability->start_time == date('H:i', $time) ? 'selected' : '' }}>
                                            {{ date('g:i A', $time) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div>
                                <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">End
                                    Time</label>
                                <select id="end_time" name="end_time"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-2 py-2">
                                    @php
                                        $start = strtotime('9:00');
                                        $end = strtotime('21:00');
                                    @endphp

                                    @for ($time = $start; $time <= $end; $time += $interval)
                                        <option value="{{ date('H:i', $time) }}"
                                            {{ isset($availability) && $availability->end_time == date('H:i', $time) ? 'selected' : '' }}>
                                            {{ date('g:i A', $time) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <!-- Guests -->
                        <div class="mb-4">
                            <label for="guests" class="block text-sm font-medium text-gray-700 mb-1">Number of
                                Guests</label>
                            <input type="number" max="{{ $space->capacity }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-2"
                                name="num_attendees" id="num_attendees" value="1">
                        </div>

                        <!-- Total Cost -->
                        <div class="border-t border-gray-200 pt-4 mb-6">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600" id="duration"></span>
                                <span class="font-medium">$</span>
                            </div>
                            <div class="flex justify-between mb-4">
                                <span class="text-gray-600">Service fee</span>
                                <span class="font-medium" id="fees"></span>
                            </div>
                            <div class="flex justify-between font-bold">
                                <span>Total</span>
                                <span id="total">$</span>
                            </div>
                        </div>

                        <input type="hidden" name="total_price" id="total_price">
                        <input type="hidden" name="service_fee" id="service_fee">
                        <input type="hidden" name="host_payout" id="host_payout">

                        <!-- Book Now Button -->
                        <button type="submit" @if (Auth::check() && Auth::user()->roles->first()->name == 'host') disabled @endif
                            class="cursor-pointer w-full bg-blue-700 hover:bg-blue-800 text-white font-medium py-3 px-4 rounded-md transition duration-150 ease-in-out">
                            Book Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const latitude = @json($space->latitude);
            const longitude = @json($space->longitude);
            const title = @json($space->title);

            var map = L.map('map').setView([latitude, longitude], 10);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([latitude, longitude]).addTo(map)
                .bindPopup(title)
                .openPopup();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startTimeSelect = document.getElementById('start_time');
            const endTimeSelect = document.getElementById('end_time');
            const numAttendeesInput = document.getElementById('num_attendees');

            // Get hourly rate directly from PHP variable
            const hourlyRate = @json($space->hourly_rate);

            const totalPriceInput = document.getElementById('total_price');
            const serviceFeeInput = document.getElementById('service_fee');
            const hostPayoutInput = document.getElementById('host_payout');

            startTimeSelect.addEventListener('change', updateCalculations);
            endTimeSelect.addEventListener('change', updateCalculations);
            numAttendeesInput.addEventListener('change', updateCalculations);

            updateCalculations();

            function updateCalculations() {
                const startTime = startTimeSelect.value;
                const endTime = endTimeSelect.value;

                const startHour = parseInt(startTime.split(':')[0]);
                const endHour = parseInt(endTime.split(':')[0]);

                if (endHour <= startHour) {
                    alert('End time must be after start time');
                    let nextEndHour = startHour + 1;
                    let found = false;
                    for (let i = 0; i < endTimeSelect.options.length; i++) {
                        const optionHour = parseInt(endTimeSelect.options[i].value.split(':')[0]);
                        if (optionHour > startHour) {
                            endTimeSelect.selectedIndex = i;
                            found = true;
                            break;
                        }
                    }
                    if (!found) {
                        endTimeSelect.selectedIndex = 0;
                    }
                    return;
                }

                const duration = endHour - startHour;
                const subtotal = hourlyRate * duration;
                const serviceFee = subtotal * 0.10;
                const total = subtotal + serviceFee;
                const hostPayout = subtotal;

                // Update visible elements
                const durationElement = document.querySelector('#duration');
                const subtotalElement = document.querySelector('.text-gray-600:nth-of-type(1) + .font-medium');
                const serviceFeeElement = document.querySelector('#fees');
                const totalElement = document.querySelector('#total');

                durationElement.textContent = `$${hourlyRate} × ${duration} hours`;
                subtotalElement.textContent = `$${subtotal.toFixed(2)}`;
                serviceFeeElement.textContent = `$${serviceFee.toFixed(2)}`;
                totalElement.textContent = `$${total.toFixed(2)}`;

                // Set hidden input values
                totalPriceInput.value = total.toFixed(2);
                serviceFeeInput.value = serviceFee.toFixed(2);
                hostPayoutInput.value = hostPayout.toFixed(2);
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const shareButton = document.getElementById('share-button');
            const shareDropdown = document.getElementById('share-dropdown');
            const copyButton = document.getElementById('copy-link');
            const shareUrl = document.getElementById('share-url');
            const copyMessage = document.getElementById('copy-message');

            shareButton.addEventListener('click', function(e) {
                e.stopPropagation();
                shareDropdown.classList.toggle('hidden');
            });

            document.addEventListener('click', function(e) {
                if (!shareButton.contains(e.target) && !shareDropdown.contains(e.target)) {
                    shareDropdown.classList.add('hidden');
                }
            });

            copyButton.addEventListener('click', function() {
                shareUrl.select();
                document.execCommand('copy');

                copyMessage.classList.remove('hidden');
                setTimeout(function() {
                    copyMessage.classList.add('hidden');
                }, 2000);
            });
        });
    </script>
@endsection