@extends('layouts.dashboard.layout')
@section('title', 'Edit Role')
@section('content')
    <h1>Edit Role #{{$id}}</h1>
    <form action="{{ route('roles.update', $id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $role->name) }}" required>
        </div>
        
        <div class="form-group mt-3">
            <label for="permissions">Permissions</label>
            @foreach($permissions as $permission)
                <div class="form-check">
                    <input 
                        type="checkbox" 
                        name="permissions[]" 
                        id="permission-{{ $permission->id }}" 
                        value="{{ $permission->id }}" 
                        class="form-check-input"
                        {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}
                    >
                    <label for="permission-{{ $permission->id }}" class="form-check-label">
                        {{ $permission->name }}
                    </label>
                </div>
            @endforeach
        </div>
        
        <button type="submit" class="btn btn-primary">Update Role</button>
    </form>
    <a href="/dashboard/roles" class="btn btn-secondary">Back to Roles</a>
@endsection