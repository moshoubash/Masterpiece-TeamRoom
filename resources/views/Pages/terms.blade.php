@extends('layouts.home.layout')

@section('content')
<div class="bg-gradient-to-r from-blue-600 to-indigo-700 py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl font-bold text-white mb-4">Terms of Service</h1>
            <p class="text-xl text-white/90">Last Updated: April 26, 2025</p>
        </div>
    </div>
</div>

<div class="min-h-screen flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl w-full bg-white rounded-lg p-8">
        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">1. Acceptance of Terms</h2>
            <p class="text-gray-600 leading-relaxed">
                By accessing or using our Meeting Rooms Booking System ("Service"), you agree to be bound by these Terms of Service ("Terms"). If you do not agree to these Terms, you may not use the Service. The Service is owned and operated by [Your Company Name] ("we," "us," or "our").
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">2. Eligibility</h2>
            <p class="text-gray-600 leading-relaxed">
                You must be at least 18 years old or have the necessary legal capacity to enter into contracts to use the Service. By using the Service, you represent and warrant that you meet these eligibility requirements.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">3. Booking and Use of Meeting Rooms</h2>
            <p class="text-gray-600 leading-relaxed">
                The Service allows you to book meeting rooms for professional or business purposes. You agree to:
            </p>
            <ul class="list-disc list-inside text-gray-600 mt-2 space-y-2">
                <li>Use the meeting rooms solely for lawful activities.</li>
                <li>Provide accurate information when making a booking.</li>
                <li>Comply with any specific rules or guidelines for the use of the meeting rooms, as provided at the time of booking.</li>
                <li>Not exceed the maximum capacity of the booked room.</li>
            </ul>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">4. Payment and Fees</h2>
            <p class="text-gray-600 leading-relaxed">
                Booking fees, if applicable, will be clearly displayed at the time of booking. You agree to pay all fees associated with your booking. All payments are non-refundable unless otherwise stated in our Cancellation Policy (see Section 5).
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">5. Cancellation and Modifications</h2>
            <p class="text-gray-600 leading-relaxed">
                You may cancel or modify your booking subject to the following conditions:
            </p>
            <ul class="list-disc list-inside text-gray-600 mt-2 space-y-2">
                <li>Cancellations made at least 24 hours before the scheduled booking time may be eligible for a full refund or credit, at our discretion.</li>
                <li>No refunds or credits will be issued for cancellations made less than 24 hours before the booking time.</li>
                <li>Modifications to bookings are subject to availability and may incur additional fees.</li>
            </ul>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">6. User Conduct</h2>
            <p class="text-gray-600 leading-relaxed">
                You agree not to:
            </p>
            <ul class="list-disc list-inside text-gray-600 mt-2 space-y-2">
                <li>Damage, deface, or remove any property from the meeting rooms.</li>
                <li>Use the Service to engage in any illegal, abusive, or disruptive behavior.</li>
                <li>Attempt to gain unauthorized access to any part of the Service or its systems.</li>
            </ul>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">7. Limitation of Liability</h2>
            <p class="text-gray-600 leading-relaxed">
                To the fullest extent permitted by law, [Your Company Name] shall not be liable for any indirect, incidental, special, consequential, or punitive damages arising out of or related to your use of the Service. Our total liability to you for any claim arising from these Terms or the Service will not exceed the amount paid by you for the specific booking in question.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">8. Termination</h2>
            <p class="text-gray-600 leading-relaxed">
                We reserve the right to suspend or terminate your access to the Service at our sole discretion, with or without notice, for any reason, including if we believe you have violated these Terms.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">9. Changes to Terms</h2>
            <p class="text-gray-600 leading-relaxed">
                We may update these Terms from time to time. We will notify you of any material changes by posting the updated Terms on our website or through the Service. Your continued use of the Service after such changes constitutes your acceptance of the updated Terms.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">10. Contact Us</h2>
            <p class="text-gray-600 leading-relaxed">
                If you have any questions about these Terms, please contact us at:
            </p>
            <p class="text-gray-600 mt-2">
                [Your Company Name]<br>
                Email: support@[yourcompany].com<br>
                Address: [Your Company Address]
            </p>
        </section>

        <div class="text-center">
            <a href="{{ url('/') }}" class="inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition duration-200">
                Back to Home
            </a>
        </div>
    </div>
</div>
@endsection