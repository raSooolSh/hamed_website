
@if ($roles->total())
    <table class="table table-bordered table-striped">

        <thead class="thead-dark text-center">
            <tr>
                <th>نام نقش</th>
                <th>دسترسی ها</th>
                <th>اقدامات</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($roles as $role)
                <tr class="text-center">
                    <th>{{ $role->name }}</th>
                    <th>
                        @foreach ($role->premissions as $key=>$premission )
                            @if($key<2)
                                {{ $premission->label }},
                            @endif
                        @endforeach
                        ...
                    </th>

                    <th>
                        <div class="dropdown">
                            <button type="button" class="btn btn-secondary " data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu">

                                <a class="dropdown-item d-flex justify-content-between py-1 @cannot('roles-edit') disabled @endcannot"
                                    href="{{ route('admin.roles.edit',$role->name) }}">
                                    <span>ویرایش</span>
                                    <i class="fa fa-cog text-primary"></i>
                                </a>

                                <hr class="divider">

                                <a class="dropdown-item d-flex justify-content-between py-1 @cannot('roles-delete') disabled @endcannot" data-toggle="modal"
                                    data-target="#delete_modal" data-name="{{ $role->name }}" href="">
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
    {{ $roles->appends(['search' => request()->get('search')])->links() }}
</div>
