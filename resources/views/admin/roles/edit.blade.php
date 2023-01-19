@extends('admin.layouts.master')
@section('title', 'ویرایش نقش')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">ویرایش نقش</h1>
    </div>
    {{-- /page heading --}}
    <hr class="">
    @include('admin.section.error')
    <form action="{{ route('admin.roles.update',$role->name) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="name">نام</label>
                <input class="form-control" type="text" id="name" name="name"
                    value="{{ old('name', $role->name) }}">
            </div>
            <div class="col-md-6">
                <label for="password">دسترسی ها</label>
                <select class="form-control selectpicker" id="premissions" name="premissions[]" multiple>
                    @foreach ($premissions as $premission)
                        <option
                            value="{{ $premission->id }}"{{ in_array($premission->id,$role->premissions->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $premission->label }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="text-left mt-5">
            <a href="{{ route('admin.roles.index') }}" class="btn btn-danger">بازگشت</a>
            <button type="submit" class="btn btn-success">ویرایش نقش</button>
        </div>

    </form>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#premissions').selectpicker({
                // actionsBox : true,
                title: 'دسترسی مدنظر را انتخاب کنید',
                liveSearch: true,
                liveSearchPlaceholder: 'جستجو ...',
            });
        })
    </script>
@endsection
