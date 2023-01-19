<div class="mb-2 me-2">
    <div class="card p-3 {{ $bg_color }}">
        <div class="d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <img class="img-profile rounded-circle"
                    src="{{ route('image.get', ['w' => 200, 'h' => 200, 'image' => $comment->user->avatar]) }}"
                    alt="">
                <div class="px-2 d-flex flex-column">
                    <strong class="">{{ $comment->user->full_name }}</strong>
                    <small class="text-white-50">{{ jdate($comment->created_at)->ago() }}</small>
                </div>

            </div>
            @if (Auth::check())
            <div class="align-self-start">
                <a class="btn btn-sm btn-outline-danger btn-scroll" scroll-to="#answer_{{ $comment->id }}"
                    href="#answer_{{ $comment->id }}" data-bs-toggle="collapse">ارسال پاسخ<i
                        class="bi bi-reply-fill me-2"></i></a>
            </div>
                
            @endif
        </div>


        <hr>

        <div class="mb-4 px-3 py-2">{{ $comment->comment }}</div>
        @foreach ($comment->childs as $child)
            @include('front.comments.show', [
                'comment' => $child,
                'bg_color' => $bg_color == 'bg-dark-600' ? 'bg-dark-500' : 'bg-dark-600',
            ])
        @endforeach
        @if (Auth::check())
            <div class="collapse pe-4 mb-2" id="answer_{{ $comment->id }}">
                <hr>
                <div class="card p-3 {{ $bg_color == 'bg-dark-600' ? 'bg-dark-500' : 'bg-dark-600' }}">
                    <div class="d-flex align-items-start">
                        <img class="img-profile rounded-circle"
                            src="{{ route('image.get', ['w' => 200, 'h' => 200, 'image' => Auth::user()->avatar]) }}"
                            alt="">
                        <strong class="px-2">{{ Auth::user()->full_name }}</strong>
                    </div>

                    <hr>

                    <form action="" class="add-comment">
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                        <textarea class="form-control bg-dark-500 text-white mb-3" placeholder="پاسخ خود را اینجا وارد کنید ..." name="comment"
                            rows="3"></textarea>

                        <div class="d-flex justify-content-end">
                            <p id="result" class="badge ms-auto"></p>
                            <button type="submit" class="btn btn-danger ms-3">ارسال
                                پاسخ</button>
                            <a class="btn btn-outline-secondary" href="#answer_{{ $comment->id }}"
                                data-bs-toggle="collapse">انصراف</a>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>

</div>
