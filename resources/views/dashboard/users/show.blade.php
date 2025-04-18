@extends('layouts.dashboard.layout')
@section('title', 'User Data')

@section('content')
    <div class="container">
        <h1>User Data</h1>
        <p>Here you can view the details of the user.</p>

        <div class="user-details">
            <h2>User ID: {{$user->id}}</h2>
            <p>Name: {{$user->first_name}} {{$user->last_name}}</p>
            <p>Email: {{$user->email}}</p>
            <p>Phone: {!! $user->phone_number ?? '<span class="badge bg-danger">no phone number</span>' !!}</p>
            <p>Bio: {!! $user->bio ?? '<span class="badge bg-danger">no bio</span>' !!}</p>
            <p>Roles: 
                @if ($user->roles && $user->roles->isNotEmpty())
                    @foreach ($user->roles as $role)
                        <span class="badge bg-primary">{{ $role->name }}</span>
                    @endforeach
                @else
                    <span class="badge bg-danger">no roles</span>
                @endif
            </p>
            <hr>
            @if ($user->address)
            <p>Country: {{$user->address->country}}</p>
            <p>City: {{$user->$address->city}}</p>
            <p>Street: {{$user->$address->street_address}}</p>
            <p>Postal Code: {{$user->$address->postal_code}}</p>
            @else
            <p>No address information available.</p>
            @endif
        </div>
    </div>
@endsection