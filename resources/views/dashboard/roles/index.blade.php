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
					<form id="add-role-form">
						<div class="mb-3">
							<label for="role-name" class="form-label">Role Name</label>
							<input type="text" name="name" class="form-control" id="role-name" placeholder="Enter role name" required>
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
					<form id="add-permission-form">
						<div class="mb-3">
							<label for="permission-name" class="form-label">Permission Name</label>
							<input type="text" name="name" class="form-control" id="permission-name" placeholder="Enter permission name" required>
						</div>
				
						<button type="submit" class="btn btn-primary">Add Permission</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
<script>
	fetch('/api/roles')  // Your API route
		.then(response => response.json())
		.then(data => {
			let tableBody = document.querySelector('#table-body');
			data.forEach(item => {
				let tableRow = document.createElement('tr');
				tableRow.innerHTML = `
					<td>${item.id}</td>
					<td class="d-none d-md-table-cell">${item.name}</td>
					<td>${item.created_at}</td>
					<td>
						${item.permissions && item.permissions.length > 0 
							? item.permissions.map(permission => `<span class="badge bg-primary">${permission.name}</span>`).join(' ') 
							: '<span class="badge bg-secondary">No Data</span>'}
					</td>
					<td class="d-none d-md-table-cell">
						<a href="/dashboard/roles/${item.id}/edit" class="btn btn-primary">
							<i class="fa-solid fa-edit"></i>
						</a>
						
						<button class="btn btn-danger" onclick="deleteRole(${item.id}, this)">
							<i class="fa-solid fa-trash"></i>
						</button>
					</td>
				`;
				tableBody.appendChild(tableRow);
			});
		})
		.catch(error => console.error('Error:', error));
</script>
<script>
	function deleteRole(id, button) {
		if (confirm('Are you sure you want to delete this role?')) {
			fetch(`/api/roles/${id}`, {
				method: 'DELETE',
				headers: {
					'Content-Type': 'application/json',
				},
			})
			.then(response => {
				if (response.ok) {
					location.reload();
				} else {
					alert('Failed to delete role because it have permissions.');
				}
			})
			.catch(error => console.error('Error:', error));
		}
	}
</script>
<script>
	document.addEventListener('DOMContentLoaded', () => {
		document.querySelector('#add-role-form').addEventListener('submit', function(e) {
			e.preventDefault();
			let roleName = document.querySelector('#role-name').value;

			fetch('/api/roles', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
				},
				body: JSON.stringify({
					name: roleName
				}),
			})
			.then(response => {
				if (response.ok) {
					location.reload();
				} else {
					alert('Failed to add role.');
				}
			})
			.catch(error => console.error('Error:', error));
		});
	});
</script>
<script>
	document.addEventListener('DOMContentLoaded', () => {
		document.querySelector('#add-permission-form').addEventListener('submit', function(e) {
			e.preventDefault();
			let permissionName = document.querySelector('#permission-name').value;

			fetch('/api/permissions', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
				},
				body: JSON.stringify({
					name: permissionName
				}),
			})
			.then(response => {
				if (response.ok) {
					location.reload();
				} else {
					alert('Failed to add permission.');
				}
			})
			.catch(error => console.error('Error:', error));
		});
	});
</script>
<script>
	fetch('/api/permissions')  // Your API route
		.then(response => response.json())
		.then(data => {
			let tableBody = document.querySelector('#permissions-table-body');
			data.forEach(item => {
				let tableRow = document.createElement('tr');
				tableRow.innerHTML = `
					<td>${item.id}</td>
					<td>${item.name}</td>
					<td>${item.created_at}</td>
					<td class="d-none d-md-table-cell">
						<button class="btn btn-danger" onclick="deletePermission(${item.id}, this)">
							<i class="fa-solid fa-trash"></i>
						</button>
					</td>
				`;
				tableBody.appendChild(tableRow);
			});
		})
		.catch(error => console.error('Error:', error));

	function deletePermission(id, button) {
		if (confirm('Are you sure you want to delete this permission?')) {
			fetch(`/api/permissions/${id}`, {
				method: 'DELETE',
				headers: {
					'Content-Type': 'application/json',
				},
			})
			.then(response => {
				if (response.ok) {
					location.reload();
				} else {
					alert('Failed to delete permission.');
				}
			})
			.catch(error => console.error('Error:', error));
		}
	}
</script>
@endsection