@extends('layouts.Home.layout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Profile Header -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="flex flex-wrap items-center">
            <div class="mr-6">
                <img src="{{ asset('images/profile-avatar.jpg') }}" alt="Profile Picture" class="w-24 h-24 rounded-full object-cover">
            </div>
            <div class="flex-grow">
                <h1 class="text-2xl font-bold text-gray-900">John Doe</h1>
                <p class="text-gray-600 mb-2">Member since April 2025</p>
                <div class="flex flex-wrap items-center gap-4">
                    <div class="flex items-center">
                        <span class="inline-flex items-center justify-center w-5 h-5 bg-green-500 rounded-full mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <span>Verified</span>
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span>4.9 (28 reviews)</span>
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 01-1.581.814L12 14.229l-2.419 2.585A1 1 0 018 16V4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 01-1.581.814L18 14.229V4a2 2 0 00-2-2h-8a2 2 0 00-2 2v12a1 1 0 01-1.581.814L4 14.229l-2.419 2.585A1 1 0 010 16V4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 01-1.581.814L10 14.229l-2.419 2.585A1 1 0 016 16V4z" clip-rule="evenodd" />
                        </svg>
                        <span>Host</span>
                    </div>
                </div>
            </div>
            <div class="mt-4 md:mt-0">
                <button class="bg-blue-700 hover:bg-blue-800 text-white font-medium py-2 px-5 rounded-md transition">
                    Edit Profile
                </button>
            </div>
        </div>
    </div>

    <!-- Profile Navigation -->
    <div class="border-b border-gray-200 mb-6">
        <nav class="-mb-px flex space-x-8">
            <a href="#" class="border-b-2 border-blue-700 text-blue-700 font-medium pb-4 px-1">My Spaces</a>
            <a href="#" class="border-b-2 border-transparent hover:text-blue-700 hover:border-blue-300 text-gray-500 pb-4 px-1">Bookings</a>
            <a href="#" class="border-b-2 border-transparent hover:text-blue-700 hover:border-blue-300 text-gray-500 pb-4 px-1">Reviews</a>
            <a href="#" class="border-b-2 border-transparent hover:text-blue-700 hover:border-blue-300 text-gray-500 pb-4 px-1">Settings</a>
        </nav>
    </div>

    <!-- Listed Spaces -->
    <div class="mb-12">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-900">My Listed Spaces</h2>
            <form action="{{route('room.create')}}">
                <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-medium py-2 px-5 rounded-md transition">
                    List a New Space
                </button>
            </form>
        </div>

        <!-- Grid of Spaces -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Space 1 -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="relative">
                    <img src="{{ asset('images/executive-room.jpg') }}" alt="Executive Meeting Room" class="w-full h-48 object-cover">
                    <div class="absolute top-3 right-3 space-x-2">
                        <button class="bg-white p-2 rounded-md shadow hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </button>
                        <button class="bg-white p-2 rounded-md shadow hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-semibold text-gray-900">Executive Meeting Room</h3>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="ml-1">5</span>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-2">Midtown Business Center, New York</p>
                    <p class="text-gray-600 mb-2">Up to 12 people • Meeting Room</p>
                    <div class="flex justify-between items-center mb-3">
                        <div class="font-semibold text-gray-900">$75<span class="text-gray-600 font-normal">/hour</span></div>
                        <div class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded">Active</div>
                    </div>
                    <div class="flex space-x-2">
                        <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View details</a>
                        <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View Stats</a>
                    </div>
                </div>
            </div>

            <!-- Space 2 -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="relative">
                    <img src="{{ asset('images/creative-workspace.jpg') }}" alt="Creative Workspace" class="w-full h-48 object-cover">
                    <div class="absolute top-3 right-3 space-x-2">
                        <button class="bg-white p-2 rounded-md shadow hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </button>
                        <button class="bg-white p-2 rounded-md shadow hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-semibold text-gray-900">Creative Workspace</h3>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="ml-1">5</span>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-2">Innovation Hub, New York</p>
                    <p class="text-gray-600 mb-2">Up to 8 people • Coworking Space</p>
                    <div class="flex justify-between items-center mb-3">
                        <div class="font-semibold text-gray-900">$45<span class="text-gray-600 font-normal">/hour</span></div>
                        <div class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded">Active</div>
                    </div>
                    <div class="flex space-x-2">
                        <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View details</a>
                        <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View Stats</a>
                    </div>
                </div>
            </div>

            <!-- Space 3 -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="relative">
                    <img src="{{ asset('images/conference-center.jpg') }}" alt="Conference Center" class="w-full h-48 object-cover">
                    <div class="absolute top-3 right-3 space-x-2">
                        <button class="bg-white p-2 rounded-md shadow hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </button>
                        <button class="bg-white p-2 rounded-md shadow hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-semibold text-gray-900">Conference Center</h3>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="ml-1">0.0</span>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-2">Riverfront Tower, New York</p>
                    <p class="text-gray-600 mb-2">Up to 50 people • Conference Room</p>
                    <div class="flex justify-between items-center mb-3">
                        <div class="font-semibold text-gray-900">$150<span class="text-gray-600 font-normal">/hour</span></div>
                        <div class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded">Active</div>
                    </div>
                    <div class="flex space-x-2">
                        <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View details</a>
                        <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View Stats</a>
                    </div>
                </div>
            </div>

            <!-- Space 4 -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="relative">
                    <img src="{{ asset('images/premium-meeting-room.jpg') }}" alt="Premium Meeting Room" class="w-full h-48 object-cover">
                    <div class="absolute top-3 right-3 space-x-2">
                        <button class="bg-white p-2 rounded-md shadow hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </button>
                        <button class="bg-white p-2 rounded-md shadow hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-semibold text-gray-900">Premium Meeting Room</h3>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="ml-1">0.0</span>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-2">Midtown Business Center, New York</p>
                    <p class="text-gray-600 mb-2">Up to 10 people • Meeting Room</p>
                    <div class="flex justify-between items-center mb-3">
                        <div class="font-semibold text-gray-900">$60<span class="text-gray-600 font-normal">/hour</span></div>
                        <div class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded">Active</div>
                    </div>
                    <div class="flex space-x-2">
                        <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View details</a>
                        <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View Stats</a>
                    </div>
                </div>
            </div>

            <!-- Space 5 -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="relative">
                    <img src="{{ asset('images/downtown-conference.jpg') }}" alt="Downtown Conference Room" class="w-full h-48 object-cover">
                    <div class="absolute top-3 right-3 space-x-2">
                        <button class="bg-white p-2 rounded-md shadow hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </button>
                        <button class="bg-white p-2 rounded-md shadow hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-semibold text-gray-900">Downtown Conference Room</h3>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="ml-1">0.0</span>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-2">Financial District, New York</p>
                    <p class="text-gray-600 mb-2">Up to 20 people • Conference Room</p>
                    <div class="flex justify-between items-center mb-3">
                        <div class="font-semibold text-gray-900">$120<span class="text-gray-600 font-normal">/hour</span></div>
                        <div class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded">Active</div>
                    </div>
                    <div class="flex space-x-2">
                        <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View details</a>
                        <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View Stats</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hosting Statistics -->
    <div>
        <h2 class="text-xl font-bold text-gray-900 mb-6">Hosting Statistics</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Bookings -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-gray-600 mb-2">Total Bookings</h3>
                <p class="text-3xl font-bold text-gray-900">142</p>
            </div>

            <!-- Average Rating -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-gray-600 mb-2">Total Bookings</h3>
                <p class="text-3xl font-bold text-gray-900">142</p>
            </div>

            <!-- Total Revenue -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-gray-600 mb-2">Total Bookings</h3>
                <p class="text-3xl font-bold text-gray-900">142</p>
            </div>

            <!-- Total Reviews -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-gray-600 mb-2">Total Bookings</h3>
                <p class="text-3xl font-bold text-gray-900">142</p>
            </div>
        </div>
    </div>
</div>
@endsection