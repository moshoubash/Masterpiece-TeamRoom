@extends('layouts.dashboard.layout')
@section('title', 'Edit User')
@section('content')
    <h1>Edit User #{{$id}}</h1>
    <form action="{{ route('users.update', $id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" required>
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}">
        </div>

        <div class="form-group">
            <label for="profile_picture_url">Profile Picture</label>
            <input type="text" name="profile_picture_url" id="profile_picture_url" class="form-control">
            @if($user->profile_picture_url)
                <img src="{{ asset($user->profile_picture_url) }}" alt="Profile Picture" class="img-thumbnail mt-2" width="150">
            @endif
        </div>

        <div class="form-group">
            <label for="bio">Bio</label>
            <textarea name="bio" id="bio" class="form-control" rows="4">{{ old('bio', $user->bio) }}</textarea>
        </div>

        <div class="form-group">
            <label for="company_name">Company Name</label>
            <input type="text" name="company_name" id="company_name" class="form-control" value="{{ old('company_name', $user->company_name) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
@endsection
@section('scripts')
    <script>
            document.querySelector('form').addEventListener('submit', async function (event) {
                const formData = new FormData(this);
                const id = "{{ $id }}";
                const url = `/api/users/${id}`;

                try {
                    const response = await fetch(url, {
                        method: 'PUT',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (response.ok) {
                        window.location = '{{ route('users.index') }}';
                    } else {
                        alert('Failed to update user: ' + (data.message || 'Unknown error'));
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('An error occurred while updating the user.');
                }
            });
    </script>
@endsection