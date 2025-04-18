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
                        @foreach ($activities->sortByDesc('created_at') as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->user_id ?? 0}}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ (new DateTime($item->created_at))->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3 ms-3">
                    {{ $activities->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
