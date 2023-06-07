@extends('layouts.app')

@section('content')

<div class="container">
    <h1>{{ $user->name }}'s details</h1>

    @if((\Auth::user()->company_id == 1 || $company->id == Auth::user()->company_id) && Auth::user()->isAdmin())
    <div class="row">
        <div class="col-md-1">
            <a href="/users/user/{{ $user->id }}/edit" class="btn btn-small btn-info mb-5">Edit User</a>
        </div>
        <div class="col-md-1">
            <form action="/users/user/{{ $user->id }}/delete" method="POST">
                {{ csrf_field() }}
                <button class="btn btn-danger" type="submit">Delete User</button>
            </form>
        </div>
    </div>


    <hr>
            <p><strong>Name: </strong>{{ $user->name }}</p>
            <p><strong>Email: </strong>{{ $user->email }}</p>
            <p><strong>Company: </strong>{{ !is_null($user->company_id) ? $user->company->company : 'Not Set' }}</p>
    <hr>
    @else
    Not your user
    @endif

    <a href="/users/{{ $user->company_id }}">Back to users list</a>
</div>

@endsection
