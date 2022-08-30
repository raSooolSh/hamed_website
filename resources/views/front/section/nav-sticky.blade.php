<nav class="navbar navbar-dark navbar-expand-md bg-dark sticky-top" id="nav_sticky">
    <div class="container-fluid mx-3">
        <a class="navbar-brand" href="#">Cryptologi.ir</a>
        <div class="d-none d-md-flex">
            @include('front.section.navbar-items')
        </div>


        @include('front.section.userDropdown')


        <button class="navbar-toggler ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#nav_offcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>

    </div>
</nav>
@include('front.section.nav-offcanvas')
