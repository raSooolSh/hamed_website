@extends('front.layouts.master')
@section('title', 'صفحه اصلی')
@section('id', 'welcome')
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
                <p class="text-white text-center my-5">دوره های آموزشی رمز ارز</p>
                <div class="text-center text-light mt-6">
                    <p class="mt-3" style="font-size: 26px;">هدف ما افزایش <span
                            class="text-primary fs-2 font-weight-bold">تخصص</span> شماست</p>
                </div>
            </div>
        </div>
    </section>
    <section class="position-relative" id="marketing">
        <div>
            <div class="owl-carousel owl-theme owl-rtl">
                <div class="item">
                    <div class="card bg-dark-500 text-white text-center rounded-4 px-4" style="width: 18rem;">
                        <img src="{{ asset('./images/learning.png') }}" class="card-img-top" alt="course">
                        <div class="card-body">
                            <strong class="fs-4">محتوا</strong>
                            <p class="card-text text-white-50">دروره های ما به صورت آموزش صفر تا صد طراحی و تا حد امکان از
                                پیچیدگی آن ها
                                کاسته شده است.</p>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card bg-dark-500 text-white text-center rounded-4 px-4" style="width: 18rem;">
                        <img src="{{ asset('./images/support.png') }}" class="card-img-top" alt="support">
                        <div class="card-body">
                            <strong class="fs-4">پشتیبانی</strong>
                            <p class="card-text text-white-50">تیم پشتیبانی ما شما را تا رسیدن به موفقیت در بازار های مالی
                                همراهی خواهد
                                کرد.</p>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="card bg-dark-500 text-white text-center rounded-4 px-4" style="width: 18rem;">
                        <img src="{{ asset('./images/guarantee.png') }}" class="card-img-top" alt="guarantee">
                        <div class="card-body">
                            <strong class="fs-4">بازگشت وجه</strong>
                            <p class="card-text text-white-50">از محتوا دوره ها راضی نبوده اید؟<br> با تیم پشتیبانی ما تماس
                                بگیرید تا به
                                درخواست شما رسیدگی شود.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="position-relative" id="currencies">
        <h4 class="text-primary w-100 position-absolute text-center">آخرین قیمت ها</h4>
        <div class='bg-transparent text-secondary'>
            <div class="owl-carousel owl-theme owl-rtl">
                @foreach (App\Models\Coin::all() as $coin)
                    <div class="item">
                        <div
                            class="card d-flex border border-2 bg-transparent flex-column justify-content-between rounded-4 px-4 py-2 text-light">
                            <div class="py-3 d-flex justify-content-between">
                                <div class="col-3">
                                    <img src="{{ url($coin->logo) }}" class="img-fluid" style="max-height: 2.8rem;"
                                        alt="{{ $coin->name }}">
                                </div>
                                <div class="d-flex flex-column col-9">
                                    <span class="text-start">{{ $coin->symbol }}</span>
                                    <span class="text-start">{{ $coin->name }}</span>
                                </div>

                            </div>
                            <div class="d-flex justify-content-between">
                                <span>قیمت کنونی:</span>
                                <span>{{ number_format($coin->price, 5) }}$</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>نسبت به دیروز :</span>
                                <span style="text-align: left" class="fs-6 {{ $coin->change_yesterday >= 0 ? 'text-success' : 'text-danger' }}"><i class="bi {{ $coin->change_yesterday >= 0 ? 'bi-caret-up-fill' : 'bi-caret-down-fill' }}"></i>{{ abs($coin->change_yesterday) }}%</span>
                            </div>
                            <div class="mt-3">
                                <span class="badge">روند 7 روزه</span>
                                {!! $coin->chart !!}
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <?php $course = App\Models\Course::where('is_active', 1)->first(); ?>
    @if ($course)
        <section id="courses" class="mt-5">
            <div class="container-fluid px-4">
                <div class="d-flex justify-content-between">
                    <h3 class="text-primary">دوره های آموزشی</h3>
                    <a href="{{ route('courses.index') }}" class="btn btn-primary">همه دوره ها</a>
                </div>
                <div class="d-flex flex-column flex-md-row align-items-center p-4">
                    <div class="col-10 col-sm-7 col-md-5 col-lg-4 col-xl-3 p-4">
                        <div class="card bg-dark-500 text-white text-center rounded-4">
                            @if ($course->discount())
                                <span class="bg-danger text-white position-absolute px-2 py-1 rounded-1"
                                    style="top:5px;right:5px;">{{ $course->discount_pct . '%' }} تخفیف</span>
                            @endif
                            <img class="rounded-4"
                                src="{{ route('image.get', ['w' => 200, 'h' => 200, 'image' => $course->image]) }}"
                                class="card-img-top" alt="{{ $course->name_en }}">
                            <div class="card-body">
                                <div class="course-title mb-2">
                                    <strong>{{ $course->name_fa }}</strong>
                                </div>
                                <div class="course-description text-white-50">
                                    {{ $course->description }}
                                </div>
                                <hr>
                                <strong class="course-price">

                                    @if ($course->discount())
                                        <p class="{{ $course->discount() ? 'text-danger' : '' }}">
                                            {{ number_format($course->price - $course->discount_off) }} تومان</p>
                                    @else
                                        <p>{{ number_format($course->price) }} تومان</p>
                                    @endif

                                </strong>
                                <a href="{{ route('courses.show', $course->slug) }}"
                                    class="btn btn-outline-primary px-5">مشاهده دوره</a>
                            </div>
                        </div>

                    </div>
                    <div class="col-10 col-md-7 col-lg-8 col-xl-9 ">
                        {{-- <h3 class="text-white text-center">منظر دوره های جدید ما باشید</h3> --}}

                        <div class="">
                            @if (App\Models\Course::where('is_active', 1)->count() < 1)
                                <div class="text-white text-center">
                                    <strong class="fs-2">منتظر دوره های بعدی ما باشید</strong>
                                </div>
                            @endif
                            <div class="owl-carousel owl-theme owl-rtl">
                                @foreach (App\Models\Course::where('is_active', 1)->orderby('updated_at')->offset(1)->limit(6)->get() as $course)
                                    <div class="item">
                                        <div class="card bg-dark-600 text-white text-center rounded-4">
                                            @if ($course->discount())
                                                <span class="bg-danger text-white position-absolute px-2 py-1 rounded-1"
                                                    style="top:5px;right:5px;">{{ $course->discount_pct . '%' }}
                                                    تخفیف</span>
                                            @endif
                                            <img class="rounded-4"
                                                src="{{ route('image.get', ['w' => 200, 'h' => 200, 'image' => $course->image]) }}"
                                                class="card-img-top" alt="{{ $course->name_en }}">
                                            <div class="card-body">
                                                <div class="course-title mb-2">
                                                    <strong>{{ $course->name_fa }}</strong>
                                                </div>
                                                <div class="course-description text-white-50">
                                                    {{ $course->description }}
                                                </div>
                                                <hr>
                                                <strong class="course-price">

                                                    @if ($course->discount())
                                                        <p class="{{ $course->discount() ? 'text-danger' : '' }}">
                                                            {{ number_format($course->price - $course->discount_off) }}
                                                            تومان</p>
                                                    @else
                                                        <p>{{ number_format($course->price) }} تومان</p>
                                                    @endif

                                                </strong>
                                                <a href="{{ route('courses.show', $course->slug) }}"
                                                    class="btn btn-outline-primary px-5">مشاهده دوره</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section id="articles" class="mt-5">
        <div class="container-fluid">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center text-white p-3">
                <div class="col-8 col-sm-3 col-md-2 d-flex flex-column align-items-center">
                    <span><i class="bi bi-newspaper fs-1"></i></span>
                    <span class="mb-2">اخبار و مقالات</span>
                    <a class="btn btn-secondary col-12 m-2" href="">اخبار</a>
                    <a class="btn btn-secondary col-12 m-2 text-white" href="">مقالات</a>
                </div>
                <div class="col-12 col-sm-9 col-md-10 px-3">

                    <div class="">
                        <div class="owl-carousel owl-theme owl-rtl">
                            @foreach (App\Models\Article::where('is_active', 1)->orderby('updated_at')->limit(8)->get() as $article)
                                <div class="item">
                                    <div class="card bg-dark-500 border border-2 border-secondary rounded-4 mx-2 p-2">
                                        <span
                                            class="badge {{ $article->getRawOriginal('type') == 'article' ? 'bg-info' : 'bg-success' }} position-absolute p-2"
                                            style="top:5px;right:5px;">{{ $article->type }}</span>
                                        <img src="{{ route('image.get', ['w' => 200, 'h' => 200, 'image' => "$article->image"]) }}"
                                            class="card-img-top" alt="article-{{ $article->id }}">
                                        <div class="card-body">
                                            <div class="text-end article-date mb-2">
                                                <span
                                                    class="">{{ jdate($article->updated_at)->format('d-M-Y') }}</span>
                                            </div>
                                            <div class="article-title">
                                                <strong>{{ $article->title }}</strong>
                                            </div>
                                            <div class="article-description text-white-50">
                                                <p>{{ $article->description }}</p>
                                            </div>
                                            <hr>
                                            <div class="text-start"><a href="#">مشاهده <i
                                                        class="bi bi-arrow-left"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section id="comments">
        <div class="container">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center text-white p-3">
                <div class="col-8 col-sm-3 col-md-2 d-flex flex-column align-items-center">
                    <span><i class="bi bi-award fs-1"></i></span>
                    <span class="mb-2">رضایت مشتریان</span>
                </div>
                <div class="col-12 col-sm-9 col-md-10 px-3">

                    <div class="">
                        <div class="owl-carousel owl-theme owl-rtl">
                            @foreach (App\Models\Comment::where('is_approved', 1)->where('is_chose', 1)->orderby('updated_at')->limit(10)->get() as $comment)
                                <div class="item px-3 col-10">
                                    <strong class="card-title">{{ $comment->user->full_name }}</strong>
                                    <p class="card-text mt-2">{{ $comment->comment }}.</p>
                                    <p class="card-text"><small
                                            class="text-muted">{{ jdate($comment->updated_at)->ago() }}</small></p>
                                </div>
                            @endforeach
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
            $('#marketing .owl-carousel').owlCarousel({
                nav: true,
                autoplay: true,
                autoplayHoverPause: true,
                loop: true,
                navText: ['<i class="bi bi-caret-right-fill fs-4 text-primary"></i>',
                    '<i class="bi bi-caret-left-fill fs-4 text-primary"></i>'
                ],
                rtl: true,
                dots: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    676: {
                        items: 2
                    },
                    948: {
                        items: 3
                    }
                }
            });

            $('#currencies .owl-carousel').owlCarousel({
                autoplay: true,
                autoplayHoverPause: true,
                loop: true,
                navText: ['<i class="bi bi-caret-right-fill fs-4 text-primary"></i>',
                    '<i class="bi bi-caret-left-fill fs-4 text-primary"></i>'
                ],
                rtl: true,
                dots: false,
                responsive: {
                    0: {
                        nav: true,
                        items: 1
                    },
                    600: {
                        nav: true,
                        items: 2
                    },
                    800: {
                        nav: true,
                        items: 3
                    },
                    1000: {
                        items: 4
                    },
                    1250: {
                        items: 5
                    },
                    1480: {
                        items: 6
                    }
                }
            });

            $('#courses .owl-carousel').owlCarousel({
                nav: true,
                navText: ['<i class="bi bi-caret-right-fill fs-4 text-primary"></i>',
                    '<i class="bi bi-caret-left-fill fs-4 text-primary"></i>'
                ],
                rtl: true,
                dots: false,
                responsive: {
                    0: {
                        navText: ['<i class="bi bi-caret-right-fill fs-4 text-white"></i>',
                            '<i class="bi bi-caret-left-fill fs-4 text-white"></i>'
                        ],
                        items: 1,
                    },
                    992: {
                        items: 2,
                    },
                    1200: {
                        items: 3,
                    },

                }
            });

            $('#articles .owl-carousel').owlCarousel({
                nav: true,
                navText: ['<i class="bi bi-caret-right-fill fs-4 text-primary"></i>',
                    '<i class="bi bi-caret-left-fill fs-4 text-primary"></i>'
                ],
                rtl: true,
                dots: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    700: {
                        items: 2
                    },
                    900: {
                        items: 3
                    },
                    1250: {
                        items: 4
                    },
                    1480: {
                        items: 5
                    }
                }
            });

            $('#comments .owl-carousel').owlCarousel({
                autoplay: true,
                autoplayHoverPause: true,
                loop: true,
                navText: ['<i class="bi bi-caret-right-fill fs-4 text-primary"></i>',
                    '<i class="bi bi-caret-left-fill fs-4 text-primary"></i>'
                ],
                rtl: true,
                dots: true,
                margin: 25,
                responsive: {
                    0: {
                        items: 1
                    }
                }
            });

        });
    </script>
@endsection
