@extends('layouts.dashboard.layout')
@section('title', 'Transaction Data')

@section('content')
    <div class="container">
        <h1>Transaction #{{$transaction->id}} Details</h1>
        <p>Here you can view the details of the transaction.</p>

        <div class="card">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Booking ID</td>
                        <td>{{ $transaction->booking_id }}</td>
                    </tr>
                    <tr>
                        <td>Amount $</td>
                        <td>{{ $transaction->amount }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>{{ $transaction->status }}</td>
                    </tr>
                    <tr>
                        <td>Transaction Type</td>
                        <td>{{ $transaction->transaction_type }}</td>
                    </tr>
                    <tr>
                        <td>Payment Method</td>
                        <td>{{ $transaction->payment_method }}</td>
                    </tr>
                    <tr>
                        <td>Created At</td>
                        <td>{{ $transaction->created_at }}</td>
                    </tr>
                    <tr>
                        <td>Updated At</td>
                        <td>{{ $transaction->updated_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <a href="/dashboard/transactions" class="btn btn-primary">Back to transactions</a>
    </div>
@endsection