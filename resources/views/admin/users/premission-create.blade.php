@extends('admin.layouts.master')
@section('title', 'دسترسی کاریر')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">دسترسی ها</h1>
    </div>
    {{-- /page heading --}}
    <hr class="">
    @include('admin.section.error')
    <form action="{{ route('admin.users.premission.store',$user->id) }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="roles">نقش ها</label>
                <select class="form-control selectpicker" id="roles" name="roles[]" multiple>
                    @foreach ($roles as $role)
                        <option
                            value="{{ $role->id }}"{{ in_array($role->id,$user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="premissions">دسترسی ها</label>
                <select class="form-control selectpicker" id="premissions" name="premissions[]" multiple>
                    @foreach ($premissions as $premission)
                        <option
                            value="{{ $premission->id }}"{{ in_array($premission->id,$user->premissions->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $premission->label }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="text-left mt-5">
            <a href="{{ route('admin.users.index') }}" class="btn btn-danger">بازگشت</a>
            <button type="submit" class="btn btn-success">ثبت دسترسی ها</button>
        </div>

    </form>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#premissions').selectpicker({
                actionsBox : true,
                title: 'دسترسی مدنظر را انتخاب کنید',
                liveSearch: true,
                liveSearchPlaceholder: 'جستجو ...',
            });

            $('#roles').selectpicker({
                // actionsBox : true,
                title: 'نقش مدنظر را انتخاب کنید',
                liveSearch: true,
                liveSearchPlaceholder: 'جستجو ...',
            });
        })
    </script>
@endsection
