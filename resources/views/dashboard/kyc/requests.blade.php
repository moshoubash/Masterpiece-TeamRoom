@extends('layouts.dashboard.layout')
@section('title', 'Kyc Requests Management')

@section('content')
    <div class="max-w-4xl mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-6">KYC Requests</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($hosts->count() > 0)
            @foreach ($hosts as $user)
                <div class="border p-4 rounded mb-4">
                    <p><strong>Name:</strong> {{ $user->first_name }} {{ $user->last_name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>ID Document:</strong> <a href="{{ asset('storage/' . $user->id_document_path) }}"
                            target="_blank" class="text-blue-600">View Document</a></p>

                    <div class="mt-3 d-flex gap-2">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success my-2" data-bs-toggle="modal"
                            data-bs-target="#approveModal{{ $user->id }}">
                            Approve
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="approveModal{{ $user->id }}" tabindex="-1"
                            aria-labelledby="approveModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="approveModalLabel">User Approval Id #{{ $user->id }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('kyc.approve', $user) }}">
                                            @csrf
                                            <div class="form-group">
                                                <p for="user_id">Do you really want to approve this KYC request?</p>
                                            </div>

                                            <button type="submit" class="btn btn-success">Approve</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger my-2" data-bs-toggle="modal"
                            data-bs-target="#rejectModal{{ $user->id }}">
                            Reject
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="rejectModal{{ $user->id }}" tabindex="-1"
                            aria-labelledby="rejectModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="rejectModalLabel">User Rejection Id #{{ $user->id }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('kyc.reject', $user) }}">
                                            @csrf
                                            <div class="form-group">
                                                <p for="user_id">Do you really want to reject this KYC request?</p>
                                            </div>

                                            <button type="submit" class="btn btn-danger">Reject</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <p>No KYC requests found.</p>
        @endif
    </div>
@endsection
