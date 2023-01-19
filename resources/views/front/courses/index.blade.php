@extends('front.layouts.master')
@section('title', 'حامد حسن زاده | دوره ها')
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
                <h1 class="text-light me-5">دوره های آموزشی</h1>
            </div>
        </div>
        <nav class="">
            <ol class="cs-breadcrump">
                <li class="cs-breadcrump-item"><a href="{{ route('homepage') }}">صفحه اصلی</a></li>
                <li class="cs-breadcrump-item active">دوره ها</li>
            </ol>
        </nav>
    </section>

    <section>
        <div class="container my-5">
            <h3 class="text-primary mb-4">دوره های آموزشی</h3>

            <div class="row {{ $courses->count() > 3 ? 'justify-content-center' :'' }}">
                
                @foreach ($courses as $course)
                <div class="p-3 col-8 col-sm-6 col-md-4 col-lg-3">
                    <div class="card bg-dark-500 text-white border border-2 border-secondary text-center rounded-4 p-0">
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
                            <div class="course-price">

                                @if ($course->discount())
                                    <p class="{{ $course->discount() ? 'text-danger' : '' }}">
                                        {{ number_format($course->price - $course->discount_off) }} تومان</p>
                                @else
                                    <p>{{ number_format($course->price) }} تومان</p>
                                @endif

                            </div>
                            <a href="{{ route('courses.show',$course->slug) }}" class="btn btn-outline-primary px-5">مشاهده دوره</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-center" dir="ltr">
            {{ $courses->links() }}
        </div>
    </section>
@endsection
