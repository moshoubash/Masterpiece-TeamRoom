@extends('layouts.dashboard.layout')
@section('title', 'Transactions')
@section('content')
	<h1 class="h3 mb-3"><strong>Transactions</strong></h1>

	<div class="row">
		<div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Transactions</h5>
                </div>
                <table class="table table-hover my-0 table-striped">
                    <thead>
                        <tr>
                            <th>Booking id</th>
							<th>Transaction type</th>
							<th>Amount</th>
							<th>Status</th>
							<th>Payment_method</th>
							<th>Created_at</th>
							<th>Updated_at</th>
							<th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @foreach ($transactions->sortByDesc('created_at') as $transaction)
                            <tr>
								<td>{{ $transaction->booking_id ?? 0}}</td>
								<td>{{ $transaction->transaction_type ?? 'No Data'}}</td>
								<td>{{ $transaction->amount ?? 'No Data'}}</td>
								<td>
									@if($transaction->status == 'pending')
										<span class="badge bg-warning">Pending</span>
									@elseif($transaction->status == 'completed')
										<span class="badge bg-success">Completed</span>
									@elseif($transaction->status == 'failed')
										<span class="badge bg-danger">Failed</span>
									@endif
								</td>
								<td>{{ $transaction->payment_method ?? 'No Data'}}</td>
								<td>{{ (new DateTime($transaction->created_at))->format('Y-m-d H:i:s') }}</td>
								<td>{{ (new DateTime($transaction->updated_at))->format('Y-m-d H:i:s') }}</td>
								<td>
									<a href="/dashboard/transactions/{{ $transaction->id }}/edit" class="btn btn-primary">
										<i class="fa-solid fa-edit"></i>
									</a>
									<form action="/dahsboard/transactions/{{ $transaction->id }}" method="post">
										@csrf
										@method('DELETE')
										<button class="btn btn-danger">
											<i class="fa-solid fa-trash"></i>
										</button>
									</form>
									<a href="/dashboard/transactions/{{ $transaction->id }}" class="btn btn-dark">
										<i class="fa-solid fa-info-circle"></i>
									</a>
								</td>
							</tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3 ms-3">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
	</div>
@endsection