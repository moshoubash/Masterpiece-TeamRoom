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
        
        <button type="submit" class="btn btn-primary">Update Role</button>
    </form>
    <a href="/dashboard/roles" class="btn btn-secondary">Back to Roles</a>
@endsection