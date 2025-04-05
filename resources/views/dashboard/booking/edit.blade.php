@extends('layouts.dashboard.layout')
@section('title', 'Edit Booking')
@section('content')
    <div class="row">
        <h1>Edit Booking #{{$id}}</h1>

        <form action="{{ route('bookings.update', $id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="space_id">Space ID</label>
                <input type="number" name="space_id" id="space_id" class="form-control" value="{{ old('space_id', $booking->space_id) }}" required>
            </div>
            <div class="form-group">
                <label for="renter_id">Renter ID</label>
                <input type="number" name="renter_id" id="renter_id" class="form-control" value="{{ old('renter_id', $booking->renter_id) }}" required>
            </div>
            <div class="form-group">
                <label for="start_datetime">Start Date & Time</label>
                <input type="datetime-local" name="start_datetime" id="start_datetime" class="form-control" value="{{ old('start_datetime', $booking->start_datetime) }}" required>
            </div>
            <div class="form-group">
                <label for="end_datetime">End Date & Time</label>
                <input type="datetime-local" name="end_datetime" id="end_datetime" class="form-control" value="{{ old('end_datetime', $booking->end_datetime) }}" required>
            </div>
            <div class="form-group">
                <label for="num_attendees">Number of Attendees</label>
                <input type="number" name="num_attendees" id="num_attendees" class="form-control" value="{{ old('num_attendees', $booking->num_attendees) }}">
            </div>
            <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ old('status', $booking->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="cancelled" {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                <option value="completed" {{ old('status', $booking->status) == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
            </div>
            <div class="form-group">
                <label for="total_price">Total Price</label>
                <input type="number" name="total_price" id="total_price" class="form-control" value="{{ old('total_price', $booking->total_price) }}" required>
            </div>
            <div class="form-group">
                <label for="service_fee">Service Fee</label>
                <input type="number" name="service_fee" id="service_fee" class="form-control" value="{{ old('service_fee', $booking->service_fee) }}" required>
            </div>
            <div class="form-group">
                <label for="host_payout">Host Payout</label>
                <input type="number" name="host_payout" id="host_payout" class="form-control" value="{{ old('host_payout', $booking->host_payout) }}" required>
            </div>
            <div class="form-group">
                <label for="cancellation_reason">Cancellation Reason</label>
                <textarea name="cancellation_reason" id="cancellation_reason" class="form-control">{{ old('cancellation_reason', $booking->cancellation_reason) }}</textarea>
            </div>
            <div class="form-group">
                <label for="cancelled_by">Cancelled By</label>
                <input type="text" name="cancelled_by" id="cancelled_by" class="form-control" value="{{ old('cancelled_by', $booking->cancelled_by) }}">
            </div>
            <button type="submit" class="btn btn-primary">Update Booking</button>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        document.querySelector('form').addEventListener('submit', async function (event) {
            event.preventDefault();
            
            const formData = new FormData(this);
            
            const id = "{{ $id }}";
            const url = `/api/bookings/${id}`;

            try {
                const response = await fetch(url, {
                    method: 'PUT',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok) {
                    window.location = '{{ route('bookings.index') }}';
                } 
                else {
                    alert('Failed to update booking: ' + (data.message || 'Unknown error'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while updating the booking.');
            }
        });
    </script>
@endsection