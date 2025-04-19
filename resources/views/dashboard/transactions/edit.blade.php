@extends('layouts.dashboard.layout')
@section('title', 'Edit Transaction')
@section('content')
    <div class="row">
        <h1>Edit Space #{{$transaction->id}}</h1>
        
        <form action="/dashboard/transactions/{{ $transaction->id }}" method="POST">
            @csrf
            @method('PUT')

            <!--Booking Id-->
            <input type="hidden" name="booking_id" value="{{ $transaction->booking_id }}">

            <div class="form-group">
                <label for="transaction_type">Transaction Type</label>
                <input type="text" name="transaction_type" id="transaction_type" class="form-control" value="{{ old('transaction_type', $transaction->transaction_type) }}" @readonly(true) required>
            </div>

            <div class="form-group">
                <label for="amount">Amount</label>
                <input name="amount" id="amount" class="form-control" required value={{ old('amount', $transaction->amount) }} @readonly(true)>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="pending" {{ old('status', $transaction->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ old('status', $transaction->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="failed" {{ old('status', $transaction->status) == 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <input type="text" name="payment_method" id="payment_method" class="form-control" value="{{ old('payment_method', $transaction->payment_method) }}" @readonly(true) required>
            </div>
            
            <button type="submit" class="btn btn-primary">Update Transaction</button>
            <a href="/dashboard/transactions" class="btn btn-secondary">Back to Transactions</a>
        </form>
    </div>
@endsection