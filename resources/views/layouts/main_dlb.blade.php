<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom Styles -->




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
        .table {
            background-color: var(--table-bg);
            color: var(--table-text);
            border-color: var(--table-text);
            transition: var(--tran-05);
        }

        .table th {
            background-color: var(--table-bg);
            color: var(--table-text);
            border-color: var(--table-text);
        }

        .table td {
            border-color: var(--table-text);
            background-color: var(--table-bg);
            color: var(--table-text);
        }

        .table-hover tbody tr:hover {
            background-color: var(--table-hover-bg);
        }

        .card-header{
            background-color: var(--table-hover-bg);
            color: var(--table-text);
        }
        .card-body{
            background-color: var(--table-bg);
            color: var(--table-text);
        }
        .btn-primary{
            background-color: var(--primary-color);
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
        <i class='bi bi-chevron-right toggle' ></i>
    </header>

    <div class="list-bar">
        @include('includes.sidebar_main')

        <div class="bottom-content">
            <li class="">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-left icon"></i>
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
                <div class="toggle-switch" >
                    <span class="switch"></span>
                </div>
            </li>
        </div>
    </div>


</nav>
<section class="home ">

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

<script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/main_dl.js')}}"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const themeToggle = document.querySelector('.toggle-switch');
        const body = document.body;
        const currentTheme = localStorage.getItem('theme') || 'light'; // По умолчанию - светлая тема

        // Установка начальной темы
        body.classList.add(currentTheme);

        // Обработка переключения темы
        themeToggle.addEventListener('click', () => {
            const newTheme = body.classList.contains('dark') ? 'light' : 'dark';
            body.classList.replace(currentTheme, newTheme); // Заменяем текущий класс темы на новый
            localStorage.setItem('theme', newTheme); // Обновляем localStorage
        });
    });




</script>
</body>
</html>
