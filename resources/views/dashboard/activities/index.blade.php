@extends('layouts.dashboard.layout')
@section('title', 'Activities')
@section('content')
<div class="container-fluid p-0">
    <!-- Page Header -->
    <div class="card mb-4">
        <div class="card-body py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 fw-bold">Activities</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 small">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Activities</li>
                        </ol>
                    </nav>
                </div>
                
                <div>
                    <button class="btn btn-primary">
                        <i class="align-middle" data-feather="refresh-cw"></i> 
                        <a href="/dashboard/activities" class="ms-1 d-none d-sm-inline text-white">Refresh</a>
                    </button>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show align-items-center" role="alert">
            <p>{{ session('success') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}"><i class="fa-solid fa-trash"></i></button>
                                        </td>
                                        {{-- delete modal --}}
                                        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Delete Activity</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this activity?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <form action="/dashboard/activities/{{ $item->id }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
        
        const searchInput = document.querySelector('input[placeholder="Search activities..."]');
        if (searchInput) {
            searchInput.addEventListener('keyup', function(e) {
                console.log('Searching for:', this.value);
            });
        }
    });
</script>
@endpush