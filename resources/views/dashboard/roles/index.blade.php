@extends('layouts.dashboard.layout')
@section('title', 'Roles And Permissions')
@section('content')
    <h1 class="h3 mb-3"><strong>Roles</strong> And Permissions</h1>

    <div class="row">
        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Roles</h5>
                </div>
                <table class="table table-hover my-0 table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th class="d-none d-md-table-cell">Created At</th>
                            <th class="d-none d-md-table-cell">Permissions</th>
                            <th class="d-none d-md-table-cell">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td class="d-none d-md-table-cell">{{ $role->name }}</td>
                                <td>{{ $role->created_at }}</td>
                                <td>
                                    @if ($role->permissions && $role->permissions->count() > 0)
                                        @foreach ($role->permissions as $permission)
                                            <span class="badge bg-primary">{{ $permission->name }}</span>
                                        @endforeach
                                    @else
                                        <span class="badge bg-secondary">No Data</span>
                                    @endif
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <a href="/dashboard/roles/{{ $role->id }}/edit" class="btn btn-primary">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>

                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $role->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                    <!--Modal-->
                                    <div class="modal fade" id="deleteModal{{ $role->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Role</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this role?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form action="/dashboard/roles/{{ $role->id }}" method="post" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            Delete
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
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Add New Role</h5>
                </div>
                <div class="card-body">
                    <form id="add-role-form" action="/dashboard/roles/" method="post">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="role-name" class="form-label">Role Name</label>
                            <input type="text" name="name" class="form-control" id="role-name"
                                placeholder="Enter role name" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Permissions</h5>
                </div>
                <table class="table table-hover my-0 table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th class="d-none d-md-table-cell">Created At</th>
                            <th class="d-none d-md-table-cell">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="permissions-table-body">
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->created_at }}</td>
                                <td class="d-none d-md-table-cell">

                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deletePermissionModal{{ $permission->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                    <!--Modal-->
                                    <div class="modal fade" id="deletePermissionModal{{ $permission->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Permission</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this permission?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form action="/dashboard/permissions/{{ $permission->id }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger">
                                                            Delete
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
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Add New Permission</h5>
                </div>
                <div class="card-body">
                    <form id="add-permission-form" action="/dashboard/permissions/" method="post">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="permission-name" class="form-label">Permission Name</label>
                            <input type="text" name="name" class="form-control" id="permission-name"
                                placeholder="Enter permission name" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Permission</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
