@extends('layouts.home.layout')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="text-center px-4 py-10 bg-white rounded-lg shadow-xl max-w-lg">
        <div class="mb-8">
            <svg class="w-16 h-16 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        
        <h1 class="text-5xl font-bold text-gray-800 mb-4">404</h1>
        <h2 class="text-2xl font-semibold text-gray-600 mb-4">Page Not Found</h2>
        
        <p class="text-gray-500 mb-8">
            The page you are looking for doesn't exist or has been moved.
        </p>
        
        <div class="flex justify-center space-x-4">
            <a href="/" class="px-5 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Go Home
            </a>
            <button onclick="window.history.back()" class="cursor-pointer px-5 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                Go Back
            </button>
        </div>
    </div>
</div>
@endsection