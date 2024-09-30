<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">


    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

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
<div class="wrapper">
    <aside class="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="fas fa-bars"></i>
            </button>
            <div class="sidebar-logo">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('image/AT_logo-rb.svg') }}" alt="Logo" class="colored-svg">
                </a>
            </div>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="fas fa-home"></i>
                    <span>{{__('Home')}}</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="fas fa-light fa-trophy"></i>
                    <span>{{__('Training')}}</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="fas fa-wrench"></i>
                    <span>{{__('Tools')}}</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="fas fa-regular fa-user-gear"></i>
                    <span>{{__('Tests')}}</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="fas fa-bell"></i>
                    <span>{{__('Notification')}}</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed has-dropdown"
                   data-bs-toggle="collapse"
                   data-bs-target=".company"
                   aria-expanded="false"
                   aria-controls="company">
                    <i class="fas fa-regular fa-plane"></i>
                    <span>{{ __('Company') }}</span>
                </a>
                <ul id="company" class="company collapse sidebar-dropdown
                list-unstyled collapsed"
                    data-bs-parent=".sidebar">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">{{ __('About') }}</a>
                    </li>
                </ul>
            </li>

        </ul>

        <div class="sidebar-footer">
            <a href="#" class="sidebar-link">
                <i class="fas fa-right-from-bracket"></i>
                <span>{{__('Logout')}}</span>
            </a>

        </div>
    </aside>

    <div class="main p-4">
        <h1>SideBar</h1>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-wJpWZiyQlYUNwPfXJpeQ3XwzI3jIhwDQv0rP5aiAxu5UNda9W1L3jFRGOjl1XkdV"
        crossorigin="anonymous"></script>


<!-- Bootstrap JS и Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-6udc/MBslBMU/LRh+F8wgXjmFb0NkmW9/iNUQqVuTL5gtXM2G6A5WJGoJue8RXOp"
        crossorigin="anonymous"></script>


</body>
</html>
