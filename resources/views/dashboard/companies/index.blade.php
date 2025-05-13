@extends('layouts.dashboard.layout')
@section('content')
    <!-- Page Header -->
    <div class="card mb-4">
        <div class="card-body py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 fw-bold">Manage Companies</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 small">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">companies</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('companies.create') }}" class="btn btn-primary">
                                <i class="fa-solid fa-plus me-2"></i>
                                Register New Company
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <div class="d-flex">
                <div class="me-2">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div>
                    {{ session('message') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">All companies</h5>

                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-download me-1"></i> Export
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                                <li><a class="dropdown-item" href="{{ route('export.excel', ['table' => 'companies']) }}"><i class="fa-solid fa-file-excel me-2"></i>Excel</a></li>
                                <li><a class="dropdown-item" href="{{ route('export.pdf', ['table' => 'companies']) }}"><i class="fa-solid fa-file-pdf me-2"></i>PDF</a></li>
                                <li><a class="dropdown-item" href="{{ route('export.csv', ['table' => 'companies']) }}"><i class="fa-solid fa-file-csv me-2"></i>CSV</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Search and filters -->
                    <form class="mt-2 row g-3 align-items-center" action="{{ route('companies.filter') }}" method="GET">
                        <div class="col-lg-4 col-md-6">
                            <label for="search" class="form-label">Search</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent"><i
                                        class="fa-solid fa-search"></i></span>
                                <input type="text" name="search" class="form-control" id="search"
                                    placeholder="Search companies..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <label for="sort" class="form-label">Sort</label>
                            <select class="form-select" id="sort" name="sort">
                                <option value="">Select Sort</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>From Oldest</option>
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>From Newest</option>
                            </select>
                        </div>
                        <div class="col-4 text-end mt-5">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fa-solid fa-filter me-1"></i> Filter
                            </button>
                            <a title="reset filters" href="/dashboard/companies"
                                class="btn btn-outline-secondary">
                                <i class="fa-solid fa-rotate me-1"></i> Reset
                            </a>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="50">ID</th>
                                    <th class="text-center" width="100">Logo</th>
                                    <th width="150">Name</th>
                                    <th width="150">Phone</th>
                                    <th width="150">Email</th>
                                    <th width="200">City</th>
                                    <th width="150">Created_at</th>
                                    <th class="text-center" width="140">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach ($companies as $company)
                                    <tr>
                                        <td class="fw-medium">{{ $company->id }}</td>
                                        <td class="text-center">
                                            <img src="{{ asset('storage/' . $company->logo) }}"
                                                alt="{{ $company->name }}" width="50" height="50"
                                                class="rounded-circle">
                                        </td>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->phone }}</td>
                                        <td>{{ $company->email }}</td>
                                        <td>{{ $company->city }}
                                        </td>
                                        <td>
                                            {{ $company->created_at->format('d M Y') }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('companies.edit', $company->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{ route('companies.show', $company->id) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
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
                            <p class="text-muted mb-0">Showing <span class="fw-medium">{{ $companies->count() }}</span> of
                                <span class="fw-medium">{{ $companies->total() }}</span> companies
                            </p>
                        </div>
                        <div>
                            {{ $companies->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
