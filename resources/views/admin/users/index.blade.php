@extends('admin.layouts.master')

@section('title', 'کاربران')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800"> کاربران </h1>
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
                    value="{{ request()->get('search') }}" placeholder="آیدی، شماره همراه یا کد ملی" aria-label="Search"
                    aria-describedby="basic-addon2">
            </div>
        </form>
    </div>
    {{-- /search box --}}

    {{-- users table --}}
    <div id='pagination_data'>
            @include('admin.users.user-paginate', ['users' => $users])
    </div>

    {{-- userModal --}}
    <div class="modal fade" id="user_modal" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
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
    {{-- /userModal --}}

    {{-- blockModal --}}
    <div class="modal fade" id="block_modal" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{ route('admin.users.block') }}" method="post" id="block_form">
                        @csrf
                        <input type="hidden" name="user_id" value="">
                        <div>
                            <textarea class="form-control mb-3" rows="4" name='block_reason'
                                placeholder="پیامی برای کاربر ثبت کنید تا از دلیل بلاک شدن خود مطلع شود"></textarea>
                        </div>
                    </form>
                    <button type="button" class="btn btn-sm btn-info" data-dismiss="modal">بیخیال</button>
                    <button type="submit" class="btn btn-sm btn-danger" disabled>حله، بلاک شه!</button>
                </div>

            </div>
        </div>
    </div>
    {{-- /blockModal --}}
@endsection
@section('script')
    <script>
        $(document).on('click', 'a[data-target="#block_modal"]', function(e) {
            $('input[name="user_id"]').val($(e.currentTarget).attr('data-id'))
        });

        $(document).on('keyup', 'textarea[name="block_reason"]', function() {
            if ($(this).val().length) {
                $('#block_modal button[type="submit"]').prop('disabled', false);
            } else {
                $('#block_modal button[type="submit"]').prop('disabled', true)
            }
        })

        $(document).on('click', '#block_modal button[type="submit"]', function(e) {
            e.preventDefault();
            if ($('textarea[name="block_reason"]').val().length) {
                $('#block_form').submit();
            }
        });

        $(document).on('click', 'a[data-target="#user_modal"]', function(e) {
            let url = "{{ route('admin.users.show', ['user' => ':user']) }}";
            url = url.replace(':user', $(e.currentTarget).attr('data-id'));
            $.ajax({
                type: "get",
                url: url,
                success: function(response) {
                    $('.lds-ellipsis').hide();
                    $('#user_modal .modal-content').html(response);
                }
            });
        })
    </script>
@endsection
