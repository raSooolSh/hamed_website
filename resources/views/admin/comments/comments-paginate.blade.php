@if ($comments->total())
    <table class="table table-bordered table-striped">

        <thead class="thead-dark text-center">
            <tr>
                <th>آیدی</th>
                <th>کاربر</th>
                <th>آیدی کامنت پدر</th>
                <th>دسته</th>
                <th>وضعیت</th>
                <th>ایجاد شده در</th>
                <th>اقدامات</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($comments as $comment)
                <tr class="text-center">
                    <th>{{ $comment->id }}</th>
                    <th>{{ $comment->user->full_name }}</th>
                    <th>{{ $comment->parent->id ?? 'ندارد' }}</th>
                    <th>{{ $comment->commentable_type.' - '.$comment->commentable->name }}</th>
                    <th>
                        @if ($comment->is_approved)
                            <span class="badge badge-success">تایید شده</span>
                        @else
                            <span class="badge badge-danger">در انتظار تایید</span>
                        @endif
                    </th>
                    <th>{{ jdate($comment->created_at)->ago() }}</th>

                    <th>
                        <a class="btn btn-success py-1" data-toggle="modal" href=""
                            data-target="#comment_modal" data-id="{{ $comment->id }}">
                            <i class="fa fa-eye"></i>
                        </a>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="text-center p-3" id='not_found'>
        <h4 class="">هیچ نتیجه ای یافت نشد!</h4>
        <img class="img-fluid" src="{{ url('/images/not-found.png') }}" alt="not-found">
    </div>

@endif

<div class="row justify-content-center" dir="ltr">
    {{ $comments->appends(['search' => request()->get('search')])->links() }}
</div>
