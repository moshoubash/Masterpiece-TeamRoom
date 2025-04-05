@extends('layouts.dashboard.layout')
@section('title', 'Space Data')

@section('content')
    <div class="container">
        <h1>Space #{{$id}} Details</h1>
        <p>Here you can view the details of the space.</p>

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
                        <td>Host ID</td>
                        <td>{{ $space->host_id }}</td>
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td>{{ $space->title }}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>{{ $space->description }}</td>
                    </tr>
                    <tr>
                        <td>Street Address</td>
                        <td>{{ $space->street_address }}</td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>{{ $space->city }}</td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td>{{ $space->state }}</td>
                    </tr>
                    <tr>
                        <td>Postal Code</td>
                        <td>{{ $space->postal_code }}</td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>{{ $space->country }}</td>
                    </tr>
                    <tr>
                        <td>Latitude</td>
                        <td>{{ $space->latitude }}</td>
                    </tr>
                    <tr>
                        <td>Longitude</td>
                        <td>{{ $space->longitude }}</td>
                    </tr>
                    <tr>
                        <td>Capacity</td>
                        <td>{{ $space->capacity }}</td>
                    </tr>
                    <tr>
                        <td>Hourly Rate</td>
                        <td>{{ $space->hourly_rate }}</td>
                    </tr>
                    <tr>
                        <td>Min Booking Duration</td>
                        <td>{{ $space->min_booking_duration }}</td>
                    </tr>
                    <tr>
                        <td>Max Booking Duration</td>
                        <td>{{ $space->max_booking_duration }}</td>
                    </tr>
                    <tr>
                        <td>Is Active</td>
                        <td>{{ $space->is_active ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td>Is Deleted</td>
                        <td>{{ $space->is_deleted ? 'Yes' : 'No' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!--Future Sections-->
        
        <!--Images-->

        <!--Address-->
        
        <!--Host Details-->
        
        <!--Amenities-->
        
        <!--Reviews-->
    </div>
@endsection