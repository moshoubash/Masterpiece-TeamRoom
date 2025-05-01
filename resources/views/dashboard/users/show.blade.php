@extends('layouts.dashboard.layout')
@section('title', 'User Data')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="bg-white shadow-sm rounded-lg p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 text-gray-800">{{ ucfirst($user->roles->first()->name) }} Profile</h1>
                <p class="text-muted mb-0">Viewing detailed information for this account</p>
            </div>
            <div>
                <span class="badge bg-primary fs-6 px-3 py-2">{{ ucfirst($user->roles->first()->name) }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- User Info Card -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0">User Information</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="avatar-placeholder rounded-circle bg-primary bg-opacity-25 text-primary mx-auto mb-3" style="width: 100px; height: 100px; line-height: 100px; font-size: 40px;">
                            {{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}
                        </div>
                        <h4>{{ $user->first_name }} {{ $user->last_name }}</h4>
                        <p class="text-muted mb-0">Member since {{ $user->created_at->format('M Y') }}</p>
                    </div>
                    
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">ID</span>
                            <span class="fw-medium">{{ $user->id }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">Email</span>
                            <span class="fw-medium">{{ $user->email }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span class="text-muted">Phone</span>
                            <span>
                                @if($user->phone_number)
                                    {{ $user->phone_number }}
                                @else
                                    <span class="badge bg-light text-dark">Not provided</span>
                                @endif
                            </span>
                        </li>
                    </ul>
                </div>
                <div class="card-footer bg-white">
                    <h6 class="text-muted mb-2">Bio</h6>
                    @if($user->bio)
                        <p class="mb-0">{{ $user->bio }}</p>
                    @else
                        <p class="text-muted mb-0 fst-italic">No bio provided</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="col-lg-8">
            @if ($user->roles->first()->name == 'renter')
                <!-- Renter Data -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Bookings</h5>
                        <span class="badge bg-info rounded-pill">{{ $user->bookingsAsRenter->count() ?? 0 }}</span>
                    </div>
                    <div class="card-body">
                        @if ($user->bookingsAsRenter && $user->bookingsAsRenter->count())
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Space</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user->bookingsAsRenter as $booking)
                                            <tr>
                                                <td>{{ $booking->id }}</td>
                                                <td>{{ $booking->space->title ?? 'N/A' }}</td>
                                                <td>{{ $booking->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    <span class="badge bg-success">Confirmed</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-light text-center py-4">
                                <i class="fas fa-calendar-times mb-3" style="font-size: 2rem;"></i>
                                <p class="mb-0">No bookings found for this user.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Reviews Section -->
                <div class="card shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Reviews</h5>
                        <span class="badge bg-info rounded-pill">{{ $user->reviewsAsReviewee->count() ?? 0 }}</span>
                    </div>
                    <div class="card-body">
                        @if ($user->reviewsAsReviewee && $user->reviewsAsReviewee->count())
                            @foreach ($user->reviewsAsReviewee as $review)
                                <div class="mb-3 pb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div>
                                            <h6 class="mb-0">On Room {{ $review->space->title }}</h6>
                                            <div class="rating-stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                            </div>
                                            <span class="text-muted small">{{ $review->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                    <p class="mb-0">{{ $review->review_text }}</p>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-light text-center py-4">
                                <i class="fas fa-star mb-3" style="font-size: 2rem;"></i>
                                <p class="mb-0">No reviews submitted by this user.</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            @if ($user->roles()->first()->name == 'host')
                <!-- Host Spaces -->
                <div class="card shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Spaces</h5>
                        <span class="badge bg-info rounded-pill">{{ $user->spaces->count() ?? 0 }}</span>
                    </div>
                    <div class="card-body">
                        @if ($user->spaces && $user->spaces->count())
                            <div class="row">
                                @foreach ($user->spaces as $space)
                                    <div class="col-md-6 mb-3">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $space->title }}</h6>
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                                    <span>{{ $space->city }}</span>
                                                </div>
                                                @if(isset($space->description))
                                                    <p class="card-text small text-muted">{{ Str::limit($space->description, 100) }}</p>
                                                @endif
                                            </div>
                                            <div class="card-footer bg-white">
                                                <a href="/dashboard/spaces/{{ $space->id }}" class="btn btn-sm btn-outline-primary">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-light text-center py-4">
                                <i class="fas fa-building mb-3" style="font-size: 2rem;"></i>
                                <p class="mb-0">No spaces listed by this host.</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection