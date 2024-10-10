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
        .modal-header{
            background-color:var(--table-hover-bg) ;
            color: var(--table-text);
        }
        .btn-close {
            color: var(--table-text);
        }
        .modal-body{
            color: var(--primary-color);
        }
        .modal-footer{
            color: var(--primary-color);
        }
        .dropdown-menu{
            background: var(--table-header-bg);

        }
        .sidebar:not(.close) .bottom-content .logout {
            display: none; /* По умолчанию скрыто */
        }

        .sidebar.close .bottom-content .logout {
            display: block; /* Показываем кнопку, когда sidebar закрыт */
        }




    </style>

</head>
<body>
<nav class="sidebar close">
    <header>
        <div class="image-text">
                <span class="image">
                    <img class=" rounded-circle bordered-image"
                         src="{{asset('image/AT.png')}}"
                         alt="Logo"  style="width: 56px">
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

        <div class="user-info  mt-4 ps-2 d-flex">
            <a href="{{ route('user.profile.profile') }}" data-bs-toggle="tooltip" title="Profile">
                @if( Auth::user()->avatar )
                    <img src="/storage/avatars/{{ Auth::user()->avatar }}" id="user-avatar"
                         class="rounded-circle justify-content-center
                         elevation-2  bordered-image"
                         alt="User Avatar" style="width: 56px">
                @else
                    <i class="bi bi-person-circle"></i>
                @endif
            </a>
            <!-- Выпадающее меню -->
            <div class=" text dropdown ms-3">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="ms-2  text">{{ Auth::user()->name }}</span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="{{ route('user.profile.profile') }}">
                            <i class="bi bi-person-lines-fill icon"></i>
                            <span class="text nav-text"> {{__('Profile')}}</span>

                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-left icon"></i>
                            <span class="text nav-text">{{__('Logout')}}</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>



    <div class="list-bar">
        @include('includes.sidebar_main')
        <div class="bottom-content">
            <li class="logout">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();"
                   data-bs-toggle="tooltip" title="Logout">
                    <i class="bi bi-box-arrow-left icon"></i>
                    <span class="text nav-text">{{__('Logout')}}</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

            <li class="mode ">
                <div class="moon-sun">
                    <i class='bi bi-moon icon moon'></i>
                    <i class='bi bi-sun icon sun'></i>
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
<script src="{{asset('js/main_dl.js')}}"></script>
<script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const themeToggle = document.querySelector('.toggle-switch');
        const body = document.body;
        let currentTheme = localStorage.getItem('theme') || 'light'; // По умолчанию - светлая тема

        // Установка начальной темы
        body.classList.add(currentTheme);

        // Обработка переключения темы
        themeToggle.addEventListener('click', () => {
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark'; // Определение новой темы
            body.classList.replace(currentTheme, newTheme); // Замена текущей темы
            localStorage.setItem('theme', newTheme); // Обновление темы в localStorage
            currentTheme = newTheme; // Обновление текущей темы
        });
    });


</script>
</body>
</html>
