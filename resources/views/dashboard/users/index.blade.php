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
						
					</tbody>
				</table>
			</div>
		</div>
	</div>	
@endsection
@section('scripts')
<script>
	fetch('/api/users')  // Your API route
		.then(response => response.json())
		.then(data => {
			let tableBody = document.querySelector('#table-body');
			data.forEach(item => {
				let tableRow = document.createElement('tr');
				tableRow.innerHTML = `
					<td>${item.id}</td>
					<td class="d-none d-md-table-cell"><img class="rounded" src="${item.profile_picture_url ?? 'http://www.placehold.co/300x300'}" alt="Profile Picture" width="50"></td>
					<td>${item.first_name} ${item.last_name}</td>
					<td class="d-none d-xl-table-cell">${item.email}</td>
					<td class="d-none d-xl-table-cell">${item.phone_number}</td>
					<td class="d-none d-xl-table-cell">${item.is_verified ? '<span class="badge bg-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></span>' : '<span class="badge bg-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg></span>'}</td>
					<td class="d-none d-xl-table-cell">${item.is_deleted ? '<span class="badge bg-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></span>' : '<span class="badge bg-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg></span>'}</td>
					<td>${item.company_name ? item.company_name : '<span class="badge bg-secondary">Empty</span>'}</td>
					<td class="d-none d-md-table-cell">${new Date(item.created_at).toLocaleDateString()}</td>
					<td class="d-none d-md-table-cell">
						<a href="/dashboard/users/${item.id}/edit" class="btn btn-primary">
							<i class="fa-solid fa-edit"></i>
						</a>
						
						<button class="btn btn-danger" onclick="deleteUser(${item.id}, this)">
							<i class="fa-solid fa-trash"></i>
						</button>
						
						<a href="/dashboard/users/${item.id}/show" class="btn btn-dark">
							<i class="fa-solid fa-circle-info"></i>
						</a>
					</td>
				`;
				tableBody.appendChild(tableRow);
			});
		})
		.catch(error => console.error('Error:', error));
</script>
<script>
	function deleteUser(userId, button) {
		if (confirm('Are you sure you want to delete this user?')) {
			fetch(`/api/users/${userId}`, {
				method: 'DELETE',
				headers: {
					'Content-Type': 'application/json',
				},
			})
			.then(response => {
				if (response.ok) {
					location.reload();
				} else {
					alert('Failed to delete user.');
				}
			})
			.catch(error => console.error('Error:', error));
		}
	}
</script>
@endsection