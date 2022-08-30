@extends('front.layouts.master')
@section('title', 'صفحه اصلی')
@section('content')
    @include('front.section.nav-sticky')
    <section id="header">
        <div class="container">

            <nav class="navbar navbar-dark navbar-expand-md bg-transparent py-3">
                <div class="container-fluid mx-3">
                    <a class="navbar-brand" href="#">Cryptologi.ir</a>


                    @include('front.section.userDropdown')

                    <button class="navbar-toggler ms-2" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#nav_offcanvas">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

            </nav>


            <nav class="navbar navbar-expand-md navbar-dark bg-dark px-5 py-2 rounded-4 d-md-flex d-none">
                <div class="collapse navbar-collapse d-flex justify-content-between">

                    <ul class="navbar-nav">
                        <li class="nav-item"><a href="" class="nav-link">صفحه اصلی</a></li>
                        <li class="nav-item"><a href="" class="nav-link">دوره های آموزشی</a></li>
                        <li class="nav-item"><a href="" class="nav-link">مقالات</a></li>
                        <li class="nav-item"><a href="" class="nav-link">چرا کریپتولوژی ؟</a></li>
                        <li class="nav-item"><a href="" class="nav-link">تماس با ما</a></li>
                    </ul>

                    <div class="text-center">
                        <a href="" class="nav-item"><i class="bi bi-instagram"></i></a>
                        <a href="" class="nav-item"><i class="bi bi-telegram"></i></a>
                        <a href="" class="nav-item"><i class="bi bi-telephone"></i></a>
                    </div>


                </div>
            </nav>


            <div class="text-center text-light mt-6">
                <p class="mt-3" style="font-size: 26px;">هدف ما افزایش تخصص شماست</p>
            </div>
        </div>
    </section>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#nav_sticky').hide();
            $(window).scroll(function() {
                if ($(document).scrollTop() > 320) {
                    $('#nav_sticky').fadeIn();
                } else {
                    $('#nav_sticky').hide();
                }
            });
        });
    </script>
@endsection
