@if ($articles->total())
    <table class="table table-bordered table-striped">

        <thead class="thead-dark text-center">
            <tr>
                <th>عنوان</th>
                <th>نوع</th>
                <th>وضعیت</th>
                <th>ایجاد شده در</th>
                <th>اقدامات</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($articles as $article)
                <tr class="text-center">
                    <th>{{ $article->title }}</th>
                    <th>{{ $article->type }}</th>
                    <th>
                        @if ($article->is_active)
                            <span class="badge badge-success">فعال</span>
                        @else
                            <span class="badge badge-danger">غیرفعال</span>
                        @endif
                    </th>
                    <th>{{ jdate($article->created_at) }}</th>
                    
                    <th>
                        <div class="dropdown">
                            <button type="button" class="btn btn-secondary " data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item d-flex justify-content-between py-1" data-toggle="modal"
                                    href="" data-target="#article_modal" data-slug="{{ $article->slug }}">
                                    <span>نمایش</span>
                                    <i class="fa fa-eye text-success"></i>
                                </a>

                                <a class="dropdown-item d-flex justify-content-between py-1 @cannot('articles-edit') disabled @endcannot"
                                    href="{{ route('admin.articles.edit', $article->slug) }}">
                                    <span>ویرایش</span>
                                    <i class="fa fa-cog text-primary"></i>
                                </a>

                                <hr class="divider">

                                <a class="dropdown-item d-flex justify-content-between py-1 @cannot('articles-delete') disabled @endcannot" data-toggle="modal"
                                    data-target="#delete_modal" data-slug="{{ $article->slug }}" href="">
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
    {{ $articles->appends(['search' => request()->get('search')])->links() }}
</div>
