
@if ($discounts->total())
    <table class="table table-bordered table-striped">

        <thead class="thead-dark text-center">
            <tr>
                <th>نام تخفیف</th>
                <th>کد تخفیف</th>
                <th>نوع</th>
                <th>مقدار</th>
                <th>کاربران</th>
                <th>تاریخ اتمام</th>
                <th>اقدامات</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($discounts as $discount)
                <tr class="text-center">
                    <th>{{ $discount->name }}</th>
                    <th>{{ $discount->code }}</th>
                    <th>{{ $discount->type }}</th>
                    <th>{{ $discount->value }}</th>
                    <th>{{ mb_substr($discount->users,0,23).'...' }}</th>
                    <th>{{ jdate($discount->expire_at) }}</th>

                    <th>
                        <div class="dropdown">
                            <button type="button" class="btn btn-secondary " data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu">

                                <a class="dropdown-item d-flex justify-content-between py-1 @cannot('discounts-edit') disabled @endcannot"
                                    href="{{ route('admin.discounts.edit',$discount->id) }}">
                                    <span>ویرایش</span>
                                    <i class="fa fa-cog text-primary"></i>
                                </a>

                                <hr class="divider">

                                <a class="dropdown-item d-flex justify-content-between py-1 @cannot('discounts-delete') disabled @endcannot" data-toggle="modal"
                                    data-target="#delete_modal" data-id="{{ $discount->id }}" href="">
                                    <span>حذف</span>
                                    <i class="fa fa-trash text-danger"></i>
                                </a>
                            </div>
                        </div>
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
    {{ $discounts->appends(['search' => request()->get('search')])->links() }}
</div>
