@extends('admin.layouts.master')
@section('title', 'ایجاد مطلب')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">ایجاد مطلب</h1>
    </div>
    {{-- /page heading --}}
    <hr class="">
    @include('admin.section.error')
    <form action="{{ route('admin.articles.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="title">عنوان</label>
                <input class="form-control" type="text" id="title" name="title" value="{{ old('title') }}">
            </div>
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="type">نوع</label>
                <select class="form-control" id="type" name="type">
                    <option value="news">خبری</option>
                    <option value="article">مقاله</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <label for="description">توضیحات</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
            </div>
        </div>
        <hr>
        <div class="row mb-3" id="file-manager">
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="">تصویر</label>
                <div class="input-group" dir="ltr">
                    <input type="text" class="form-control" id="file-manager-input" name="image"
                        value="{{ old('image') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="file-manager-button" type="button">انتخاب</button>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="is_active">وضعیت</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1" selected>فعال</option>
                    <option value="0">غیرفعال</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <label for="content">محتوا</label>
                <textarea class="form-control" rows="10" id="content" name="content">{{ old('content') }}</textarea>
            </div>
            <div class="mt-3 mr-3">
                <span class="badge badge-warning">قبل از ذخیره لطفا چک کنید در یخش محتوا از h1 (Heading 1) استفاده نکرده
                    باشید</span>
            </div>
        </div>

        <div class="text-left mt-5">
            <a href="{{ route('admin.articles.index') }}" class="btn btn-danger">بازگشت</a>
            <button type="submit" class="btn btn-success">ایجاد مطلب</button>
        </div>

    </form>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('content', {
                filebrowserImageBrowseUrl: '/file-manager/ckeditor',
            });
        })
    </script>
@endsection
