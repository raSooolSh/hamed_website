<div class="modal-header">
    <h5 class="modal-title">کامنت</h5>
</div>
{{-- {{ dd($comment->parent) }} --}}
<div class="modal-body">
    <div class="d-flex flex-column">
        @include('admin.comments.commment', ['comment' => $comment->bigParent(),'selected'=>$comment->id])
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
</div>
