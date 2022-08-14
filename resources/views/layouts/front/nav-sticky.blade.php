<nav class="navbar navbar-dark navbar-expand-md bg-dark sticky-top" id="nav_sticky">
            <div class="container-fluid mx-3">
                <a class="navbar-brand" href="#">Cryptologi.ir</a>

                {{-- copy offcanvas without id --}}
                <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title">کریپتولوژی</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
                    </div>
                    <div class="offcanvas-body d-flex flex-column justify-content-between my-3 my-md-0">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">صفحه اصلی</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">دوره های آموزشی</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    مقالات
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    چرا کریپتولوژی ؟
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    تماس با ما
                                </a>
                            </li>
                        </ul>

                        <div class="text-center d-md-none">
                            <a href="" class="nav-item"><i class="bi bi-instagram"></i></a>
                            <a href="" class="nav-item"><i class="bi bi-telegram"></i></a>
                            <a href="" class="nav-item"><i class="bi bi-telephone"></i></a>
                        </div>

                    </div>
                </div>
                {{--/copy offcanvas without id--}}

                <div class="ms-auto">
                    <a href="" class="btn btn-info text-light">ورود <i class="bi bi-box-arrow-in-right"></i></a>
                    <a href="" class="btn btn-success">عضویت <i class="bi bi-person-plus"></i></a>
                </div>

                <button class="navbar-toggler ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#nav_offcanvas">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </div>
        </nav>
@include('layouts.front.nav-offcanvas')


