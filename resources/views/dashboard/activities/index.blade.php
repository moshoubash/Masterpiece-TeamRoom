@extends('layouts.dashboard.layout')
@section('title', 'Activities')
@section('content')
<div class="container-fluid p-0">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0"><strong>Activities</strong></h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Activities</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <button class="btn btn-primary">
                        <i class="align-middle" data-feather="refresh-cw"></i> 
                        <span class="ms-1 d-none d-sm-inline">Refresh</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 avatar-lg rounded bg-primary bg-opacity-10 p-3 text-center">
                            <i class="align-middle text-primary" data-feather="activity" style="width: 30px; height: 30px;"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h4 class="mb-0">{{ $activities->count() }}</h4>
                            <p class="text-muted mb-0">Total Activities</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 avatar-lg rounded bg-success bg-opacity-10 p-3 text-center">
                            <i class="align-middle text-success" data-feather="user" style="width: 30px; height: 30px;"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h4 class="mb-0">{{ $activities->where('type', 'user')->count() }}</h4>
                            <p class="text-muted mb-0">User Activities</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 avatar-lg rounded bg-warning bg-opacity-10 p-3 text-center">
                            <i class="align-middle text-warning" data-feather="clock" style="width: 30px; height: 30px;"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h4 class="mb-0">{{ $activities->where('created_at', '>=', now()->subDay())->count() }}</h4>
                            <p class="text-muted mb-0">Last 24 Hours</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 avatar-lg rounded bg-info bg-opacity-10 p-3 text-center">
                            <i class="align-middle text-info" data-feather="alert-circle" style="width: 30px; height: 30px;"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h4 class="mb-0">{{ $activities->where('type', 'system')->count() }}</h4>
                            <p class="text-muted mb-0">System Events</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Activities Table Card -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">All Activities</h5>
                        <div class="d-flex gap-2">
                            <div class="input-group input-group-sm" style="width: 200px;">
                                <input type="text" class="form-control" placeholder="Search activities...">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="align-middle" data-feather="search"></i>
                                </button>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="align-middle" data-feather="filter"></i> Filter
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                    <li><a class="dropdown-item" href="#">All Types</a></li>
                                    <li><a class="dropdown-item" href="#">User</a></li>
                                    <li><a class="dropdown-item" href="#">System</a></li>
                                    <li><a class="dropdown-item" href="#">Admin</a></li>
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
                                    <th class="border-top-0">User ID</th>
                                    <th class="border-top-0">Type</th>
                                    <th class="border-top-0">Name</th>
                                    <th class="border-top-0 w-25">Description</th>
                                    <th class="border-top-0">Created At</th>
                                    <th class="border-top-0 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach ($activities->sortByDesc('created_at') as $item)
                                    <tr>
                                        <td><span class="badge bg-secondary">#{{ $item->id }}</span></td>
                                        <td>
                                            @if($item->user_id)
                                                <div class="d-flex align-items-center">
                                                    {{ $item->user_id }}
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $typeClass = [
                                                    'user' => 'success',
                                                    'system' => 'info',
                                                    'admin' => 'warning',
                                                    'error' => 'danger'
                                                ][$item->type] ?? 'secondary';
                                            @endphp
                                            <span class="badge bg-{{ $typeClass }}-subtle text-{{ $typeClass }}">{{ $item->type }}</span>
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 300px;" title="{{ $item->description }}">
                                                {{ $item->description }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="align-middle me-2 text-muted" data-feather="clock" style="width: 14px; height: 14px;"></i>
                                                <span title="{{ (new DateTime($item->created_at))->format('Y-m-d H:i:s') }}">
                                                    {{ (new DateTime($item->created_at))->format('Y-m-d H:i:s') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="align-middle" data-feather="more-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                                    <li><a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="eye"></i> View Details</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="archive"></i> Archive</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item text-danger" href="#"><i class="align-middle me-1" data-feather="trash-2"></i> Delete</a></li>
                                                </ul>
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
                            Showing <strong>{{ $activities->firstItem() ?? 0 }}</strong> to <strong>{{ $activities->lastItem() ?? 0 }}</strong> of <strong>{{ $activities->total() }}</strong> entries
                        </div>
                        <div>
                            {{ $activities->links('pagination::bootstrap-5') }}
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
        // Initialize Feather icons
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
        
        // Add any custom JavaScript functionality here
        const searchInput = document.querySelector('input[placeholder="Search activities..."]');
        if (searchInput) {
            searchInput.addEventListener('keyup', function(e) {
                // Implement search functionality if needed
                console.log('Searching for:', this.value);
            });
        }
    });
</script>
@endpush