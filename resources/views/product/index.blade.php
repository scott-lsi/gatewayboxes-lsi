@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-sm-6">
            <h1>All Products</h1>
            <h4>Length x Width x Depth</h4>
        </div>
        <div class="col-sm-6">
            <h4 class="text-right">Free Orders: 
                <?php 
                if($companyOrders <= 0) {
                    echo "0";
                } else {
                    echo "$companyOrders remaining";
                }?>
            </h4>
        </div>
    </div>

    <hr>
    
    <div class="row">

        <?php $i = 1; ?>
        @foreach($products as $product)

        <div class="col-sm-3 text-center">
            <a href="{{ action('ProductController@show', $product->id)}}">
                <?php
                    if(strncmp($product->image, 'http', 4) === 0){
                        $imageurl = $product->image;
                    } else {
                        $imageurl = asset('products/' . $product->image);
                    }
                ?>
                <img src="{{ $imageurl }}" alt="{{ $product->name }}" class="img-responsive thumbnail">
                <div class="h3" style="margin-bottom: 10px;">{{ $product->name }}</div>
                <div class="h4" style="margin-bottom: 20px;">{{ $product->dimensions }}</div>
            </a>
        </div>

		<?php if($i % 4 === 0){ echo '<div class="clearfix"></div>'; } ?>
        <?php $i++; ?>
        
        @endforeach
    </div>
</div>

@endsection