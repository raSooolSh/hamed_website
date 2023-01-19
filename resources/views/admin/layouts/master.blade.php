<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>حامد حسن زاده | @yield('title')</title>

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/admin/admin.css') }}" rel="stylesheet">
    @yield('style')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('admin.section.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">


            <div id="app">
                <!-- Topbar -->
                @include('admin.section.topbar-nav')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->
            </div>


            <!-- Footer -->
            @include('admin.section.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    @include('admin.section.scroll-top')



    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('js/admin/admin.js') }}"></script>
    <script src="{{ url('ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ url('ckeditor4/lang/fa.js') }}"></script>
    @include('sweet::alert')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            $(document).on('click', '#file-manager-button', function(event) {
                event.preventDefault();
                window.open('/file-manager/fm-button', 'fm', 'width=800,height=600');
            });
        });

        // set file link
        function fmSetLink($url) {
            $('#file-manager-input').val($url);
        }
    </script>
    @yield('script')


</body>

</html>
