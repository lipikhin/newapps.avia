<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/main2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


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
    <div class="sidebar">
        <div class="logo-details">

            <img class="logo_sm" src="{{asset('image/AT.png')}}"
                 alt="AT_Logo" height="36" width="36">

            <span class="logo_name ">
                <a class="brand" href="{{ url('/') }}">
                <img src="{{asset('image/AT_logo-rb.svg')}}" alt="Logo"
                     class="colored-svg">
            </a>
            </span>
        </div>
        <ul class="nav-links">
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-house-door"></i>
                    <span class="link-name">{{__('Home')}}</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class='bx bxs-trophy'></i>
                    <span class="link-name">{{__('Training')}}</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class='bx bx-wrench'></i>
                    <span class="link-name">{{__('Tools')}}</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class='bx bxs-select-multiple'></i>
                    <span class="link-name">{{__('Tests')}}</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class='bx bx-bell'></i>
                    <span class="link-name">{{__('Notification')}}</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class='bx bx-bell'></i>
                    <span class="link-name">{{__('Notification')}}</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class='bx bx-bell'></i>
                    <span class="link-name">{{__('Notification')}}</span>
                </a>
            </li>

        </ul>
    </div>


<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
