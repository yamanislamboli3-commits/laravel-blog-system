@php
  $categories = \App\Models\Category::all();
@endphp
<header class="header_area">
  <div class="main_menu">
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container box_1620">
        <!-- Brand and toggle get grouped for better mobile display -->
        <a class="navbar-brand logo_h" href="index.html"><img src="img/logo.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
          <ul class="nav navbar-nav menu_nav justify-content-center">
            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}"><a class="nav-link" href="/">Home</a></li>
            <li class="nav-item submenu dropdown {{ request()->is('category') ? 'active' : '' }}">
              <a href="/category" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                aria-haspopup="true" aria-expanded="false">Categories</a>
              @if($categories->count() > 0)

                <ul class="dropdown-menu">
                  @foreach ($categories as $category)
                    <li class="nav-item "><a class="nav-link" href="/category/{{ $category->id }}">{{ $category->name}}</a></li>
                  @endforeach
                </ul>

              @endif
            </li>
            <li class="nav-item {{ request()->is('contact') ? 'active' : '' }}">
              <a class="nav-link" href="/contact">Contact</a>
            </li>
          </ul>

          <!-- Add new blog -->
           @auth
          <a href='/blogs/create' class="btn btn-sm btn-primary mr-2">Add New</a>
          @endauth
          <!-- End - Add new blog -->

          <ul class="nav navbar-nav navbar-right navbar-social">
            @if(Auth::check())
              <li class="nav-item submenu dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">Welcome {{ Auth::user()->name }}</a>
                <ul class="dropdown-menu">
                  <li class="nav-item"><a class="nav-link" href="/myblogs">My Blogs</a></li>
                  <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                      @csrf

                      <button type="submit" class="dropdown-item">
                        Logout
                      </button>
                    </form>
                  </li>
                </ul>
              </li>
            @else
              <a href='/register' class="btn btn-sm btn-warning">Register / Login</a>
            @endif
            <!-- <li class="nav-item submenu dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">Welcome User</a>
                <ul class="dropdown-menu">
                  <li class="nav-item"><a class="nav-link" href="blog-details.html">My Blogs</a></li>
                </ul>
              </li> -->
          </ul>
        </div>
      </div>
    </nav>
  </div>
</header>