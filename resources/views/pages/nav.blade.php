@foreach ($pages as $page)
    <a class="nav-link" href="{{$page->url}}">
        {{ $page->title}}
    </a>
@endforeach
