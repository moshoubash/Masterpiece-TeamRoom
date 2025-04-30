@extends('layouts.Home.layout')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Profile Header -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="flex flex-wrap items-center">
                <div class="mr-6">
                    <img src="
                            @if ($profile_image) {{ asset($profile_image) }}
                            @else
                                {{ asset('images/profile-pictures/default-avatar.svg') }} @endif
                        "
                        alt="Profile Picture" class="w-24 h-24 rounded-full object-cover shadow-md">
                </div>
                <div class="flex-grow">
                    <h1 class="text-2xl font-bold text-gray-900">{{ $name }}</h1>
                    <p class="text-gray-600 mb-2">Member since {{ $created_at }}</p>
                    <div class="flex flex-wrap items-center gap-4">
                        <div class="flex items-center">
                            @if ($is_verified)
                                <i class="fa-regular fa-circle-check text-green-500 mr-1 text-lg"></i>
                            @else
                                <i class="fa-regular fa-circle-xmark text-red-500 mr-1 text-lg"></i>
                            @endif

                            <span>Verified</span>
                        </div>

                        @if ($role == 'HOST')
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 mr-1"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span>{{ $average_rating }} ({{ $total_reviews }} reviews)</span>
                            </div>
                        @endif

                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-600 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>{{ $role }}</span>
                        </div>
                    </div>
                </div>

                @auth
                    @if ($user->id == Auth::user()->id)
                        <div class="mt-4 md:mt-0">
                            <form action="{{ route('user.edit', $user->slug) }}">
                                <button
                                    class="cursor-pointer bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-5 rounded-md transition">
                                    Edit Profile
                                </button>
                                <form>
                        </div>
                    @endif
                @endauth
            </div>
        </div>

        @if ($role == 'HOST')
            <!-- Listed Spaces -->
            <div class="mb-12">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Listed Spaces</h2>
                    @auth
                        @if ($role == 'HOST' && $user->id == Auth::user()->id)
                            <a href="{{ route('room.create') }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-5 rounded-md transition flex items-center cursor-pointer">
                                <svg class="w-5 h-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                List New Space
                            </a>
                        @endif
                    @endauth
                </div>
                <!-- Grid of Spaces -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @if ($spaces)
                        @foreach ($spaces as $space)
                            <div class="bg-white rounded-lg shadow overflow-hidden">
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $space->images->first()->image_url) }}"
                                        alt="Executive Meeting Room" class="w-full h-48 object-cover">
                                    {{-- enable this section for the owner or host --}}
                                    @if (Auth::check() && $role == 'HOST' && $user->id == Auth::user()->id)
                                        <div class="absolute top-3 right-3 space-x-2">
                                            <a href="{{ route('space.edit', $space->slug) }}"
                                                class="cursor-pointer bg-white p-2 w-9 h-9 flex items-center justify-center rounded-md shadow hover:bg-gray-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-600"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $space->title }}</h3>
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <span class="ml-1">{{ $space->reviews->avg('rating') ?? 0 }}</span>
                                        </div>
                                    </div>
                                    <p class="text-gray-600 mb-2">Jordan, {{ $space->city }}</p>
                                    <p class="text-gray-600 mb-2">Up to {{ $space->capacity }} people • Meeting Room</p>
                                    <div class="flex justify-between items-center mb-3">
                                        <div class="font-semibold text-gray-900">${{ $space->hourly_rate }}<span
                                                class="text-gray-600 font-normal">/hour</span></div>
                                        <div class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded">
                                            Active</div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('rooms.details', [$space->slug]) }}"
                                            class="text-blue-500 hover:text-blue-600 text-sm font-medium">View details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        @else
            <!-- Renter Bookings -->
            <div>
                <h2 class="text-xl font-bold text-gray-900 mb-6">Renter Bookings</h2>

                <div class="grid grid-cols-2 xm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4 w-full gap-6">
                    @foreach ($bookings as $booking)
                        <div class="bg-white rounded-lg shadow p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-2">Booking ID: {{ $booking->id }}</h2>
                            <h3 class="text-gray-600 mb-2">{{ $booking->space->name }}</h3>
                            <p class="text-gray-600 mb-2">{{ $booking->space->city }}</p>
                            <p class="text-gray-600 mb-2">{{ $booking->start_datetime }} - {{ $booking->end_datetime }}
                            </p>
                            <div class="flex justify-between items-center mb-3">
                                <div class="font-semibold text-gray-900">${{ $booking->space->hourly_rate }}<span
                                        class="text-gray-600 font-normal">/hour</span></div>
                                <div class="text-xs font-medium px-2 py-1 rounded">
                                    @if ($booking->status == 'pending')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-yellow-100 text-xs font-medium text-yellow-800">Pending</span>
                                    @elseif($booking->status == 'confirmed')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-green-100 text-xs font-medium text-green-800">Confirmed</span>
                                    @elseif($booking->status == 'cancelled')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-red-100 text-xs font-medium text-red-800">Cancelled</span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-gray-100 text-xs font-medium text-gray-800">Completed</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('bookings.details', $booking->id) }}"
                                    class="text-blue-500 hover:text-blue-600 text-sm font-medium">View details</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
