@if (Auth::check())
    <div class="dropdown ms-auto">
        <a class="dropdown-toggle" data-bs-toggle='dropdown'>
            <img class="img-profile rounded-circle me-2" src="{{ url(Auth::user()->avatar) }}" alt="profile">
            {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
        </a>

        <ul class="dropdown-menu dropdown-menu-end">
            @if (Auth::user()->hasAccessToAdminPanel())
                <li><a href="{{ route('admin.dashboard') }}" class="dropdown-item d-flex justify-content-between py-2">
                        <span> پنل مدیریت </span><i class="bi bi-tools text-info"></i></a>
                </li>
            @endif
            <li><a href="{{ route('dashboard') }}" class="dropdown-item d-flex justify-content-between py-2">
                    <span> پنل کاربری </span><i class="bi bi-gear text-success"></i></a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><button type="button" class="dropdown-item d-flex justify-content-between py-2"
                    onclick="event.preventDefault();getElementById('logout_form').submit();">
                    <span>خروج از حساب </span><i class="bi bi-escape text-danger"></i></a>
            </li>
            <form action="{{ route('logout') }}" method="POST" id='logout_form'>
                @csrf
            </form>
        </ul>
    </div>
@else
    <div class="ms-auto">
        <a href="{{ route('login') }}" class="btn btn-info text-light">ورود <i class="bi bi-box-arrow-in-right"></i></a>
        <a href="{{ route('register') }}" class="btn btn-success">عضویت <i class="bi bi-person-plus"></i></a>
    </div>
@endif
