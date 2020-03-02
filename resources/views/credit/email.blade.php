@extends('emails.master')

@section('title', 'Contact Form')

@section('content')

<table cellpadding="5" cellspacing="0" border="0" width="100%" align="center">
    @foreach($request as $key=>$value)
    @if($key !== '_token' && !is_null($value))
    <tr>
        <td valign="top">{{ title_case(str_replace('_', ' ', $key)) }}</td>
        <td>
            {!! nl2br($value) !!}
        </td>
    </tr>
    @endif
    @endforeach
</table>

@endsection