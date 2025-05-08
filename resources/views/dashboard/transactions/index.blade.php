@extends('layouts.dashboard.layout')
@section('title', 'Transactions')
@section('content')
<!-- Page header with breadcrumb -->
<div class="card mb-4">
    <div class="card-body py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 fw-bold">Transactions</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 small">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Transactions</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Search and filters -->
<div class="card mb-4">
    <div class="card-body">
        <form class="row g-3 align-items-center" action="{{route('transactions.filter', )}}" method="GET">
            <div class="col-lg-3 col-md-6">
                <label for="search" class="form-label">Search</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent"><i class="fa-solid fa-search"></i></span>
                    <input type="text" name="search" class="form-control" id="search" placeholder="Search transactions...">
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="">All Statuses</option>
                    <option value="completed">Completed</option>
                    <option value="pending">Pending</option>
                    <option value="failed">Failed</option>
                </select>
            </div>
            <div class="col-lg-3 col-md-6">
                <label for="sort" class="form-label">Sort</label>
                <select class="form-select" id="sort" name="sort">
                    <option value="">Select Sort</option>
                    <option value="oldest">From Oldest</option>
                    <option value="newest">From Newest</option>
                    <option value="amount">By Amount</option>
                </select>
            </div>
            <div class="col-3 text-end mt-5">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fa-solid fa-filter me-1"></i> Filter
                </button>
                <a title="reset filters" href="/dashboard/transactions" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-rotate me-1"></i> Reset
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Main transactions table -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">All Transactions</h5>
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-download me-1"></i> Export
                </button>
                <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                    <li><a class="dropdown-item" href="{{ route('export.excel', ['table' => 'transactions']) }}"><i class="fa-solid fa-file-excel me-2"></i>Excel</a></li>
                    <li><a class="dropdown-item" href="{{ route('export.pdf', ['table' => 'transactions']) }}"><i class="fa-solid fa-file-pdf me-2"></i>PDF</a></li>
                    <li><a class="dropdown-item" href="{{ route('export.csv', ['table' => 'transactions']) }}"><i class="fa-solid fa-file-csv me-2"></i>CSV</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-striped align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th scope="col">Booking ID</th>
                    <th scope="col">Transaction Type</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Payment Method</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="table-body">
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>
                            <span class="fw-medium">#{{ $transaction->booking_id ?? 0}}</span>
                        </td>
                        <td>
                            @if($transaction->transaction_type == 'payment')
                                <span class="badge bg-primary-subtle text-primary">Payment</span>
                            @elseif($transaction->transaction_type == 'refund')
                                <span class="badge bg-info-subtle text-info">Refund</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary">{{ $transaction->transaction_type ?? 'No Data'}}</span>
                            @endif
                        </td>
                        <td>
                            <span class="fw-semibold">${{ number_format($transaction->amount, 2) ?? 'No Data'}}</span>
                        </td>
                        <td>
                            @if($transaction->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($transaction->status == 'completed')
                                <span class="badge bg-success">Completed</span>
                            @elseif($transaction->status == 'failed')
                                <span class="badge bg-danger">Failed</span>
                            @else
                                <span class="badge bg-secondary">{{ $transaction->status ?? 'No Data'}}</span>
                            @endif
                        </td>
                        <td>
                            @if($transaction->payment_method == 'credit_card')
                                <i class="fa-solid fa-credit-card me-1"></i>
                            @elseif($transaction->payment_method == 'paypal')
                                <i class="fa-brands fa-paypal me-1"></i>
                            @elseif($transaction->payment_method == 'bank_transfer')
                                <i class="fa-solid fa-university me-1"></i>
                            @endif
                            {{ $transaction->payment_method ?? 'No Data'}}
                        </td>
                        <td>
                            <div>{{ (new DateTime($transaction->created_at))->format('Y-m-d') }}</div>
                            <small class="text-muted">{{ (new DateTime($transaction->created_at))->format('H:i:s') }}</small>
                        </td>
                        <td>
                            <div>{{ (new DateTime($transaction->updated_at))->format('Y-m-d') }}</div>
                            <small class="text-muted">{{ (new DateTime($transaction->updated_at))->format('H:i:s') }}</small>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="/dashboard/transactions/{{ $transaction->id }}" class="btn btn-sm btn-outline-dark" data-bs-toggle="tooltip" title="View Details">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="/dashboard/transactions/{{ $transaction->id }}/edit" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Edit Transaction">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $transaction->id }}" title="Delete Transaction">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $transaction->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $transaction->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $transaction->id }}">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center mb-3">
                                                <i class="fa-solid fa-triangle-exclamation text-danger fs-1"></i>
                                            </div>
                                            <p class="text-center mb-0">Are you sure you want to delete transaction <strong>#{{ $transaction->booking_id }}</strong>?</p>
                                            <p class="text-center text-muted small">This action cannot be undone.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="/dashboard/transactions/{{ $transaction->id }}" method="post">
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
                
                @if(count($transactions) == 0)
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <div class="text-muted mb-2">
                                <i class="fa-solid fa-folder-open fs-3"></i>
                            </div>
                            <h6>No transactions found</h6>
                            <p class="text-muted mb-0">No transaction records match your search criteria.</p>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted small">
                Showing <span class="fw-medium">{{ $transactions->firstItem() ?? 0 }}</span> to 
                <span class="fw-medium">{{ $transactions->lastItem() ?? 0 }}</span> of 
                <span class="fw-medium">{{ $transactions->total() }}</span> entries
            </div>
            <div>
                {{ $transactions->links() }}
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
    });
</script>
@endpush
@endsection