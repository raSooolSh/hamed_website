@extends('front.layouts.master')

@section('title', 'ورود')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center align-content-center px-5" id="login">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card">
                    <div class="card-body bg-transparent text-light">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <h4 class="text-center text-dark py-3 fw-bold">ورود به سایت</h4>
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
                                    <label for="remember" class="form-check-label text-dark">مرا به خاطر بسپار </label>
                                </div>
                            </div>

                            <div class="row justify-content-center py-3">
                                <div class="col-md-10">
                                    <button type="submit" class="btn btn-primary col-12" id="loginBtn">ورود <i
                                            class="bi bi-box-arrow-in-right"></i></button>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="d-flex col-md-10 justify-content-between">
                                    <a href="{{ route('resetPassword') }}" class="text-danger">گذر واژه خود را فراموش کرده اید
                                        ؟</a>
                                    <a href="{{ route('register') }}" class="text-danger">ثبت نام نکرده اید؟</a>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
