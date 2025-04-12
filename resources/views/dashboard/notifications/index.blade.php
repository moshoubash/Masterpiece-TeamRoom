@extends('layouts.dashboard.layout')
@section('title', 'Notifications')
@section('content')
    <h1 class="h3 mb-3"><strong>Notifications</strong></h1>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Notifications</h5>
                </div>
                <table class="table table-hover my-0 table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Message</th>
                            <th>Is Read</th>
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
        fetch('/api/notifications')
            .then(response => response.json())
            .then(data => {
                let tableBody = document.querySelector('#table-body');
                data.forEach(item => {
                    let tableRow = document.createElement('tr');
                    tableRow.innerHTML = `
					<td>${item.id}</td>
					<td>${item.title}</td>
					<td>${item.notification_type}</td>
					<td>${item.message}</td>
					<td>${item.is_read == 0 ? 'No' : 'Yes'}</td>
					<td>${new Date(item.created_at).toLocaleDateString()}</td>
				`;
                    tableBody.appendChild(tableRow);
                });
            })
            .catch(error => console.error('Error:', error));
    </script>
@endsection
