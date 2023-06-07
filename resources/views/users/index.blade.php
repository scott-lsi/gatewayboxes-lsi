@extends('layouts.app')

@section('content')

<div class="container">
    @if(\Auth::user()->company_id == 1 && Auth::user()->isAdmin())
        <div>
            <h2 class="h5">Select A Company</h2>
            @foreach(\App\Company::all() as $button_company)
                <a href="{{ action('UsersController@index', $button_company->id) }}" class="btn {{ request()->companyid == $button_company->id ? 'btn-primary' : 'btn-default' }}">{{ $button_company->company }}</a>
            @endforeach
            <br><br>
            <a href="{{ action('UsersController@index') }}" class="btn btn-primary">Users with No Company Set</a><br>
        </div>

        <hr>
    @endif

    @if(!is_null($company))
        <h1>Users for {{ $company->company }}</h1>

        <h4>Click on a users name for more actions</h4>

        @if((\Auth::user()->company_id == 1 || $company->id == Auth::user()->company_id) && Auth::user()->isAdmin())
            <a class="btn btn-primary" href="/userreg">Make New User</a>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th>Employee Name</th>
                        <th>Email Address</th>
                        <th>Company Name</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($company->users as $user)
                    <tr>
                        <td><a href="/users/user/{{ $user->id }}">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $company->company }}</td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        @else
            Not your company
        @endif
    @elseif(Auth::user()->isAdmin())
        <h3>Users with no company set</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Email Address</th>
                </tr>
            </thead>
            <tbody>
            @foreach(\App\User::whereNull('company_id')->get() as $user)
                <tr>
                    <td><a href="/users/user/{{ $user->id }}">{{ $user->name }}</a></td>
                    <td>{{ $user->email }}</td>
                </tr>

            @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
