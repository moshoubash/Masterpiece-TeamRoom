@extends('layouts.dashboard.layout')
@section('title', 'Manage Spaces')
@section('content')
    <h1 class="h3 mb-3"><strong>Manage</strong> Spaces</h1>

    <div class="row">
        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Listings</h5>
                </div>
                <table class="table table-hover my-0 table-striped">
                    <thead>
                        <tr>
							<th>Id</th>
							<th>Host Id</th>
							<th class="d-none d-md-table-cell">Title</th>
							<th>Capacity</th>
							<th class="d-none d-md-table-cell">$ Hourly Rate</th>
							<th class="d-none d-md-table-cell">Min Booking Duration (hrs)</th>
							<th>Is Active</th>
							<th>Is Deleted</th>
							<th>Created At</th>
							<th>Actions</th>
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
        fetch('/api/spaces')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('table-body');
                data.forEach(space => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${space.id}</td>
                        <td>${space.host_id}</td>
                        <td class="d-none d-md-table-cell">${space.title}</td>
                        <td>${space.capacity}</td>
                        <td class="d-none d-md-table-cell">$${space.hourly_rate}</td>
                        <td class="d-none d-md-table-cell">${space.min_booking_duration}</td>
                        <td>${space.is_active ? '<span class="badge bg-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></span>' : '<span class="badge bg-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg></span>'}</td>
                        <td>${space.is_deleted ? '<span class="badge bg-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></span>' : '<span class="badge bg-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg></span>'}</td>
                        <td>${new Date(space.created_at).toLocaleDateString()}</td>
                        <td>
                            <a href="/dashboard/spaces/${space.id}/edit" class="btn btn-primary"><i class="fa-solid fa-edit"></i></a>
                            <button class="btn btn-danger" onclick="handleDelete(${space.id})"><i class="fa-solid fa-trash"></i></button>
                            <a href="/dashboard/spaces/${space.id}/show" class="btn btn-dark"><i class="fa-solid fa-info-circle"></i></a>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });
            });

        function handleDelete(id) {
            if (confirm('Are you sure you want to delete this space?')) {
                fetch(`/api/spaces/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
            }
        }
	</script>
@endsection
