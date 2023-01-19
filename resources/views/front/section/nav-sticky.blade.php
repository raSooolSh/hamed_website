<div class="container-flueid sticky-md-top"  id="nav_sticky">
    <nav class="navbar navbar-dark navbar-expand-xl shadow">
        <div class="container-fluid d-flex flex-column flex-sm-row justify-content-between mx-3">
            <a class="navbar-brand">{{ env('APP_NAME') }}</a>
            <div class="d-none d-xl-flex">
                @include('front.section.navbar-items')
            </div>


            @include('front.section.userDropdown')


        </div>
    </nav>
</div>

@include('front.section.nav-offcanvas')
