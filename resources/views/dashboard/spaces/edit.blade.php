@extends('layouts.dashboard.layout')
@section('title', 'Edit User')
@section('content')
    <div class="row">
        <h1>Edit Space #{{$space->id}}</h1>
        
        <form action="/dashboard/spaces/{{ $space->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $space->title) }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ old('description', $space->description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="street_address">Street Address</label>
                <input type="text" name="street_address" id="street_address" class="form-control" value="{{ old('street_address', $space->street_address) }}" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $space->city) }}" required>
            </div>
            <div class="form-group">
                <label for="state">State</label>
                <input type="text" name="state" id="state" class="form-control" value="{{ old('state', $space->state) }}">
            </div>
            <div class="form-group">
                <label for="postal_code">Postal Code</label>
                <input type="text" name="postal_code" id="postal_code" class="form-control" value="{{ old('postal_code', $space->postal_code) }}" required>
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" name="country" id="country" class="form-control" value="{{ old('country', $space->country) }}" required>
            </div>
            <div class="form-group">
                <label for="latitude">Latitude</label>
                <input type="text" name="latitude" id="latitude" class="form-control" value="{{ old('latitude', $space->latitude) }}">
            </div>
            <div class="form-group">
                <label for="longitude">Longitude</label>
                <input type="text" name="longitude" id="longitude" class="form-control" value="{{ old('longitude', $space->longitude) }}">
            </div>
            <div class="form-group">
                <label for="capacity">Capacity</label>
                <input type="number" name="capacity" id="capacity" class="form-control" value="{{ old('capacity', $space->capacity) }}" required>
            </div>
            <div class="form-group">
                <label for="hourly_rate">Hourly Rate</label>
                <input type="number" name="hourly_rate" id="hourly_rate" class="form-control" value="{{ old('hourly_rate', $space->hourly_rate) }}" required>
            </div>
            <div class="form-group">
                <label for="min_booking_duration">Min Booking Duration (in hours)</label>
                <input type="number" name="min_booking_duration" id="min_booking_duration" class="form-control" value="{{ old('min_booking_duration', $space->min_booking_duration) }}" required>
            </div>
            <div class="form-group">
                <label for="max_booking_duration">Max Booking Duration (in hours)</label>
                <input type="number" name="max_booking_duration" id="max_booking_duration" class="form-control" value="{{ old('max_booking_duration', $space->max_booking_duration) }}">
            </div>
            <div class="form-group">
                <label for="is_active">Is Active</label>
                <select name="is_active" id="is_active" class="form-control">
                    <option value="1" {{ old('is_active', $space->is_active) == 1 ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('is_active', $space->is_active) == 0 ? 'selected' : '' }}>No</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Space</button>
            <a href="/dashboard/spaces" class="btn btn-secondary">Back to Spaces</a>
        </form>
    </div>
@endsection