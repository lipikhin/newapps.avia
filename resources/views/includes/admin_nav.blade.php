<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">
{{--        Admin Panel--}}
       <span></span>
    </div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{route('home.index')}}"
                                               class="btn btn-primary">Home</a></li>

                <li class="nav-item ms-2"><a href="{{route('user.work_orders.index')}}"
                                               class="btn
                                               btn-primary">{{__('Work Orders')
                                               }}</a></li>
                @auth
                    @if(Auth::user()->is_admin)

                        <li class="nav-item ms-2">
                            <h3>
                                <a href="{{route('admin.cmms.index')}}" class="btn btn-primary">CMM</a>
                            </h3>

                        </li>
                        <li class="nav-item ms-2">
                            <h3>
                                <a href="{{route('admin.units.index')}}" class="btn btn-primary"
                                >Units</a>
                            </h3>

                        </li>
                        <li class="nav-item ms-2">
                            <h3>
                                <a href="{{route('admin.users.index')}}" class="btn btn-primary"
                                >Users</a>
                            </h3>

                        </li>
                        <li class="nav-item ms-2">
                            <h3>
                                <a href="{{route('admin.customers.index')}}" class="btn btn-primary"
                                >Customers</a>
                            </h3>

                        </li>
                    @endif
                @endauth
            </ol>
        </nav>
    </div>
{{--    <div class="ms-auto">--}}
{{--        <div class="btn-group">--}}
{{--            <button type="button" class="btn btn-primary">Settings</button>--}}
{{--            <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>--}}
{{--            </button>--}}
{{--            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="#">Action</a>--}}
{{--                <a class="dropdown-item" href="#">Another action</a>--}}
{{--                <a class="dropdown-item" href="#">Something else here</a>--}}
{{--                <div class="dropdown-divider"></div>	<a class="dropdown-item" href="#">Separated link</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
