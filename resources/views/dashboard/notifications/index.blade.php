@extends('layouts.dashboard.layout')
@section('title', 'Notifications')
@section('content')
<!-- Page header with breadcrumb -->
<div class="card mb-4">
    <div class="card-body py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 fw-bold">Notifications</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 small">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Notifications</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createNotificationModal">
                    <i class="fa-solid fa-plus me-1"></i> Create Notification
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Alert for success messages -->
@if (session('alert'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-check-circle me-2"></i>
            <div>{{ session('alert') }}</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Search and filters -->
<div class="card mb-4">
    <div class="card-body">
        <form class="row g-3" action="{{ route('notifications.filter') }}">
            <div class="col-lg-4 col-md-6">
                <label for="search" class="form-label">Search</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent"><i class="fa-solid fa-search"></i></span>
                    <input type="text" class="form-control" name="search" id="search" placeholder="Search notifications...">
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" id="type" name="type">
                    <option value="">All Types</option>
                    <option value="alert">Alert</option>
                    <option value="booking">Booking</option>
                    <option value="review">Review</option>
                    <option value="transaction">Transaction</option>
                    <option value="listing">Listing</option>
                    <option value="message">Message</option>
                </select>
            </div>
            <div class="col-lg-3 col-md-6">
                <label for="read-status" class="form-label">Status</label>
                <select name="status" class="form-select" id="read-status">
                    <option value="">All Status</option>
                    <option value="read">Read</option>
                    <option value="unread">Unread</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-6 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fa-solid fa-filter me-1"></i> Filter
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Main notifications table -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">All Notifications</h5>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th width="40">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="selectAll">
                        </div>
                    </th>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Created At</th>
                    <th width="100" class="text-center">Status</th>
                    <th width="100" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="table-body">
                @foreach($notifications as $item)
                    <tr class="{{ $item->is_read == 0 ? 'bg-light' : ''}}">
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $item->id }}">
                            </div>
                        </td>
                        <td><span class="fw-medium">#{{ $item->id }}</span></td>
                        <td>
                            <div class="fw-semibold">{{ $item->title }}</div>
                        </td>
                        <td>
                            @switch($item->notification_type)
                                @case('alert')
                                    <span class="badge bg-danger">Alert</span>
                                    @break
                                @case('booking')
                                    <span class="badge bg-primary">Booking</span>
                                    @break
                                @case('review')
                                    <span class="badge bg-success">Review</span>
                                    @break
                                @case('transaction')
                                    <span class="badge bg-info">Transaction</span>
                                    @break
                                @case('listing')
                                    <span class="badge bg-warning">Listing</span>
                                    @break
                                @case('message')
                                    <span class="badge bg-secondary">Message</span>
                                    @break
                                @default
                                    <span class="badge bg-dark">{{ $item->notification_type }}</span>
                            @endswitch
                        </td>
                        <td>
                            <div>{{ (new DateTime($item->created_at))->format('Y-m-d') }}</div>
                            <small class="text-muted">{{ (new DateTime($item->created_at))->format('H:i:s') }}</small>
                        </td>
                        <td class="text-center">
                            @if($item->is_read == 0)
                                <span class="badge bg-danger-subtle text-danger">Unread</span>
                            @else
                                <span class="badge bg-success-subtle text-success">Read</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                @if($item->is_read == 0)
                                    <form action="/dashboard/notifications/{{$item->id}}/markAsRead" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-outline-success" data-bs-toggle="tooltip" title="Mark as Read">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="/dashboard/notifications/{{$item->id}}/markAsRead" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-outline-warning" data-bs-toggle="tooltip" title="Mark as Unread">
                                            <i class="fa-solid fa-eye-slash"></i>
                                        </button>
                                    </form>
                                @endif
                                <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#viewModal{{ $item->id }}" title="View Details">
                                    <i class="fa-solid fa-info-circle"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}" title="Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>

                            <!-- View Modal -->
                            <div class="modal fade" id="viewModal{{ $item->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewModalLabel{{ $item->id }}">Notification Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Title</label>
                                                <p>{{ $item->title }}</p>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Type</label>
                                                <p>{{ $item->notification_type }}</p>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Message</label>
                                                <p>{{ $item->message }}</p>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Created At</label>
                                                <p>{{ (new DateTime($item->created_at))->format('Y-m-d H:i:s') }}</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center mb-3">
                                                <i class="fa-solid fa-triangle-exclamation text-danger fs-1"></i>
                                            </div>
                                            <p class="text-center mb-0">Are you sure you want to delete this notification?</p>
                                            <p class="text-center text-muted small">This action cannot be undone.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('notifications.destroy', $item->id) }}') }}" method="post">
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
                
                @if(count($notifications) == 0)
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <div class="text-muted mb-2">
                                <i class="fa-solid fa-bell-slash fs-3"></i>
                            </div>
                            <h6>No notifications found</h6>
                            <p class="text-muted mb-0">You currently have no notifications.</p>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted small">
                Showing <span class="fw-medium">{{ $notifications->firstItem() ?? 0 }}</span> to 
                <span class="fw-medium">{{ $notifications->lastItem() ?? 0 }}</span> of 
                <span class="fw-medium">{{ $notifications->total() }}</span> entries
            </div>
            <div>
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Create Notification Modal -->
<div class="modal fade" id="createNotificationModal" tabindex="-1" aria-labelledby="createNotificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="createNotificationModalLabel">Create New Notification</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('notifications.store') }}">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter notification title" required>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select name="notification_type" id="type" class="form-select" required>
                            <option value="" selected disabled>Select notification type</option>
                            <option value="alert">Alert</option>
                            <option value="booking">Booking</option>
                            <option value="review">Review</option>
                            <option value="transaction">Transaction</option>
                            <option value="listing">Listing</option>
                            <option value="message">Send Message</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea name="message" id="message" class="form-control" rows="4" placeholder="Enter notification message" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="user_id" class="form-label">Recipient</label>
                        <select name="user_id" id="user_id" class="form-select" required>
                            <option value="" selected disabled>Select user</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->email }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-paper-plane me-1"></i> Send Notification
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Select all checkbox functionality
        document.getElementById('selectAll').addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    });
</script>
@endpush
@endsection