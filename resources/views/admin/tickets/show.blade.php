@extends('admin.layouts.master')
@section('title', 'کامنت ها')
@section('content')
    <div class="card position-relative" style="max-height: 80vh">
        <div
            class="card-header d-flex flex-column flex-md-row justify-content-center justify-content-md-between align-items-center">
            <p class="text-center">{{ $ticket->phone_number }} به عنوان <span
                    class="badge badge-sm {{ $ticket->user ? 'badge-success' : 'badge-danger' }}">
                    {{ $ticket->user ? 'کاربر سایت' : 'کاربر مهمان' }}</span></p>
            @if (!$ticket->is_close)
                <a class="btn btn-sm btn-danger" href="{{ route('admin.tickets.close', $ticket->id) }}">بستن تیکت</a>
            @else
            <p class="badge badge-secondary">این تیکت قبلا بسته شده</p>

            @endif
        </div>
        <div class="card-body d-flex flex-column" id="messages" style="overflow: scroll;">
            @include('admin.tickets.messages', ['ticket' => $ticket])
        </div>
        @if(! $ticket->is_close)
        <div class="card-footer text-muted">
            <form action="" id="answer_form">
                <div class="input-group flex-row-reverse align-items-end">
                    <button type="submit" class="btn btn-success rounded rounded-circle m-2"><i
                            class="fa fa-comment"></i></button>
                    <textarea name="message" class="form-control rounded rounded-3" rows="2" aria-label="With textarea">{{ $ticket->user ? '' : 'به دلیل عدم عضویت با شما تماس گرفته شد، پشتیبانی سایت -...' }}</textarea>
                </div>
            </form>
        </div>
        @endif
    </div>

@endsection
@section('script')
    <script>
        $(document).on('submit', '#answer_form', function(e) {
            e.preventDefault();
            let url = "{{ route('admin.tickets.store', ['ticket' => ':ticket']) }}";
            url = url.replace(':ticket', "{{ $ticket->id }}")
            $.ajax({
                type: "post",
                url: url,
                data: {
                    _token: document.head.querySelector('meta[name="csrf-token"]').content,
                    message: $('textarea[name="message"]').val()
                },
                success: function(response) {
                    $('.card-body#messages').html(response);
                    $('textarea[name="message"]').val('');
                }
            });
        })
    </script>
@endsection
