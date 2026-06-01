@php
  $categories = \App\Models\Category::all();
  $recentBlogs = \App\Models\Blog::latest()->take(3)->get();
@endphp

@extends('themes.master')
@section('content')
  <main class="site-main">
    <!--================Hero Banner start =================-->
    <section class="mb-30px">
      <div class="container">
        <div class="hero-banner">
          <div class="hero-banner__content">
            <h3>Tours & Travels</h3>
            <h1>Amazing Places on earth</h1>
            <h4>December 12, 2018</h4>
          </div>
        </div>
      </div>
    </section>
    <!--================Hero Banner end =================-->
    <!--================ Blog slider start =================-->

    <!--================ End Blog Post Area =================-->
  </main>
 @if ($recentBlogs->isNotEmpty())
<section>
    <div class="container">
        <div class="owl-carousel owl-theme blog-slider">
            @foreach($recentBlogs as $recentBlog)
                <div class="card blog__slide text-center">

                    <div class="blog__slide__img">
                        <img class="card-img rounded-0" height="200px"
                             src="{{ asset('storage/blogs/' . $recentBlog->image) }}"
                             alt="{{ $recentBlog->name }}">
                    </div>

                    <div class="blog__slide__content">

                        <a class="blog__slide__label"
                           href="{{ route('blogs.show', $recentBlog) }}">
                            {{ $recentBlog->category->name }}
                        </a>

                        <h3>
                            <a href="{{ route('blogs.show', $recentBlog) }}">
                                {{ $recentBlog->name }}
                            </a>
                        </h3>

                        <p>
                            {{ $recentBlog->created_at->format('d M Y') }}
                        </p>

                    </div>

                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
  <!--================ Blog slider end =================-->

  <!--================ Start Blog Post Area =================-->
  <section class="blog-post-area section-margin mt-4">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">

          @if($blogs->count() > 0)

            @foreach($blogs as $blog)

              <div class="single-recent-blog-post">
                <div class="thumb">
                  <img class="w-100 img-fluid" src="{{ asset('storage/blogs/' . $blog->image) }}" alt="{{ $blog->name }}">

                  <ul class="thumb-info">
                    <li>
                      <a href="#">
                        <i class="ti-user"></i>
                        {{ $blog->user->name }}
                      </a>
                    </li>

                    <li>
                      <a href="#">
                        <i class="ti-notepad"></i>
                        {{ $blog->created_at->format('d M Y') }}
                      </a>
                    </li>

                    <li>
                      <a href="#">
                        <i class="ti-themify-favicon"></i>
                        2 Comments
                      </a>
                    </li>
                  </ul>
                </div>

                <div class="details mt-20">
                  <a href="#">
                    <h3>{{ $blog->name }}</h3>
                  </a>

                  <p>{{ $blog->description }}</p>

                  <a class="button" href="/blogs/{{ $blog->id }}">
                    Read More <i class="ti-arrow-right"></i>
                  </a>
                </div>
              </div>

            @endforeach

            {{-- Pagination --}}
            <div class="d-flex  mt-5 mb-5">
              {{ $blogs->links('pagination::bootstrap-5') }}
            </div>

          @else

            <div class="alert alert-info">
              No blogs found.
            </div>

          @endif

        </div>

        <!-- Start Blog Post Siddebar -->
        <div class="col-lg-4 sidebar-widgets">
          <div class="widget-wrap">
            <div class="single-sidebar-widget newsletter-widget">
              <h4 class="single-sidebar-widget__title">Newsletter</h4>
              <div class="form-group mt-30">
                <div class="col-autos">
                </div>
                @if(session('success'))
                  <div class="alert alert-success mt-2">
                    {{ session('success') }}
                  </div>
                @endif
                <form action={{ route('subscribe') }} method="POST">
                  @csrf
                  <div class="form-group mt-30">
                    <div class="col-autos">
                      <input type="email" name="email" class="form-control" id="inlineFormInputGroup"
                        placeholder="Enter email" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter email'">
                      @error('email')
                        <div class="text-danger mt-2">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <button class="bbtns d-block mt-20 w-100">Subcribe</button>
                </form>

              </div>

              <div class="single-sidebar-widget post-category-widget">
                <h4 class="single-sidebar-widget__title">Category</h4>
                <ul class="cat-list mt-20">
                  @foreach ($categories as $category)
                    <li>
                      <a href="#" class="d-flex justify-content-between">
                        <p>{{ $category->name }}</p>
                        <p>({{ $category->blogs->count() }})</p>
                      </a>
                    </li>
                  @endforeach

                </ul>
              </div>

              <div class="single-sidebar-widget popular-post-widget">
                <h4 class="single-sidebar-widget__title">Recent Post</h4>
                <div class="popular-post-list">
  @foreach ($recentBlogs as $recentBlog)
                  <div class="single-post-list">
                    <div class="thumb">
                      <a href="{{ route('blogs.show', $recentBlog) }}">
                        <img class="card-img rounded-0" src="{{ asset('storage/blogs/' . $recentBlog->image) }}" alt="{{ $recentBlog->name }}">
                      </a>
                      <ul class="thumb-info">
                        <li><a href="blogs/{{ $recentBlog->id }}">{{ $recentBlog->user->name }}</a></li>
                        <li><a href="blogs/{{ $recentBlog->id }}">{{ $recentBlog->created_at->format('M d, Y') }}</a></li>
                      </ul>
                    </div>
                    <div class="details mt-20">
                      <a href="{{ route('blogs.show', $recentBlog) }}">
                        <h6>{{ $recentBlog->name }}</h6>
                      </a>
                    </div>
                  </div>
  @endforeach
                </div>
              </div>
            </div>
          </div>
          <!-- End Blog Post Siddebar -->
        </div>
  </section>

@endsection