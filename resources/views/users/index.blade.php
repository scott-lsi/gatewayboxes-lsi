@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Users for {{ $company->company }}</h1>
    <h4>Click on a users name for more actions</h4>
    
    

    @if($company->id !== Auth::user()->company_id)
    Not your company
    @else 
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
    @endif

    
    
    
</div>

@endsection
