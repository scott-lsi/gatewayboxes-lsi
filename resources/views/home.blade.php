@extends('layouts.app')

@section('content')

<div class="container">
    
    <div class="row">
        <div class="col-sm-4">
            <h1>{{ config('app.name', 'Personaliser') }}</h1>
            <!-- <h3 class="text-muted">You are logged in.</h3> -->
        </div>
        <div class="col-sm-8 text-right">
            <p class="lead">Oliver: <span class="text-primary">01274 854963</span><br>Dan: <span class="text-primary">01274 854977</span><br>Email: <span class="text-primary">sales@thinkinsidethebox.online</span></p>
        </div>
    </div>

    <br>

    <!-- WELCOME SECTION -->
    <div class="row">
        <div class="col-sm-2">
            <img src="{{ asset('images/homepage/welcome.jpg') }}" style="width: 150px;" alt="Welcome">
        </div>
        <div class="col-sm-10 text-center">
            <p style="font-size: 16px;">
            Welcome to your very own bespoke box portal for sampling purposes.
            <br>
            Here you can create bespoke boxes featuring your prospective clients logo or design. 
            This is done using our online designer, which allows you to live edit the box, making the process simple and efficient. 
            Once you have created your sample box, add it to the cart and we will print and dispatch your order within 3 days.
            </p>
        </div>
    </div>
</div>
<hr>

    <!-- BANNER SECTION -->
    <a href="{{ action('ProductController@getProductsByType', 'Boxes') }}"><img class="img-responsive" src="{{ asset('images/homepage/banner.jpg') }}" alt="big"></a>



    <!-- MODAL SECTIONS -->
<div class="container">
    <hr>
    <div class="row">
        <div class="col-sm-4 text-center">
            <a href="" data-toggle="modal" data-target="#modal-fi"><img id="img1" src="{{ asset('images/homepage/fimpression.jpg') }}" style="width: 200px;" alt="First Impressions"></a>
        </div>
        <div class="col-sm-4 text-center">
            <a href="" data-toggle="modal" data-target="#modal-hl"><img id="img2" src="{{ asset('images/homepage/helpline.jpg') }}" style="width: 200px;" alt="Help Line"></a>
        </div>
        <div class="col-sm-4 text-center">
            <a href="" data-toggle="modal" data-target="#modal-tou"><img id="img3" src="{{ asset('images/homepage/tou.jpg') }}" style="width: 200px;" alt="Terms of use"></a>
        </div>
    </div>

    <div id="modal-fi" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">First Impressions</h4>
            </div>
            <div class="modal-body">
                <p>Bespoke boxes are a fantastic way to add value to yours or your clients merchandise/giveaways. 
                Gift boxes are used currently for product launches, onboarding gifts, thankyou and commemorative gifts. 
                Help your customers stay ahead of their competition and create a positive first impression.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <div id="modal-hl" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Help Line</h4>
            </div>
            <div class="modal-body">
                <p>Once you have gained your clients interest in the product and discussed what products may feature in the box,
                please call <strong class="text-primary">Dan on 01274 854977</strong> or <strong class="text-primary">Oliver on 01274 854963</strong> for help and advice. They will guide you through the process
                of housing products in the box and provide layout designs free of cost.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <div id="modal-tou" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Terms of Use</h4>
            </div>
            <div class="modal-body">
                <p>
                    As a new user your first 10 box designs are free of charge. Following that we will invoice you monthly for any box
                    designs you order via the portal (Payment terms are 30 days nett of month end). Late payment of invoices will result in your
                    access to the portal being suspended.<br>
                    Boxes are limited to 1 box 1 design - should you require more than 1 box for your chosen design, you just speak to 
                    Dan or Oliver who can help.
                </p>
                <p>
                    Once your client is happy with the proposed layout, should you wish to see a finished sample with foam inlay this laser
                    sample is charged at £25, any subsequent changes to the layout and further samples will be charged at £15 each.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <hr>
    <p><a href="{{ action('ProductController@index') }}" class="btn btn-md btn-primary">Click to view the product list</a></p>
    
    
</div>

@endsection

