@extends('admin.layouts.master')

@section('title', 'مطالب')
@section('content')
    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">مطالب </h1>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-sm btn-success @cannot('courses-create') disabled @endcannot">
            <span>ایجاد مطلب</span>
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
                    value="{{ request()->get('search') }}" placeholder="عنوان یا بخشی از محتوا" aria-label="Search"
                    aria-describedby="basic-addon2">
            </div>
        </form>
    </div>
    {{-- /search box --}}

    {{-- users table --}}
    <div id="pagination_data" class="table-responsive">
        @include('admin.articles.articles-paginate', ['articles' => $articles])
    </div>

    {{-- articleModal --}}
    <div class="modal fade" id="article_modal" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                {{-- fill with javascript --}}
            </div>
            <div class="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    {{-- /articleModal --}}


    {{-- DeleteModal --}}
    <div class="modal fade" id="delete_modal" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <span>واقعا میخای که این مورد حذف شه ؟</span>
                    <form class="mt-3" action="{{ route('admin.articles.destroy') }}" method="post" id="delete_from">
                        @csrf
                        @method('delete')
                        <input type="hidden" name='article_slug'>
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
                $('input[name="article_slug"]').val($(this).attr('data-slug'));
            });

            $(document).on('click', 'a[data-target="#article_modal"]', function(e) {
                let url = "{{ route('admin.articles.show', ['article' => ':article']) }}";
                url = url.replace(':article', $(e.currentTarget).attr('data-slug'));
                $.ajax({
                    type: "get",
                    url: url,
                    success: function(response) {
                        $('.lds-ellipsis').hide();
                        $('#article_modal .modal-content').html(response);
                    }
                });
            });
        });
    </script>
@endsection
