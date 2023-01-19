@extends('front.layouts.master')
@section('title', 'حامد حسن زاده | ' . bsISActive('news.index', 'اخبار') . bsISActive('articles.index', 'مقالات'))
@section('id', 'articles')
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
                <h1 class="text-light me-5">{{ bsISActive('news.index', 'اخبار') ?? 'مقالات' }}</h1>
            </div>
        </div>
        <nav class="">
            <ol class="cs-breadcrump">
                <li class="cs-breadcrump-item"><a href="{{ route('homepage') }}">صفحه اصلی</a></li>
                <li class="cs-breadcrump-item active">{{ bsISActive('news.index', 'اخبار') ?? 'مقالات' }}</li>
            </ol>
        </nav>
    </section>

    <section>
        <div class="container my-5">
            <h3 class="text-primary mb-4">{{ bsISActive('news.index', 'اخبار') ?? 'مقالات' }}</h3>

            <div class="row text-white {{ $articles->count() > 3 ? 'justify-content-center' : '' }}">

                @foreach ($articles as $article)
                    <div class="p-3 col-8 col-sm-6 col-md-4 col-lg-3">
                        <div class="card bg-dark-500 border border-2 border-secondary rounded-4 mx-2 p-2">
                            <img src="{{ route('image.get', ['w' => 200, 'h' => 200, 'image' => "$article->image"]) }}"
                                class="card-img-top" alt="article-{{ $article->id }}">
                            <div class="card-body">
                                <div class="text-end article-date mb-2">
                                    <span class="">{{ jdate($article->updated_at)->format('d-M-Y') }}</span>
                                </div>
                                <div class="article-title">
                                    <strong>{{ $article->title }}</strong>
                                </div>
                                <div class="article-description text-white-50">
                                    <p>{{ $article->description }}</p>
                                </div>
                                <hr>
                                <div class="text-start"><a href="#">مشاهده <i class="bi bi-arrow-left"></i></a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-center" dir="ltr">
            {{ $articles->links() }}
        </div>
    </section>
@endsection
