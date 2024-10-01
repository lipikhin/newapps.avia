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

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/bootstrap-icons.css')}}">

    <link rel="stylesheet" href="{{ asset('css/main_dlb.css') }}">


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

    <div class="list-bar">
        <div class="list-item">
            <ul class="list-link">
                <li class="">
                    <a href="#">
                        <i class="bi bi-house-door icon"></i>
                        <span class="text nav-text">{{__('Home')}}</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{route('user.trainings.index')}}">
                        <i class='bi bi-trophy icon'></i>
                        <span class="text nav-text">{{__('Training')
                            }}</span>
                    </a>
                </li>
                <li class="">
                    <a href="#">

                        <i class="bi bi-tools  icon"></i>
                        <span class="text nav-text">{{__('Tools')}}</span>
                    </a>
                </li>
                <li class="">
                    <a href="#">
                        <i class="bi bi-minecart icon"></i>
                        <span class="text nav-text">{{__('Materials')
                            }}</span>
                    </a>
                </li>
                <li class="">
                    <a href="#">
                        <i class="bi bi-journal-check icon"></i>
                        <span class="text nav-text">{{__('Tests')}}</span>
                    </a>
                </li>
                <li class="">
                    <a href="#">
                        <i class='bi bi-bell icon'></i>
                        <span class="text nav-text">{{__('Notification')}}</span>
                    </a>
                </li>
                <li class="">
                    <a href="#">
                        <i class="bi bi-list-columns-reverse icon"></i>
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
{{--    <div class="text">Dashboard</div>--}}

    <div class="m-3">
        @if(Auth::user()->is_admin)
            @include('includes.admin_nav')
        @else
            @include('includes.work_nav')
        @endif
    </div>

    <div class="container mt-2">
        <main class="py-4">



            @yield('content')



        </main>
    </div>



</section>

<script src="{{asset('/js/main_dl.js')}}"></script>
</body>
</html>
