@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Create Company</h1>
    
    <form action="{{ route('company.store') }}" method="POST">
        {{ csrf_field() }}
        
        <div class="form-group">
            <label for="company">Company Name</label>
            <input type="text" name="company" id="company" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="free_budget">Free Budget</label>
            <input type="text" name="free_budget" id="free_budget" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>

@endsection