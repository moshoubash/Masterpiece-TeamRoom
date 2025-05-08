@extends('layouts.home.layout')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        #map {
            height: 100%;
            width: 100%;
            border-radius: 0.5rem;
        }
    </style>
@endsection

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-5xl">
        <!-- Header Section -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="bg-gray-50 px-6 py-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800">Booking #{{ $booking->id }}</h1>
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                    {{ $booking->status == 'confirmed'
                        ? 'bg-green-100 text-green-800'
                        : ($booking->status == 'cancelled'
                            ? 'bg-red-100 text-red-800'
                            : 'bg-yellow-100 text-yellow-800') }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>
            </div>
            @if (session('alert'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-green-200 dark:text-green-800"
                    role="alert">
                    <i class="fa-solid fa-check mx-2"></i>
                    {{ session('alert') }}
            @endif

            <!-- Status Notification -->
            @if ($booking->status == 'confirmed')
                <div class="bg-green-50 border-l-4 border-green-500 p-4 flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">Your booking is confirmed and ready to go!</p>
                    </div>
                </div>
            @elseif($booking->status == 'cancelled')
                <div class="bg-red-50 border-l-4 border-red-500 p-4 flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-800">This booking has been cancelled.</p>
                        @if ($booking->cancellation_reason)
                            <p class="mt-1 text-sm text-red-700">Reason: {{ $booking->cancellation_reason }}</p>
                        @endif
                        @if ($booking->cancelled_by)
                            <p class="mt-1 text-sm text-red-700">Cancelled by: {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Booking Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Booking Summary -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-semibold text-gray-800">Booking Summary</h2>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 bg-blue-100 rounded-full p-2">
                                <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Date & Time</p>
                                <p class="text-base text-gray-900">
                                    {{ \Carbon\Carbon::parse($booking->start_datetime)->format('D, M d, Y') }}
                                    <span class="mx-2">·</span>
                                    {{ \Carbon\Carbon::parse($booking->start_datetime)->format('h:i A') }} -
                                    {{ \Carbon\Carbon::parse($booking->end_datetime)->format('h:i A') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 bg-blue-100 rounded-full p-2">
                                <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Attendees</p>
                                <p class="text-base text-gray-900">{{ $booking->num_attendees }}
                                    {{ Str::plural('person', $booking->num_attendees) }}</p>
                            </div>
                        </div>

                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 bg-blue-100 rounded-full p-2">
                                <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Duration</p>
                                <p class="text-base text-gray-900">
                                    {{ \Carbon\Carbon::parse($booking->start_datetime)->diffInHours($booking->end_datetime) }}
                                    hours</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-100 rounded-full p-2">
                                <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Booking Created</p>
                                <p class="text-base text-gray-900">
                                    {{ \Carbon\Carbon::parse($booking->created_at)->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Space Details -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-semibold text-gray-800">Space Details</h2>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2"><a
                                href="{{ route('rooms.details', $booking->space->slug) }}">{{ $booking->space->title }}</a>
                        </h3>
                        <p class="text-gray-600 mb-4">{{ $booking->space->description }}</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-gray-100 rounded-full p-2">
                                    <svg class="h-5 w-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-500">Address</p>
                                    <p class="text-sm text-gray-900">{{ $booking->space->street_address }}</p>
                                    <p class="text-sm text-gray-900">{{ $booking->space->city }},
                                        {{ $booking->space->postal_code }}</p>
                                    <p class="text-sm text-gray-900">{{ $booking->space->country }}</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-gray-100 rounded-full p-2">
                                    <svg class="h-5 w-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-500">Capacity</p>
                                    <p class="text-sm text-gray-900">{{ $booking->space->capacity }}
                                        {{ Str::plural('person', $booking->space->capacity) }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Map Placeholder (you can replace with actual map) -->
                        <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Payment and Actions -->
            <div class="space-y-6">
                <!-- Payment Summary -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-semibold text-gray-800">Payment Details</h2>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between py-3 text-sm">
                            <span class="text-gray-600">Rate</span>
                            <span class="text-gray-900">${{ number_format($booking->space->hourly_rate, 2) }} ×
                                {{ \Carbon\Carbon::parse($booking->start_datetime)->diffInHours($booking->end_datetime) }}
                                hours</span>
                        </div>
                        <div class="flex justify-between py-3 text-sm border-t border-gray-200">
                            <span class="text-gray-600">Host Payout</span>
                            <span
                                class="text-gray-900">${{ number_format($booking->total_price - $booking->service_fee, 2) }}</span>
                        </div>
                        <div class="flex justify-between py-3 text-sm border-t border-gray-200">
                            <span class="text-gray-600">Service Fee</span>
                            <span class="text-gray-900">${{ number_format($booking->service_fee, 2) }}</span>
                        </div>
                        <div class="flex justify-between py-3 text-base font-medium border-t border-gray-200">
                            <span class="text-gray-900">Total</span>
                            <span class="text-gray-900">${{ number_format($booking->total_price, 2) }}</span>
                        </div>

                        @if ($booking->status == 'confirmed')
                            <div class="mt-4 bg-gray-50 border border-gray-200 rounded-md p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-700">
                                            Payment was processed successfully. The host will receive
                                            ${{ number_format($booking->host_payout, 2) }}.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Actions Card -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-semibold text-gray-800">Actions</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        @if ($booking->status == 'confirmed' || $booking->status == 'pending')
                            @if ($canRefund)
                                <button
                                    onclick="document.getElementById('refundModal').classList.remove('hidden')"
                                    class="cursor-pointer w-full bg-red-600 hover:bg-red-600 focus:ring-4 focus:ring-red-300 text-white font-medium py-2.5 px-4 rounded transition duration-150 ease-in-out flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                    </svg>
                                    Request Refund
                                </button>

                                <!-- Refund Modal -->
                                <div class="fixed inset-0 z-100000 flex items-center justify-center bg-black/30 backdrop-blur-sm hidden h-screen" id="refundModal">
                                    <div class="bg-white rounded-lg w-full max-w-md p-6 shadow-lg relative">
                                        <!-- Close Button -->
                                        <button type="button"
                                            class="cursor-pointer absolute top-2 right-2 text-gray-500 hover:text-gray-700"
                                            onclick="document.getElementById('refundModal').classList.add('hidden')">&times;</button>

                                        <h2 class="text-xl font-bold mb-4">Refund Request</h2>

                                        <form method="POST" action="{{ route('refund', $booking->id) }}">
                                            @csrf

                                            <label for="cancellation_reason" class="block text-gray-700 mb-1">Cancellation
                                                Reason</label>
                                            <textarea id="cancellation_reason" name="cancellation_reason" rows="4" class="w-full border rounded p-2 mb-4"
                                                required></textarea>

                                            <input type="hidden" name="cancelled_by" value="{{ Auth::user()->id }}">

                                            <button type="submit"
                                                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 w-full">
                                                Submit Refund
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endif

                        {{-- Button to trigger the modal --}}
                        @if ($booking->status == 'completed')
                            @if ($booking->space->reviews->where('booking_id', $booking->id)->where('reviewee_id', Auth::user()->id)->count() == 0)
                                <button id="reviewModalButton"
                                    class="flex cursor-pointer items-center w-full bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 text-white font-medium py-2.5 px-4 rounded transition duration-150 ease-in-out flex items-center justify-center">
                                    <i class="fa-solid fa-star mr-2"></i>
                                    Add Review
                                </button>
                            @else
                                <p class="text-xs text-gray-500 text-center mt-1">
                                    You have already reviewed this space
                                </p>
                            @endif
                        @endif

                        <a href="{{ route('user.profile', Auth::user()->slug) }}"
                            class="block w-full bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:ring-gray-300 text-gray-700 font-medium py-2.5 px-4 rounded transition duration-150 ease-in-out text-center">
                            Back to Bookings
                        </a>

                        {{-- Review Modal --}}
                        <div id="reviewModal" class="fixed inset-0 z-10000 hidden overflow-y-auto">
                            <div class="flex items-center justify-center min-h-screen px-4">
                                {{-- Dark Background Overlay --}}
                                <div class="fixed inset-0 bg-black opacity-50" id="reviewModalOverlay"></div>

                                {{-- Modal Content --}}
                                <div class="relative bg-white rounded-lg shadow-lg w-full max-w-md mx-auto z-10">
                                    {{-- Modal Header --}}
                                    <div class="flex items-center justify-between p-4 border-b rounded-t">
                                        <h3 class="text-xl font-semibold text-gray-900">
                                            Add Your Review
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                            id="closeReviewModal">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    {{-- Modal Body with Review Form --}}
                                    <div class="p-6">
                                        <form id="reviewForm" action="{{ route('reviews.store', $booking->id) }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                                            {{-- Star Rating --}}
                                            <div class="mb-5">
                                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                                    Your Rating
                                                </label>
                                                <div class="flex items-center space-x-1" id="starRating">
                                                    <input type="hidden" name="rating" id="ratingInput"
                                                        value="0">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <button type="button" data-rating="{{ $i }}"
                                                            class="star-btn text-2xl text-gray-300 hover:text-yellow-400 focus:outline-none transition-colors">
                                                            <i class="fa-solid fa-star"></i>
                                                        </button>
                                                    @endfor
                                                </div>
                                            </div>

                                            {{-- Review Comment --}}
                                            <div class="mb-5">
                                                <label class="block text-gray-700 text-sm font-bold mb-2"
                                                    for="review_text">
                                                    Your Review
                                                </label>
                                                <textarea id="review_text" name="review_text" rows="4"
                                                    class="shadow-lg appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    placeholder="Share your experience..." required></textarea>
                                            </div>

                                            {{-- Submit Button --}}
                                            <div class="flex justify-end">
                                                <button type="submit"
                                                    class="bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 text-white font-medium py-2 px-6 rounded transition duration-150 ease-in-out">
                                                    Submit Review
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lat = {{ $booking->space->latitude }};
            const lng = {{ $booking->space->longitude }};
            const map = L.map('map').setView([lat, lng], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 10,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            const marker = L.marker([lat, lng]).addTo(map);

            marker.bindPopup("<b>{{ $booking->space->title }}</b><br>{{ $booking->space->street_address }}")
                .openPopup();
        });
    </script>

    {{-- JavaScript for Modal Functionality --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get DOM elements
            const modal = document.getElementById('reviewModal');
            const modalButton = document.getElementById('reviewModalButton');
            const closeButton = document.getElementById('closeReviewModal');
            const overlay = document.getElementById('reviewModalOverlay');
            const starButtons = document.querySelectorAll('.star-btn');
            const ratingInput = document.getElementById('ratingInput');

            if (modalButton) {
                modalButton.addEventListener('click', function() {
                    modal.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden'); // Prevent scrolling
                });
            }

            const closeModal = function() {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            };

            if (closeButton) {
                closeButton.addEventListener('click', closeModal);
            }

            if (overlay) {
                overlay.addEventListener('click', closeModal);
            }

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });

            starButtons.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const rating = parseInt(this.getAttribute('data-rating'));
                    ratingInput.value = rating;

                    starButtons.forEach(function(star, index) {
                        if (index < rating) {
                            star.classList.add('text-yellow-400');
                            star.classList.remove('text-gray-300');
                        } else {
                            star.classList.add('text-gray-300');
                            star.classList.remove('text-yellow-400');
                        }
                    });
                });

                btn.addEventListener('mouseenter', function() {
                    const hoverRating = parseInt(this.getAttribute('data-rating'));

                    starButtons.forEach(function(star, index) {
                        if (index < hoverRating) {
                            star.classList.add('text-yellow-400');
                            star.classList.remove('text-gray-300');
                        }
                    });
                });

                btn.addEventListener('mouseleave', function() {
                    const currentRating = parseInt(ratingInput.value);

                    starButtons.forEach(function(star, index) {
                        if (index < currentRating) {
                            star.classList.add('text-yellow-400');
                            star.classList.remove('text-gray-300');
                        } else {
                            star.classList.add('text-gray-300');
                            star.classList.remove('text-yellow-400');
                        }
                    });
                });
            });
        });
    </script>
@endsection
