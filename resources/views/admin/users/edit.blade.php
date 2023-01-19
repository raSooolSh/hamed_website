@extends('admin.layouts.master')
@section('title','ویرایش کاربر')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800"> ویرایش کاربر </h1>
        <img class="img-profile rounded-circle" style="width: 4rem;" src="{{ url($user->avatar) }}" alt="user">
    </div>
    {{-- /page heading --}}
    <hr class="">
    @include('admin.section.error')
    <form action="{{ route('admin.users.update',$user->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="first_name">نام</label>
                <input class="form-control" type="text" id="first_name" name="first_name"
                    value="{{ old('first_name',$user->first_name) }}">
            </div>
            <div class="col-md-6">
                <label for="last_name">نام خانوادگی</label>
                <input class="form-control" type="text" id="last_name" name="last_name"
                    value="{{ old('last_name',$user->last_name) }}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="password">گذر واژه</label>
                <input class="form-control" type="password" id="password" name="password">
            </div>
            <div class="col-md-6">
                <label for="password_confirmation">تکرار گذر واژه</label>
                <input class="form-control" type="password" id="password_confirmation" name="password_confirmation">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="phone_number">شماره همراه</label>
                <input class="form-control" type="text" id="phone_number" name="phone_number"
                    value="{{ old('phone_number',$user->phone_number)  }}">
            </div>
            <div class="col-md-6">
                <label for="meli_code">کد ملی</label>
                <input class="form-control" type="text" id="meli_code" name="meli_code"
                    value="{{ old('meli_code',$user->meli_code) }}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="user_type">نوع کاربری </label>
                <select class="form-control" id="user_type" name='type'>
                    <option value="user" {{ $user->type == 'user' ? 'selected' : ""}}>User</option>
                    <option value="admin" {{ $user->type == 'admin' ? 'selected' : ""}}>Admin</option>
                    <option value="manager" {{ $user->type == 'manager' ? 'selected' : ""}}>manager</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="user_block">وضعیت کاربری </label>
                <select class="form-control" id="user_block" name='is_block'>
                    <option value="1" {{ $user->is_block ? 'selected' : ""}}>بلاک شده</option>
                    <option value="0" {{ $user->is_block ? '' : 'selected'}}>فعال</option>
                </select>
               
            </div>
        </div>
        <div class="mb-3">
            <label>دلیل بلاک شدن</label>
            <textarea class="form-control" rows="4" name="block_reason">{{ $user->block_reason }}</textarea>
        </div>

        <div class="text-left mt-5">
            <a href="{{ route('admin.users.index') }}" class="btn btn-danger" >بازگشت</a>
            <button type="submit" class="btn btn-success">ویرایش</button>
        </div>

    </form>
@endsection