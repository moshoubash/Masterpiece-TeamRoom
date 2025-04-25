@extends('layouts.Home.layout')
@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Success Header -->
            <div class="bg-green-600 py-6 px-8 text-center">
                <div class="flex justify-center mb-4">
                    <div class="rounded-full bg-white p-2">
                        <svg class="h-8 w-8 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
                <h1 class="text-2xl font-bold text-white">Booking Confirmed!</h1>
                <p class="text-green-100 mt-1">Your meeting room has been successfully booked.</p>
            </div>

            <!-- Booking Details -->
            <div class="p-8 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Booking Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="mb-4">
                            <span class="block text-sm text-gray-500">Confirmation Number</span>
                            <span class="block font-medium text-gray-800">{{ $booking->id }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="block text-sm text-gray-500">Date</span>
                            <span class="block font-medium text-gray-800">{{ $booking->start_datetime }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="block text-sm text-gray-500">Time</span>
                            <span class="block font-medium text-gray-800">{{ $booking->start_datetime }} - {{ $booking->end_datetime }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="block text-sm text-gray-500">Duration</span>
                            <span class="block font-medium text-gray-800">
                                @php
                                    $startDate = Carbon\Carbon::parse($booking->start_datetime);
                                    $endDate = Carbon\Carbon::parse($booking->end_datetime);
                                    $duration = $endDate->diffInMinutes($startDate);
                                    $hours = floor($duration / 60);
                                    $minutes = $duration % 60;
                                    echo $hours > 0 ? $hours . ' hour' . ($hours > 1 ? 's' : '') : '';
                                    echo $hours > 0 && $minutes > 0 ? ' ' : '';
                                    echo $minutes > 0 ? $minutes . ' minute' . ($minutes > 1 ? 's' : '') : '';
                                @endphp
                            </span>
                        </div>
                    </div>
                    <div>
                        <div class="mb-4">
                            <span class="block text-sm text-gray-500">Space</span>
                            <span class="block font-medium text-gray-800">{{ $booking->space->title }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="block text-sm text-gray-500">Location</span>
                            <span class="block font-medium text-gray-800">{{ $booking->space->city ?? 'Location details will be provided in the confirmation email' }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="block text-sm text-gray-500">Attendees</span>
                            <span class="block font-medium text-gray-800">{{ $booking->num_attendees }} {{ $booking->num_attendees > 1 ? 'people' : 'person' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Details -->
            <div class="p-8 border-b border-gray-200 bg-gray-50">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Payment Summary</h2>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Booking Fee</span>
                        <span class="font-medium text-gray-800">${{ number_format($booking->host_payout, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Service Fee</span>
                        <span class="font-medium text-gray-800">${{ number_format($booking->service_fee, 2) }}</span>
                    </div>
                    <div class="flex justify-between pt-3 border-t border-gray-200">
                        <span class="text-lg font-semibold text-gray-800">Total Paid</span>
                        <span class="text-lg font-semibold text-green-600">${{ number_format($booking->total_price, 2) }}</span>
                    </div>
                </div>
                <div class="mt-6 p-4 bg-blue-50 rounded-md border border-blue-100 text-blue-800 text-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p>A confirmation email has been sent to {{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Access Details -->
            <div class="p-8 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Access Information</h2>
                <div class="rounded-md border border-gray-200 p-4">
                    <p class="mb-3 text-gray-800">
                        @if($booking->space->access_instructions)
                            {{ $booking->space->access_instructions }}
                        @else
                            Access details for this space will be provided in your confirmation email. If you have any questions about accessing the space, please contact support.
                        @endif
                    </p>
                    
                    @if($booking->space->access_code)
                    <div class="mt-4">
                        <span class="block text-sm text-gray-500">Access Code</span>
                        <span class="block font-medium text-gray-800 text-lg">{{ $booking->space->access_code }}</span>
                    </div>
                    @endif
                    
                    <div class="mt-4 flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-2">
                            <p class="text-sm text-gray-500">Please arrive on time for your booking.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Host Contact -->
            @if(isset($booking->space->host) && $booking->space->host)
            <div class="p-8 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Host Information</h2>
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center">
                            @if($booking->space->host->profile_picture_url)
                                <img src="{{ $booking->space->host->profile_photo_url }}" alt="{{ $booking->space->host->name }}" class="h-12 w-12 rounded-full object-cover">
                            @else
                                <span class="text-gray-500 text-lg font-medium">{{ substr($booking->space->host->first_name, 0, 1) }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-md font-medium text-gray-800">{{ $booking->space->host->name }}</h3>
                        <p class="text-sm text-gray-500">Host since {{ $booking->space->host->created_at->format('F Y') }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="/" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                        <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        Contact Host
                    </a>
                </div>
            </div>
            @endif

            <!-- Cancellation Policy -->
            <div class="p-8 bg-gray-50">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Cancellation Policy</h2>
                <p class="text-gray-600 mb-4">
                    Free cancellation up to 24 hours before your booking. Cancellations made less than 24 hours in advance are subject to a fee equivalent to 50% of the booking price.
                </p>
                <div class="mt-4">
                    <a href="/" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                        <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Manage Booking
                    </a>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-8 flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
            <a href="/" class="inline-flex justify-center items-center px-6 py-3 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Go to Dashboard
            </a>
            <button onclick="window.print()" class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Print Receipt
            </button>
        </div>

        <!-- Need Help -->
        <div class="mt-8 text-center">
            <p class="text-gray-600">Need help with your booking?</p>
            <a href="/" class="text-blue-600 hover:text-blue-800 font-medium">Contact Support</a>
        </div>
    </div>
</div>
@endsection