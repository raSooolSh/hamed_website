
@if ($episodes->count())
<table class="table table-bordered table-striped">
    <thead class="thead-dark text-center">
        <tr>
            <th>ID</th>
            <th>قسمت</th>
            <th>دوره</th>
            <th>بخش</th>
            <th>نوع</th>
            <th>درخواست ها</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($episodes as $episode)
            <tr class="text-center">
                <td>{{ $episode->id }}</td>
                <td>{{ $episode->number }}</td>
                <td>{{ $episode->course->name }}</td>
                <td>{{ $episode->section->name }}</td>
                <td>
                    @if($episode->is_free)
                        <span class="badge badge-danger">رایگان</span>
                    @else
                    <span class="badge badge-success">نقدی</span>
                    @endif
                </td>
                <td>{{ $episode->pivot->request }}</td>
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
</div>
