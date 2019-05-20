<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Personaliser') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
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

                        <!-- Deleted other navigations from here -->

                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Boxes<span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="{{ action('ProductController@getProductsByType', 'Boxes') }}">All Boxes</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ action('ProductController@getProductsByType', 'midiBoxes') }}">Gift Box</a></li>
                            <li><a href="{{ action('ProductController@getProductsByType', 'execBox1') }}">Gift Box 1</a></li>
                            <li><a href="{{ action('ProductController@getProductsByType', 'execBox3') }}">Gift Box 3</a></li>
                            <li><a href="{{ action('ProductController@getProductsByType', 'execBox4') }}">Gift Box 4</a></li>
                            <li><a href="{{ action('ProductController@getProductsByType', 'execBox5') }}">Gift Box 5</a></li>
                            <li><a href="{{ action('ProductController@getProductsByType', 'execBox6') }}">Gift Box 6</a></li>
                            <li><a href="{{ action('ProductController@getProductsByType', 'execBox7') }}">Gift Box 7</a></li>
                            <li><a href="{{ action('ProductController@getProductsByType', 'execBox8') }}">Gift Box 8</a></li>
                          </ul>
                        </li>

                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Intro Box<span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="{{ action('ProductController@getProductsByType', 'Boxes') }}">All Intro Boxes</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ action('ProductController@getProductsByType', 'midiBoxes') }}">Black Intro Box</a></li>
                            <li><a href="{{ action('ProductController@getProductsByType', 'execBox1') }}">White Intro Box</a></li>
                          </ul>
                        </li>

                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Powerbank Box<span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="{{ action('ProductController@getProductsByType', 'Boxes') }}">All Powerbank Boxes</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ action('ProductController@getProductsByType', 'midiBoxes') }}">Powerbank Box 4000mah</a></li>
                            <li><a href="{{ action('ProductController@getProductsByType', 'midiBoxes') }}">Powerbank Box 4000mah White</a></li>
                            <li><a href="{{ action('ProductController@getProductsByType', 'execBox1') }}">Powerbank Box 8000mah</a></li>
                            <li><a href="{{ action('ProductController@getProductsByType', 'execBox1') }}">Powerbank Box 8000mah White</a></li>
                          </ul>
                        </li>

                        @endif

                    </ul>
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
        
        @if(session()->has('message'))
        <div class="container">
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        </div>
        @endif

        @yield('content')
        
        <footer id="footer">
            <div class="container">
                <hr>
                &copy; LSi 2018 @if(date('Y') !== '2018') &ndash; {{ date('Y') }} @endif
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
