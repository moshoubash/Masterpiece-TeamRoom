@extends('layouts.home.layout')

@section('content')
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 py-6 px-8">
                    <h1 class="text-2xl font-bold text-white">Complete Your Booking</h1>
                    <p class="text-blue-100 mt-1">You're just a few steps away from securing your meeting room.</p>
                </div>

                <!-- Booking Details -->
                <div class="p-8 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Booking Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="mb-4">
                                <span class="block text-sm text-gray-500">Date</span>
                                <span
                                    class="block font-medium text-gray-800">{{ \Carbon\Carbon::parse($request->date)->format('l, F j, Y') }}</span>
                            </div>
                            <div class="mb-4">
                                <span class="block text-sm text-gray-500">Time</span>
                                <span
                                    class="block font-medium text-gray-800">{{ \Carbon\Carbon::parse($request->start_time)->format('g:i A') }}
                                    - {{ \Carbon\Carbon::parse($request->end_time)->format('g:i A') }}</span>
                            </div>
                            <div class="mb-4">
                                <span class="block text-sm text-gray-500">Duration</span>
                                <span class="block font-medium text-gray-800">
                                    @php
                                        $start = \Carbon\Carbon::parse($request->start_datetime);
                                        $end = \Carbon\Carbon::parse($request->end_datetime);
                                        $duration = $start->diffInMinutes($end);
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
                                <span class="block font-medium text-gray-800">
                                    @php
                                        $space = \App\Models\Space::find($request->space_id);
                                        echo $space ? $space->name : 'Meeting Room';
                                    @endphp
                                </span>
                            </div>
                            <div class="mb-4">
                                <span class="block text-sm text-gray-500">Attendees</span>
                                <span class="block font-medium text-gray-800">{{ $request->num_attendees }}
                                    {{ $request->num_attendees > 1 ? 'people' : 'person' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Price Summary -->
                <div class="p-8 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Price Summary</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Booking Fee</span>
                            <span class="font-medium text-gray-800">${{ number_format($request->host_payout, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Service Fee</span>
                            <span class="font-medium text-gray-800">${{ number_format($request->service_fee, 2) }}</span>
                        </div>
                        <div class="flex justify-between pt-3 border-t border-gray-200">
                            <span class="text-lg font-semibold text-gray-800">Total</span>
                            <span
                                class="text-lg font-semibold text-blue-600">${{ number_format($request->total_price, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Stripe Payment Form -->
                <div class="p-8">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Payment Method</h2>
                    <form id="payment-form" action="{{ route('payment.process') }}" method="POST">
                        @csrf
                        @method('POST')

                        <input type="hidden" name="space_id" value="{{ $request->space_id }}">
                        <input type="hidden" name="date" value="{{ $request->date }}">
                        <input type="hidden" name="start_time" value="{{ $request->start_time }}">
                        <input type="hidden" name="end_time" value="{{ $request->end_time }}">
                        <input type="hidden" name="num_attendees" value="{{ $request->num_attendees }}">
                        <input type="hidden" name="total_price" value="{{ $request->total_price }}">
                        <input type="hidden" name="service_fee" value="{{ $request->service_fee }}">
                        <input type="hidden" name="host_payout" value="{{ $request->host_payout }}">
                        <input type="hidden" name="start_datetime" value="{{ $request->start_datetime }}">
                        <input type="hidden" name="end_datetime" value="{{ $request->end_datetime }}">
                        <input type="hidden" name="payment_method_id" id="payment_method_id">
                        <input type="hidden" name="payment_intent_id" id="payment_intent_id">

                        <!-- Billing Information -->
                        <div class="mb-6">
                            <h3 class="text-md font-medium text-gray-700 mb-3">Billing Information</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                    <input type="text" id="name" name="name"
                                        class="mt-1 block w-full px-3 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email
                                        Address</label>
                                    <input type="email" id="email" name="email"
                                        class="mt-1 block w-full px-3 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                </div>
                            </div>
                        </div>

                        <!-- Stripe Card Element -->
                        <div class="mb-6">
                            <h3 class="text-md font-medium text-gray-700 mb-3">Card Details</h3>
                            <div class="bg-white p-4 border border-gray-300 rounded-md shadow-sm">
                                <div id="card-element">
                                    <!-- Stripe Card Element will be inserted here -->
                                </div>
                                <div id="card-errors" class="text-red-600 text-sm" role="alert"></div>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="flex items-start mt-6">
                            <div class="flex items-center h-5">
                                <input id="terms" name="terms" type="checkbox"
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="font-medium text-gray-700">I agree to the <a href="#"
                                        class="text-blue-600 hover:text-blue-800">Terms and Conditions</a> and <a
                                        href="#" class="text-blue-600 hover:text-blue-800">Privacy
                                        Policy</a></label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6">
                            <button id="submit-button" type="submit"
                                class="w-full bg-blue-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Pay ${{ number_format($request->total_price, 2) }}
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Cancellation Policy -->
                <div class="p-6 bg-gray-50 border-t border-gray-200">
                    <h3 class="text-sm font-medium text-gray-700">Cancellation Policy</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Free cancellation up to 24 hours before your booking. Cancellations made less than 24 hours in
                        advance are subject to a fee equivalent to 50% of the booking price.
                    </p>
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-6 text-center">
                <a href="{{ url()->previous() }}" class="text-blue-600 hover:text-blue-800 font-medium">
                    &larr; Back to selection
                </a>
            </div>

            <!-- Stripe Security Badge -->
            <div class="mt-8 text-center">
                <div class="inline-flex items-center space-x-2 text-gray-600 text-sm">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <span>Secure payment powered by Stripe</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Stripe JS -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Stripe
            const stripe = Stripe('{{ config('services.stripe.key') }}');
            const elements = stripe.elements();

            // Create card Element and mount it
            const cardElement = elements.create('card', {
                style: {
                    base: {
                        color: '#32325d',
                        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                        fontSmoothing: 'antialiased',
                        fontSize: '16px',
                        '::placeholder': {
                            color: '#aab7c4'
                        }
                    },
                    invalid: {
                        color: '#fa755a',
                        iconColor: '#fa755a'
                    }
                }
            });
            cardElement.mount('#card-element');

            const form = document.getElementById('payment-form');
            form.addEventListener('submit', async (event) => {
                event.preventDefault();
                document.getElementById('submit-button').disabled = true;

                const {
                    paymentMethod,
                    error
                } = await stripe.createPaymentMethod({
                    type: 'card',
                    card: cardElement,
                    billing_details: {
                        name: document.getElementById('name').value,
                        email: document.getElementById('email').value
                    }
                });

                if (error) {
                    document.getElementById('card-errors').textContent = error.message;
                    document.getElementById('submit-button').disabled = false;
                } else {
                    document.getElementById('payment_method_id').value = paymentMethod.id;
                    form.submit();
                }
            });

        });
    </script>
@endsection
