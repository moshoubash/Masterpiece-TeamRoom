@extends('layouts.dashboard.layout')
@section('title', 'Amenities Management')
@section('content')
    <!-- Page Header -->
    <div class="card mb-4">
        <div class="card-body py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 fw-bold">Amenities Management</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 small">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Amenities</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAmenityModal">
                        <i class="fa-solid fa-plus me-1"></i> Add New Amenity
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Amenity Modal -->
    <div class="modal fade" id="addAmenityModal" tabindex="-1" aria-labelledby="addAmenityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title text-white" id="addAmenityModalLabel">Add New Amenity</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add-amenity-form" action="{{ route('amenities.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="amenity-name" class="form-label">Amenity Name</label>
                            <input type="text" name="name" class="form-control" id="amenity-name"
                                placeholder="e.g. Wi-Fi, Coffee Machine" required>
                        </div>
                        <div class="mb-3">
                            <label for="amenity-icon" class="form-label">Icon (FontAwesome Class)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-icons"></i></span>
                                <input type="text" name="icon" class="form-control" id="amenity-icon"
                                    placeholder="e.g. fa-solid fa-wifi">
                            </div>
                            <div class="form-text">Use FontAwesome classes. Example: <code>fa-solid fa-wifi</code></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa-solid fa-times me-1"></i> Cancel
                    </button>
                    <button type="submit" form="add-amenity-form" class="btn btn-primary">
                        <i class="fa-solid fa-check me-1"></i> Create Amenity
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">All Amenities</h5>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="60" class="text-center">ID</th>
                                    <th width="80" class="text-center">Icon</th>
                                    <th>Amenity Name</th>
                                    <th width="120" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @forelse ($amenities as $amenity)
                                    <tr>
                                        <td class="text-center fw-medium">{{ $amenity->id }}</td>
                                        <td class="text-center">
                                            @if($amenity->icon)
                                                <i class="{{ $amenity->icon }} fa-lg text-primary"></i>
                                            @else
                                                <i class="fa-solid fa-question text-muted"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="fw-medium">{{ $amenity->name }}</div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $amenity->id }}" title="Edit Amenity">
                                                    <i class="fa-solid fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $amenity->id }}" title="Delete Amenity">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </div>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal{{ $amenity->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title text-white">Edit Amenity</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-start">
                                                            <form id="edit-form-{{ $amenity->id }}" action="{{ route('amenities.update', $amenity->id) }}" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="edit-name-{{ $amenity->id }}" class="form-label">Amenity Name</label>
                                                                    <input type="text" name="name" class="form-control" id="edit-name-{{ $amenity->id }}" value="{{ $amenity->name }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="edit-icon-{{ $amenity->id }}" class="form-label">Icon (FontAwesome Class)</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><i class="{{ $amenity->icon ?: 'fa-solid fa-icons' }}"></i></span>
                                                                        <input type="text" name="icon" class="form-control" id="edit-icon-{{ $amenity->id }}" value="{{ $amenity->icon }}">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                <i class="fa-solid fa-times me-1"></i> Cancel
                                                            </button>
                                                            <button type="submit" form="edit-form-{{ $amenity->id }}" class="btn btn-primary">
                                                                <i class="fa-solid fa-check me-1"></i> Update Amenity
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $amenity->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title text-white">Delete Amenity</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <i class="fa-solid fa-triangle-exclamation text-danger fa-3x mb-3"></i>
                                                            <h5>Are you sure?</h5>
                                                            <p class="text-muted">You are about to delete <strong>{{ $amenity->name }}</strong>. This action cannot be undone.</p>
                                                        </div>
                                                        <div class="modal-footer justify-content-center">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                <i class="fa-solid fa-times me-1"></i> Cancel
                                                            </button>
                                                            <form action="{{ route('amenities.destroy', $amenity->id) }}" method="post">
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
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            No amenities found. Click "Add New Amenity" to get started.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <p class="text-muted mb-0">Total: <span class="fw-medium">{{ count($amenities) }}</span> amenities</p>
                </div>
            </div>
        </div>
    </div>
@endsection
