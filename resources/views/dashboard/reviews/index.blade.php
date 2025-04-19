@extends('layouts.dashboard.layout')
@section('title', 'Reviews')
@section('content')
	<h1 class="h3 mb-3"><strong>Reviews</strong></h1>

	<div class="row">
		<div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Reviews</h5>
                </div>
                <table class="table table-hover my-0 table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
							<th>Booking Id</th>
							<th>Reviewer Id</th>
							<th>Reviewee Id</th>
							<th>Space Id</th>
							<th>Rating</th>
							<th>Review Text</th>
							<th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @foreach ($reviews->sortByDesc('created_at') as $review)
                            <tr>
                                <td>{{ $review->id }}</td>
								<td>{{ $review->booking_id ?? 0}}</td>
								<td>{{ $review->reviewer_id ?? 0}}</td>
								<td>{{ $review->reviewee_id ?? 0 }}</td>
								<td>{{ $review->space_id ?? 0 }}</td>
								<td>{{ $review->rating ?? 0}}</td>
								<td>{{ $review->review_text ?? 'No Data'}}</td>
								<td>{{ (new DateTime($review->created_at))->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteReviewModal{{ $review->id }}">
                                        <i class="align-middle" data-feather="trash-2"></i>
                                    </button>

                                    <!--Modal-->
                                    <div class="modal fade" id="deleteReviewModal{{ $review->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Review</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this review?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form action="/dashboard/reviews/{{ $review->id }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3 ms-3">
                    {{ $reviews->links() }}
                </div>
            </div>
        </div>
	</div>	
@endsection