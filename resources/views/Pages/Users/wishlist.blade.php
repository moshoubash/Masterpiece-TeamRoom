@extends('layouts.Home.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">My Wishlist</h1>
            <p class="text-gray-600 mt-1">Spaces you've saved for later</p>
        </div>
        
        @if (!$wishlist->isEmpty())
        <div class="mt-4 md:mt-0">
            <span class="text-sm text-gray-600">{{ count($wishlist) }} {{ Str::plural('item', count($wishlist)) }}</span>
        </div>
        @endif
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm">
            <div class="flex items-center">
                <svg class="h-5 w-5 mr-2 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif
    
    <!-- Wishlist Items -->
    @if (!$wishlist->isEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($wishlist as $wish)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <!-- Space Image -->
                    <div class="relative h-48 overflow-hidden">
                        @if(isset($wish->space->images) && $wish->space->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $wish->space->images->first()->image_url) }}" 
                                alt="{{ $wish->space->title }}" 
                                class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <svg class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        
                        <!-- Remove Button -->
                        <form action="{{ route('wishlist.remove', $wish->space->id) }}" method="post" class="absolute top-3 right-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-white text-red-500 p-2 rounded-full shadow-md hover:bg-red-500 hover:text-white transition-colors duration-300 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    
                    <!-- Space Info -->
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-900 mb-1 hover:text-blue-600 transition-colors">
                            <a href="{{ route('rooms.details', $wish->space->slug ?? $wish->space->id) }}">
                                {{ $wish->space->title }}
                            </a>
                        </h2>
                        
                        <div class="flex items-center text-sm text-gray-600 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            {{ $wish->space->city ?? 'Location not specified' }}
                        </div>
                        
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                            {{ Str::limit($wish->space->description, 100) }}
                        </p>
                        
                        <div class="flex justify-between items-center">
                            @if(isset($wish->space->hourly_rate))
                                <span class="font-bold text-blue-600">{{ $wish->space->hourly_rate }} JOD/hour</span>
                            @endif
                            <a href="{{ route('rooms.details', $wish->space->slug ?? $wish->space->id) }}" 
                               class="text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-16 px-4 bg-gray-50 rounded-lg border border-gray-200">
            <i class="text-6xl text-gray-400 mb-4 far fa-star"></i>
            
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Your wishlist is empty</h2>
            
            <p class="text-gray-600 text-center mb-6">Save your favorite spaces to revisit them later</p>
            
            <a href="{{ route('explore') }}" 
               class="px-6 py-3 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition-colors">
                Explore Spaces
            </a>
        </div>
    @endif
</div>
@endsection