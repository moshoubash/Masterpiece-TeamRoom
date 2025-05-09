@extends('layouts.dashboard.layout')
@section('title', 'Manage Bookings')
@section('content')
    
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0"><strong>Manage</strong> Bookings</h1>
        </div>
    </div>
</div>

    <!--Alert if there is a message-->
    @if (session('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <div class="d-flex">
                <div class="me-2">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div>
                    {{ session('message') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">All Bookings</h5>
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-filter me-1"></i> Filter
                                            </button>
                                            <ul class="dropdown-menu" name="status">
                                                <li><a class="dropdown-item" href="/bookings/status/confirmed">Confirmed</a></li>
                                                <li><a class="dropdown-item" href="/bookings/status/pending">Pending</a></li>
                                                <li><a class="dropdown-item" href="/bookings/status/cancelled">Cancelled</a></li>
                                                <li><a class="dropdown-item" href="/bookings/status/completed">Completed</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="70">ID</th>
                                    <th width="80">Space</th>
                                    <th width="80">Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th class="text-center" width="50">Guests</th>
                                    <th class="text-center" width="100">Status</th>
                                    <th class="text-end" width="100">Total</th>
                                    <th class="text-end" width="100">Fee</th>
                                    <th class="text-end" width="100">Payout</th>
                                    <th width="90">Created</th>
                                    <th class="text-center" width="140">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach ($bookings->sortByDesc('created_at') as $booking)
                                    <tr>
                                        <td class="fw-medium">{{ $booking->id }}</td>
                                        <td>
                                            <a href="/dashboard/spaces/{{ $booking->space_id }}" class="text-decoration-none" data-bs-toggle="tooltip" title="View Space">
                                                #{{ $booking->space_id }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($booking->start_datetime)->format('Y/m/d') }}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="me-2 text-primary">
                                                    <i class="fa-regular fa-calendar-check"></i>
                                                </span>
                                                <span class="badge bg-light text-dark ms-2">
                                                    {{ (new DateTime($booking->start_datetime))->format('H:i') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="me-2 text-danger">
                                                    <i class="fa-regular fa-calendar-xmark"></i>
                                                </span>
                                                <span class="badge bg-light text-dark ms-2">
                                                    {{ (new DateTime($booking->end_datetime))->format('H:i') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-light text-dark">
                                                <i class="fa-solid fa-users me-1"></i> {{ $booking->num_attendees ?? 0 }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $statusClass = [
                                                    'confirmed' => 'bg-success',
                                                    'pending' => 'bg-warning text-dark',
                                                    'cancelled' => 'bg-danger',
                                                    'completed' => 'bg-info',
                                                ][$booking->status] ?? 'bg-secondary';
                                            @endphp
                                            <span class="badge {{ $statusClass }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                        <td class="text-end fw-bold">${{ number_format($booking->total_price, 2) }}</td>
                                        <td class="text-end text-muted">${{ number_format($booking->service_fee, 2) }}</td>
                                        <td class="text-end text-success">${{ number_format($booking->host_payout, 2) }}</td>
                                        <td>{{ (new DateTime($booking->created_at))->format('M d, Y') }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="/dashboard/bookings/{{ $booking->id }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="View Details">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a href="/dashboard/bookings/{{ $booking->id }}/edit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit Booking">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $booking->id }}" title="Delete Booking">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $booking->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title">Delete Booking</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-center mb-3">
                                                                <i class="fa-solid fa-triangle-exclamation text-danger fa-3x mb-3"></i>
                                                                <h5>Are you sure you want to delete this booking?</h5>
                                                                <p class="text-muted">Booking ID: <strong>#{{ $booking->id }}</strong></p>
                                                                <p class="text-muted">This action cannot be undone and may affect related records.</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-center">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                <i class="fa-solid fa-times me-1"></i> Cancel
                                                            </button>
                                                            <form action="/dashboard/bookings/{{ $booking->id }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">
                                                                    <i class="fa-solid fa-trash me-1"></i> Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-0">Showing <span class="fw-medium">{{ $bookings->count() }}</span> of <span class="fw-medium">{{ $bookings->total() }}</span> bookings</p>
                        </div>
                        <div>
                            {{ $bookings->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Initialize tooltips -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
@endsection