<div class="modal-header">
    <h5 class="modal-title">{{ $episode->name }}</h5>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="">نام</label>
                <input class="form-control" type="text" value="{{ $episode->name }}" readonly>
            </div>
            <div class="form-group">
                <label for=""> بخش</label>
                <input class="form-control" type="text" value="{{ $episode->section->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="">وضعیت</label>
                <input class="form-control" type="text" value="{{ $episode->is_free ? 'رایگان' : 'نقدی' }}" readonly>
            </div>
        </div>
        <div class="col-lg-6 text-center">
            <video src="{{ $episode->download() }}" class="w-100 mt-3" controls></video>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
</div>
