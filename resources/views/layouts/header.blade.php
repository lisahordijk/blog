<div class="container">

  <header class="blog-header py-3">

    <div class="row flex-nowrap justify-content-between align-items-center">

      <div class="col-4 pt-1">
        <a class="text-muted" href="#">Subscribe</a>
      </div>

      <!-- Title of the blog -->
      <div class="col-4 text-center">
        <a class="blog-header-logo text-dark" href="/">Lisa's Blog</a>
      </div>

      <!-- Items above right side -->
      <div class="col-4 d-flex justify-content-end align-items-center">
        <a class="text-muted" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
        </a>
        <a class="btn btn-sm btn-outline-secondary" href="/register">Sign up</a>
        <a class="btn btn-sm btn-outline-secondary" href="/login">Log in</a>
        <a class="btn btn-sm btn-outline-secondary" href="/logout">Log out</a>
        <a class="btn btn-sm btn-outline-secondary" href="/pages">Pages</a>
        <a class="btn btn-sm btn-outline-secondary" href="/posts/create">Create Post</a>
      </div>

    </div>

  </header>

  <!-- Navigation bar with pages (up to date) -->
  <div class="nav-scroller py-1 mb-2">
    <nav class="navbar navbar-default navbar-static-top">
      @foreach ($pages as $page)
        <a class="nav-link" href="{{$page->url}}">
          {{ $page->title }}
        </a>
      @endforeach

      <!-- Name of person who is logged in -->
      @if (Auth::check())
       <a class="nav-link ml-auto" href="#">{{ Auth::user()->name }}</a>
      @endif

    </nav>
  </div>
</div>
