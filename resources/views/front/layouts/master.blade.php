<!doctype html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/front/app.css') }}">
    @yield('style')
</head>

<body id="@yield('id', '')" class="bg-dark">
    {{-- include toast elements --}}
    @toast
    @include('front.section.toast')
    @endif
    {{-- /include toast elements --}}

    {{-- animation --}}
    <div>
        <div class="firefly"></div>
        <div class="firefly"></div>
        <div class="firefly"></div>
        <div class="firefly"></div>
        <div class="firefly"></div>
        <div class="firefly"></div>
        <div class="firefly"></div>
        <div class="firefly"></div>
        <div class="firefly"></div>
        <div class="firefly"></div>
        <div class="firefly"></div>
        <div class="firefly"></div>
        <div class="firefly"></div>
        <div class="firefly"></div>
        <div class="firefly"></div>
    </div>


    {{-- main content --}}
    <div id="mian">
        @include('front.section.nav-sticky')

        @yield('content')


        <hr class="text-primary">
        @include('front.section.footer')
    </div>
    {{-- /main content --}}

    {{-- scripts section --}}
    <script src="{{ asset('js/front/app.js') }}"></script>
    <script>
        $(document).ready(function() {

            $(document).on('mouseleave', '#user_dropdown', function() {
                setTimeout(() => {
                    $(this).removeClass('show')
                }, 600);

            })
        });
    </script>
    @yield('script')
    {{-- /scripts section --}}
</body>

</html>
