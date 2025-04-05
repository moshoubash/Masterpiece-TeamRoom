@extends('layouts.dashboard.layout')
@section('title', 'Activities')
@section('content')
	<h1 class="h3 mb-3"><strong>Activities</strong></h1>

	<div class="row">
		<div class="col-12 d-flex">
			<div class="card flex-fill">
				<div class="card-header">
					<h5 class="card-title mb-0">All Activities</h5>
				</div>
				<table class="table table-hover my-0 table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>User ID</th>
							<th>Type</th>
							<th>Name</th>
							<th>Description</th>
							<th>Created At</th>
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
	fetch('/api/activities')  // Your API route
		.then(response => response.json())
		.then(data => {
			let tableBody = document.querySelector('#table-body');
			data.forEach(item => {
				let tableRow = document.createElement('tr');
				tableRow.innerHTML = `
					<td>${item.id}</td>
					<td>${item.user_id}</td>
					<td>${item.type}</td>
					<td>${item.name}</td>
					<td>${item.description}</td>
					<td>${new Date(item.created_at).toLocaleDateString()}</td>
				`;
				tableBody.appendChild(tableRow);
			});
		})
		.catch(error => console.error('Error:', error));
</script>
@endsection