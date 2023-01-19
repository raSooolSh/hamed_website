@if ($courses->total())
    <table class="table table-bordered table-striped">

        <thead class="thead-dark text-center">
            <tr>
                <th>نام دوره</th>
                <th>مدرس</th>
                <th>قیمت (تومان)</th>
                <th>وضعیت</th>
                <th>ایجاد شده در</th>
                <th>اقدامات</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($courses as $course)
                <tr class="text-center">
                    <th>{{ $course->name_fa }}</th>
                    <th>{{ $course->teacher }}</th>
                    <th>{{ $course->price ?? 'رایگان' }}</th>
                    <th>
                        @if ($course->is_active)
                            <span class="badge badge-success">فعال</span>
                        @else
                            <span class="badge badge-danger">غیرفعال</span>
                        @endif
                    </th>
                    <th>{{ jdate($course->created_at) }}</th>
                    
                    <th>
                        <div class="dropdown">
                            <button type="button" class="btn btn-secondary " data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item d-flex justify-content-between py-1" data-toggle="modal"
                                    href="" data-target="#course_modal" data-slug="{{ $course->slug }}">
                                    <span>نمایش</span>
                                    <i class="fa fa-eye text-success"></i>
                                </a>

                                <a class="dropdown-item d-flex justify-content-between py-1 @cannot('courses-edit') disabled @endcannot"
                                    href="{{ route('admin.courses.edit', $course->slug) }}">
                                    <span>ویرایش</span>
                                    <i class="fa fa-cog text-primary"></i>
                                </a>

                                <a class="dropdown-item d-flex justify-content-between py-1 @cannot('courses-edit') disabled @endcannot"
                                    href="{{ route('admin.episodes.index', $course->slug) }}">
                                    <span>اپیزود ها</span>
                                    <i class="fa fa-film text-info"></i>
                                </a>

                                <hr class="divider">

                                <a class="dropdown-item d-flex justify-content-between py-1 @cannot('courses-delete') disabled @endcannot" data-toggle="modal"
                                    data-target="#delete_modal" data-slug="{{ $course->slug }}" href="">
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
    {{ $courses->appends(['search' => request()->get('search')])->links() }}
</div>
