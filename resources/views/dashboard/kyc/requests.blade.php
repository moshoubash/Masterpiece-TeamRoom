@extends('layouts.dashboard.layout')
@section('title', 'KYC Requests Management')
@section('content')
<div class="container-fluid p-0">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0"><strong>KYC Verification Requests</strong></h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">KYC Requests</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <button class="btn btn-primary">
                        <i class="align-middle" data-feather="refresh-cw"></i> 
                        <a href="/dashboard/kyc/requests" class="ms-1 d-none d-sm-inline text-white">Refresh</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Alerts -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <div class="d-flex">
                <div class="flex-shrink-0">
                    <i class="align-middle" data-feather="check-circle"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <strong>Success!</strong> {{ session('success') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- KYC Requests -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Pending KYC Verification Requests</h5>
                    </div>
                </div>
                
                <div class="card-body">
                    @if ($hosts->count() > 0)
                        <div class="row row-cols-1 row-cols-md-2 g-4">
                            @foreach ($hosts as $user)
                                <div class="col">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="avatar avatar-md bg-primary bg-opacity-10 text-primary rounded-circle me-3">
                                                    <span>{{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}</span>
                                                </div>
                                                <div>
                                                    <h5 class="card-title mb-0">{{ $user->first_name }} {{ $user->last_name }}</h5>
                                                    <p class="text-muted small mb-0">
                                                        <i class="align-middle" data-feather="mail" style="width: 14px; height: 14px;"></i>
                                                        {{ $user->email }}
                                                    </p>
                                                </div>
                                                <div class="ms-auto">
                                                    <span class="badge bg-info-subtle text-info">Pending</span>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="align-middle me-2 text-primary" data-feather="calendar" style="width: 16px; height: 16px;"></i>
                                                    <span class="fw-medium">Submitted:</span>
                                                    <span class="ms-2">{{ $user->created_at->format('M d, Y') }}</span>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <i class="align-middle me-2 text-primary" data-feather="file-text" style="width: 16px; height: 16px;"></i>
                                                    <span class="fw-medium">ID Document:</span>
                                                    <a href="{{ asset('storage/' . $user->id_document_path) }}" target="_blank" class="ms-2 btn btn-sm btn-outline-primary">
                                                        <i class="align-middle" data-feather="eye" style="width: 14px; height: 14px;"></i> View Document
                                                    </a>
                                                </div>
                                            </div>
                                            
                                            <div class="d-flex gap-2 mt-3">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approveModal{{ $user->id }}">
                                                    <i class="align-middle" data-feather="check"></i> Approve
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $user->id }}">
                                                    <i class="align-middle" data-feather="x"></i> Reject
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Approve Modal -->
                                <div class="modal fade" id="approveModal{{ $user->id }}" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-success text-white">
                                                <h5 class="modal-title" id="approveModalLabel">Approve KYC Verification</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-center mb-4">
                                                    <div class="avatar avatar-xl bg-success bg-opacity-10 text-success rounded-circle mx-auto mb-3">
                                                        <i class="align-middle" data-feather="check" style="width: 30px; height: 30px;"></i>
                                                    </div>
                                                    <h5>Approve {{ $user->first_name }} {{ $user->last_name }}'s KYC Verification?</h5>
                                                    <p class="text-muted">This action will verify the user and grant them host privileges.</p>
                                                </div>
                                                
                                                <div class="card bg-light mb-3">
                                                    <div class="card-body">
                                                        <h6 class="card-subtitle mb-2 text-muted">User Information</h6>
                                                        <p class="mb-1"><strong>Name:</strong> {{ $user->first_name }} {{ $user->last_name }}</p>
                                                        <p class="mb-1"><strong>Email:</strong> {{ $user->email }}</p>
                                                        <p class="mb-0"><strong>User ID:</strong> #{{ $user->id }}</p>
                                                    </div>
                                                </div>
                                                
                                                <form method="POST" action="{{ route('kyc.approve', $user) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success w-100">Confirm Approval</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Reject Modal -->
                                <div class="modal fade" id="rejectModal{{ $user->id }}" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="rejectModalLabel">Reject KYC Verification</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-center mb-4">
                                                    <div class="avatar avatar-xl bg-danger bg-opacity-10 text-danger rounded-circle mx-auto mb-3">
                                                        <i class="align-middle" data-feather="x" style="width: 30px; height: 30px;"></i>
                                                    </div>
                                                    <h5>Reject {{ $user->first_name }} {{ $user->last_name }}'s KYC Verification?</h5>
                                                    <p class="text-muted">This action will reject the user's KYC verification request.</p>
                                                </div>
                                                
                                                <div class="card bg-light mb-3">
                                                    <div class="card-body">
                                                        <h6 class="card-subtitle mb-2 text-muted">User Information</h6>
                                                        <p class="mb-1"><strong>Name:</strong> {{ $user->first_name }} {{ $user->last_name }}</p>
                                                        <p class="mb-1"><strong>Email:</strong> {{ $user->email }}</p>
                                                        <p class="mb-0"><strong>User ID:</strong> #{{ $user->id }}</p>
                                                    </div>
                                                </div>
                                                
                                                <form method="POST" action="{{ route('kyc.reject', $user) }}">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="rejection_reason" class="form-label">Rejection Reason (Optional)</label>
                                                        <textarea class="form-control" id="rejection_reason" name="rejection_reason" rows="3" placeholder="Provide a reason for rejection..."></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-danger w-100">Confirm Rejection</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="avatar avatar-xl text-secondary rounded-circle mx-auto mb-3 ">
                                <i class="align-middle" data-feather="inbox" style="width: 30px; height: 30px;"></i>
                            </div>
                            <h5>No KYC Requests Found</h5>
                            <p class="text-muted">There are currently no pending KYC verification requests in the system.</p>
                        </div>
                    @endif
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
        
        const searchInput = document.querySelector('input[placeholder="Search users..."]');
        if (searchInput) {
            searchInput.addEventListener('keyup', function(e) {
                console.log('Searching for:', this.value);
            });
        }
    });
</script>
@endpush