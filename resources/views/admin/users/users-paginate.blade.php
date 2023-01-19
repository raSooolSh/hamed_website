
@if ($users->total())
    <table class="table table-bordered table-striped">
        <thead class="thead-dark text-center">
            <tr>
                <th>ID</th>
                <th>نام و نام خانوادگی</th>
                <th>شماره همراه</th>
                <th>شماره ملی</th>
                <th>نوع کاربری</th>
                <th>وضعیت</th>
                <th>اقدامات</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr class="text-center">
                    <th>{{ $user->id }}</th>
                    <th>{{ $user->full_name }}</th>
                    <th>{{ $user->phone_number }}</th>
                    <th>{{ $user->meli_code }}</th>
                    <th>{{ $user->type }}</th>
                    <th>
                        @if (!$user->is_block)
                            <span class="badge badge-success">فعال</span>
                        @else
                            <span class="badge badge-danger">مسدود</span>
                        @endif
                    </th>

                    <th>
                        <div class="dropdown">
                            <button type="button" class="btn btn-secondary " data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item d-flex justify-content-between py-1" data-toggle="modal"
                                    href="" data-target="#user_modal" data-id="{{ $user->id }}">
                                    <span>نمایش</span>
                                    <i class="fa fa-eye text-success"></i>
                                </a>


                                <a class="dropdown-item d-flex justify-content-between py-1 @cannot('users-edit') disabled @endcannot"
                                    href="{{ route('admin.users.edit', $user->id) }}">
                                    <span>ویرایش</span>
                                    <i class="fa fa-cog text-primary"></i>
                                </a>

                                <a class="dropdown-item d-flex justify-content-between py-1 @cannot('users-premission') disabled @endcannot"
                                    href="{{ route('admin.users.premission.create', $user->id) }}">
                                    <span>دسترسی ها</span>
                                    <i class="fa fa-key text-warning"></i>
                                </a>

                                <a class="dropdown-item d-flex justify-content-between py-1 @cannot('users-premission') disabled @endcannot"
                                    href="{{ route('admin.users.downloads.index',$user->id) }}">
                                    <span>دانلود ها</span>
                                    <i class="fa fa-download text-info"></i>
                                </a>

                                <hr class="divider">

                                @if (!$user->is_block)
                                    <a class="dropdown-item d-flex justify-content-between py-1 @cannot('users-block') disabled @endcannot"
                                        data-toggle="modal" data-target="#block_modal" data-id="{{ $user->id }}"
                                        href="">
                                        <span>بلاک کردن</span>
                                        <i class="fa fa-ban text-danger"></i>
                                    </a>
                                @else
                                    <form action="{{ route('admin.users.unblock', $user->id) }}" method="post">
                                        @csrf
                                        <button type="submit"
                                            class="btn dropdown-item d-flex justify-content-between py-1"
                                            @cannot('users-unblock') disabled @endcannot>
                                            <span>آنبلاک کردن</span>
                                            <i class="fa fa-flag text-info"></i>
                                        </button>
                                    </form>
                                @endif
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
    {{ $users->appends(['search' => request()->get('search')])->links() }}
</div>
