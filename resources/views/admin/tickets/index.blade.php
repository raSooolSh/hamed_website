@extends('admin.layouts.master')

@section('title', 'تیکت ها')
@section('content')
    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">تیکت ها - {{ $tickets->count() }}مورد</h1>
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
                    value="{{ request()->get('search') }}" placeholder="نام،آیدی یا بخشی از متن" aria-label="Search"
                    aria-describedby="basic-addon2">
            </div>
        </form>
    </div>
    {{-- /search box --}}

    {{-- users table --}}
    <div id="pagination_data" class="table-responsive">
        @include('admin.tickets.tickets-paginate', ['tickets' => $tickets])
    </div>


@endsection
@section('script')
@endsection
