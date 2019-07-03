@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Basket</h1>
    
    <hr>
    
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <hr>
    @endif
    
    <div class="row">
        <div class="col-md-9">
            <table class="table">
                <thead>
                    <tr>
                        <th class="col-xs-3">Image</th>
                        <th class="col-xs-9">Product Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($basket as $row)
                    <tr>
                        <td><img src="{{ $row->options->imageurl }}" alt="{{ $row->name }}" class="img-responsive"></td>
                        <td>
                            <p>{{ $row->name }}</p>
                            
                            @if($row->options->textinputs)
                            <p>
                            <strong>Text to be printed</strong><br>
                            @foreach($row->options->textinputs as $textinput)
                            {{ $textinput }}<br>
                            @endforeach
                            </p>
                            @endif

                            <p><strong>Price:</strong> £{{ $row->price }}</p>
                            <!-- <p><strong>Total:</strong> £{{ $row->price * $row->qty }}</p>
                            
                            {!! Form::open(['action' => ['CartController@postUpdateQty', $row->rowId]]) !!}
                            <div class="row">
                                <div class="col-xs-6">
                                    {!! Form::hidden('productId', $row->id) !!}
                                    {!! Form::number('qty', $row->qty, ['class' => 'input-sm form-control']) !!}
                                </div>
                                <div class="col-xs-6">
                                    {!! Form::submit('Update Qty', ['class' => 'btn btn-primary btn-sm']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!} -->
                            
                            <p><small><a href="{{ action('CartController@getRemoveItem', ['rowId' => $row->rowId]) }}">Remove</a></small></p>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Subtotal shown at the end of cart -->
            <div class="h3">Subtotal: £{{ Cart::total() }}</div>
        </div>
        
        <div class="col-md-3">
            @if($basket->count() >= 1)
            <div class="panel panel-primary">
                <div class="panel-heading">Enter details below&hellip;</div>
                <div class="panel-body">
                    {!! Form::open(['action' => 'CartController@postToPrint']) !!}
                        
                        {!! Form::hidden('user_id', auth()->user()->id) !!}
                        {!! Form::hidden('name', auth()->user()->name) !!}

                        <div class="form-group">
                            <label for="jobref">Job Reference *</label>
                            {!! Form::text('jobref', null, ['class' => 'form-control', 'id' => 'jobref', 'required']) !!}
                        </div>

                        <div class="form-group">
                            <label for="email">Your Email Address *</label>
                            {!! Form::text('email', auth()->user()->email, ['class' => 'form-control', 'id' => 'email', 'required']) !!}
                        </div>

                        <div class="form-group">
                            <label for="compname">Company Name *</label>
                            {!! Form::text('compname', null, ['class' => 'form-control', 'id' => 'compname', 'required']) !!}
                        </div>

                        <div class="form-group">
                            <label for="telenum">Telephone Number *</label>
                            {!! Form::text('telenum', null, ['class' => 'form-control', 'id' => 'telenum', 'required']) !!}
                        </div>

                        <p for="email"><u>Address</u></p>
                        <div class="form-group">
                            <label for="addline1">Address Line 1 *</label>
                            {!! Form::text('addline1', null, ['class' => 'form-control', 'id' => 'addline1', 'required']) !!}
                        </div>
                        <div class="form-group">
                            <label for="addline2">Address Line 2</label>
                            {!! Form::text('addline2', null, ['class' => 'form-control', 'id' => 'addline2']) !!}
                        </div>
                        <div class="form-group">
                            <label for="postcode">Post Code *</label>
                            {!! Form::text('postcode', null, ['class' => 'form-control', 'id' => 'postcode', 'required']) !!}
                        </div>
                        <div class="form-group">
                            <label for="city">City *</label>
                            {!! Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'required']) !!}
                        </div>
                        <div class="form-group">
                            <label for="county">County</label>
                            {!! Form::text('county', null, ['class' => 'form-control', 'id' => 'county']) !!}
                        </div>
                        
                        <h3>Subtotal: £{{ Cart::total() }}</h3>
                        {!! Form::submit('Send To Print', ['class' => 'btn btn-block btn-primary']) !!}
                        
                    {!! Form::close() !!}
                </div>
            </div>
            @endif
        </div>
    </div>
    
</div>

@endsection
