@extends('front.layouts.master')
@section('title', $course->name_fa)
@section('content')
    <section id="header">
        <div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
            <div class="firefly"></div>
        </div>
    </section>

    <section>
        <div class="row container-fluid px-2 px-sm-3 px-lg-5 mt-3 justify-content-center">
            <div class="col-lg-6 col-sm-10 col-md-8 mb-3">
                <form action="{{ route('payment',['course' => $course->slug]) }}" method="POST"  class="card py-3 px-4 bg-dark-500 rounded-3 text-white mb-3" id="description">
                    @csrf
                    <strong class="fs-4 mb-4">پیش فاکتور خرید :</strong>
                    <input type="hidden" name="course" value="{{ $course->id }}">
                    <div class="row justify-content-center">
                        <img class="rounded-4 col-sm-9"
                            src="{{ route('image.get', ['w' => 300, 'h' => 150, 'image' => $course->image]) }}"
                            class="card-img-top" alt="{{ $course->name_en }}">
                    </div>
                    <div class="row justify-content-center my-3">
                        <strong class="fs-5 text-center">{{ $course->name_fa }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mt-3 px-3">
                        <span>تعداد جلسات</span>
                        <span>{{ $course->episodes->count() - 1 }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between px-3">
                        <span>قیمت دوره</span>
                        @if ($course->discount_off && $course->discount_expire_at > now())
                            <span class="text-decoration-line-through text-danger">{{ number_format($course->price) }}
                                تومان</span>
                        @else
                            <span id="price">{{ number_format($course->price) }} تومان</span>
                        @endif
                    </div>
                    <hr>
                    @if ($course->discount_off && $course->discount_expire_at > now())
                        <div id='discount' class="d-flex justify-content-between px-3">
                            <span>قیمت با محاسبه تخفیف</span>
                            <span id="priceByDiscount">{{ number_format($course->price - $course->discount_off) }}
                                تومان</span>
                        </div>
                        <hr>
                    @else
                        <div id='discount' class="d-none px-3">
                            <div class="d-flex justify-content-between">
                                <span>قیمت با محاسبه تخفیف</span>
                                <span id="priceByDiscount"></span>
                            </div>
                            <hr>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-content-center px-3">
                        <div>
                            <input type="hidden" name="discount">
                            <input class="form-control-sm py-0" type="text" name="discount_ajax"
                                placeholder="کد تخفیف دارید ؟">
                        </div>
                        <div>
                            <button id="discount_btn" class="btn btn-sm btn-success" type="button" disabled>اعمال کد
                                تخفیف</button>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary mx-3">پرداخت</button>
                </form>
            </div>


        </div>
    </section>
@endsection
@section('script')
    <script>
        let discount_input = $('input[name="discount_ajax"]');
        discount_input.on('keyup', function() {
            if (discount_input.val().length) {
                $('#discount_btn').prop('disabled', false)
            } else {
                $('#discount_btn').prop('disabled', true)
            }
        })

        $(discount_btn).on('click', function() {
            $(discount_btn).prop('disabled', true)
            $.ajax({
                type: "post",
                url: "{{ route('discountCheck') }}",
                data: {
                    course_id: {{ $course->id }},
                    discount_code: discount_input.val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $(discount_btn).prop('disabled', false);
                    if (response.error) {
                        discount_input.addClass('is-invalid');
                        discount_input.removeClass('is-valid');
                        $('#discount_feedback').remove();
                        $(`<span id="discount_feedback" class="invalid-feedback"><strong>${response.error}</strong></span>`)
                            .insertAfter(discount_input);
                    } else {
                        discount_input.addClass('is-valid');
                        discount_input.removeClass('is-invalid');
                        $('#discount_feedback').remove();
                        $(`<span id="discount_feedback" class="valid-feedback"><strong>کد تخفیف اعمال شد</strong></span>`)
                            .insertAfter(
                                discount_input);
                        $('#discount').removeClass('d-none');
                        $('#price').addClass('text-decoration-line-through text-danger')
                        $('input[name="discount"]').val(response.code);
                        $('#priceByDiscount').html(`${response.priceByDiscount} تومان`);
                    }
                }
            });
        })
    </script>
@endsection
