@extends('layouts.home.layout')
@section('content')

<div class="bg-gradient-to-r from-blue-600 to-indigo-700 py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl font-bold text-white mb-4">About Us</h1>
            <p class="text-xl text-white/90">Connecting you with the perfect space for productivity</p>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-16">
    <div class="max-w-3xl mx-auto">
        <div class="mb-12 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Welcome to <span class="text-blue-600">Team Room</span></h2>
            <p class="text-lg text-gray-700 mb-6">
                The smart solution for finding and booking meeting rooms effortlessly.
            </p>
        </div>
        
        <div class="mb-12">
            <p class="text-gray-700 mb-6">
                We built this platform to simplify how individuals, teams, and businesses schedule meetings. Whether you're a freelancer needing a quiet space, a startup hosting a brainstorming session, or a corporate team arranging client meetings, our system connects you with the right space at the right time.
            </p>
            
            <p class="text-gray-700 mb-6">
                Our goal is to save your time and eliminate the hassle of manual booking and availability checking. With real-time availability, easy filters, and secure booking, we bring flexibility and transparency to meeting room management.
            </p>
        </div>
        
        <div class="mb-12">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">What We Offer</h3>
            
            <div class="grid md:grid-cols-2 gap-x-8 gap-y-6">
                <div class="flex items-start">
                    <div class="bg-blue-100 p-3 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-1">Diverse Spaces</h4>
                        <p class="text-gray-600">A wide range of rooms from coworking spaces to corporate boardrooms</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-blue-100 p-3 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-1">Real-Time Booking</h4>
                        <p class="text-gray-600">Real-time availability and instant booking confirmation</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-blue-100 p-3 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-1">Secure Transactions</h4>
                        <p class="text-gray-600">Secure payments and booking confirmations</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-blue-100 p-3 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-1">Custom Features</h4>
                        <p class="text-gray-600">Tailored functionality for admins, hosts, and users</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mb-12">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Who We Serve</h3>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-blue-600 rounded-full mr-3"></div>
                        <span class="text-gray-700">Remote teams & startups</span>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-blue-600 rounded-full mr-3"></div>
                        <span class="text-gray-700">Event organizers</span>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-blue-600 rounded-full mr-3"></div>
                        <span class="text-gray-700">Office managers</span>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-blue-600 rounded-full mr-3"></div>
                        <span class="text-gray-700">Coworking space providers</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Vision</h3>
            <p class="text-gray-700 text-lg mb-8">
                At <span class="font-semibold text-blue-600">Team Room</span>, we believe productive meetings start with the right space. Let us help you find it.
            </p>
            
            <a href="/explore" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-colors">
                Start Booking Now
            </a>
        </div>
    </div>
</div>

@endsection