@extends('admin.layouts.master')
@section('title', 'ویرایش تخفیف')
@section('style')
    <link rel="stylesheet" href="{{ asset('vendor/MD.DTP/dist/jquery.md.bootstrap.datetimepicker.style.css') }}">
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">ویرایش تخفیف</h1>
    </div>
    {{-- /page heading --}}
    <hr class="">
    @include('admin.section.error')
    <form action="{{ route('admin.discounts.update',$discount->id) }}" method="POST">
        @csrf
        @method('patch')
        <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="name">نام</label>
                <input class="form-control" type="text" id="name" name="name" value="{{ old('name',$discount->name) }}">
            </div>
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="code">کد</label>
                <input class="form-control" type="text" id="code" name="code" value="{{ old('code',$discount->code) }}">
            </div>
        </div>
        <hr>
        <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="courses">دوره ها</label>
                <select name="courses[]" id="courses" class="form-control" multiple>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}" {{ in_array($course->id,$discount->courses->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $course->name_fa }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3 mb-md-0">
                <label for="users">کاربران</label>
                <input class="form-control" type="text" id="users" name="users" value="{{ old('users',$discount->users) }}"
                    placeholder="شماره همراه کاربران و * برای جدا کردن آنان">
            </div>
            <div class="mt-3 mr-3">
                <span class="badge">خالی رها کردن قسمت کاربران به معنای عمومی بودن تخفیف است. </span>
            </div>
            

        </div>
        <hr>
        <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="type">نوع</label>
                <select name="type" id="type" class="form-control">
                    <option value="percent" {{ $discount->getRawOriginal('type') == 'value' ?'':'selected' }}>درصدی</option>
                    <option value="value" {{ $discount->getRawOriginal('type') == 'value' ?'selected':'' }}>مبلغی</option>
                </select>
            </div>
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="value">مقدار</label>
                <input class="form-control" type="text" id="value" name="value" value="{{ old('value',$discount->value) }}">
            </div>

        </div>
        <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="is_active">تا تاریخ</label>
                <div class="input-group">
                    <div class="input-group-prepend order-2">
                        <span class="input-group-text" id="discount_expire">
                            <i class="fa fa-clock"></i>
                        </span>
                    </div>
                    <input type="text" name="expire_at" value="{{ old('expire_at',$discount->expire_at ? jdate($discount->expire_at) : '') }}" class="form-control">
                </div>
                <div class="mt-3 mr-3">
                    <p class="badge">در صورت خالی بودن این تخفیف تا هنگام پاک شدن به صورت دستی فعال می ماند. </p>
                </div>

            </div>

        </div>
        
        <div class="text-left mt-5">
            <a href="{{ route('admin.discounts.index') }}" class="btn btn-danger">بازگشت</a>
            <button type="submit" class="btn btn-success">ویرایش تخفیف</button>
        </div>

    </form>
@endsection
@section('script')
    <script src="{{ asset('/vendor/MD.DTP/dist/jquery.md.bootstrap.datetimepicker.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#courses').selectpicker({
                actionsBox : true,
                title: 'دوره های مدنظر را انتخاب کنید',
                liveSearch: true,
                liveSearchPlaceholder: 'جستجو ...',
            });

            $('#discount_expire').MdPersianDateTimePicker({
                targetTextSelector: 'input[name="expire_at"]',
                englishNumber: true,
                textFormat: 'yyyy-MM-dd HH:mm:ss',
                disableBeforeToday: true,
                enableTimePicker: true
            });
        })
    </script>
@endsection
