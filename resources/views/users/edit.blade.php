@extends('layouts.app')

@section('title', 'Edit Details for ' . $user->name)

@section('content')
<div class="container">
    @if((\Auth::user()->company_id == 1 || $company->id == Auth::user()->company_id) && Auth::user()->isAdmin())
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @if(Auth::check() && Auth::user()->isAdmin())
                
                    <div class="panel-heading">Edit Details for {{ $user->name }}</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ action('UsersController@update', $user->id) }}">
                            {{ csrf_field() }}
                            
                            @include('users.form')

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save User
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @else
                <h2 class="panel-heading">Sorry, you've reached an unavailable page.<br><br>Please navigate using the links above.</h2>
                @endif
            </div>
        </div>
    </div>
    @else
    <h3>Can't edit this user as they do not belong to your company.</h3>
    @endif
@endsection
