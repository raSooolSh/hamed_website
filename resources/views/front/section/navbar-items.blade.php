<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link {{ bsIsActive('homepage','disabled active') }}" href="{{ route('homepage') }}">صفحه اصلی</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ bsIsActive('courses.index','disabled active') }}" href="{{ route('courses.index') }}">دوره های آموزشی</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ bsIsActive('articles.index','disabled active') }}" href="{{ route('articles.index') }}">
            مقالات
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ bsIsActive('news.index','disabled active') }}" href="{{ route('news.index') }}">
            اخبار
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
           درباره ما
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            تماس با ما
        </a>
    </li>
</ul>