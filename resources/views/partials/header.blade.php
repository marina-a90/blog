<header class="blog-header py-3">
    <div class="container">
        <div class="row flex-nowrap justify-content-between align-items-center">

          <div class="col-4 text-center">
              <a class="text-muted" href="{{ route('home') }}">Home</a>
          </div>

          <div class="col-4 text-center">
            <a class="text-muted" href="/posts/create">Create</a>
          </div>

          <div class="col-4 text-center">
            <a class="text-muted" href="{{ route('posts.index') }}">Posts</a>
          </div>

          <div>
              @if(auth()->check())
            <span>{{ auth()->user()->name }}</span>
              <a class="btn btn-outline-primary" href="{{ route('logout') }}">Logout</a>
              @else
                <a class="btn btn-outline-primary" href="{{ route('register') }}">Sign up</a>
              @endif
          </div>

        </div>
    </div>
        <hr>
</header>