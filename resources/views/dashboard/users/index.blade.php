@extends('layouts.dashboard.layout')
@section('title', 'Users Management')
@section('content')
    <!-- Page Header -->
    <div class="card mb-4">
        <div class="card-body py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 fw-bold">Users Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 small">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Users</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <div class="input-group" style="width: 250px;">
                        <form action="{{route('users.search')}}" method="GET" class="d-flex">
                            <input type="text" class="form-control" name="query" placeholder="Search users...">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="fa-solid fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @session('success')
        <div class="alert alert-success" role="alert"> 
            {{ $value }}
        </div>
    @endsession

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">All Users</h5>
                        <div>
                            <div class="btn-group ms-2">
                                <a class="btn btn-sm btn-danger me-1 text-white" href="/dashboard/users/deleted"> 
                                    <i class="fa-solid fa-user-minus me-1"></i> 
                                    Deleted Users
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-filter me-1"></i> Filter
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="/dashboard/users">All Users</a></li>
                                    <li><a class="dropdown-item" href="/dashboard/users/verified">Verified Users</a></li>
                                    <li><a class="dropdown-item" href="/dashboard/users/unverified">Unverified Users</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="/dashboard/users/recent">Recently Added</a></li>
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
                                    <th width="60">ID</th>
                                    <th width="70">Avatar</th>
                                    <th width="200">User</th>
                                    <th class="text-center" width="100">Role</th>
                                    <th class="text-center">Email Status</th>
                                    <th>Registered</th>
                                    <th width="100">Is Deleted</th>
                                    <th class="text-center" width="140">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="fw-medium">{{ $user->id }}</td>
                                        <td>
                                            <div class="avatar avatar-md">
                                                <img class="avatar-img rounded-circle" 
                                                    src="{{ $user->profile_picture_url ?? 'http://www.placehold.co/300x300' }}"
                                                    alt="{{ $user->first_name }}" width="40" height="40">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="fw-medium">{{ $user->first_name }} {{ $user->last_name }}</span>
                                                <small class="text-muted">{{ $user->email }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column align-items-center">
                                                @if ($user->roles->first()->name == 'admin')
                                                    <span class="badge bg-danger">Admin</span>
                                                @elseif ($user->roles->first()->name == 'superadmin')
                                                    <span class="badge bg-primary">Super Admin</span>
                                                @elseif ($user->roles->first()->name == 'host')
                                                    <span class="badge bg-info">Host</span>
                                                @elseif($user->roles->first()->name == 'renter')
                                                    <span class="badge bg-warning">Renter</span>
                                                @else
                                                    <span class="badge bg-secondary">Company</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex flex-column align-items-center gap-1">
                                                @if ($user->is_verified)
                                                    <span class="badge bg-success">Verified</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">Unverified</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="fa-regular fa-calendar me-2 text-muted"></i>
                                                {{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if ($user->is_deleted)
                                                <span class="badge bg-danger">Deleted</span>
                                            @else
                                                <span class="badge bg-success">Active</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ url('/dashboard/users/' . $user->id . '/show') }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="View Details">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a href="{{ url('/dashboard/users/' . $user->id . '/edit') }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit User">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}" data-bs-toggle="tooltip" title="Delete User">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                                @if ($user->is_deleted == true)
                                                    <form action="{{ route('user.restore', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success btn-sm text-white" title="Restore User">
                                                            <i class="fa-solid fa-trash-restore me-1"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title">Delete User</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-center mb-3">
                                                                <i class="fa-solid fa-triangle-exclamation text-danger fa-3x mb-3"></i>
                                                                <h5>Are you sure you want to delete this user?</h5>
                                                                <p class="text-muted">User: <strong>{{ $user->first_name }} {{ $user->last_name }}</strong></p>
                                                                <p class="text-muted mb-0">This action cannot be undone.</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-center">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                <i class="fa-solid fa-times me-1"></i> Cancel
                                                            </button>
                                                            <form action="{{ url('/dashboard/users/' . $user->id) . '/destroy' }}" method="post">
                                                                @csrf
                                                                @method('POST')
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
                            <p class="text-muted mb-0">Showing <span class="fw-medium">{{ $users->count() }}</span> of <span class="fw-medium">{{ $users->total() }}</span> users</p>
                        </div>
                        <div>
                            {{ $users->links() }}
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