@extends('themes.master')

@section('content')

  @include('themes.partials.hero', ['title' => 'My Blogs'])

  <!--================ Start Blog Post Area =================-->
  <section class="blog-post-area section-margin mt-4">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">

          <div class="card">
            <div class="card-header">
              <h4>My Blogs</h4>
            </div>
@if(session('blogstatus'))
              <div class="alert alert-success m-3">
                {{ session('blogstatus') }}
              </div>
              @endif
            <div class="card-body">

              @if($blogs->count() > 0)

                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Blog Name</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Actions</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach($blogs as $blog)
                        <tr>
                          <td>{{ $loop->iteration }}</td>



                          <td>{{ $blog->name }}</td>

                          <td>
                            {{ $blog->category->name ?? 'No Category' }}
                          </td>

                          <td>
                            {{ $blog->created_at->format('d M Y') }}
                          </td>

                          <td>
                            <a href="{{ route('blogs.show', ['blog' => $blog]) }}" class="btn btn-sm btn-primary">
                              View
                            </a>

                            <a href="{{ route('blogs.edit', ['blog' => $blog]) }}" class="btn btn-sm btn-warning">
                              Edit
                            </a>

                            <form action="{{ route('blogs.destroy', ['blog' => $blog]) }}" method="POST" style="display:inline;">
                              @csrf
                              @method('DELETE')

                              <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete this blog?')">
                                Delete
                              </button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>

                <div class="mt-3">
                  {{ $blogs->links('pagination::bootstrap-5') }}
                </div>

              @else

                <div class="alert alert-info">
                  No blogs found.
                </div>

              @endif

            </div>
          </div>
        </div>

        <!-- Start Blog Post Siddebar -->




        <!-- End Blog Post Siddebar -->
      </div>
  </section>
@endsection