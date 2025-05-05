@extends('layouts.dashboard.layout')
@section('title', 'Reviews')
@section('content')
<div class="container-fluid p-0">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0"><strong>Reviews</strong></h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Reviews</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="/dashboard/reviews" class="btn btn-primary">
                        <i class="align-middle" data-feather="refresh-cw"></i> 
                        <span class="ms-1 d-none d-sm-inline">Refresh</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Table Card -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">All Reviews</h5>
                        <div class="d-flex gap-2">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="align-middle" data-feather="filter"></i> Filter
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                    <li><a class="dropdown-item" href="/dashboard/reviews">All Ratings</a></li>
                                    <li><a class="dropdown-item" href="/dashboard/reviews/5">5 Stars</a></li>
                                    <li><a class="dropdown-item" href="/dashboard/reviews/4">4 Stars</a></li>
                                    <li><a class="dropdown-item" href="/dashboard/reviews/3">3 Stars</a></li>
                                    <li><a class="dropdown-item" href="/dashboard/reviews/2">2 Stars</a></li>
                                    <li><a class="dropdown-item" href="/dashboard/reviews/1">1 Star</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-top-0">ID</th>
                                    <th class="border-top-0">Booking ID</th>
                                    <th class="border-top-0">Reviewer ID</th>
                                    <th class="border-top-0">Reviewee ID</th>
                                    <th class="border-top-0">Space ID</th>
                                    <th class="border-top-0">Rating</th>
                                    <th class="border-top-0 w-25">Review Text</th>
                                    <th class="border-top-0">Created At</th>
                                    <th class="border-top-0 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach ($reviews->sortByDesc('created_at') as $review)
                                    <tr>
                                        <td><span class="badge bg-secondary">#{{ $review->id }}</span></td>
                                        <td>
                                            <a href="/dashboard/bookings/{{ $review->booking_id }}" class="text-decoration-none">
                                                {{ $review->booking_id ?? 0 }}
                                            </a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                {{ $review->reviewer_id ?? 0 }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                {{ $review->reviewee_id ?? 0 }}
                                            </div>
                                        </td>
                                        <td>
                                            <a href="/dashboard/spaces/{{ $review->space_id }}" class="text-decoration-none text-primary">
                                                {{ $review->space_id ?? 0 }}
                                            </a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @php
                                                    $rating = $review->rating ?? 0;
                                                    $ratingColor = match(true) {
                                                        $rating >= 4 => 'success',
                                                        $rating >= 3 => 'warning',
                                                        default => 'danger'
                                                    };
                                                @endphp
                                                <span class="badge bg-{{ $ratingColor }}-subtle text-{{ $ratingColor }} me-2">{{ $rating }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 200px;" title="{{ $review->review_text ?? 'No Data' }}">
                                                {{ $review->review_text ?? 'No Data' }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="align-middle me-2 text-muted" data-feather="clock" style="width: 14px; height: 14px;"></i>
                                                <span title="{{ (new DateTime($review->created_at))->format('Y-m-d H:i:s') }}">
                                                    {{ (new DateTime($review->created_at))->format('Y-m-d H:i:s') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <button type="button" class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#viewReviewModal{{ $review->id }}">
                                                    <i class="align-middle" data-feather="eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteReviewModal{{ $review->id }}">
                                                    <i class="align-middle" data-feather="trash-2"></i>
                                                </button>
                                            </div>

                                            <!-- View Modal -->
                                            <div class="modal fade" id="viewReviewModal{{ $review->id }}" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="viewModalLabel">Review Details</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-center mb-4">
                                                                <div class="rating-stars d-flex justify-content-center mb-2">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($i <= ($review->rating ?? 0))
                                                                            <i class="text-warning" data-feather="star" style="width: 24px; height: 24px;"></i>
                                                                        @else
                                                                            <i class="text-muted" data-feather="star" style="width: 24px; height: 24px;"></i>
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                                <h4 class="mb-0">{{ $review->rating ?? 0 }}/5</h4>
                                                            </div>
                                                            <div class="mb-3">
                                                                <h6 class="fw-bold">Review:</h6>
                                                                <p class="mb-3">{{ $review->review_text ?? 'No review text available.' }}</p>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <h6 class="fw-bold">Reviewer:</h6>
                                                                    <p>ID: {{ $review->reviewer_id ?? 0 }}</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <h6 class="fw-bold">Reviewee:</h6>
                                                                    <p>ID: {{ $review->reviewee_id ?? 0 }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <h6 class="fw-bold">Booking:</h6>
                                                                    <p>ID: {{ $review->booking_id ?? 0 }}</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <h6 class="fw-bold">Space:</h6>
                                                                    <p>ID: {{ $review->space_id ?? 0 }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <h6 class="fw-bold">Date:</h6>
                                                                    <p>{{ (new DateTime($review->created_at))->format('F j, Y, g:i a') }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteReviewModal{{ $review->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title" id="deleteModalLabel">Delete Review</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-center mb-3">
                                                                <i data-feather="alert-triangle" class="text-danger" style="width: 50px; height: 50px;"></i>
                                                            </div>
                                                            <p class="text-center fs-5">Are you sure you want to delete this review?</p>
                                                            <p class="text-center text-muted">This action cannot be undone.</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <form action="/dashboard/reviews/{{ $review->id }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Delete</button>
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
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            Showing <strong>{{ $reviews->firstItem() ?? 0 }}</strong> to <strong>{{ $reviews->lastItem() ?? 0 }}</strong> of <strong>{{ $reviews->total() }}</strong> entries
                        </div>
                        <div>
                            {{ $reviews->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
        
        const searchInput = document.querySelector('input[placeholder="Search reviews..."]');
        if (searchInput) {
            searchInput.addEventListener('keyup', function(e) {
                console.log('Searching for:', this.value);
            });
        }
    });
</script>
@endpush