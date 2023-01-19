<div class="modal-header">
    <h5 class="modal-title">{{ $course->name_fa }}</h5>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="">نام دوره</label>
                <input class="form-control" type="text" value="{{ $course->name_fa }}" readonly>
            </div>
            <div class="form-group">
                <label for="">نام لاتین دوره</label>
                <input class="form-control" type="text" value="{{ $course->name_en }}" readonly>
            </div>
            <div class="form-group">
                <label for="">مدرس دوره</label>
                <input class="form-control" type="text" value="{{ $course->teacher }}" readonly>
            </div>
            <div class="form-group">
                <label for="">قیمت دوره</label>
                <input class="form-control" type="text" value="{{ $course->price }}" readonly>
            </div>
        </div>
        <div class="col-lg-6 text-center">
            <img class="img-fluid" src="{{ route('image.get',['w'=>600,'h'=>400,'image'=>$course->image]) }}" alt="{{ $course->name_en }}">
        </div>
    </div>
    <div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">تخفیف دوره</label>
                    <input class="form-control" type="text" value="{{ $course->discount_off }}" readonly>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">تاریخ اتمام تخفیف</label>
                    <input class="form-control" type="text" value="{{ $course->discount_expire_at ? jdate($course->discount_expire_at) :'' }}" readonly>
                </div>
            </div>
        </div>
        <p>توضیحات</p>
        <div class="col-12 border border-3 rounded rounded-3 p-3 div-disabled">
            {{ $course->description }}
        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
</div>
