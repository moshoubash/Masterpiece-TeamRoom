@extends('layouts.dashboard.layout')
@section('title', 'User Data')

@section('content')
<div class="container">
    <h1>{{ ucfirst($user->roles->first()->name) }} Data</h1>
    <p>Here you can view the details of the user.</p>

    {{-- Renter View --}}
    @if ($user->roles->first()->name == 'renter')
        <h3 class="mt-4">Bookings</h3>
        @if ($user->bookings && $user->bookings->count())
            <ul>
                @foreach ($user->bookings as $booking)
                    <li>Booking ID: {{ $booking->id }} | Space: {{ $booking->space->name ?? 'N/A' }} | Date: {{ $booking->created_at->format('Y-m-d') }}</li>
                @endforeach
            </ul>
        @else
            <p>No bookings found.</p>
        @endif

        <h3 class="mt-4">Reviews</h3>
        @if ($user->reviews && $user->reviews->count())
            <ul>
                @foreach ($user->reviews as $review)
                    <li>Rating: {{ $review->rating }} - "{{ $review->comment }}"</li>
                @endforeach
            </ul>
        @else
            <p>No reviews found.</p>
        @endif
    @endif

    {{-- Host View --}}
    @if ($user->roles()->first()->name == 'host')
        <h3 class="mt-4">Spaces</h3>
        @if ($user->spaces && $user->spaces->count())
            <ul type="square">
                @foreach ($user->spaces as $space)
                    <li>{{ $space->title }} - {{ $space->city }}</li>
                @endforeach
            </ul>
        @else
            <p>No spaces found.</p>
        @endif
    @endif

    {{-- User Info Table --}}
    <h3 class="mt-4">User Information</h3>
    <table class="table table-bordered">
        <tr>
            <th>User ID</th>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{!! $user->phone_number ?? '<span class="badge bg-danger">No phone number</span>' !!}</td>
        </tr>
        <tr>
            <th>Bio</th>
            <td>{!! $user->bio ?? '<span class="badge bg-danger">No bio</span>' !!}</td>
        </tr>
        <tr>
            <th>Roles</th>
            <td>
                <span class="badge bg-primary">{{ $user->roles->first()->name }}</span>
            </td>
        </tr>
    </table>
</div>
@endsection
