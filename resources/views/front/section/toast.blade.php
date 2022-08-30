<div class="toast-container ms-3 mb-3 position-fixed start-0 bottom-0">
    @foreach (session('toast') as $type => $message)
        @switch($type)
            @case('success')
            <div class="toast align-items-center text-white bg-success m-2" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ $message }}
                    </div>
                    <i class="bi bi-check2-circle fs-4 text-white me-2 m-auto"></i>
                </div>
            </div>
            @break

            @case('error')
            <div class="toast align-items-center text-white bg-danger m-2" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ $message }}
                    </div>
                    <i class="bi bi-exclamation-circle fs-4 text-white me-2 m-auto"></i>
                </div>
            </div>
            @break

            @case('warning')
            <div class="toast align-items-center text-white bg-warning m-2" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ $message }}
                    </div>
                    <i class="bi bi-info-circle fs-4 text-white me-2 m-auto"></i>
                </div>
            </div>
            @break

            @default
        @endswitch
    @endforeach
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function (toastEl) {
            return new bootstrap.Toast(toastEl, {
                'delay': 5000,
            })
        })
        toastList.forEach(function (toast) {
            toast.show();
        });
    })

</script>

