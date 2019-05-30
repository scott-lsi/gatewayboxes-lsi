<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            @if(\Auth::check())
            <a class="navbar-brand" href="{{ action('ProductController@index') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            @else
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            @endif
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav" >
                @if(\Auth::check())
                <li><a href="{{ action('ProductController@index') }}">All Products</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Boxes<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <li><a href="{{ action('ProductController@getProductsByType', 'Boxes') }}">All Boxes</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{ action('ProductController@getProductsByType', 'midiBoxes') }}">Midi Box</a></li>
                    <li><a href="{{ action('ProductController@getProductsByType', 'giftBoxOne') }}">Gift Box 1</a></li>
                    <li><a href="{{ action('ProductController@getProductsByType', 'giftBoxThree') }}">Gift Box 3</a></li>
                    <li><a href="{{ action('ProductController@getProductsByType', 'giftBoxFour') }}">Gift Box 4</a></li>
                    <li><a href="{{ action('ProductController@getProductsByType', 'giftBoxFive') }}">Gift Box 5</a></li>
                    <li><a href="{{ action('ProductController@getProductsByType', 'giftBoxSix') }}">Gift Box 6</a></li>
                    <li><a href="{{ action('ProductController@getProductsByType', 'giftBoxSeven') }}">Gift Box 7</a></li>
                    <li><a href="{{ action('ProductController@getProductsByType', 'giftBoxEight') }}">Gift Box 8</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ action('ProductController@getProductsByType', 'Intro Boxes') }}">Intro Box</a>
                </li>

                <li>
                    <a href="{{ action('ProductController@getProductsByType', 'Powerbank Boxes') }}">Powerbank Box</a>
                </li>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->

            <ul class="nav navbar-nav navbar-right">
                    @if(Auth::check() && Auth::user()->isAdmin())
                    <li>
                        <a href="{{ action('ProductController@getTrashed') }}">Soft Deletes</a>
                    </li>
                    <li>
                        <a href="/userreg">Make User</a>
                    </li>                       
                    @endif
                    @if(!\Auth::check())
                    <li>
                        <a href="{{ route('login') }}">Login</a>
                    </li>
                    @else
                    <li>
                        <a href="{{ action('OrderController@getOrders', ['id' => auth()->user()->id]) }}">My Orders</a>
                    </li>
                    <li>
                        <a href="{{ action('CartController@index') }}">Basket</a>
                    </li>
                    <li>
                        <a href="{{ action('HomeController@logout') }}">Log Out</a>
                    </li>
                    @endif
            </ul>
        </div>
    </div>
</nav>