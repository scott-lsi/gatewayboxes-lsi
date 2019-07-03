@extends('layouts.app')

@section('content')

<div class="container">
    <h1>{{ config('app.name', 'Personaliser') }}</h1>
    <h3 class="text-muted">You are logged in.</h3>
    <br>
    
    <div class="container">
        <p class="lead">Welcome to your very own bespoke box portal for sampling purposes. 
        Here you can create bespoke boxes featuring your prospective clients logo or design. 
        Once created add to cart and we will print and dispatch within 3 days.</p>    
    </div>
    <br>
    <div class="container">
        <p class="lead">Bespoke boxes are a fantastic way to add value to yours or your clients merchandise/giveaways. 
        Gift boxes are used currently for product launches, onboarding gifts, thankyou and commemerative gifts. 
        Help your customers stay ahead of their competition and create a positive first impression.</p>
    </div>
    <br>
    <div class="container">
        <p class="lead">Once you have gained your clients interest in the produc and discussed what products may feature in the box,
        please call Dan on 01274 854977 or Oliver on 01274 854963 for help and advice. They will guide you through the process
        of having products in the box and provide layout designs free of cost.<br>
        Once your client is happy with the proposed layout, should? you wish to see a finished sample with foam in lay this laser
        sample is charged at £25, any subsequent changes to the layout and further samples will be charged at £15 each.</p>
    </div>
    <br>
    <div class="container">
        <p class="lead">As a new user your first 10 box designs are free of cost. Following that we will invoice you ___ for any box
        designs you order via the portal (Payment terms are 30 days ___ of month end). Late payment of invoiced will result in your
        access to the portal being suspended.<br>
        Boxes are limited to one box one design - should you require more than one box for your chosen design, you just speak to 
        Dan or Oliver who can help.</p>
    </div>
    <br>
    <p><a href="{{ action('ProductController@index') }}" class="btn btn-md btn-primary">Click to view the product list</a></p>
    
    
</div>

@endsection

