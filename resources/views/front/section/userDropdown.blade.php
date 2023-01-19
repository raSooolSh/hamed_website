@if (Auth::check())
    <div class="d-flex align-items-center align-self-end">

        <div class="dropdown">
            <a class="" data-bs-toggle='dropdown'>
                <img class="img-profile rounded-circle me-2 border border-primary"
                    src="{{ route('image.get', ['w' => '200', 'h' => '200', 'image' => Auth::user()->avatar]) }}"
                    alt="profile">
                <span class="d-none d-md-inline text-white">{{ Auth::user()->full_name }}<span
                        class="dropdown-toggle me-1"></span></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-start dropdown-menu-dark" id="user_dropdown">
                <li>
                    <h6 class="dropdown-header text-end">{{ Auth::user()->full_name }}</h6>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                @if (Auth::user()->hasAccessToAdminPanel())
                    <li><a href="{{ route('admin.dashboard') }}"
                            class="dropdown-item d-flex justify-content-between py-2">
                            <span> پنل مدیریت </span><i class="bi bi-tools text-info"></i></a>
                    </li>
                @endif
                <li><a href="{{ route('dashboard') }}" class="dropdown-item d-flex justify-content-between py-2">
                        <span> پنل کاربری </span><i class="bi bi-gear text-success"></i></a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item d-flex justify-content-between py-2"
                        onclick="event.preventDefault();getElementById('logout_form').submit();">
                        <span>خروج از حساب </span><i class="bi bi-escape text-danger"></i></a>
                </li>
                <form action="{{ route('logout') }}" method="POST" id='logout_form'>
                    @csrf
                </form>
            </ul>

        </div>

        <div class="dropdown" id="notification">
            <a class="m-3" data-bs-toggle='dropdown'>
                <span><i class="bi bi-bell fs-4"></i></span>
                <span class="badge bg-danger position-absolute rounded-circle border border-1" id="counter">3</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-start dropdown-menu-dark" id="user_dropdown">
                <li>
                    <h6 class="dropdown-header text-end">تیکت ها</h6>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a href="{{ route('dashboard') }}" class="dropdown-item d-flex justify-content-between py-2">
                        <span> پنل کاربری </span><i class="bi bi-gear text-success"></i></a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item d-flex justify-content-between py-2"
                        onclick="event.preventDefault();getElementById('logout_form').submit();">
                        <span>خروج از حساب </span><i class="bi bi-escape text-danger"></i></a>
                </li>
                <form action="{{ route('logout') }}" method="POST" id='logout_form'>
                    @csrf
                </form>
            </ul>

        </div>


        <button class="navbar-toggler mx-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#nav_offcanvas">
            <span class="navbar-toggler-icon position-relative"></span>
        </button>

    </div>
@else
    <div class="">
        <a href="{{ route('login') }}" class="btn btn-sm btn-primary text-light ms-5">ورود به سایت <i
                class="bi bi-box-arrow-in-right"></i></a>

        <button class="navbar-toggler ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#nav_offcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
@endif
