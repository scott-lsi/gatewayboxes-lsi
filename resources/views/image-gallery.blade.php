@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Gallery</h1>
    <h4>Hover for box details</h4>
    <hr>
    
    <div class="row">

        <?php $i = 1; ?>
        @foreach($images as $image)

        <div class="col-sm-3 text-center box">
            <?php
                if(strncmp($image->image, 'http', 4) === 0){
                    $imageurl = $image->image;
                } else {
                    $imageurl = asset('gallery/' . $image->image);
                }
            ?>
            <a href="{{ $imageurl }}" data-toggle="lightbox">
                <div class="imgBox">
                    <img src="{{ $imageurl }}" alt="{{ $image->title }}" class="img-responsive thumbnail">
                </div>
                
                <div class="title-box">
                    <div class="title">
                        <h2>{{ $image->title }}</h2>
                    </div>
                </div>
            </a>

        </div>

		<?php if($i % 4 === 0){ echo '<div class="clearfix"></div>'; } ?>
        <?php $i++; ?>
        
        @endforeach

        
    </div>
    
    <!-- Links for the pagination -->
    <div class="text-center">
        {{ $images->links() }}
    </div>
    
</div>

@endsection