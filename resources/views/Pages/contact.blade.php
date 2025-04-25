@extends('layouts.home.layout')

@section('content')
<!-- Page Header -->
<div class="bg-gradient-to-r from-blue-600 to-indigo-700 py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl font-bold text-white mb-4">Get in touch</h1>
            <p class="text-xl text-white/90">We'd love to hear from you. Please fill out the form below and we'll get back to you as soon as possible.</p>
        </div>
    </div>
</div>
<div class="container mx-auto py-12 px-4">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-gray-800 mb-4 text-center">Contact Us</h1>
        <!-- Contact Form Section -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-12">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                @csrf
                @method('POST')
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Your Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="subject" class="block mb-2 text-sm font-medium text-gray-700">Subject</label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('subject')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-700">Your Message</label>
                    <textarea id="message" name="message" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition duration-300">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection