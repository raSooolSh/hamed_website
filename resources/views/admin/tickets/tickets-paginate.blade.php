@if ($tickets->total())
    <table class="table table-bordered table-striped">

        <thead class="thead-dark text-center">
            <tr>
                <th>آیدی</th>
                <th>نام و نام خانوادگی</th>
                <th>شماره تماس</th>
                <th>وضعیت عضویت</th>
                <th>ایجاد شده در</th>
                <th>اقدامات</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($tickets as $ticket)
                <tr class="text-center">
                    <th>{{ $ticket->id }}</th>
                    <th>{{ $ticket->full_name }}</th>
                    <th>{{ $ticket->phone_number }}</th>
                    <th>
                        @if ($ticket->user)
                            <span class="badge badge-success">عضو سایت</span>
                        @else
                            <span class="badge badge-danger">کاربر مهمان</span>
                        @endif
                    </th>
                    <th>{{ jdate($ticket->created_at)->ago() }}</th>

                    <th>
                        <a class="btn btn-success py-1" href="{{ route('admin.tickets.show',$ticket->id) }}">
                            <i class="fa fa-eye"></i>
                        </a>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="text-center p-3" id='not_found'>
        <h4 class="">هیچ نتیجه ای یافت نشد!</h4>
        <img class="img-fluid" src="{{ url('/images/not-found.png') }}" alt="not-found">
    </div>

@endif

<div class="row justify-content-center" dir="ltr">
    {{ $tickets->appends(['search' => request()->get('search')])->links() }}
</div>
