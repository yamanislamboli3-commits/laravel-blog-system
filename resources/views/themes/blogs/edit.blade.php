@extends('themes.master')
@section('content')

  <!--================Hero Banner start =================-->
  @include('themes.partials.hero', ['title' => $blog->name])
  <!--================Hero Banner end =================-->
  <!--================ Blog slider start =================-->

  <!--================ End Blog Post Area =================-->

  <!-- ================ contact section start ================= -->

  <!-- ================ contact section end ================= -->
  <section class="section-margin--small section-margin">
    <div class="container">
      <div class="row">
        <div class="col-12">
          @if(session('blogstatus'))
            <div class="alert alert-success">
              {{ session('blogstatus') }}
            </div>
          @endif
          <form action="{{ route('blogs.update', $blog->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="column">
              <div class="col-6">
                <div class="form-group">

                  <div class="column">
                    <div class="col-6">
                      <div class="form-group">
                        <input class="form-control border" name="name" id="name" type="text" placeholder="Enter blog name"
                          value="{{ old('name', $blog->name) }}">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                      </div>

                      <div class="form-group">
                        <input class="form-control border" name="image" id="image" type="file"
                          value="{{ old('image', $blog->image) }}">
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                      </div>
                    </div>
                    <div class="col-6">

                      <div class="form-group">
                        <select class="form-control border" name="category_id" id="category_id">

                          <option value="">Select Category</option>
                          @if(count($categories) > 0)
                            @foreach($categories as $category)
                              <option value="{{ $category->id }}" {{ $category->id == $blog->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                              </option>
                            @endforeach
                          @endif
                        </select>

                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                      </div>
                      <div class="form-group">
                        <textarea class="form-control border" name="description" placeholder="Enter blog description"
                          rows="5">{{ old('description', $blog->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group text-center text-md-right mt-3">

                    <a href="{{ url('/myblogs') }}" class="button button-secondary">
                      Cancel
                    </a>
                    <button type="submit" class="button button--active button-contactForm">Update Blog</button>

                  </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection