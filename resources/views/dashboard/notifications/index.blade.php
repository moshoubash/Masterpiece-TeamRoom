@extends('layouts.dashboard.layout')
@section('title', 'Notifications')
@section('content')
    <h1 class="h3 mb-3"><strong>Notifications</strong></h1>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Create new Notification
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
                    <form method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="notification_type" id="type" class="form-control" required>
                                <option value="alert">Alert</option>
                                <option value="booking">Booking</option>
                                <option value="review">Review</option>
                                <option value="transaction">Transaction</option>
                                <option value="listing">Listing</option>
                                <option value="message">Send Message</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="user_id">User Email</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->email }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Send Notification</button>
                    </form>
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
                        @foreach($notifications as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->notification_type}}</td>
                                <td>{{$item->message}}</td>
                                <td>{{$item->is_read == 0 ? 'No' : 'Yes'}}</td>
                                <td>{{new DateTime($item->created_at).toLocaleDateString()}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection