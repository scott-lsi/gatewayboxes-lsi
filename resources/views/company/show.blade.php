@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Company: {{ $company->company }}</h1>

    <p class="lead">Free Budget: &pound;{{ number_format($company->free_budget, 2) }}</p>
    
    <p><a href="{{ route('company.edit', $company) }}" class="btn btn-primary">Edit company</a></p>

    <h2>Users</h2>

    @if($company->users->count())
        <table class="table">
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Email Address</th>
                </tr>
            </thead>
            <tbody>
            @foreach($company->users as $user)
                <tr>
                    <td><a href="/users/user/{{ $user->id }}">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                </tr>

            @endforeach
            </tbody>
        </table>
    @else
        <p>No users found</p>
        <p><a href="{{ action('UsersController@index') }}" class="btn btn-primary">Add users to this company</a></p>
    @endif
</div>

@endsection