<div class="modal-header">
    <h5 class="modal-title">{{ $article->title }}</h5>
</div>
<div class="modal-body">
    <div class="row mb-3">
        <div class="form-group col-md-6 mb-3 mb-md-0">
            <label for="">عنوان</label>
            <input class="form-control" type="text" value="{{ $article->title }}" readonly>
        </div>
        <div class="form-group col-md-6">
            <label for="">نوع</label>
            <input class="form-control" type="text" value="{{ $article->type }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-12">
            <label for="">محتوا</label>
            <div class="p-3 border border-3 rounded rounded-3">{!! $article->content !!}</div>
        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
</div>
