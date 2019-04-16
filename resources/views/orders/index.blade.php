@extends('layouts.app')

@section('content')

<div class="container">
    <h1>My Orders</h1>
    <h4>Click the date to view order</h4>
    <hr>

    <table class="table">
		<thead>
			<tr>
				<th>Created At</th>
				<th>Company Name</th>
			</tr>
		</thead>
		<tbody>
    	@foreach($orders as $order)
			<tr>
				<td><a href="{{ action('OrderController@getOrder', ['id' => $order['id']]) }}">{{ $order['created_at'] }}</a></td>
				<td>{{ $order['compname'] }}</td>
			</tr>

    	@endforeach
    	</tbody>
	</table>
    
    
</div>

@endsection
