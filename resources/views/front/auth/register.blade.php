@extends('front.layouts.master')

@section('title', 'ثبت نام')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center align-content-center px-5" id="register">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card">
                    <div class="card-body bg-transparent text-light">

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <h4 class="text-center text-dark py-3 fw-bold">ثبت نام در سایت</h4>
                            <div class="row mb-3 justify-content-center">
                                <div class="col-md-10 ">
                                    <input id="first_name" type="text"
                                        class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                        value="{{ old('first_name') }}" placeholder="نام خود را به فارسی وارد کنید" autocomplete="first_name"
                                        autofocus>

                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <div class="col-md-10 ">
                                    <input id="last_name" type="text"
                                        class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                        value="{{ old('last_name') }}" placeholder="نام خانوادگی را به فارسی وارد کنید" autocomplete="last_name"
                                        autofocus>

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

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
                                        placeholder="گذر واژه شامل اعداد و حروف لاتین" autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center" id="phone_div">
                                <div class="col-md-8">
                                    <input id="phone_number" type="text"
                                        class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                        value="{{ old('phone_number') }}"
                                        placeholder="شماره تماس همراه برای مثال 09121234567" autofocus>
                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-2 text-end mt-1">
                                    <button id="sendVerifyCode_btn" type="button" class="btn btn-secondary col-12 disabled">ارسال
                                        پیامک</button>
                                </div>

                            </div>

                            <div class="row mb-3 justify-content-center">
                                <div class="col-md-10">
                                    <input id="verify_code" type="text"
                                        class="form-control @error('verify_code') is-invalid @enderror" name="verify_code"
                                        value="{{ old('verify_code') }}" placeholder="کد تایید درون پیامک را وارد کنید">

                                    @error('verify_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <div class="col-md-10">
                                    <input id="terms" type="checkbox"
                                        class="form-check-input" name="terms">
                                    <label for="terms" class="form-check-label text-dark"><a href="" class="@error('terms') text-danger @enderror text-primary">قوانین و مقررات </a>را خوانده ام و آنرا می پذیرم</label>
                                </div>
                            </div>

                            <div class="row justify-content-center py-3">
                                <div class="col-md-10">
                                    <button type="submit" class="btn btn-primary col-12 disabled" id="registerBtn">ثبت نام <i class="bi bi-person-plus"></i></button>
                                </div>
                               </div>

                            <div class="row justify-content-center">
                                <div class="d-flex col-md-10 justify-content-end">
                                    <a href="{{ route('login') }}" class="text-danger">قبلا ثبت نام کرده اید ؟</a>
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

            if ($('#phone_number').val().match(/^09\d{9}$/)) {
                $('#registerBtn').removeClass('disabled');
                $('#sendVerifyCode_btn').removeClass('disabled');
            }

            $('#phone_number').keyup(function() {
                let valid = $('#phone_number').val().match(/^09\d{9}$/);
                if (valid &&  $('#sendVerifyCode_btn').text() == sendVerifyCodeDefultText) {
                    $('#sendVerifyCode_btn').removeClass('disabled');
                } else {
                    $('#sendVerifyCode_btn').addClass('disabled');

                }
            })


            $('#sendVerifyCode_btn').click(function() {

                if ($('#phone_number').val().match(/^09\d{9}$/)) {
                    $('#sendVerifyCode_btn').addClass('disabled');
                    $.ajax({
                        type: "POST",
                        url: "/register/sendVerifyCode",
                        data: {
                            phone_number: $('#phone_number').val(),
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#phone_div input').addClass('is-valid');
                            $('#phone_div input').removeClass('is-invalid');
                            $('#phone_div .valid-feedback').remove();
                            $('#phone_div .invalid-feedback').remove();
                            $('#phone_div>div').append(`<span class="valid-feedback" role="alert">
                            <strong>پیامکی حاوی کد فعال سازی ارسال شد</strong>`);
                            expireTimer($('#sendVerifyCode_btn'),180);
                            $('#registerBtn').removeClass('disabled');
                            $('#phone_number').attr('readonly',true);
                        },
                        error: function(response) {
                            $('#phone_div input').addClass('is-invalid');
                            $('#phone_div input').removeClass('is-valid');
                            $('#phone_div .invalid-feedback').remove();
                            $('#phone_div .valid-feedback').remove();
                            let message;
                            if (response.status == 429) {
                                message = `<span class="invalid-feedback" role="alert">
                                        <strong>شما بیش از حد مجاز درخواست داده اید</strong>
                                    </span>`
                            } else if (response.status == 422) {
                                message = `<span class="invalid-feedback" role="alert">
                                        <strong>${response.responseJSON.errors.phone_number}</strong>
                                    </span>`
                            }else{
                                message = `<span class="invalid-feedback" role="alert">
                                        <strong>مشکلی پیش آمده لطفا بعد از مدتی دوباره امتحان کنید.
                                            در صورت عدم برطرف شدن مشکل با پشتیبانی تماس بگیرید!</strong>
                                    </span>`
                            }
                            $('#phone_div>div').append(message);
                            $('#sendVerifyCode_btn').removeClass('disabled');
                        }
                    });


                } else {
                    $('#phone_number').addClass('is-invalid');
                    $('#phone_div>div').append(`<span class="invalid-feedback" role="alert">
                                        <strong>مقدار شماره تماس معتبر نمی باشد</strong>
                                    </span>`);
                }
            });

        });
    </script>
@endsection
