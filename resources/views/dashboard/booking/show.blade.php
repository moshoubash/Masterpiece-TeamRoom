@extends('layouts.dashboard.layout')
@section('title', 'Bookings Data')

@section('content')
    <div class="container">
        <h1>Booking #{{$id}} Details</h1>
        <p>Here you can view the details of the booking.</p>

        <div class="card">
            <table class="table table-bordered">
            <thead>
                <tr>
                <th>Field</th>
                <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>Space ID</td>
                <td>{{ $booking->space_id }}</td>
                </tr>
                <tr>
                <td>Renter ID</td>
                <td>{{ $booking->renter_id }}</td>
                </tr>
                <tr>
                <td>Start Datetime</td>
                <td>{{ $booking->start_datetime }}</td>
                </tr>
                <tr>
                <td>End Datetime</td>
                <td>{{ $booking->end_datetime }}</td>
                </tr>
                <tr>
                <td>Number of Attendees</td>
                <td>{{ $booking->num_attendees ?? 'No Data' }}</td>
                </tr>
                <tr>
                <td>Status</td>
                <td>{{ $booking->status }}</td>
                </tr>
                <tr>
                <td>Total Price</td>
                <td>{{ $booking->total_price }}</td>
                </tr>
                <tr>
                <td>Service Fee</td>
                <td>{{ $booking->service_fee }}</td>
                </tr>
                <tr>
                <td>Host Payout</td>
                <td>{{ $booking->host_payout }}</td>
                </tr>
                <tr>
                <td>Cancellation Reason</td>
                <td>{{ $booking->cancellation_reason ?? 'No Data' }}</td>
                </tr>
                <tr>
                <td>Cancelled By</td>
                <td>{{ $booking->cancelled_by ?? 'No Data'}}</td>
                </tr>
            </tbody>
            </table>
        </div>
    </div>
@endsection