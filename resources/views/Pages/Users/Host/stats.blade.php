@extends('layouts.Home.layout')
@section('content')
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Host Statistics</h1>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Top Stats Row -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-4 mb-8">
            <!-- Total Credits -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Total Rooms</h3>
                    <div class="mt-2">
                        <div class="text-3xl font-semibold text-gray-900">{{ $hostRooms }}</div>
                    </div>
                </div>
            </div>

            <!-- Total Space Bookings -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Total Spaces Bookings</h3>
                    <div class="mt-2">
                        <div class="text-3xl font-semibold text-gray-900">{{ $totalHostBookings }}</div>
                    </div>
                </div>
            </div>

            <!-- Pending Bookings -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Host Profits</h3>
                    <div class="mt-2">
                        <div class="text-3xl font-semibold text-gray-900">${{ $hostProfits }}</div>
                    </div>
                </div>
            </div>

            <!-- Cancelled Bookings -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Cancelled Bookings</h3>
                    <div class="mt-2">
                        <div class="text-3xl font-semibold text-gray-900">{{ $cancelledBookings }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Middle Row -->
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 mb-8">
            <!-- Most Spaces Booking (Donut Chart) -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Most Spaces Booking</h3>
                    <div class="mt-5 flex justify-center">
                        <div class="w-64 h-64">
                            <canvas id="mostBookedSpacesChart"></canvas>
                        </div>
                    </div>
                    <div class="mt-5 grid grid-cols-3 gap-2">
                        @foreach ($mostBookedSpaces as $index => $space)
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-blue-600 rounded-full mr-3">
                                </div>
                                <div class="text-sm text-gray-700">
                                    {{ $space->title }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Pending Bookings List -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Pending Bookings</h3>
                    <div class="mt-5 flow-root">
                        @if (count($pendingBookingsOnSpces) > 0)
                            <ul class="divide-y divide-gray-200">
                                @foreach ($pendingBookingsOnSpces as $booking)
                                    <li class="py-3">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">
                                                    {{ $booking->first_name }} {{ $booking->last_name }}
                                                </p>
                                                <p class="text-sm text-gray-500 truncate">{{ $booking->start_datetime }} - {{ $booking->end_datetime }}</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="inline-flex items-center">
                                                    <form action="{{ route('booking.confirm', $booking->booking_id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        
                                                        <button class="mr-1 cursor-pointer bg-green-100 text-green-800 px-2.5 py-0.5 rounded-full text-xs font-medium">Approve</button>
                                                    </form>

                                                    <form action="{{ route('booking.cancel', $booking->booking_id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        
                                                        <button class="mr-1 cursor-pointer bg-red-100 text-red-800 px-2.5 py-0.5 rounded-full text-xs font-medium">Reject</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-sm text-gray-500 py-4 text-center">No pending bookings at the moment.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Bookings Table -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Recent Bookings</h3>
                <div class="mt-5 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            Room</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Start</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">End</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @forelse($recentBookings as $booking)
                                        <tr>
                                            <td
                                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                {{ $booking->title }}</td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ \Carbon\Carbon::parse($booking->start_datetime)->format('M d, Y') }}
                                                </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ \Carbon\Carbon::parse($booking->start_datetime)->format('h:i A') }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ \Carbon\Carbon::parse($booking->end_datetime)->format('h:i A') }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm">
                                                @if ($booking->status === 'confirmed') 
                                                <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">Confirmed</span>
                                                @elseif($booking->status === 'pending')
                                                <span class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800">Pending</span>
                                                @elseif($booking->status === 'cancelled')
                                                <span
                                                    class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800">Cancelled</span>
                                                @else
                                                <span
                                                    class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800">Completed</span>
                                                @endif
                                            </td>
                                            @if(Carbon\Carbon::now()->isAfter($booking->end_datetime) && $booking->status === 'confirmed')
                                                <td scope="col"
                                                    class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                    <form action="{{ route('booking.complete', $booking->booking_id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button class="cursor-pointer text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">Mark as Complete</button>
                                                    </form>
                                                </td>
                                            @else
                                                <td scope="col"
                                                    class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                    <button disabled class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">No Actions</button>
                                                </td>
                                            @endif
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="px-3 py-4 text-sm text-gray-500 text-center">No recent
                                                bookings found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="mt-4">
                                {{ $recentBookings->links('pagination::tailwind') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const labels = {!! json_encode($mostBookedSpaces->pluck('title')) !!};
            const data = {!! json_encode($mostBookedSpaces->pluck('bookings_count')) !!};
    
            const spaceCtx = document.getElementById('mostBookedSpacesChart').getContext('2d');
            const spaceChart = new Chart(spaceCtx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: ['#3b82f6', '#2563eb', '#1d4ed8', '#1e40af', '#1e3a8a'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    </script>    
@endsection
