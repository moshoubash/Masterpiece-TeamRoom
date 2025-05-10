@extends('layouts.dashboard.layout')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Company Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Company Information</h4>
                            <table class="table">
                                <tr>
                                    <th>Company Name:</th>
                                    <td>{{ $company->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $company->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td>{{ $company->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Address:</th>
                                    <td>{{ $company->city }} - {{ $company->street }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4>Host Details</h4>
                            <table class="table">
                                <tr>
                                    <th>Host Name:</th>
                                    <td>{{ $company->user->first_name }} {{ $company->user->last_name }}</td>
                                </tr>
                                <tr>
                                    <th>Host Email:</th>
                                    <td>{{ $company->user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Host Phone:</th>
                                    <td>{{ $company->user->phone_number ?? +9620000000 }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <h4>Company Location</h4>
                            <div id="map" style="height: 400px;"></div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('companies.index') }}" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left me-2"></i>
                        Back to Companies
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const map = L.map('map').setView([{{ $company->latitude }}, {{ $company->longitude }}], 13);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([{{ $company->latitude }}, {{ $company->longitude }}])
                .addTo(map)
                .bindPopup("{{ $company->name }}")
                .openPopup();
        });
    </script>
@endsection