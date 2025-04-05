@extends('layouts.dashboard.layout')
@section('title', 'User Data')

@section('content')
    <div class="container">
        <h1>User Data</h1>
        <p>Here you can view the details of the user.</p>

        <div class="user-details">
            <h2>User ID: {{$id}}</h2>
            <p>Name: {{$user->first_name}} {{$user->last_name}}</p>
            <p>Email: {{$user->email}}</p>
            <p>Phone: {!! $user->phone_number ?? '<span class="badge bg-danger">no phone number</span>' !!}</p>
            <p>Bio: {!! $user->bio ?? '<span class="badge bg-danger">no bio</span>' !!}</p>
            <p>Roles: 
                @if ($userRoles && $userRoles->isNotEmpty())
                    @foreach ($userRoles as $role)
                        <span class="badge bg-primary">{{ $role->name }}</span>
                    @endforeach
                @else
                    <span class="badge bg-danger">no roles</span>
                @endif
            </p>
            <hr>
            @if ($address)
            <p>Country: {{$address->country}}</p>
            <p>City: {{$address->city}}</p>
            <p>Street: {{$address->street_address}}</p>
            <p>Postal Code: {{$address->postal_code}}</p>
            @else
            <p>No address information available.</p>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        fetch('/api/users/{{$id}}')
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })
            .catch(error => console.error('Error fetching user data:', error));
    </script>
@endsection