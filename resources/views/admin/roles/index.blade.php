@extends('admin.layouts.master')

@section('title', 'نقش ها')
@section('content')
    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800"> نقش ها </h1>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-success @cannot('roles-create') disabled @endcannot">
            <span>ایجاد نقش</span>
            <i class="fa fa-plus mr-2"></i>
        </a>
    </div>
    {{-- /page heading --}}

    <hr class="">

    {{-- search box --}}
    <div class="d-flex justify-content-end">
        <form action="" id="search_form" class="col-sm-8 col-md-6 col-lg-4 mr-auto my-2 navbar-search">
            <div class="input-group">
                <div class="input-group-prepend order-2">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
                <input type="text" class="form-control bg-white border-0 small" name='search'
                    value="{{ request()->get('search') }}" placeholder="نام نقش " aria-label="Search"
                    aria-describedby="basic-addon2">
            </div>
        </form>
    </div>
    {{-- /search box --}}

    {{-- users table --}}
    <div id="pagination_data" class="table-responsive">
        @include('admin.roles.roles-paginate', ['roles' => $roles])
    </div>
    {{-- DeleteModal --}}
    <div class="modal fade" id="delete_modal" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <span>واقعا میخای که این مورد حذف شه ؟</span>
                    <form class="mt-3" action="{{ route('admin.roles.destroy') }}" method="post" id="delete_from">
                        @csrf
                        @method('delete')
                        <input type="hidden" name='role_name'>
                        <button type="button" class="btn btn-sm btn-info" data-dismiss="modal">بیخیال</button>
                        <button type="submit" class="btn btn-sm btn-danger">آره، حذف شه!</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- /DeleteModal --}}
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', 'a[data-target="#delete_modal"]', function() {
                $('input[name="role_name"]').val($(this).attr('data-name'));
            });
        });
    </script>
@endsection
