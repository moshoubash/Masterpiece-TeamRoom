@extends('layouts.home.layout')

@section('content')
<div class="bg-gradient-to-r from-blue-600 to-indigo-700 py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl font-bold text-white mb-4">Privacy Policy</h1>
            <p class="text-xl text-white/90">Last Updated: April 26, 2025</p>
        </div>
    </div>
</div>

<div class="min-h-screen flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl w-full bg-white rounded-lg p-8">
        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">1. Introduction</h2>
            <p class="text-gray-600 leading-relaxed">
                Welcome to Team Room. We are committed to protecting your privacy and ensuring that your personal information is handled in a safe and responsible manner. This Privacy Policy explains how we collect, use, disclose, and protect your information when you use our Service.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">2. Information We Collect</h2>
            <p class="text-gray-600 leading-relaxed">
                We may collect the following types of information when you use the Service:
            </p>
            <ul class="list-disc list-inside text-gray-600 mt-2 space-y-2">
                <li><strong>Personal Information:</strong> Name, email address, phone number, and payment information provided when you create an account or make a booking.</li>
                <li><strong>Booking Information:</strong> Details about your meeting room bookings, such as dates, times, and room preferences.</li>
                <li><strong>Usage Data:</strong> Information about how you interact with the Service, including IP address, browser type, device information, and pages visited.</li>
                <li><strong>Cookies and Tracking Technologies:</strong> We use cookies and similar technologies to enhance your experience, analyze usage, and deliver personalized content.</li>
            </ul>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">3. How We Use Your Information</h2>
            <p class="text-gray-600 leading-relaxed">
                We use your information for the following purposes:
            </p>
            <ul class="list-disc list-inside text-gray-600 mt-2 space-y-2">
                <li>To process and manage your meeting room bookings.</li>
                <li>To communicate with you about your account, bookings, or customer support inquiries.</li>
                <li>To improve and optimize the Service, including analyzing usage trends and preferences.</li>
                <li>To send you promotional offers, newsletters, or other marketing communications (you may opt out at any time).</li>
                <li>To comply with legal obligations and protect the security of the Service.</li>
            </ul>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">4. Sharing Your Information</h2>
            <p class="text-gray-600 leading-relaxed">
                We do not sell or rent your personal information to third parties. We may share your information in the following circumstances:
            </p>
            <ul class="list-disc list-inside text-gray-600 mt-2 space-y-2">
                <li><strong>Service Providers:</strong> With trusted third-party providers who assist us in operating the Service, such as payment processors or hosting providers, under strict confidentiality agreements.</li>
                <li><strong>Legal Requirements:</strong> When required by law, such as to comply with a subpoena, court order, or other legal process.</li>
                <li><strong>Business Transfers:</strong> In connection with a merger, acquisition, or sale of assets, where your information may be transferred as part of the transaction.</li>
            </ul>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">5. Cookies and Tracking Technologies</h2>
            <p class="text-gray-600 leading-relaxed">
                We use cookies and similar technologies to enhance your experience and analyze usage. You can manage your cookie preferences through your browser settings. Essential cookies are required for the Service to function, while optional cookies (e.g., for analytics or marketing) can be disabled.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">6. Data Security</h2>
            <p class="text-gray-600 leading-relaxed">
                We implement reasonable technical and organizational measures to protect your personal information from unauthorized access, loss, or misuse. However, no system is completely secure, and we cannot guarantee the absolute security of your information.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">7. Your Rights</h2>
            <p class="text-gray-600 leading-relaxed">
                Depending on your location, you may have the following rights regarding your personal information:
            </p>
            <ul class="list-disc list-inside text-gray-600 mt-2 space-y-2">
                <li><strong>Access:</strong> Request a copy of the personal information we hold about you.</li>
                <li><strong>Correction:</strong> Request correction of inaccurate or incomplete information.</li>
                <li><strong>Deletion:</strong> Request deletion of your personal information, subject to legal obligations.</li>
                <li><strong>Opt-Out:</strong> Opt out of marketing communications or certain data processing activities.</li>
            </ul>
            <p class="text-gray-600 leading-relaxed mt-2">
                To exercise these rights, please contact us at the details provided in Section 10.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">8. Data Retention</h2>
            <p class="text-gray-600 leading-relaxed">
                We retain your personal information only for as long as necessary to fulfill the purposes outlined in this Privacy Policy or as required by law. For example, booking information may be retained for accounting purposes, while usage data may be anonymized and retained for analytics.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">9. Changes to This Privacy Policy</h2>
            <p class="text-gray-600 leading-relaxed">
                We may update this Privacy Policy from time to time to reflect changes in our practices or legal requirements. We will notify you of material changes by posting the updated Privacy Policy on our website or through the Service. Your continued use of the Service after such changes constitutes your acceptance of the updated Privacy Policy.
            </p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">10. Contact Us</h2>
            <p class="text-gray-600 leading-relaxed">
                If you have any questions or concerns about this Privacy Policy or our data practices, please contact us at:
            </p>
            <p class="text-gray-600 mt-2">
                Team Room<br>
                Email: support@teamroom.com<br>
                Address: Amman, Jordan ABC street 123
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