@extends('front.layouts.master')
@section('title', $course->name_fa)
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
                <li class="cs-breadcrump-item active">{{ $course->name_fa }}</li>
            </ol>
        </nav>
    </section>
    <div class="row flex-lg-row container-fluid px-2 px-sm-3 px-lg-5 pt-5 position-relative">

        <h1 class="text-primary mb-5 me-3">{{ $course->name_fa }}</h1>


        <nav class="navbar navbar-expand bg-dark-500 text-white p-3 rounded-3 mb-4">
            <ul class="navbar-nav">
                <li class="nav-item px-3">
                    <strong><a class="nav-link text-white btn-scroll" href="" scroll-to="#description">توضیحات</a></strong>
                </li>
                <li class="nav-item px-3">
                    <strong><a class="nav-link text-white btn-scroll" href="" scroll-to="#guarantee">ضمانت بازگشت وجه</a></strong>
                </li>
                <li class="nav-item px-3">
                    <strong><a class="nav-link text-white btn-scroll" href="" scroll-to="#episodes">جلسات دوره</a></strong>
                </li>
                <li class="nav-item px-3">
                    <strong><a class="nav-link text-white btn-scroll" href="" scroll-to="#comments">پرسش و پاسخ</a></strong>
                </li>
            </ul>
        </nav>
    </div>

    <section>
        <div class="row container-fluid px-2 px-sm-3 px-lg-5 position-relative">

            <aside class="col-lg-4 pb-3 h-100">

                <div class="d-flex flex-wrap mb-3">
                    <div class="col-4 p-2">
                        <div class="d-flex gap-2 py-3 flex-column text-center bg-dark-500 rounded-3 text-white">
                            <i class="bi bi-mortarboard fs-2"></i>
                            <p>نوع دوره :</p>
                            <strong>{{ $course->is_free ? 'رایگان' : 'نقدی' }}</strong>
                        </div>
                    </div>

                    <div class="col-4 p-2">
                        <div class="d-flex gap-2 py-3 flex-column text-center bg-dark-500 rounded-3 text-white">
                            <i class="bi bi-film fs-2"></i>
                            <p>تعداد جلسات :</p>
                            <strong>{{ $course->episodes->count() - 1 }}</strong>
                        </div>
                    </div>

                    <div class="col-4 p-2">
                        <div class="d-flex gap-2 py-3 flex-column text-center bg-dark-500 rounded-3 text-white">
                            <i class="bi bi-calendar2-date fs-2"></i>
                            <p>آخرین آپدیت :</p>
                            <strong>{{ jdate($course->episodes()->orderby('updated_at')->first()->updated_at ?? $course->updated_at)->format('Y-m-d') }}</strong>
                        </div>
                    </div>
                </div>


                <div class="d-flex justify-content-center px-lg-3 position-sticky" style="top:65px;">
                    <div
                        class="card bg-dark-500 d-flex flex-column-reverse flex-md-row flex-wrap justify-content-between border border-2 border-secondary rounded-3">
                        <div class="d-flex flex-column flex-sm-row-reverse flex-lg-column text-white position-relative">
                            <div class="col-sm-4 col-lg-12 d-flex flex-column justify-content-center">
                                <img class="card-img-top px-sm-2 px-lg-0"
                                    src="{{ route('image.get', ['w' => 400, 'h' => 400, 'image' => $course->image]) }}"
                                    alt="{{ $course->name_en }}">
                            </div>
                            <div class="col-sm-8 col-lg-12 py-3">
                                <div class="course-title px-3">
                                    <strong>{{ $course->name_fa }}</strong>
                                </div>
                                <p class="text-white-50 p-3">{{ $course->description }}</p>
                                <div
                                    class="d-flex flex-lg-column-reverse mt-auto justify-content-between align-items-center p-3">
                                    <a href="{{ route('course.invoice',['course'=>$course->slug]) }}" class="btn btn-primary px-3">خرید دوره<i
                                            class="bi bi-bag-check fs-5 me-5"></i></a>
                                    @if ($course->discount())
                                        <div class="d-felx flex-column mb-lg-3">
                                            <div>
                                                <strong
                                                    class="text-danger text-decoration-line-through fs-5">{{ number_format($course->price) }}
                                                    تومان</strong>
                                            </div>
                                            <strong
                                                class="text-white fs-5">{{ number_format($course->price - $course->discount_off) }}
                                                تومان</strong>
                                        </div>
                                    @else
                                        <strong class="text-white fs-5">{{ number_format($course->price) }} تومان</strong>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </aside>


            <div class="col-lg-8 mb-3">
                <div class="card py-3 px-4 bg-dark-500 rounded-3 text-white mb-3" id="description">
                    <strong class="fs-4 mb-4">توضیحات</strong>
                    <div class="py-3">
                        {!! $course->content !!}
                    </div>
                    @if ($course->episodes()->whereNumber(0)->first())
                        <video class="w-100" src="{{ $course->episodes()->whereNumber(0)->first()->download() }}"
                            controls></video>
                    @endif
                </div>

                <div class="py-3 px-4 bg-dark-500 rounded-3 text-white mb-3" id="guarantee">
                    <strong class="fs-4 mb-4">گارانتی بازگشت وجه</strong>
                    <div class="row py-3 justify-content-between align-items-center">
                        <div class="col-sm-3 col-lg-2">
                            <img class="w-100" src="{{ asset('images/guarantee-icon.png') }}" alt="guarantee">
                        </div>
                        <div class="col-sm-8 col-lg-9 text-justify px-5 fs-5">
                            برای آنکه به شما اطمینان دهیم، که ما از محتوای دوره‌های خود ۱۰۰ درصد مطمئن هستیم، برای این دوره
                            گارانتی بازگشت وجه قرار داده‌ایم و این به این معنی است که اگر شما محتوای این دوره را به شکل کامل
                            مشاهده کنید، اما نتیجه‌ای که به شما قول دادیم را دریافت نکنید ۱۰۰ درصد مبلغ پرداختی شما را برگشت
                            خواهیم زد.
                        </div>
                    </div>
                </div>

                <div class="py-3 px-4 bg-dark-500 rounded-3 text-white mb-3" id="episodes">
                    <strong class="fs-4 mb-4">جلسات دوره</strong>
                    <div>
                        <div class="accordion accordion-flush py-3" id="episodes_accrdion">
                            @foreach ($course->sections()->orderby('id')->get() as $section)
                                <div class="accordion-item bg-dark-600 text-white mb-2 py-2 rounded-3 border-0">
                                    <strong class="accordion-header d-flex justify-content-between px-4">
                                        <a class="text-white rounded-3 collapsed w-100 fs-4" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse-{{ $section->id }}"
                                            aria-expanded="false" aria-controls="flush-collapseOne">
                                            {{ $section->name }}
                                        </a>
                                        <i class="bi bi-caret-left-fill fs-4"></i>
                                    </strong>
                                    <div id="collapse-{{ $section->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="flush-headingOne" data-bs-parent="#episodes_accrdion">
                                        <div class="accordion-body">
                                            <ul class="list-unstyled">
                                                @foreach ($section->episodes()->where('number', '>', 0)->orderby('number')->get() as $episode)
                                                    <li
                                                        class="d-flex justify-content-start align-items-center p-3 bg-dark-500 rounded-3 mb-2">
                                                        <div class="col-8 d-flex">
                                                            <span class="fs-5 ms-3">
                                                                {{ $episode->is_free || $course->is_free ? $episode->number : '' }}
                                                                <i class='bi bi-shield-lock-fill text-danger'
                                                                    style="{{ $episode->is_free || $course->is_free ? 'display:none;' : '' }}"></i>
                                                                |
                                                            </span>
                                                            <span class="fs-6 overflow-hidden">{{ $episode->name }}</span>
                                                        </div>
                                                        <div class="col-4 d-flex justify-content-end ms-auto">
                                                            <a class="text-white btn btn-sm btn-primary"
                                                                href="{{ route('episode.show', ['course' => $course->slug, 'number' => $episode->number]) }}">مشاهده
                                                                <i class="bi bi-eye"></i>
                                                            </a>
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

                <div class="py-3 px-4 bg-dark-500 rounded-3 text-white" id="comments">
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
                                        <textarea class="form-control bg-dark-500 text-white mb-3" placeholder="متن خود را اینجا وارد کنید ..."
                                            name="comment" rows="3"></textarea>

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
                            @include('front.comments.show',['comment'=>$comment,'bg_color'=>'bg-dark-600'])
                        @endforeach

                        <div class="d-flex mt-3 justify-content-center" dir="ltr">
                            {{ $comments->fragment("comments")->links() }}
                        </div>
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
                let commentable_type = "{{ str_replace('\\', '\\\\', get_class($course)) }}";
                let commentable_id = {{ $course->id }};
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
