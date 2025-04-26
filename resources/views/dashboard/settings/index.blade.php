@extends('layouts.dashboard.layout')
@section('title', 'Settings')
@section('content')
	<h1 class="h3 mb-3"><strong>Settings</strong></h1>

	<div class="row">
		<div class="col-12">
			<form action="{{ route('settings.update', $user) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<div class="mb-3">
					<label for="email" class="form-label">Email</label>
					<input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
				</div>

				<div class="mb-3">
					<label for="password" class="form-label">Password</label>
					<input type="password" class="form-control" id="password" name="password">
					<small class="text-muted">Leave blank to keep current password</small>
				</div>

				<div class="mb-3">
					<label for="first_name" class="form-label">First Name</label>
					<input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" required>
				</div>

				<div class="mb-3">
					<label for="last_name" class="form-label">Last Name</label>
					<input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
				</div>

				<div class="mb-3">
					<label for="phone_number" class="form-label">Phone Number</label>
					<input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
				</div>

				<div class="mb-3">
					<label for="profile_picture_url" class="form-label">Profile Picture</label>
					<input type="file" class="form-control" id="profile_picture_url" name="profile_picture_url">
				</div>

				<div class="mb-3">
					<label for="bio" class="form-label">Bio</label>
					<textarea class="form-control" id="bio" name="bio" rows="3">{{ old('bio', $user->bio) }}</textarea>
				</div>

				<div class="mb-3">
					<label for="company_name" class="form-label">Company Name</label>
					<input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', $user->company_name) }}">
				</div>

				<div class="mb-3 form-check">
					<input type="checkbox" class="form-check-input" id="is_verified" name="is_verified" {{ old('is_verified', $user->is_verified) ? 'checked' : '' }}>
					<label class="form-check-label" for="is_verified">Verified</label>
				</div>

				<div class="mb-3 form-check">
					<input type="checkbox" class="form-check-input" id="is_deleted" name="is_deleted" {{ old('is_deleted', $user->is_deleted) ? 'checked' : '' }}>
					<label class="form-check-label" for="is_deleted">Deleted</label>
				</div>

				<button type="submit" class="btn btn-primary">Save Changes</button>
			</form>
		</div>
	</div>	
@endsection