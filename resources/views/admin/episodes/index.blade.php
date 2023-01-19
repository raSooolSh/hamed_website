@extends('admin.layouts.master')

@section('title', "اپیزود ها")
@section('content')
    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">اپیزود های {{ $course->name_fa }}</h1>
        <a href="{{ route('admin.episodes.create',$course->slug) }}" class="btn btn-sm btn-success @cannot('courses-create') disabled @endcannot">
            <span>ایجاد اپیزود</span>
            <i class="fa fa-plus mr-2"></i>
        </a>
    </div>
    {{-- /page heading --}}

    <hr class="">
    {{-- users table --}}
    <div id="pagination_data" class="table-responsive">
        @include('admin.episodes.episodes-paginate', ['episodes' => $course->episodes->sortByDesc('number')])
    </div>

    {{-- EpisodeModal --}}
    <div class="modal fade" id="episode_modal" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
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
    {{-- /EpisodeModal --}}


    {{-- DeleteModal --}}
    <div class="modal fade" id="delete_modal" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <span>واقعا میخای که این مورد حذف شه ؟</span>
                    <form class="mt-3" action="{{ route('admin.episodes.destroy',$course->slug) }}" method="post" id="delete_from">
                        @csrf
                        @method('delete')
                        <input type="hidden" name='episode_id'>
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
                $('input[name="episode_id"]').val($(this).attr('data-id'));
            });

            $(document).on('click', 'a[data-target="#episode_modal"]', function(e) {
                let url = "{{ route('admin.episodes.show', ['episode' => ':episode','course'=>':course']) }}";
                url = url.replace(':episode', $(e.currentTarget).attr('data-id'));
                url = url.replace(':course', "{{ $course->slug }}");
                $.ajax({
                    type: "get",
                    url: url,
                    success: function(response) {
                        $('.lds-ellipsis').hide();
                        $('#episode_modal .modal-content').html(response);
                    }
                });
            });
        });
    </script>
@endsection
