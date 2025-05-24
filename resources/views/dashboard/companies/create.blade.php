@extends('layouts.dashboard.layout')
@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
@endsection
@section('content')
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show align-items-center" role="alert">
            <p>{{ session('error') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('success'))
        <div class="alert alert-success alert-dismissible fade show align-items-center" role="alert">
            <p>{{ session('success') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0"><strong>Company Registration</strong></h1>
            </div>
        </div>
    </div>

    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- Company Information -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Company Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="website" class="form-label">Website</label>
                            <input type="url" class="form-control" id="website" name="website">
                        </div>
                        <div class="mb-3">
                            <label for="logo" class="form-label">Company Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address Information -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Address Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="mb-3">
                            <label for="street" class="form-label">Street</label>
                            <input type="text" class="form-control" id="street" name="street" required>
                        </div>
                        <div class="mb-3">
                            <label for="apartment" class="form-label">Apartment</label>
                            <input type="text" class="form-control" id="apartment" name="apartment">
                        </div>
                        <div class="mb-3">
                            <label for="floor" class="form-label">Floor</label>
                            <input type="number" class="form-control" id="floor" name="floor">
                        </div>
                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">
                        <div id="map" style="height: 200px;" class="mb-3"></div>
                    </div>
                </div>
            </div>

            <!-- Host Information -->
            <div class="col-md-12 mb-2">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Host Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="host_first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="host_first_name"
                                        name="host_first_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="host_last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="host_last_name" name="host_last_name"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="host_email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="host_email" name="host_email"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="host_profile_picture" class="form-label">Profile Picture</label>
                                    <input type="file" class="form-control" id="host_profile_picture"
                                        name="host_profile_picture" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="host_password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="host_password" name="host_password"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="host_password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="host_password_confirmation"
                                        name="host_password_confirmation" required>
                                </div>
                                <div class="mb-3">
                                    <label for="host_phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="host_phone" name="host_phone"
                                        required>
                                </div>
                            </div>
                            <input type="hidden" name="company_name" id="host_company_name">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Create Company</button>
                <a href="{{ route('companies.index') }}" class="btn btn-secondary">
                    Back to Companies
                </a>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Initialize map
        var map = L.map('map').setView([31.9539, 35.9106], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        var marker;

        map.on('click', function(e) {
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker(e.latlng).addTo(map);

            document.getElementById('latitude').value = e.latlng.lat;
            document.getElementById('longitude').value = e.latlng.lng;
        });

        document.getElementById('name').addEventListener('input', function(e) {
            document.getElementById('host_company_name').value = document.getElementById('name').value;
        });
    </script>
@endsection