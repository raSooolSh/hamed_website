<div class="col-12 d-flex flex-column rounded rounded-3 my-2 mx-2 border p-3 bg-light" id="comment_{{ $comment->id }}">
    <div class="row align-items-center pb-3 mr-2">
        <img class="rounded rounded-circle mx-2 img-profile-sm"
            src="{{ route('image.get', ['w' => 100, 'h' => 100, 'image' => $comment->user->avatar]) }}" alt="userImage">
        <span>{{ $comment->user->full_name }}</span>
    </div>
    <div class="p-3 rounded rounded-3 ml-3 border {{ $comment->id == $selected ? 'border-primary' : '' }}">
        <div class="d-flex justify-content-between align-items-center mb-2">
            @if (!!!$comment->parent)
                <span class="badge badge-sm badge-success mb-2">کامنت اصلی</span>
            @else
                <span class="badge badge-sm badge-danger mb-2">کامنت پاسخ</span>
            @endif
            <button type="button" id="chose_form" class="btn btn-sm {{ $comment->is_chose ? 'btn-warning':'btn-outline-warning' }} mx-1 rounded rounded-3"
                data-id={{ $comment->id }}>
                <i class="fa fa-star"> رضایت مشتری </i>
            </button>
        </div>


        <form action="">
            <div class="input-group">
                <textarea class="form-control" name="comment" id="comment_text_{{ $comment->id }}" rows="3" readonly>{{ $comment->comment }}</textarea>
            </div>
        </form>

        <div class="p-2 row flex-row-reverse">
            <button type="button" class="btn btn-sm btn-success mx-1 rounded rounded-3 comment-apply"
                {{ $comment->is_approved ? 'disabled' : '' }} data-id="{{ $comment->id }}">
                <i class="fa fa-check-square"></i>
            </button>
            <button type="button" class="btn btn-sm btn-danger mx-1 rounded rounded-3" data-toggle="modal"
                data-target="#delete_modal" data-id={{ $comment->id }}>
                <i class="fa fa-times"></i>
            </button>
            <button type="button" class="btn btn-sm btn-primary mx-1 rounded rounded-3 comment-edit"
                data-id="{{ $comment->id }}" {{ $comment->is_approved ? 'disabled' : '' }}>
                <i class="fa fa-pencil"></i>
            </button>
            <button type="button" class="btn btn-sm btn-info mx-1 rounded rounded-3"data-toggle="modal"
                data-target="#answer_modal" data-id={{ $comment->id }}>
                <i class="fa fa-comment"></i>
            </button>
            

        </div>
    </div>
    @foreach ($comment->childs as $child)
        @include('admin.comments.commment', ['comment' => $child, 'selected' => $selected])
    @endforeach
</div>
