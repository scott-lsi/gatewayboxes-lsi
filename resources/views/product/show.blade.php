@extends('layouts.app')

@section('content')

<div class="container">
    <h1>{{ $product->name }}</h1>
    <hr>

    <div class="row">
        <div class="col-md-5">
            @if($product->images->count())
            <div id="product-main-image" style="background-image: url({{ asset('products/' . $product->images->first()->image) }}); background-size: cover;">
                <?php if(strncmp($product->image, 'http', 4) === 0){ ?>
                    <img src="{{ $product->images->first()->image }}" alt="{{ $product->name }}" class="img-responsive">
                <?php } else { ?>
                    <img src="{{ asset('products/' . $product->images->first()->image) }}" alt="{{ $product->name }}" class="img-responsive">
                <?php } ?>
            </div>
            @else
            <div id="product-main-image">
                <img src="{{ asset('products/placeholder.png') }}" alt="{{ $product->name }}" class="img-responsive">
            </div>
            @endif

            <div id="product-thumbnails" style="margin-top: 30px;">
                <div class="row">
                @foreach($product->images as $image)
                    <div class="col-xs-3 thumbnail-wrapper">
                        <a href="{{ asset('products/' . $image->image) }}">
                            <img src="{{ asset('products/' . $image->image) }}" alt="{{ $product->name }}" class="img-responsive">
                        </a>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
        
        <div class="col-md-7">
            {!! $product->description !!}
            
            <p>£{{ $product->price }}</p>
            <p>Cost is per item (delivery charges not included)</p>
            <p>Foam inlay and products sold separately</p>
            
            @if($product->gateway)
            <p>You may personalise this product</p>
            
            <p><a href="{{ action('ProductController@personaliser', $product->id) }}" class="btn btn-primary hidden-xs hidden-sm">Personalise Now</a> </p>
            <p><a href="{{ $mobileUrl }}" class="btn btn-primary hidden-lg hidden-md">Personalise Now</a> </p>
            @endif
            
            @if($product->gatewaymulti)
            <p>This is a multi-part product: You may personalise all products in this pack</p>
            
            <p><a href="{{ action('ProductController@personaliser', [json_decode($product->gatewaymulti, true)[1], $product->id]) }}" class="btn btn-primary">Personalise Now</a> </p>
            @endif
        </div>
    </div>
</div>

@endsection
