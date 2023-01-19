@extends('admin.layouts.master')
@section('title', 'ایجاد اپیزود')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">ایجاد اپیزود</h1>
    </div>
    {{-- /page heading --}}
    <hr class="">
    @include('admin.section.error')

    <form action="{{ route('admin.episodes.store', $course->slug) }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="name">نام نمایشی</label>
                <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}"
                    placeholder="برای مثال معرفی دوره">
            </div>
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="section">بخش</label>
                <select class="form-control" id="section" name="section_id">
                    @foreach ($course->sections as $section)
                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="number">قسمت</label>
                <input class="form-control" type="number" id="number" name="number" value="{{ old('number') }}">
                <p class="badge">تعداد قسمت ها تا کنون : {{ $course->episodes->count() }}</p>
            </div>
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="is_free">دسترسی</label>
                <select class="form-control" id="is_free" name="is_free">
                    <option value="1">رایگان</option>
                    <option value="0" selected>نقدی</option>
                </select>
            </div>
        </div>
        <hr>
        <div class="row mb-3 align-items-center">
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="">ویدیو</label>
                <div class="input-group" dir="ltr">
                    <input type="text" class="form-control" id="file-manager-input" name="video" value="{{ old('video') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="file-manager-button" type="button">انتخاب</button>
                    </div>
                </div>
            </div>

        </div>
        <hr>

        <div class="text-left mt-5">
            <a href="{{ route('admin.episodes.index', $course->slug) }}" class="btn btn-danger">بازگشت</a>
            <button type="submit" class="btn btn-success">ایجاد اپیزود</button>
        </div>
    </form>

@endsection
@section('script')
@endsection
