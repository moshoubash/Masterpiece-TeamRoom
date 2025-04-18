@extends('layouts.dashboard.layout')
@section('title', 'Users Management')
@section('content')
    <h1 class="h3 mb-3"><strong>Users</strong> Management</h1>

    <div class="row">
        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Users</h5>
                </div>
                <table class="table table-hover my-0 table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th class="d-none d-md-table-cell">Profile Picture</th>
                            <th>Full Name</th>
                            <th class="d-none d-xl-table-cell">Email</th>
                            <th class="d-none d-xl-table-cell">Phone Number</th>
                            <th class="d-none d-xl-table-cell">Is Verified</th>
                            <th class="d-none d-xl-table-cell">Is Deleted</th>
                            <th>Company Name</th>
                            <th class="d-none d-md-table-cell">Created At</th>
                            <th class="d-none d-md-table-cell">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>

                                <td class="d-none d-md-table-cell">
                                    <img class="rounded"
                                        src="{{ $user->profile_picture_url ?? 'http://www.placehold.co/300x300' }}"
                                        alt="Profile Picture" width="50">
                                </td>

                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>

                                <td class="d-none d-xl-table-cell">{{ $user->email }}</td>

                                <td class="d-none d-xl-table-cell">{{ $user->phone_number }}</td>

                                <td class="d-none d-xl-table-cell">
                                    @if ($user->is_verified)
                                        <span class="badge bg-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-check-circle">
                                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                                <polyline points="22 4 12 14.01 9 11.01" />
                                            </svg>
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-x-circle">
                                                <circle cx="12" cy="12" r="10" />
                                                <line x1="15" y1="9" x2="9" y2="15" />
                                                <line x1="9" y1="9" x2="15" y2="15" />
                                            </svg>
                                        </span>
                                    @endif
                                </td>

                                <td class="d-none d-xl-table-cell">
                                    @if ($user->is_deleted)
                                        <span class="badge bg-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-check-circle">
                                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                                <polyline points="22 4 12 14.01 9 11.01" />
                                            </svg>
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-x-circle">
                                                <circle cx="12" cy="12" r="10" />
                                                <line x1="15" y1="9" x2="9" y2="15" />
                                                <line x1="9" y1="9" x2="15" y2="15" />
                                            </svg>
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    @if ($user->company_name)
                                        {{ $user->company_name }}
                                    @else
                                        <span class="badge bg-secondary">Empty</span>
                                    @endif
                                </td>

                                <td class="d-none d-md-table-cell">
                                    {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}
                                </td>

                                <td class="d-none d-md-table-cell">
                                    <a href="{{ url('/dashboard/users/' . $user->id . '/edit') }}" class="btn btn-primary">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>

                                    <form action="{{ url('/dashboard/users/' . $user->id) . '/destroy' }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <button class="btn btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>

                                    <a href="{{ url('/dashboard/users/' . $user->id . '/show') }}" class="btn btn-dark">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3 ms-3">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
