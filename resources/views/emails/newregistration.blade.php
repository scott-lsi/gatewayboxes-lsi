@extends('emails.master')

@section('title', 'New Registration')

@section('content')

<tr>
	<td>
        <p>{{ $name }} from {{ $company }} has registered</p>
    </tr>
</td>

@endsection