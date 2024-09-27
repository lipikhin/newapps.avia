<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'AVL_Code') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">

    <!-- Styles -->
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
<video autoplay loop muted playsinline class="video-background">
    <source src="{{asset('video/background.mp4')}}" type="video/mp4">
    Your browser does not support the video tag.
</video>

<div class="container">
    <div class="navbar navbar-expand-md">
        <div class="navbar-nav me-auto">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{asset('image/AT_logo-rb.svg')}}" alt="Logo"
                     class="colored-svg">
                {{--                    {{ config('app.name', 'Laravel') }}--}}
            </a>
        </div>

        <div class="navbar-nav ms-auto" >
            @if (Route::has('login'))
                <div class="nav justify-content-end" >
                    @auth
                        <a href="{{ url('/home') }}" class="nav-link" aria-current="page">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link "
                           aria-current="page" >Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-link" aria-current="page">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

    </div>

    <div class="content">
        {{--        <h1>Welcome to Avia Doc</h1>--}}
        {{--        <p>Your text here</p>--}}
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.min.js"></script>
</body>
</html>
