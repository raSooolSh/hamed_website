<div class="modal-header">
    <h5 class="modal-title">{{ $user->first_name . ' ' . $user->last_name }}</h5>
</div>
<div class="modal-body">
    <div class="text-center mb-3">
        <img src="{{ url($user->avatar) }}" class="img-profile" alt="user">
    </div>
    <div class="row mb-3">
        <div class="col-md-6 mb-3 mb-md-0">
            <label>نام</label>
            <input class="form-control" type="text" id="first_name" readonly value="{{ $user->first_name }}">
        </div>
        <div class="col-md-6">
            <label>نام خانوادگی</label>
            <input class="form-control" type="text" id="first_name" readonly value="{{ $user->last_name }}">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6 mb-3 mb-md-0">
            <label>شماره همراه</label>
            <input class="form-control" type="text" id="first_name" readonly value="{{ $user->phone_number }}">
        </div>
        <div class="col-md-6">
            <label>کد ملی</label>
            <input class="form-control" type="text" id="first_name" readonly value="{{ $user->meli_code }}">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6 mb-3 mb-md-0">
            <label>تاریخ ثبت نام</label>
            <input class="form-control" type="text" id="first_name" readonly value="{{ $user->created_at }}">
        </div>
        <div class="col-md-6">
            <label>نوع کاربری </label>
            <input class="form-control" type="text" id="first_name" readonly value="{{ $user->type }}">
        </div>
    </div>
    <div>
        <label>دلیل بلاک شدن</label>
        <textarea class="form-control" rows="4" readonly>{{ $user->block_reason }}</textarea>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
</div>
