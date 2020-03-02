@extends('emails.master')

@section('title', 'Contact Form')

@section('content')

<tr>
	<td>
        <p style="font-size:14px; margin-top:30px; margin-bottom:20px;">You received a message from: {{ $request['name'] }}</p>
        <p style="font-size:14px; margin-top:10px; margin-bottom:20px;">Name: {{ $request['name'] }}</p>
        <p style="font-size:14px; margin-top:10px; margin-bottom:20px;">Email: {{ $request['email'] }}</p>
        <p style="font-size:14px; margin-top:10px; margin-bottom:20px;">Message: {{ $request['message'] }}</p>
	</td>
</tr>
<tr>
	<td>
		<img src="{{ asset('images/emails/hr.png') }}" style="display:block" border="0" />
	</td>
</tr>

@endsection