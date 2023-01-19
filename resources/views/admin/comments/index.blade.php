@extends('admin.layouts.master')

@section('title', 'کامنت ها')
@section('content')
    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">کامنت ها - {{ $comments->count() }} مورد</h1>
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
                    value="{{ request()->get('search') }}" placeholder="کاربر،آیدی یا بخشی از متن" aria-label="Search"
                    aria-describedby="basic-addon2">
            </div>
        </form>
    </div>
    {{-- /search box --}}

    {{-- users table --}}
    <div id="pagination_data" class="table-responsive">
        @include('admin.comments.comments-paginate', ['comments' => $comments])
    </div>

    {{-- commentModal --}}
    <div class="modal fade" id="comment_modal" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
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
    {{-- /commentModal --}}


    {{-- DeleteModal --}}
    <div class="modal fade" id="delete_modal" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <span>واقعا میخای که این مورد حذف شه ؟</span>
                    <form id="delete_from">
                        <input type="hidden" name='comment_id'>
                        <button type="button" class="btn btn-sm btn-info" data-dismiss="modal">بیخیال</button>
                        <button type="submit" class="btn btn-sm btn-danger">آره، حذف شه!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- /DeleteModal --}}

    {{-- answerModal --}}
    <div class="modal fade" id="answer_modal" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="answer_from">
                        <input type="hidden" name="parrent_id" value="">
                        <textarea name='answer_comment' class="form-control mb-3" rows="5" placeholder="متن پاسخ را اینجا وارد کنید"></textarea>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">پشیمون شدم!</button>
                        <button type="submit" class="btn btn-sm btn-info">ارسال پاسخ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- /answerModal --}}
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', 'button[data-target="#delete_modal"]', function() {
                $('input[name="comment_id"]').val($(this).attr('data-id'));
            });

            $(document).on('click', 'button[data-target="#answer_modal"]', function() {
                $('input[name="parrent_id"]').val($(this).attr('data-id'));
            });

            $(document).on('submit', '#delete_from', function(e) {
                e.preventDefault();
                $('#delete_modal').modal('hide');
                let commentId = $('input[name="comment_id"]').val()
                $.ajax({
                    type: "delete",
                    url: "{{ route('admin.comments.destroy') }}",
                    data: {
                        _token: document.head.querySelector('meta[name="csrf-token"]').content,
                        comment_id: commentId,
                    },
                    success: function(response) {
                        $(`div#comment_${commentId}`).fadeOut(300).remove();
                        $.get(window.location.href, function(data) {
                            $('#pagination_data').html(data);
                        });
                    }
                });
            });

            $(document).on('submit', '#answer_from', function(e) {
                e.preventDefault()
                $('#answer_modal').modal('hide');
                let loading = $('.lds-ellipsis')[0];
                $('#comment_modal .modal-content').html(loading);
                let commentId = $('input[name="parrent_id"]').val()
                $.ajax({
                    type: "post",
                    url: "{{ route('admin.comments.store') }}",
                    data: {
                        _token: document.head.querySelector('meta[name="csrf-token"]').content,
                        parent_id: commentId,
                        comment: $('textarea[name="answer_comment"]').val(),
                    },
                    success: function(response) {
                        $('textarea[name="answer_comment"]').val('');
                        let url =
                            "{{ route('admin.comments.show', ['comment' => ':comment']) }}";
                        url = url.replace(':comment', commentId);
                        $.ajax({
                            type: "get",
                            url: url,
                            success: function(response) {
                                $('.lds-ellipsis').hide();
                                $('#comment_modal .modal-content').html(response);
                            }
                        });
                        $.get(window.location.href, function(data) {
                            $('#pagination_data').html(data);
                        });
                    }
                });
            })

            $(document).on('click', 'a[data-target="#comment_modal"]', function(e) {
                let url = "{{ route('admin.comments.show', ['comment' => ':comment']) }}";
                url = url.replace(':comment', $(e.currentTarget).attr('data-id'));
                $.ajax({
                    type: "get",
                    url: url,
                    success: function(response) {
                        $('.lds-ellipsis').hide();
                        $('#comment_modal .modal-content').html(response);
                    }
                });
            });

            $(document).on('click', '.comment-edit', function() {
                $(`#comment_text_${$(this).attr('data-id')}`).prop('readonly', false);
            });

            $(document).on('click', '.comment-apply', function(e) {
                let applyButton = $(e.currentTarget);
                applyButton.prop('disabled', true);
                $.ajax({
                    type: "post",
                    url: "{{ route('admin.comments.apply') }}",
                    data: {
                        _token: document.head.querySelector('meta[name="csrf-token"]').content,
                        id: $(this).attr('data-id'),
                        comment: $(`#comment_text_${$(this).attr('data-id')}`).val(),
                    },
                    success: function(response) {
                        $(`#comment_text_${applyButton.attr('data-id')}`).prop('readonly',
                            true);
                        $(`.comment-edit[data-id="${applyButton.attr('data-id')}"]`).prop(
                                'disabled', true),
                            $.get(window.location.href, function(data) {
                                $('#pagination_data').html(data);
                            });
                    },
                    error: function() {
                        $(`.comment-apply[data-id="${applyButton.attr('data-id')}"]`).prop(
                            'disabled', false);
                        $(`.comment-edit[data-id="${applyButton.attr('data-id')}"]`).prop(
                            'disabled', false);
                    },
                });
            });

            $(document).on('click','#chose_form',function(e){
                let choseBtn=$(this);
                e.preventDefault();
                choseBtn.prop('disabled','true');

                $.ajax({
                    type: "post",
                    url: "{{ route('admin.comments.chose') }}",
                    data: {
                        _token: document.head.querySelector('meta[name="csrf-token"]').content,
                        id: $(this).attr('data-id'),
                    },
                    success: function (response) {
                        if(response.comment.is_chose){
                            choseBtn.removeClass('btn-outline-warning');
                            choseBtn.addClass('btn-warning');
                        }else{
                            choseBtn.addClass('btn-outline-warning');
                            choseBtn.removeClass('btn-warning');
                        }
                        choseBtn.prop('disabled',false);
                    }
                });
            })
        });
    </script>
@endsection
