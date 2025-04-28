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
                    <a href="/dashboard/activities" class="btn btn-primary">
                        <i class="align-middle" data-feather="refresh-cw"></i> 
                        <span class="ms-1 d-none d-sm-inline">Refresh</span>
                    </a>
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
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="align-middle" data-feather="filter"></i> Filter
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                    <li><a class="dropdown-item" href="/dashboard/activities">All Types</a></li>
                                    <li><a class="dropdown-item" href="/dashboard/activities/user">User</a></li>
                                    <li><a class="dropdown-item" href="/dashboard/activities/system">System</a></li>
                                    <li><a class="dropdown-item" href="/dashboard/activities/admin">Admin</a></li>
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