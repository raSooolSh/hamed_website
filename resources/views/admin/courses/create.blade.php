@extends('admin.layouts.master')
@section('title', 'ایجاد دوره')
@section('style')
    <link rel="stylesheet" href="{{ asset('vendor/MD.DTP/dist/jquery.md.bootstrap.datetimepicker.style.css') }}">
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">ایجاد دوره</h1>
    </div>
    {{-- /page heading --}}
    <hr class="">
    @include('admin.section.error')
    <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="name">نام</label>
                <input class="form-control" type="text" id="name_fa" name="name_fa" value="{{ old('name_fa') }}">
            </div>
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="name">نام لاتین</label>
                <input class="form-control" type="text" id="name_en" name="name_en" value="{{ old('name_en') }}">
            </div>
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="teacher">مدرس</label>
                <input class="form-control" type="text" id="teacher" name="teacher" value="{{ old('teacher') }}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <label for="description">توضیحات</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="(برای استفاده در موتور های جستجو).لطفا متن این قسمت را با دقت وارد کرده و نسبت به دیگر دوره ها متمایز کنید همچنین از همین متن درون محتوای دوره استفاده کنید">{{ old('description') }}</textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="price">قیمت (تومان)</label>
                <input class="form-control" type="text" id="price" name="price" value="{{ old('price') }}">
                <p class="badge my-2">در صورت رایگان بودن دوره این قسمت را خالی رها کنید</p>
            </div>
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="is_active">وضعیت</label>
                <select class="form-control" id="is_active" name="is_active">
                    <option value="1">فعال</option>
                    <option value="0">غیرفعال</option>
                </select>
            </div>
        </div>
        <hr>
        <p>اعمال تخفیف</p>
        <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="discount_off">مقدار (تومان)</label>
                <input class="form-control" type="text" id="discount_off" name="discount_off"
                    value="{{ old('discount_off') }}">
                <p class="badge my-2"> تخفیف ندارید ؟ این قسمت را خالی رها کنید</p>
            </div>
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="is_active">تا تاریخ</label>
                <div class="input-group">
                    <div class="input-group-prepend order-2">
                        <span class="input-group-text" id="discount_expire">
                            <i class="fa fa-clock"></i>
                        </span>
                    </div>
                    <input type="text" name="discount_expire_at" value="{{ old('discount_expire_at') }}"
                        class="form-control">
                </div>
                <p class="badge my-2">خالی بودن این قسمت به منظور عدم داشتن محدودیت زمانی می باشد</p>

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
            <div class="col-md-6 text-center" id="course_image">
                {{-- fill with javaScript --}}
            </div>
        </div>

        <hr>
        <div class="accordion" id="sectionsAccrodian">
            <button type="button" class="btn d-flex justify-content-between align-items-center col-12"
                data-toggle="collapse" data-target="#sections">
                <span>بخش ها</span>
                <i class="fa fa-arrow-left"></i>
            </button>
            <div class="collapse p-4 show" id="sections">
                @if (old('section'))
                    @foreach (old('section') as $key => $section)
                        <div class="row align-items-center" id="section-{{ $key }}">
                            <button class="btn btn-danger mx-3" type="button"
                                onclick="document.getElementById('section-{{ $key }}').remove()">
                                <i class="fa fa-trash"></i>
                            </button>
                            <div class="form-group">
                                <label>نام</label>
                                <input class="form-control" type="text" name="section[{{ $key }}]"
                                    value="{{ $section }}">
                            </div>
                        </div>
                    @endforeach
                @endif
                <button type="button" class="btn btn-success mr-5"
                    onclick="addSection(document.getElementById('sections'))"><i class="fa fa-plus"></i></button>
            </div>
        </div>

        <hr>

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
            <a href="{{ route('admin.courses.index') }}" class="btn btn-danger">بازگشت</a>
            <button type="submit" class="btn btn-success">ایجاد دوره</button>
        </div>

    </form>
@endsection
@section('script')
    <script src="{{ asset('/vendor/MD.DTP/dist/jquery.md.bootstrap.datetimepicker.js') }}"></script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('content', {
                filebrowserImageBrowseUrl: '/file-manager/ckeditor',
            });

            $('#discount_expire').MdPersianDateTimePicker({
                targetTextSelector: 'input[name="discount_expire_at"]',
                englishNumber: true,
                textFormat: 'yyyy-MM-dd HH:mm:ss',
                disableBeforeToday: true,
                enableTimePicker: true
            });


            let fileManagerInput = $('#file-manager-input').val()
            $('#file-manager').on('mouseenter', function(event) {
                if ($('#file-manager-input').val() != fileManagerInput) {
                    fileManagerInput = $('#file-manager-input').val();
                    $.ajax({
                        type: "get",
                        url: "{{ route('admin.courses.image') }}",
                        data: {
                            url: $('#file-manager-input').val()
                        },
                        success: function(response) {
                            $('#course_image').html(response);
                        }
                    });
                }
            });

        })

        function addSection(parent) {
            let id = $(parent).children().length - 1;
            let section = createSection(id)
            $(section).insertBefore($(parent).children('button'))
        }

        function createSection(id) {
            let div = $('<div/>').addClass('row align-items-center').attr('id', `section-${id}`);
            let button = $('<button/>').addClass('btn btn-danger mx-3').attr('type', 'button').attr('onClick',
                'document.getElementById("section-' + id + '").remove()').html('<i class="fa fa-trash"></i>');
            let inputGroup = $('<div/>').addClass('form-group');
            let label = $('<label/>').html('نام');
            let input = $('<input>').addClass("form-control").attr('type', 'text').attr('name', 'section[]').attr(
                'placeholder', "برای مثال معرفی دوره");
            inputGroup.append(label);
            inputGroup.append(input);
            div.append(button);
            div.append(inputGroup);
            return div;
        }
    </script>
@endsection
