@extends('themes.master')

@section('content')

@include('themes.partials.hero', ['title' => $categoryName])

<!--================ Start Blog Post Area =================-->
<section class="blog-post-area section-margin">
    <div class="container">
        <div class="row">

            <!-- Main Content -->
            <div class="col-lg-8">

                <div class="row">
                    @if($blogs->count() > 0)

                        @foreach($blogs as $blog)
                            <div class="col-md-6">
                                <div class="single-recent-blog-post card-view">

                                    <div class="thumb">
                                        <img
                                            class="card-img rounded-0"
                                            src="{{ asset('storage/blogs/' . $blog->image) }}"
                                            alt="{{ $blog->name }}"
                                        >

                                        <ul class="thumb-info">
                                            <li>
                                                <a href="#">
                                                    <i class="ti-user"></i>
                                                    {{ $blog->user->name }}
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
                                        <a href="{{ route('blogs.show', $blog) }}">
                                            <h3>{{ $blog->name }}</h3>
                                        </a>

                                        <p>{{ Str::limit($blog->description, 120) }}</p>

                                        <a class="button" href="{{ route('blogs.show', $blog) }}">
                                            Read More
                                            <i class="ti-arrow-right"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                    @else

                        <div class="col-12">
                            <p class="text-center">
                                No blogs found in this category.
                            </p>
                        </div>

                    @endif
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        {{ $blogs->links('pagination::bootstrap-5') }}
                    </div>
                </div>

            </div>
            <!-- End Main Content -->

            <!-- Sidebar -->
            <div class="col-lg-4 sidebar-widgets">

                <div class="widget-wrap">

                    <div class="single-sidebar-widget newsletter-widget">
                        <h4 class="single-sidebar-widget__title">Newsletter</h4>

                        <form action="{{ route('subscribe') }}" method="POST">
                            @csrf

                            <div class="form-group mt-30">
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="Enter email"
                                >
                            </div>

                            <button class="bbtns d-block mt-20 w-100">
                                Subscribe
                            </button>
                        </form>
                    </div>

                    <div class="single-sidebar-widget post-category-widget">
                        <h4 class="single-sidebar-widget__title">Category</h4>

                        <ul class="cat-list mt-20">
                            @foreach($categories as $category)
                                <li>
                                    <a
                                        href="{{ url('/category/' . $category->id) }}"
                                        class="d-flex justify-content-between"
                                    >
                                        <p>{{ $category->name }}</p>
                                        <p>{{ $category->blogs->count() }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>

            </div>
            <!-- End Sidebar -->

        </div>
    </div>
</section>

@endsection