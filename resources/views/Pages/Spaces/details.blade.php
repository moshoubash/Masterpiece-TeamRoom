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
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $space->title }}</h1>
                <div class="flex items-center mt-2">
                    <div class="flex items-center text-yellow-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="ml-1 text-gray-700">{{ $avgReview }} ({{$reviewsCount}} reviews)</span>
                    </div>
                    <div class="flex items-center ml-4">
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
            <div class="flex items-center">
                <button class="flex items-center text-gray-600 mr-4 hover:text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                            clip-rule="evenodd" />
                    </svg>
                    Save
                </button>
                <button class="flex items-center text-gray-600 hover:text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                    </svg>
                    Share
                </button>
            </div>
        </div>

        <!-- Room Images Grid -->
        <div class="grid grid-cols-3 gap-4 mb-8">
            <div class="col-span-2 row-span-2">
                <img src="{{ asset('storage/' . $space->images->first()->image_url) }}" alt="Executive Meeting Room"
                    class="w-full h-full object-cover rounded-lg">
            </div>
            @foreach ($space->images as $image)
                <div>
                    <img src="{{ asset('storage/' . $image->image_url) }}" alt="Room Image"
                        class="w-full h-full object-cover rounded-lg">
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
                    <div class="grid grid-cols-2 md:grid-cols-2 gap-6">
                        <div>
                            <ul class="space-y-3">
                                @foreach ($space->amenities as $amenity)
                                    <li class="flex items-center">
                                        <i class="{{ $amenity->icon }} mr-2"></i>
                                        {{ $amenity->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
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
                        <h3 class="font-semibold text-gray-800 mb-2">{{ $space->city }}, {{ $space->street_address }}</h3>
                        <p class="text-gray-700">Located in a convenient area, easily accessible by public transportation.
                            The building offers secure access and is surrounded by restaurants, cafes, and hotels.</p>
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="ml-1">{{ $avgReview }} ({{$reviewsCount}})</span>
                        </div>
                    </div>

                    <form action="{{ route('spaces.book', $space->id) }}" method="POST">
                        @csrf
                        @method('POST')

                        <input type="hidden" name="space_id" value="{{ $space->id }}">

                        <!-- Date -->
                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                            <div class="relative">
                                <input type="date" id="date" name="date" value="2025-04-22"
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
                                    @foreach (['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00'] as $time)
                                        <option value="{{ $time }}"
                                            {{ isset($availability) && $availability->start_time == $time ? 'selected' : '' }}>
                                            {{ $time }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">End
                                    Time</label>
                                <select id="end_time" name="end_time"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-2 py-2">
                                    @foreach (['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00'] as $time)
                                        <option value="{{ $time }}"
                                            {{ isset($availability) && $availability->end_time == $time ? 'selected' : '' }}>
                                            {{ $time }}
                                        </option>
                                    @endforeach
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
                        <button type="submit"
                            class="cursor-pointer w-full bg-blue-700 hover:bg-blue-800 text-white font-medium py-3 px-4 rounded-md transition duration-150 ease-in-out">
                            Book Now
                        </button>
                    </form>
                </div>
            </div>
            <!-- About the Host -->
            <div class="w-full lg:w-2/3 px-4">
                <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">About the Host</h2>
                    <div class="flex items-center mb-4">
                        <img src="https://via.placeholder.com/50x50" alt="Host Avatar"
                            class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                    <a href="{{route('user.profile', $space->host->id)}}">{{ $space->host->first_name }} {{ $space->host->last_name }}
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
                            @foreach ($hostSpaces as $hostedSpace)
                                <div
                                    class="bg-white rounded-lg shadow overflow-hidden flex flex-col md:flex-row border border-gray-200">
                                    <!-- Left side - Image -->
                                    <div class="relative w-full md:w-1/3">
                                        <img src="{{ asset('storage/' . $hostedSpace->images->first()->image_url) }}"
                                            alt="{{ $hostedSpace->title }}"
                                            class="object-cover w-full h-full min-h-48 md:h-full">
                                    </div>

                                    <!-- Right side - Details -->
                                    <div class="w-full md:w-2/3 p-6">
                                        <h4 class="text-lg font-semibold text-gray-800">{{ $hostedSpace->title }}</h4>
                                        <p class="text-gray-600 mt-2">${{ $hostedSpace->hourly_price }} per hour</p>
                                        <p class="text-gray-600 mt-1 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                
                                            </svg>{{ $hostedSpace->capacity }} People</p>

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
            const hourlyRateElement = document.querySelector('.text-2xl.font-bold');
            const numAttendeesInput = document.getElementById('num_attendees');

            const totalPriceInput = document.getElementById('total_price');
            const serviceFeeInput = document.getElementById('service_fee');
            const hostPayoutInput = document.getElementById('host_payout');

            startTimeSelect.addEventListener('change', updateCalculations);
            endTimeSelect.addEventListener('change', updateCalculations);
            numAttendeesInput.addEventListener('change', updateCalculations);

            updateCalculations();

            function updateCalculations() {
                const hourlyRateText = hourlyRateElement.textContent.trim();
                const hourlyRate = parseFloat(hourlyRateText.replace('$', ''));

                const startTime = startTimeSelect.value;
                const endTime = endTimeSelect.value;

                const startHour = parseInt(startTime.split(':')[0]);
                const endHour = parseInt(endTime.split(':')[0]);

                if (endHour <= startHour) {
                    alert('End time must be after start time');
                    const newEndHour = startHour + 1;
                    if (newEndHour <= 16) {
                        endTimeSelect.value = newEndHour.toString().padStart(2, '0') + ':00';
                    }
                    updateCalculations();
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
@endsection
