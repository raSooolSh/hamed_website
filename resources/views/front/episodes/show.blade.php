@extends('front.layouts.master')
@section('title', $episode->name)
@section('id', 'courses')
@section('content')
    <section id="header">
        <div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
        </div>
        <div class="container">
            <div class="context">
                <h4 class="h1 text-light me-5">دوره های آموزشی</h4>
            </div>
        </div>
        <nav class="">
            <ol class="cs-breadcrump">
                <li class="cs-breadcrump-item"><a href="{{ route('homepage') }}">صفحه اصلی</a></li>
                <li class="cs-breadcrump-item"><a href="{{ route('courses.index') }}">دوره ها</a></li>
                <li class="cs-breadcrump-item"><a
                        href="{{ route('courses.show', $course->slug) }}">{{ $course->name_fa }}</a></li>
                <li class="cs-breadcrump-item active">{{ $episode->name }}</li>
            </ol>
        </nav>
    </section>

    <h1 class="text-primary mt-4 mb-3 me-5">{{ $episode->course->name_fa }}</h1>


    <section>
        <div class="px-5">

            <div class="row p-3 bg-dark-500 mb-3 rounded-3 position-relative">
                <span class="text-white mb-3 fs-5">{{ $episode->number }} - {{ $episode->name }}</span>
                @if ($episode->is_free)
                    <div class="col-lg-8">
                        <video class="w-100" src="{{ $episode->download() }}" controls></video>
                    </div>
                @else
                    <div class="col-lg-8 position-relative">
                        <img src="{{ $episode->course->image }}" alt="course" class="img-fluid">
                        @if (Auth::check())
                            <a href="{{ route('course.invoice', $course->slug) }}"
                                class="absolute-centered w-50 text-center bg-light-50 py-3 rounded-3 text-black">
                                <i class="bi bi-shield-lock-fill text-danger fs-2 d-block"></i>
                                <span class="fs-6">
                                    fمشاهده این جلسه فقط اعضای دوره امکان پذیر است، برای <strong class="text-primary">خرید
                                        دوره</strong> کلیک کنید
                                </span>
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="absolute-centered w-50 text-center bg-light-50 py-3 rounded-3 text-black">
                                <i class="bi bi-shield-lock-fill text-danger fs-2 d-block"></i>
                                <span class="fs-6">
                                    برای دسترسی به این قسمت ابتدا <strong class="text-primary">وارد
                                        سایت</strong> شوید
                                </span>
                            </a>
                        @endif
                    </div>
                @endif

                <div class="col-lg-4" id="episodes_list">
                    <div class="accordion accordion-flush py-3" id="episodes_accrdion">
                        @foreach ($course->sections()->orderby('id')->get() as $section)
                            <div class="accordion-item bg-dark-600 text-white mb-2 py-2 rounded-3 border-0">
                                <strong class="accordion-header d-flex justify-content-between px-4">
                                    <a class="text-white rounded-3 collapsed  w-100 fs-4" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse-{{ $section->id }}"
                                        aria-expanded="false" aria-controls="flush-collapseOne">
                                        {{ $section->name }}
                                    </a>
                                    <i class="bi bi-caret-left-fill fs-4"></i>
                                </strong>
                                <div id="collapse-{{ $section->id }}"
                                    class="accordion-collapse collapse {{ in_array($episode->id, $section->episodes->pluck('id')->toArray()) ? 'show' : '' }}"
                                    aria-labelledby="flush-headingOne" data-bs-parent="#episodes_accrdion">
                                    <div class="accordion-body">
                                        <ul class="list-unstyled">
                                            @foreach ($section->episodes()->where('number', '>', 0)->orderby('number')->get() as $semi_episode)
                                                <li
                                                    class="d-flex justify-content-start align-items-center p-3 bg-dark-500 rounded-3 mb-2">
                                                    <div class="col-8 d-flex">
                                                        <span class="fs-5 ms-3">
                                                            {{ $semi_episode->is_free || $course->is_free ? $semi_episode->number : '' }}
                                                            <i class='bi bi-shield-lock-fill text-danger'
                                                                style="{{ $semi_episode->is_free || $course->is_free ? 'display:none;' : '' }}"></i>
                                                            |
                                                        </span>
                                                        <span class="fs-6">{{ $semi_episode->name }}</span>
                                                    </div>
                                                    <div class="col-4 d-flex justify-content-end ms-auto">
                                                        @if ($episode->id != $semi_episode->id)
                                                            <a class="text-white btn btn-sm btn-primary"
                                                                href="{{ route('episode.show', ['course' => $course->slug, 'number' => $semi_episode->number]) }}">مشاهده
                                                                <i class="bi bi-eye"></i>
                                                            </a>
                                                        @else
                                                            <i class="bi bi-play-fill fs-5 text-success"></i>
                                                        @endif
                                                    </div>
                                                </li>
                                            @endforeach
                                    </div>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card py-3 px-4 bg-dark-500 rounded-3 text-white" id="comments">
                <div>
                    <div class="d-flex justify-content-between align-items-start">
                        <strong class="fs-4 mb-4">پرسش و پاسخ</strong>
                        @if (Auth::check())
                            <a class="btn btn-outline-primary" href="#add_comment" data-bs-toggle="collapse">افزودن
                                دیدگاه <i class="bi bi-plus"></i></a>
                        @endif
                    </div>

                    @if (Auth::check())
                        <div class="collapse mb-2" id="add_comment">
                            <div class="card bg-dark-600 p-3">
                                <div class="d-flex align-items-start">
                                    <img class="img-profile rounded-circle"
                                        src="{{ route('image.get', ['w' => 200, 'h' => 200, 'image' => Auth::user()->avatar]) }}"
                                        alt="">
                                    <strong class="px-2">{{ Auth::user()->full_name }}</strong>
                                </div>

                                <hr>

                                <form action="" class="add-comment">
                                    <input type="hidden" name="parent_id" value="0">
                                    <textarea class="form-control bg-dark-500 text-white mb-3" placeholder="متن خود را اینجا وارد کنید ..." name="comment"
                                        rows="3"></textarea>

                                    <div class="d-flex justify-content-end">
                                        <p id="result" class="badge ms-auto"></p>
                                        <button type="submit" class="btn btn-primary ms-3">ثبت نظر</button>
                                        <a class="btn btn-outline-secondary" href="#add_comment"
                                            data-bs-toggle="collapse">انصراف</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                    @foreach ($comments as $comment)
                        @include('front.comments.show', [
                            'comment' => $comment,
                            'bg_color' => 'bg-dark-600',
                        ])
                    @endforeach

                    <div class="d-flex mt-3 justify-content-center" dir="ltr">
                        {{ $comments->fragment('comments')->links() }}
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('submit', '.add-comment', function(e) {
                e.preventDefault();

                let comment = e.currentTarget.querySelector('textarea[name="comment"]');
                let parent_id = e.currentTarget.querySelector('input[name="parent_id"]');
                let token = document.head.querySelector('meta[name="csrf-token"]').content;
                let commentable_type = "{{ str_replace('\\', '\\\\', get_class($episode)) }}";
                let commentable_id = {{ $episode->id }};
                let result = e.target.querySelector('p#result');

                if (comment.value.trim() == "") {
                    result.innerHTML = 'متن کامنت نمی تواند خالی باشد';
                    result.classList.add('bg-danger');
                    result.classList.remove('bg-success');
                }
                e.target.querySelector('button[type="submit"]').classList.add('disabled')
                $.ajax({
                    type: "post",
                    url: "{{ route('comments.store') }}",
                    data: {
                        '_token': token,
                        'parent_id': parent_id.value,
                        'comment': comment.value,
                        'commentable_type': commentable_type,
                        'commentable_id': commentable_id,
                    },
                    success: function(response) {
                        comment.value = '';
                        e.target.querySelector('button[type="submit"]').classList.remove(
                            'disabled');
                        console.log(response.is_approved)
                        if (response.is_approved) {
                            result.innerHTML = 'دیدگاه شما با موفقیت ثبت شد';
                        } else {
                            result.innerHTML = 'دیدگاه شما پس از تایید نمایش داده خواهد شد';
                        }
                        result.classList.add('bg-success');
                        result.classList.remove('bg-danger');
                    },

                    error: function(response) {
                        e.target.querySelector('button[type="submit"]').classList.remove(
                            'disabled');

                        result.innerHTML = "مشکلی پیش آمده لطفا دوباره امتحان کنید";
                        result.classList.add('bg-danger');
                        result.classList.remove('bg-success');
                    }
                });
            })
        })
    </script>
@endsection
