@extends('front.layouts.master')

@section('title', 'بازنشانی گذر واژه')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center align-content-center px-5" id="register">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card">
                    <div class="card-body bg-transparent text-light">

                        <form method="POST" action="{{ route('resetPassword') }}">
                            @csrf

                            <h4 class="text-center text-dark py-3 fw-bold">بازنشانی گذر واژه</h4>

                            <div class="row mb-3 justify-content-center" id="meliCode_div">
                                <div class="col-md-10">
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
                                        placeholder="گذر واژه شامل اعداد و حروف لاتین" autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <div class="col-md-10">
                                    <input id="password_confirmation " type="password"
                                        class="form-control" name="password_confirmation"
                                        placeholder="گذر واژه خود را مجددا وارد کنید">
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <div class="col-md-8">
                                    <input id="verify_code" type="text"
                                        class="form-control @error('verify_code') is-invalid @enderror" name="verify_code"
                                        value="{{ old('verify_code') }}" placeholder="کد تایید درون پیامک را وارد کنید">

                                    @error('verify_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-2 text-end mt-1">
                                    <button id="sendVerifyCode_btn" type="button" class="btn btn-secondary col-12">ارسال
                                        پیامک</button>
                                </div>
                            </div>

                            <div class="row justify-content-center py-3">
                                <div class="col-md-10">
                                    <button type="submit" class="btn btn-primary col-12" id="registerBtn"> بازنشانی گذر واژه <i class="bi bi-person-plus"></i></button>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="d-flex col-md-10 justify-content-end">
                                    <a href="{{ route('login') }}" class="text-danger">بازشگت به صفحه ورود</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function expireTimer(btn,expire=180) {
            btnDefultText=$(btn).text();

            $(btn).addClass('disabled');
            let time = expire;
            let timeInterval = setInterval(() => {

                let $secounds = time % 60;
                if ($secounds < 10) {
                    $secounds = '0' + $secounds;
                }
                let $minutes = Math.floor(time / 60)
                $(btn).text($minutes + ":" + $secounds);
                time--;

                if (time == 0) {
                    clearInterval(timeInterval);

                    $(btn).text(btnDefultText);

                    $(btn).removeClass('disabled');
                }
            }, 1000);
        }

        $(document).ready(function() {
            let sendVerifyCodeDefultText=$('#sendVerifyCode_btn').text();


            $('#sendVerifyCode_btn').click(function() {
                    $('#sendVerifyCode_btn').addClass('disabled');
                    $.ajax({
                        type: "POST",
                        url: "/reset-password/sendVerifyCode",
                        data: {
                            meli_code: $('#meli_code').val(),
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#meliCode_div input').addClass('is-valid');
                            $('#meliCode_div input').removeClass('is-invalid');
                            $('#meliCode_div .valid-feedback').remove();
                            $('#meliCode_div .invalid-feedback').remove();
                            $('#meliCode_div>div').append(`<span class="valid-feedback" role="alert">
                            <strong>پیامکی حاوی کد فعال سازی ارسال شد</strong>`);
                            expireTimer($('#sendVerifyCode_btn'),180);
                            $('#meli_code').attr('readonly',true);
                        },
                        error: function(response) {
                            $('#meliCode_div input').addClass('is-invalid');
                            $('#meliCode_div input').removeClass('is-valid');
                            $('#meliCode_div .invalid-feedback').remove();
                            $('#meliCode_div .valid-feedback').remove();
                            let message;
                            if (response.status == 429) {
                                message = `<span class="invalid-feedback" role="alert">
                                        <strong>شما بیش از حد مجاز درخواست داده اید</strong>
                                    </span>`
                            } else if (response.status == 422) {
                                message = `<span class="invalid-feedback" role="alert">
                                        <strong>${response.responseJSON.errors.meli_code}</strong>
                                    </span>`
                            }else{
                                message = `<span class="invalid-feedback" role="alert">
                                        <strong>مشکلی پیش آمده لطفا بعد از مدتی دوباره امتحان کنید.
                                            در صورت عدم برطرف شدن مشکل با پشتیبانی تماس بگیرید!</strong>
                                    </span>`
                            }
                            $('#meliCode_div>div').append(message);
                            $('#sendVerifyCode_btn').removeClass('disabled');
                        }
                    });
            });

        });
    </script>
@endsection
