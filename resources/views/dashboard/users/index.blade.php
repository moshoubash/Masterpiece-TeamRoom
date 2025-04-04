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
					<td class="d-none d-xl-table-cell">${item.is_verified ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-danger">No</span>'}</td>
					<td>${item.company_name ? item.company_name : '<span class="badge bg-secondary">Empty</span>'}</td>
					<td class="d-none d-md-table-cell">${new Date(item.created_at).toLocaleDateString()}</td>
					<td class="d-none d-md-table-cell">
						<a href="/users/${item.id}/edit" class="btn btn-primary">
							<i class="fa-solid fa-edit"></i>
						</a>
						<button class="btn btn-danger" onclick="deleteUser(${item.id}, this)">
							<i class="fa-solid fa-trash"></i>
						</button>
						
						<a href="/users/${item.id}/show" class="btn btn-dark">
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
		}
	}
</script>
@endsection