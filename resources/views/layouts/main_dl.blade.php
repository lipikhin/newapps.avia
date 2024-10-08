<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom Styles -->

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="{{ asset('css/main_dl.css') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <style>
        .colored-svg {
            width: 180px;
            height: auto;
            filter: brightness(0) saturate(100%) invert(24%) sepia(95%) saturate(2178%) hue-rotate(210deg) brightness(108%) contrast(98%);
        }
    </style>

</head>
<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img class="logo" src="{{asset('image/AT.png')}}"
                         alt="AT_Logo">
                </span>
                <div class="text header-text">
{{--                    <span class="name">Aviatechnik</span>--}}
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('image/AT_logo-rb.svg') }}"
                             alt="Logo" class="colored-svg" style="width:
                             150px">
                    </a>
                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-home icon'></i>
                            <span class="text nav-text">{{__('Home')}}</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#">

                            <i class='bx bx-trophy icon'></i>
                            <span class="text nav-text">{{__('Training')
                            }}</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-wrench  icon'></i>
                            <span class="text nav-text">{{__('Tools')}}</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#">

                            <i class='bx bx-cart-download icon'></i>
                            <span class="text nav-text">{{__('Materials')
                            }}</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-select-multiple icon'></i>
                            <span class="text nav-text">{{__('Tests')}}</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-bell icon'></i>
                            <span class="text nav-text">{{__('Notification')}}</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bxs-grid icon'></i>
                            <span class="text nav-text">{{__('Standart
                            Processes')}}</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">{{__('Logout')}}</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                <li class="mode">
                    <div class="moon-sun">
                        <i class='bx bxs-moon icon moon'></i>
                        <i class='bx bxs-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">{{__('Dark Mode')}}</span>
                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
            </div>
        </div>
    </nav>
<section class="home ">
    <div class="text">Dashboard</div>


</section>

    <script src="{{asset('/js/main_dl.js')}}"></script>
</body>
</html>
