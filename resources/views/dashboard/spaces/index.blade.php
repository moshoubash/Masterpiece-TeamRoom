@extends('layouts.dashboard.layout')
@section('title', 'Manage Spaces')
@section('content')
    <!-- Page Header -->
    <div class="card mb-4">
        <div class="card-body py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 fw-bold">Spaces</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 small">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Spaces</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <button class="btn btn-primary">
                        <i class="align-middle" data-feather="refresh-cw"></i> 
                        <a href="/dashboard/spaces" class="ms-1 d-none d-sm-inline text-white">Refresh</a>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">All Listings</h5>
                        <div class="input-group" style="width: 250px;">
                            <form action="{{ route('spaces.search') }}" method="GET" class="d-flex">
                                <input type="text" name="search" class="form-control" placeholder="Search spaces...">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fa-solid fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" width="60">ID</th>
                                    <th width="80">Image</th>
                                    <th width="200">Title</th>
                                    <th class="text-center" width="80">Capacity</th>
                                    <th class="text-end" width="100">Hourly Rate</th>
                                    <th class="text-center" width="120">Min Duration</th>
                                    <th class="text-center" width="80">Status</th>
                                    <th class="text-center" width="100">Created</th>
                                    <th class="text-center" width="140">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach ($spaces->sortByDesc('created_at') as $space)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $space->id }}</td>
                                        <td>
                                            @if (!$space->images->isEmpty())
                                                <img src="{{ asset('storage/' . $space->images->first()->image_url ?? '') }}" alt="{{$space->title}}" class="img-fluid rounded">
                                            @else
                                                <img src="https://www.svgrepo.com/show/508699/landscape-placeholder.svg" alt="Default Space Image" class="img-fluid rounded">
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>{{ $space->title }}</div>
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $space->capacity }}</td>
                                        <td class="text-end fw-medium">${{ number_format($space->hourly_rate, 2) }}</td>
                                        <td class="text-center">{{ $space->min_booking_duration }} hrs</td>
                                        <td class="text-center">
                                            @if($space->is_deleted)
                                                <span class="badge bg-danger">Deleted</span>
                                            @elseif($space->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ (new DateTime($space->created_at))->format('Y-m-d') }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="/dashboard/spaces/{{ $space->id }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="View Details">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a href="/dashboard/spaces/{{ $space->id }}/edit" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit Space">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $space->id }}" data-bs-toggle="tooltip" title="Delete Space">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $space->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title">Delete Space</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-center mb-3">
                                                                <i class="fa-solid fa-triangle-exclamation text-danger fa-3x mb-3"></i>
                                                                <h5>Are you sure you want to delete this space?</h5>
                                                                <p class="text-muted mb-0">Space: <strong>{{ $space->title }}</strong></p>
                                                                <p class="text-muted">This action cannot be undone.</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-center">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                <i class="fa-solid fa-times me-1"></i> Cancel
                                                            </button>
                                                            <form action="/dashboard/spaces/{{ $space->id }}" method="post">
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
                            <p class="text-muted mb-0">Showing <span class="fw-medium">{{ $spaces->count() }}</span> entries</p>
                        </div>
                        <div>
                            {{ $spaces->links() }}
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