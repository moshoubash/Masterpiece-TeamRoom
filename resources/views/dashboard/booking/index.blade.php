@extends('layouts.dashboard.layout')
@section('title', 'Manage Bookings')
@section('content')
    <h1 class="h3 mb-3"><strong>Manage</strong> Bookings</h1>

    <div class="row">
        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Bookings</h5>
                </div>
                <table class="table table-hover my-0 table-striped">
                    <thead>
                        <tr>
                            <th>Space Id</th>
                            <th>Renter Id</th>
                            <th>Start Datetime</th>
                            <th class="d-none d-md-table-cell">End Datetime</th>
                            <th class="d-none d-md-table-cell">Number of Attendees</th>
                            <th>Status</th>
                            <th>Total Price</th>
                            <th class="d-none d-md-table-cell">Service Fee</th>
                            <th class="d-none d-md-table-cell">Host Payout</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @foreach ($bookings as $booking)
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->renter_id }}</td>
                            <td>{{ (new DateTime($booking->start_datetime))->format('Y-m-d H:i:s') }}</td>
                            <td class="d-none d-md-table-cell">{{ (new DateTime($booking->end_datetime))->format('Y-m-d H:i:s') }}</td>
                            <td class="d-none d-md-table-cell">{{ $booking->num_attendees ?? 0 }}</td>
                            <td>{{ $booking->status }}</td>
                            <td>${{ $booking->total_price }}</td>
                            <td class="d-none d-md-table-cell">${{ $booking->service_fee }}</td>
                            <td class="d-none d-md-table-cell">${{ $booking->host_payout }}</td>
                            <td>{{ $booking->created_at || 'N/A' }}</td>
                            <td>
                                <a href="/dashboard/bookings/{{ $booking->id }}/edit" class="btn btn-primary">
                                    <i class="fa-solid fa-edit"></i>
                                </a>

                                <form action="/dashboard/bookings/{{ $booking->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>

                                <a href="/dashboard/bookings/{{ $booking->id }}" class="btn btn-dark">
                                    <i class="fa-solid fa-info-circle"></i>
                                </a>
                            </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
