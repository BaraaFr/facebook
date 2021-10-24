<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    {{Html::style('css/style.css')}}
    <style>
    .row-nav{
         margin:1rem !important;
    }
    </style>
        
</head>
<body>
{{--     <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{url('/')}}">Home</a>
                  </li>
            
                <li class="nav-item">
                <a class="nav-link {{Request::is('Login')?'active':''}}" aria-current="page" href="{{ route('login') }}">Login</a>
                </li>
            @if (Route::has('register'))
                <li class="nav-item {{Route::is('register')?'active':''}}">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
                                 
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                    </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
               @endguest
           </ul>
            </div>
       </div>
            </div>
        </nav>
    </div> --}}
    <div class="row row-nav">
        <div class="col-md-11">
            <ul class="nav nav-tabs">
        @guest
              <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{url('/')}}">Home</a>
              </li>
        
              <li class="nav-item">
                <a class="nav-link {{Request::is('login')?'active':''}}" aria-current="page" href="{{ route('login') }}">{{__('Login')}}</a>
              </li>
            <li class="nav-item">
                <a class="nav-link {{Request::is('register')?'active':''}}" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            
        @endguest
        @auth
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{url('/')}}">Home</a>
            </li>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        @endauth    
        
    </div>
    <div class="col-md-1">
        @yield('dropdown')
    </div>
    </ul>
</div>
    <main class="py-4">
        @yield('content')
    </main>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</html>
