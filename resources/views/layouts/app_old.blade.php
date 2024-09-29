<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Scripts -->
{{--    @vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        .video-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
        .container {
            position: relative;
            z-index: 1;
        }
        .content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
        }
        .colored-svg {
            width: 180px; /* Установите желаемую ширину */
            height: auto; /* Высота будет автоматически скорректирована пропорционально */
            /*filter: invert(31%) sepia(84%) saturate(5873%) hue-rotate(355deg) brightness(101%) contrast(106%);*/
            filter: brightness(0) saturate(100%) invert(24%) sepia(95%) saturate(2178%) hue-rotate(210deg) brightness(108%) contrast(98%);
            /* Настройте фильтры для получения желаемого цвета */
        }
    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('image/AT_logo-rb.svg')}}" alt="Logo"
                         class="colored-svg">
                </a>
{{--                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"  --}}
{{--                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  --}}
{{--                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--                    <span class="navbar-toggler-icon"></span>--}}
{{--                </button>--}}
                <div class="row">
                    <div class="col-8">

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav me-auto">

                            </ul>

                        </div>
                    <div class="col-4">

                {{--        !-- Right Side Of Navbar -->--}}
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown ">
                                    <div class="image d-flex">
                                        <img src="/storage/avatars/{{ Auth::user()->avatar }}"
                                             class="rounded-circle elevation-2" alt="User Image" style="width:
                                             50px">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                            {{ Auth::user()->name }}
                                        </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">


                                            <a class="dropdown-item" href="{{ route('user.profile.profile') }}">
                                                <i class="fas fa-user-circle mr-2"></i> Profile
                                            </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>

                </div>
            </div>
        </nav>
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
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>


</body>
</html>
