<!doctype html>
<html lang="en" data-bs-theme="light">


<style>
    .colored-svg {
        width: 180px; /* Установите желаемую ширину */
        height: auto; /* Высота будет автоматически скорректирована пропорционально */
        /*filter: invert(31%) sepia(84%) saturate(5873%) hue-rotate(355deg) brightness(101%) contrast(106%);*/
        filter: brightness(0) saturate(100%) invert(24%) sepia(95%) saturate(2178%) hue-rotate(210deg) brightness(108%) contrast(98%);
        /* Настройте фильтры для получения желаемого цвета */
    }

</style>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'AvL_Code') }}</title>
    <link rel="icon" href="{{asset('assets/images/AT.png?v=2')}}"
          type="image/png" style="width: 32px;">

    <!--plugins-->
    <link href="{{asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
{{--    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/metismenu/metisMenu.min.css')}}">--}}
{{--    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/metismenu/mm-vertical.css')}}">--}}
    <!--bootstrap css-->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!--main css-->
    <link href="{{asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet">
    <link href="{{asset('sass/main.css')}}" rel="stylesheet">
    <link href="{{asset('sass/dark-theme.css')}}" rel="stylesheet">
    <link href="{{asset('sass/semi-dark.css')}}" rel="stylesheet">
    <link href="{{asset('sass/bordered-theme.css')}}" rel="stylesheet">
    <link href="{{asset('sass/responsive.css')}}" rel="stylesheet">

</head>

<body>

<!--start header-->
<header class="top-header">
    @include('includes.top_header_navbar')
</header>
<!--end top header-->

<!--start mini sidebar-->
<aside class="mini-sidebar d-flex align-items-center flex-column justify-content-between">
    <div class="user">
        <a href="#offcanvasUserDetails" data-bs-toggle="offcanvas" class="user-icon">
{{--            <i class="material-icons-outlined">account_circle</i>--}}
            @if( Auth::user()->avatar )
                <img src="/storage/avatars/{{ Auth::user()->avatar }}"
                     class="rounded-circle justify-content-center elevation-2"
                     alt="User Image" style="width: 60px">
            @else
                <i class="material-icons-outlined">account_circle</i>
            @endif

{{--            <div class="image">--}}
{{--                <--}}
{{--            </div>--}}

        </a>
    </div>
    <div class="quick-menu">
        <nav class="nav flex-column gap-1">
            <a class="nav-link" href="{{url('/home')}}">
                <i class="material-icons-outlined">home</i>
            </a>
            <a class="nav-link" href="{{route('user.trainings.index')}}">
               <span class="material-symbols-outlined ">trophy</span>
            </a>

{{--            <a class="nav-link" href="#"><i class="material-icons-outlined">apps</i></a>--}}
{{--            <a class="nav-link" href="ecommerce-products.html"><i class="material-icons-outlined">shopping_cart</i></a>--}}
{{--            <a class="nav-link" href="#"><i class="material-icons-outlined">forum</i></a>--}}
{{--            <a class="nav-link" href="#"><i class="material-icons-outlined">event</i></a>--}}
        </nav>
    </div>
    <div class="mini-footer dark-mode">
        <a href="#" class="footer-icon dark-mode-icon">
            <i class="material-icons-outlined">dark_mode</i>
        </a>
    </div>
</aside>
<!--end mini sidebar-->


<!--start main wrapper-->
<main class="main-wrapper">
    <div class="main-content">
        <!--breadcrumb-->
        @if(Auth::user()->is_admin)
            @include('includes.admin_nav')
        @else
            @include('includes.work_nav')
         @endif
         <!--end breadcrumb-->
@yield('content')



</div>
</main>
<!--end main wrapper-->



<!--start primary menu offcanvas-->
<div class="offcanvas offcanvas-start w-260" data-bs-scroll="true" tabindex="-1" id="offcanvasPrimaryMenu">
<div class="offcanvas-header border-bottom h-70">
    <img src="{{asset('assets/images/logo1.svg')}}" class="ms-1 colored-svg" width="160" alt="">
<a href="#" class="primaery-menu-close" data-bs-dismiss="offcanvas">
   <i class="material-icons-outlined">close</i>
</a>
</div>
<div class="offcanvas-body">
@include('includes.sidebar')
</div>
<div class="offcanvas-footer p-3 border-top h-70">
<div class="form-check form-switch">
   <input class="form-check-input" type="checkbox" role="switch" id="DarkMode">
   <label class="form-check-label" for="DarkMode">Dark Mode</label>
</div>
</div>
</div>
<!--end primary menu offcanvas-->


<!--start user details offcanvas-->
<div class="offcanvas offcanvas-start w-260" data-bs-scroll="true" tabindex="-1" id="offcanvasUserDetails">
<div class="offcanvas-body">
<div class="user-wrapper">
   <div class="text-center p-3 bg-light rounded">
       @if( Auth::user()->avatar )
           <img src="/storage/avatars/{{ Auth::user()->avatar }}"
                class="rounded-circle p-1 shadow mb-3" width="120"
                height="120" alt="User Image">
       @else
           <i class="material-icons-outlined">account_circle</i>
       @endif

       <h5 class="user-name mb-0 fw-bold"> {{ Auth::user()->name }}</h5>
{{--                <p class="mb-0"> {{ Auth::user()->role->name }}</p>--}}
   </div>
   <div class="list-group list-group-flush mt-3 profil-menu fw-bold">
       <a href="{{ route('user.profile.profile') }}"
          class="list-group-item list-group-item-action d-flex align-items-center gap-2 border-top"><i
               class="material-icons-outlined">person_outline</i>Profile</a>

       <a href="{{ route('logout') }}"
          class="list-group-item list-group-item-action d-flex align-items-center gap-2 border-bottom"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           <i class="material-icons-outlined">power_settings_new</i>Logout</a>
       <form id="logout-form" action="{{ route('logout') }}" method="POST"
             class="d-none">
            @csrf
       </form>
   </div>
</div>

</div>
<div class="offcanvas-footer p-3 border-top">
<div class="text-center">
   <button type="button" class="btn d-flex align-items-center gap-2" data-bs-dismiss="offcanvas"><i
           class="material-icons-outlined">close</i><span>Close Sidebar</span></button>
</div>
</div>
</div>
<!--end user details offcanvas-->


<!--start switcher-->
<button class="btn btn-primary position-fixed bottom-0 end-0 m-3 d-flex align-items-center gap-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop">
<i class="material-icons-outlined">tune</i>Customize
</button>

<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="staticBackdrop">
<div class="offcanvas-header border-bottom h-70">
<div class="">
   <h5 class="mb-0">Theme Customizer</h5>
   <p class="mb-0">Customize your theme</p>
</div>
<a href="#" class="primaery-menu-close" data-bs-dismiss="offcanvas">
   <i class="material-icons-outlined">close</i>
</a>
</div>
<div class="offcanvas-body">
<div>
   <p>Theme variation</p>

   <div class="row g-3">
       <div class="col-12 col-xl-6">
           <input type="radio" class="btn-check" name="theme-options" id="LightTheme" checked>
           <label class="btn btn-outline-secondary d-flex flex-column gap-1 align-items-center justify-content-center p-4" for="LightTheme">
               <span class="material-icons-outlined">light_mode</span>
               <span>Light</span>
           </label>
       </div>
       <div class="col-12 col-xl-6">
           <input type="radio" class="btn-check" name="theme-options" id="DarkTheme">
           <label class="btn btn-outline-secondary d-flex flex-column gap-1 align-items-center justify-content-center p-4" for="DarkTheme">
               <span class="material-icons-outlined">dark_mode</span>
               <span>Dark</span>
           </label>
       </div>
       <div class="col-12 col-xl-6">
           <input type="radio" class="btn-check" name="theme-options" id="SemiDarkTheme">
           <label class="btn btn-outline-secondary d-flex flex-column gap-1 align-items-center justify-content-center p-4" for="SemiDarkTheme">
               <span class="material-icons-outlined">contrast</span>
               <span>Semi Dark</span>
           </label>
       </div>
       <div class="col-12 col-xl-6">
           <input type="radio" class="btn-check" name="theme-options" id="BoderedTheme">
           <label class="btn btn-outline-secondary d-flex flex-column gap-1 align-items-center justify-content-center p-4" for="BoderedTheme">
               <span class="material-icons-outlined">border_style</span>
               <span>Bordered</span>
           </label>
       </div>
   </div><!--end row-->

</div>
</div>
</div>
<!--end switcher-->


<!--bootstrap js-->
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

<!--plugins-->
{{--<script src="{{asset('assets/js/jquery.min.js')}}"></script>--}}
<!--plugins-->
{{--<script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>--}}
{{--<script src="{{asset('assets/plugins/metismenu/metisMenu.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/plugins/apexchart/apexcharts.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/js/index.js')}}"></script>--}}
{{--<script src="{{asset('assets/plugins/peity/jquery.peity.min.js')}}"></script>--}}
<script>
// $(".data-attributes span").peity("donut")
</script>
{{--<script src="{{asset('assets/js/main.js')}}"></script>--}}




</body>

</html>
