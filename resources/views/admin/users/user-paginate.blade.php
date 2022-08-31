@if ($users->total())
    <table class="table table-responsive-md table-bordered table-striped">

        <thead class="thead-dark text-center">
            <tr>
                <th>ID</th>
                <th>نام و نام خانوادگی</th>
                <th>شماره همراه</th>
                <th>شماره ملی</th>
                <th>نوع کاربری</th>
                <th>اقدامات</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr class="text-center">
                    <th>{{ $user->id }}</th>
                    <th>{{ $user->first_name . ' ' . $user->last_name }}</th>
                    <th>{{ $user->phone_number }}</th>
                    <th>{{ $user->meli_code }}</th>
                    <th>{{ $user->type }}</th>

                    <th>
                        <div class="dropdown">
                            <button type="button" class="btn btn-secondary " data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item d-flex justify-content-between py-1" data-toggle="modal"
                                    data-target="#user_modal" data-id="{{ $user->id }}">
                                    <span>نمایش</span>
                                    <i class="fa fa-eye text-success"></i>
                                </a>

                                <a class="dropdown-item d-flex justify-content-between py-1"
                                    href="{{ route('admin.users.edit', $user->id) }}">
                                    <span>ویرایش</span>
                                    <i class="fa fa-cog text-primary"></i>
                                </a>

                                <hr class="divider">

                                <a class="dropdown-item d-flex justify-content-between py-1" data-toggle="modal"
                                    data-target="#block_modal" data-id="{{ $user->id }}">
                                    <span>بلاک کردن</span>
                                    <i class="fa fa-ban text-danger"></i>
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
    <img class="img-fluid" src="{{ url('/images/not-found.png') }}" alt="">
</div>
  
@endif

<div class="row justify-content-center" dir="ltr">
    {{ $users->appends(['search' => request()->get('search')])->links() }}
</div>
