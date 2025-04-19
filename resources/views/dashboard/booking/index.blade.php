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

                <!--Alert if there is an message-->
                @if (session('message'))
                    <div class="alert alert-warning">
                        {{ session('message') }}
                    </div>
                @endif

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
                        @foreach ($bookings->sortByDesc('created_at') as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->renter_id }}</td>
                                <td>{{ (new DateTime($booking->start_datetime))->format('Y-m-d H:i:s') }}</td>
                                <td class="d-none d-md-table-cell">
                                    {{ (new DateTime($booking->end_datetime))->format('Y-m-d H:i:s') }}</td>
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

                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $booking->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                    <!--Modal-->
                                    <div class="modal fade" id="deleteModal{{ $booking->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="deleteModalLabel">Delete
                                                        Booking</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this booking?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <form action="/dashboard/bookings/{{ $booking->id }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="/dashboard/bookings/{{ $booking->id }}" class="btn btn-dark">
                                        <i class="fa-solid fa-info-circle"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3 ms-3">
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
