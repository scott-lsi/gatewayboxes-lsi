@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Companies</h1>

    <p><a href="{{ route('company.create') }}" class="btn btn-primary">Create Company</a></p>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Budget</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $company)
                <tr>
                    <td><a href="{{ route('company.show', $company) }}">{{ $company->company }}</a></td>
                    <td>&pound;{{ number_format($company->budget, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection