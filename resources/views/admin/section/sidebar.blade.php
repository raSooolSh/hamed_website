<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion pr-0" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('homepage') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ env('APP_NAME') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ bsIsActive('admin.dashboard') }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span> داشبورد </span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        محتوا
    </div>


    <!-- Nav Item - Pages Collapse Menu -->
    <li
        class="nav-item {{ bsIsActive(['admin.users.index', 'admin.users.index.admins', 'admin.users.index.blocked']) }}">
        <a class="nav-link @cannot('users-show') disabled @endcannot collapsed" data-toggle="collapse"
            data-target="#userCollapse" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-users"></i>
            <span>کاربران</span>
        </a>
        <div id="userCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ bsIsActive('admin.users.index') }}"
                    href="{{ route('admin.users.index') }}">همه کاربران</a>

                <a class="collapse-item {{ bsIsActive('admin.users.index.admins') }}"
                    href="{{ route('admin.users.index.admins') }}">کاربران ادمین</a>



                <a class="collapse-item {{ bsIsActive('admin.users.index.blocked') }}"
                    href="{{ route('admin.users.index.blocked') }}">کاربران بلاک شده</a>


            </div>
        </div>
    </li>


    <li class="nav-item {{ bsIsActive('admin.roles.index') }}">
        <a class="nav-link @cannot('roles-show') disabled @endcannot" href="{{ route('admin.roles.index') }}">
            <i class="fas fa-unlock"></i>
            <span> نقش ها </span></a>
    </li>

    <li class="nav-item {{ bsIsActive('admin.courses.index') }}">
        <a class="nav-link @cannot('courses-show') disabled @endcannot" href="{{ route('admin.courses.index') }}">
            <i class="fa fa-folder-open"></i>
            <span> دوره ها </span></a>
    </li>

    <li class="nav-item {{ bsIsActive('admin.articles.index') }}">
        <a class="nav-link @cannot('articles-show') disabled @endcannot" href="{{ route('admin.articles.index') }}">
            <i class="fas fa-newspaper"></i>
            <span>مطالب </span></a>
    </li>

    <li class="nav-item {{ bsIsActive(['admin.comments.index', 'admin.comments.all']) }}">
        <a class="nav-link @cannot('comments-manage') disabled @endcannot collapsed" data-toggle="collapse"
            data-target="#commentsCollapse" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-comment"></i>
            <span>کامنت ها</span>
        </a>
        <div id="commentsCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ bsIsActive('admin.comments.index') }}"
                    href="{{ route('admin.comments.index') }}"> کامنت های در انتظار</a>

                <a class="collapse-item {{ bsIsActive('admin.comments.all') }}"
                    href="{{ route('admin.comments.all') }}">همه کامنت ها</a>

            </div>
        </div>
    </li>


    <li class="nav-item {{ bsIsActive(['admin.tickets.index', 'admin.tickets.all', 'admin.tickets.show']) }}">
        <a class="nav-link @cannot('tickets-manage') disabled @endcannot collapsed" data-toggle="collapse"
            data-target="#ticketsCollapse" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-comment"></i>
            <span>تیکت ها</span>
        </a>
        <div id="ticketsCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ bsIsActive('admin.tickets.index') }}"
                    href="{{ route('admin.tickets.index') }}"> تیکت های باز</a>

                <a class="collapse-item {{ bsIsActive('admin.tickets.all') }}"
                    href="{{ route('admin.tickets.all') }}">همه تیکت ها</a>

            </div>
        </div>
    </li>

    <li class="nav-item {{ bsIsActive('admin.discounts.index') }}">
        <a class="nav-link @cannot('discounts-show') disabled @endcannot" href="{{ route('admin.discounts.index') }}">
            <i class="fas fa-calculator"></i>
            <span> تخفیف ها </span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
