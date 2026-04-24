@extends('layouts.home.layout')

@section('content')
    <div class="bg-gray-50 min-h-screen py-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Notifications</h1>
                    <p class="text-gray-600 mt-1">Stay updated with your latest activities and messages.</p>
                </div>

                @if($notifications->where('is_read', false)->count() > 0)
                    <form action="{{ route('notifications.markAllAsRead', Auth::user()->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-sm">
                            <i class="fa-solid fa-check-double mr-2"></i>
                            Mark All as Read
                        </button>
                    </form>
                @endif
            </div>

            <!-- Notifications List -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                @if($notifications->count() > 0)
                    <div class="divide-y divide-gray-100">
                        @foreach($notifications as $notification)
                            <div
                                class="p-6 transition-colors duration-200 {{ $notification->is_read ? 'bg-white' : 'bg-blue-50/40' }} hover:bg-gray-50">
                                <div class="flex items-start gap-4">
                                    <!-- Icon Circle -->
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-12 h-12 rounded-full flex items-center justify-center {{ $notification->is_read ? 'bg-gray-100 text-gray-500' : 'bg-blue-100 text-blue-600' }}">
                                            @if($notification->notification_type == 'booking')
                                                <i class="fa-solid fa-calendar-check text-lg"></i>
                                            @elseif($notification->notification_type == 'message')
                                                <i class="fa-solid fa-comment-dots text-lg"></i>
                                            @else
                                                <i class="fa-solid fa-bell text-lg"></i>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between">
                                            <h3
                                                class="text-lg font-semibold text-gray-900 {{ $notification->is_read ? 'font-medium' : 'font-bold' }}">
                                                {{ $notification->title }}
                                            </h3>
                                            <span class="text-sm text-gray-500 whitespace-nowrap ml-4">
                                                {{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
                                            </span>
                                        </div>
                                        <p class="mt-1 text-gray-600 leading-relaxed">
                                            {{ $notification->message }}
                                        </p>

                                        @if(!$notification->is_read)
                                            <div class="mt-4 flex items-center gap-3">
                                                <form action="{{ route('notifications.markRead', $notification->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="text-sm font-semibold text-blue-600 hover:text-blue-800 flex items-center transition-colors">
                                                        <i class="fa-solid fa-check mr-1.5"></i>
                                                        Mark as read
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Status Dot -->
                                    @if(!$notification->is_read)
                                        <div class="flex-shrink-0 self-center">
                                            <div class="w-3 h-3 bg-blue-500 rounded-full ring-4 ring-blue-100 animate-pulse"></div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($notifications->hasPages())
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                            {{ $notifications->links('pagination::tailwind') }}
                        </div>
                    @endif
                @else
                    <div class="flex flex-col items-center justify-center py-20 px-4">
                        <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                            <i class="fa-solid fa-bell-slash text-4xl text-gray-300"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">No notifications yet</h3>
                        <p class="text-gray-500 mt-1 text-center max-w-xs">
                            When you receive updates about your bookings or account, they'll appear here.
                        </p>
                        <a href="{{ route('explore') }}"
                            class="mt-6 inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-all shadow-md hover:shadow-lg">
                            Explore Spaces
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection