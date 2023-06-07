@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Edit Company</h1>
    
    <form action="{{ route('company.update', $company) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        
        <div class="form-group">
            <label for="company">Company Name</label>
            <input type="text" name="company" id="company" value="{{ $company->company }}" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="free_budget">Free Budget</label>
            <input type="text" name="free_budget" id="free_budget" value="{{ $company->free_budget }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

@endsection