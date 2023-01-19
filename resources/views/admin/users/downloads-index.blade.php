@extends('admin.layouts.master')

@section('title', 'کاربران')
@section('content')
    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800"> دانلود ها </h1>
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
                    value="{{ request()->get('search') }}" placeholder="نام دوره" aria-label="Search"
                    aria-describedby="basic-addon2">
            </div>
        </form>
    </div>
    {{-- /search box --}}

    {{-- users table --}}
    <div class="m-2 text-justify">
        <span class="badge-warning rounded rounded-4">توجه :تعداد درخواست ها به معنای تعداد دفعات دانلود نمی باشد، نرم افزار های مدیریت دانلود در هر
        بار دانلود بیش از یک درخواست ارسال می کنند.</span>
    </div>
    <div id="pagination_data" class="table-responsive">
        @include('admin.users.downloads-paginate', ['episodes' => $episodes])
    </div>



@endsection
@section('script')
@endsection
