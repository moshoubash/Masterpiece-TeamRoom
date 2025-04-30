@extends('layouts.dashboard.layout')
@section('title', 'Settings')
@section('content')
	<h1 class="h3 mb-3"><strong>Settings</strong></h1>

	@if(session('success'))
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
	@endsession

	<div class="row">
		<div class="col-12">
			<form action="{{ route('admin.settings.update', $user) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<div class="mb-3">
					<label for="email" class="form-label">Email</label>
					<input type="email" class="form-control" id="email" value="{{ old('email', $user->email) }}" disabled required>
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

				<button type="submit" class="btn btn-primary">Save Changes</button>
			</form>

			<hr>

			<!-- update password -->
			<h1 class="h3 my-3">Update Password</h1>

			<form action="{{ route('user.password.update', $user->id) }}" method="POST" class="mt-4">
				@csrf
				@method('PUT')

				<div class="mb-3">
					<label for="password" class="form-label">Password</label>
					<input type="password" class="form-control" id="password" name="password" required>
				</div>

				<div class="mb-3">
					<label for="password_confirmation" class="form-label">Confirm Password</label>
					<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
				</div>

				<button type="submit" class="btn btn-primary">Update Password</button>
			</form>
		</div>
	</div>	
@endsection