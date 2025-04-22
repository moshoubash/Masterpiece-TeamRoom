@extends('layouts.Home.layout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Breadcrumbs -->
    <div class="flex items-center text-sm text-gray-600 mb-4">
        <a href="/" class="hover:text-blue-600">Home</a>
        <span class="mx-2">/</span>
        <a href="/" class="hover:text-blue-600">Meeting Rooms</a>
        <span class="mx-2">/</span>
        <span class="font-medium text-gray-900">Executive Meeting Room</span>
    </div>

    <!-- Room Title and Actions -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Executive Meeting Room</h1>
            <div class="flex items-center mt-2">
                <div class="flex items-center text-yellow-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <span class="ml-1 text-gray-700">5 (2 reviews)</span>
                </div>
                <div class="flex items-center ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-1 text-gray-700">Midtown Business Center, New York</span>
                </div>
            </div>
        </div>
        <div class="flex items-center">
            <button class="flex items-center text-gray-600 mr-4 hover:text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                </svg>
                Save
            </button>
            <button class="flex items-center text-gray-600 hover:text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                </svg>
                Share
            </button>
        </div>
    </div>

    <!-- Room Images Grid -->
    <div class="grid grid-cols-3 gap-4 mb-8">
        <div class="col-span-2 row-span-2">
            <img src="https://audiovisualindiana.com/wp-content/uploads/2020/09/conference-room-av-indianapolis.jpg" alt="Executive Meeting Room" class="w-full h-full object-cover rounded-lg">
        </div>
        <div>
            <img src="https://crunchytech.com/wp-content/uploads/2022/11/teleconferencing-systems-1.jpg" alt="Cozy corner" class="w-full h-full object-cover rounded-lg">
        </div>
        <div>
            <img src="https://www.focusav.com.au/wp-content/uploads/microsoftteams-image-67-scaled.jpg" alt="Room view" class="w-full h-full object-cover rounded-lg">
        </div>
        <div>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQuyFpl7aZVvy_YN6NSAK1RPFoTLQAKcDgS9EFcOKOX8G0N4g24cd8v-wE8QljPlAPWwBY&usqp=CAU" alt="Workspace" class="w-full h-full object-cover rounded-lg">
        </div>
        <div>
            <img src="https://imagedelivery.net/NTBbUGXbgnQKXhDzmZxa9Q/10fba224-b51b-4db7-dde5-c84f2d440200/default?w=1000&h=600" alt="Corridor" class="w-full h-full object-cover rounded-lg">
        </div>
    </div>

    <div class="flex flex-wrap -mx-4">
        <!-- Left Column: Room Details -->
        <div class="w-full lg:w-2/3 px-4">
            <!-- About this space -->
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">About this space</h2>
                <p class="text-gray-700">
                    Our Executive Meeting Room offers a professional environment designed to impress clients and inspire team collaboration. Located in the heart of Midtown, this space features premium furnishings, state-of-the-art technology, and all the amenities needed for productive meetings.
                </p>
            </div>

            <!-- Amenities -->
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Amenities</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Essentials -->
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-3">Essentials</h3>
                        <ul class="space-y-3">
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                </svg>
                                High-speed Wi-Fi
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd" />
                                </svg>
                                Coffee & refreshments
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                                </svg>
                                Whiteboard & supplies
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Technology -->
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-3">Technology</h3>
                        <ul class="space-y-3">
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z" clip-rule="evenodd" />
                                </svg>
                                4K Display with HDMI
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                                </svg>
                                Video conferencing
                            </li>
                        </ul>
                    </div>

                    <!-- Services -->
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-3">Services</h3>
                        <ul class="space-y-3">
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z" />
                                </svg>
                                Catering Available
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Reviews -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        5 · 2 reviews
                    </h2>
                    <a href="#" class="text-blue-600 hover:underline">See all reviews</a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Review 1 -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center mb-3">
                            <img src="https://cdn.vectorstock.com/i/1000v/51/05/male-profile-avatar-with-brown-hair-vector-12055105.jpg" alt="Reviewer" class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <p class="font-medium">Reviewer</p>
                                <p class="text-sm text-gray-500">April 2025</p>
                            </div>
                        </div>
                        <p class="text-gray-700">Perfect space for our client presentation. The tech setup was flawless and the coffee station was a nice touch. Will definitely book again.</p>
                    </div>
                    
                    <!-- Review 2 -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center mb-3">
                            <img src="https://www.silcharmunicipality.in/wp-content/uploads/2021/02/male-face.jpg" alt="Reviewer" class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <p class="font-medium">Reviewer</p>
                                <p class="text-sm text-gray-500">April 2025</p>
                            </div>
                        </div>
                        <p class="text-gray-700">The room exceeded our expectations. Very professional environment and the staff was extremely helpful with setting up our presentation.</p>
                    </div>
                </div>
            </div>

            <!-- Location -->
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Location</h2>
                <div class="mb-4 rounded-lg overflow-hidden">
                    <div class="bg-gray-200 h-64 relative">
                        <!-- Map placeholder - in a real app this would be an interactive map -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-gray-500">Map view · Midtown Business Center, New York</span>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h3 class="font-semibold text-gray-800 mb-2">Midtown Business Center</h3>
                    <p class="text-gray-700 mb-2">Midtown Business Center, New York</p>
                    <p class="text-gray-700">Located in a convenient area, easily accessible by public transportation. The building offers secure access and is surrounded by restaurants, cafes, and hotels.</p>
                </div>
            </div>

            <!-- Space policies -->
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Space policies</h2>
                
                <div class="mb-4">
                    <h3 class="font-semibold text-gray-800 mb-2">Cancellation policy</h3>
                    <p class="text-gray-700">Free cancellation up to 24 hours before your booking. Cancellations made less than 24 hours in advance are not refundable.</p>
                </div>
                
                <div>
                    <h3 class="font-semibold text-gray-800 mb-2">House rules</h3>
                    <ul class="space-y-2 text-gray-700">
                        <li class="flex items-start">
                            <span class="text-gray-400 mr-2">•</span>
                            No smoking or vaping
                        </li>
                        <li class="flex items-start">
                            <span class="text-gray-400 mr-2">•</span>
                            No pets allowed
                        </li>
                        <li class="flex items-start">
                            <span class="text-gray-400 mr-2">•</span>
                            No loud music
                        </li>
                        <li class="flex items-start">
                            <span class="text-gray-400 mr-2">•</span>
                            Clean up after your meeting
                        </li>
                        <li class="flex items-start">
                            <span class="text-gray-400 mr-2">•</span>
                            Report any damages
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Right Column: Booking Widget -->
        <div class="w-full lg:w-1/3 px-4">
            <div class="bg-white rounded-lg shadow p-6 border border-gray-200 sticky top-4">
                <div class="flex justify-between items-center mb-6">
                    <div class="text-2xl font-bold">$75<span class="text-gray-500 text-base font-normal">/hour</span></div>
                    <div class="flex items-center text-yellow-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="ml-1">5 (2)</span>
                    </div>
                </div>

                <form>
                    <!-- Date -->
                    <div class="mb-4">
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <div class="relative">
                            <input type="date" id="date" name="date" value="2025-04-22" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>

                    <!-- Time Range -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="start-time" class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
                            <select id="start-time" name="start-time" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <!-- Additional time options -->
                            </select>
                        </div>
                        <div>
                            <label for="end-time" class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
                            <select id="end-time" name="end-time" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="12:00">12:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <!-- Additional time options -->
                            </select>
                        </div>
                    </div>

                    <!-- Guests -->
                    <div class="mb-4">
                        <label for="guests" class="block text-sm font-medium text-gray-700 mb-1">Number of Guests</label>
                        <select id="guests" name="guests" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="1-4">1-4 people</option>
                            <option value="5-8">5-8 people</option>
                            <option value="9-12">9-12 people</option>
                        </select>
                    </div>

                    <!-- Special Requests -->
                    <div class="mb-6">
                        <label for="special-requests" class="block text-sm font-medium text-gray-700 mb-1">Add Special Requests (Optional)</label>
                        <textarea id="special-requests" name="special-requests" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    </div>

                    <!-- Price Summary -->
                    <div class="border-t border-gray-200 pt-4 mb-6">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">$75 x 2 hours</span>
                            <span class="font-medium">$150.00</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Cleaning fee</span>
                            <span class="font-medium">$25</span>
                        </div>
                        <div class="flex justify-between mb-4">
                            <span class="text-gray-600">Service fee</span>
                            <span class="font-medium">$15</span>
                        </div>
                        <div class="flex justify-between font-bold">
                            <span>Total</span>
                            <span>$190.00</span>
                        </div>
                    </div>

                    <!-- Book Now Button -->
                    <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-medium py-3 px-4 rounded-md transition duration-150 ease-in-out">
                        Book Now
                    </button>
                </form>

                <!-- Report Listing -->
                <div class="mt-4 text-center">
                    <button class="text-gray-500 text-sm flex items-center justify-center mx-auto hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a1 1 0 00-1 1v3a1 1 0 11-2 0V6z" clip-rule="evenodd" />
                        </svg>
                        Report this listing
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection