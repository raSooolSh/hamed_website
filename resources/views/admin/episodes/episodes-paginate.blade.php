@if ($episodes->count())
    <table class="table table-bordered table-striped">

        <thead class="thead-dark text-center">
            <tr>
                <th>قسمت</th>
                <th>نام</th>
                <th>بخش</th>
                <th>وضعیت</th>
                <th>اقدامات</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($episodes as $episode)
                <tr class="text-center">
                    <th>{{ $episode->number}}</th>
                    <th>{{ $episode->name }}</th>
                    <th>{{ $episode->section->name }}</th>
                    <th>
                        @if ($episode->is_free)
                            <span class="badge badge-success">رایگان</span>
                        @else
                            <span class="badge badge-danger">نقدی</span>
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
                                    href="" data-target="#episode_modal" data-id="{{ $episode->id }}">
                                    <span>نمایش</span>
                                    <i class="fa fa-eye text-success"></i>
                                </a>

                                <a class="dropdown-item d-flex justify-content-between py-1 @cannot('courses-edit') disabled @endcannot"
                                    href="{{ route('admin.episodes.edit', ['course'=>$course->slug,'episode'=>$episode->id]) }}">
                                    <span>ویرایش</span>
                                    <i class="fa fa-cog text-primary"></i>
                                </a>

                                <hr class="divider">

                                <a class="dropdown-item d-flex justify-content-between py-1 @cannot('courses-delete') disabled @endcannot" data-toggle="modal"
                                    data-target="#delete_modal" data-id="{{ $episode->id }}" href="">
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

