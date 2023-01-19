@extends('front.layouts.master')

@section('title', 'ورود')
@section('id', 'login')
@section('content')
    <div class="area">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center align-content-center px-5">
            <div class="context">
                <div class="bg-transparent">
                    <h1 class="text-center py-3 fw-bold">خوش آمدید</h1>
                    <div class="">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row mb-3 justify-content-center">
                                <div class="col-md-10 ">
                                    <input id="meli_code" type="text"
                                        class="form-control @error('meli_code') is-invalid @enderror" name="meli_code"
                                        value="{{ old('meli_code') }}" placeholder="کد ملی بدون خط تیره" autofocus>

                                    @error('meli_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <div class="col-md-10">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        placeholder="گذر واژه">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2 justify-content-center">
                                <div class="col-md-10">
                                    <input id="remember" type="checkbox" class="form-check-input" name="remember">
                                    <label for="remember" class="form-check-label text-dark text-white">مرا به خاطر بسپار </label>
                                </div>
                            </div>

                            <div class="row justify-content-center py-3">
                                <div class="col-md-10">
                                    <button type="submit" class="btn btn-primary col-12" id="loginBtn">ورود <i
                                            class="bi bi-box-arrow-in-right"></i></button>
                                </div>
                            </div>

                            <div class="row justify-content-center mb-3">
                                <div class="d-flex col-md-10 justify-content-between">
                                    <a href="{{ route('resetPassword') }}" class="">گذر واژه خود را فراموش
                                        کرده اید
                                        ؟</a>
                                    <a href="{{ route('register') }}" class="">ثبت نام نکرده اید؟</a>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
