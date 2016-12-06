<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>App</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    
    <!-- Angular -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
        .footer {
        height: 50px;
        }
        .menu_items li{
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }
        .menu_items i{
           font-size: 30px;
           margin-top: 5px; 
        }
        .nav.navbar-nav li a {
            color: #666666;           
        }
        .nav.navbar-nav li a:hover {
            color: #333333;
            animation: hover_effect 1s infinite;
        }
        .navbar {
            background-color: #b3b3ff;
        }
        .navbar-center {
            display: table;
            margin: auto;
        }
        .navbar-right {
            float: right;
        }
        
        @keyframes hover_effect {
            0% {color: #666666;}
            50% {color: #333333;}
            100% {color: #666666;}
        }
    @yield('style')
    </style>
</head>
<body id="app-layout">
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

            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <div class="navbar-center">
                <ul class="nav navbar-nav menu_items">
                    <li><a href="{{ url('/post') }}">Posts<br/><i class="fa fa-btn fa-file-text"></i></a></li>
                    @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login<br/><i class="fa fa-btn fa-sign-in"></i></a></li>
                    <li><a href="{{ url('/register') }}">Register<br/><i class="fa fa-btn fa-user-plus"></i></a></li>
                    @else
                    <li><a href="{{ url('/logout') }}">Logout<br/><i class="fa fa-btn fa-sign-out"></i></a></li>
                    @endif 
                </ul>
                </div>

            </div>
        </div>
    </nav>

    @yield('content')
    
    <div class="footer"></div>
    
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    @yield('script')
</body>
</html>
