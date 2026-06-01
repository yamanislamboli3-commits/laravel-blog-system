@extends('themes.master')
@section('content')

  <!--================Hero Banner start =================-->
  @include('themes.partials.hero', ['title' => 'Add new blog'])
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
          <form action="{{ route('blogs.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="column">
              <div class="col-6">
                <div class="form-group">
                  <input class="form-control border" name="name" id="name" type="text" placeholder="Enter blog name"
                    value="{{ old('name') }}">
                  <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                
                <div class="form-group">
                  <input class="form-control border" name="image" id="image" type="file">
                  <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
              </div>
              <div class="col-6">
               
                <div class="form-group">
                  <select class="form-control border" name="category_id" id="category_id">

                    <option value="">Select Category</option>
@if(count($categories) > 0)
                    @foreach($categories as $category)
                      <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                      </option>
                    @endforeach
@endif
                  </select>

                  <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                </div>
                 <div class="form-group">
                 <textarea class="form-control border" name="description" placeholder="Enter blog description" rows="5">{{ old('description') }}</textarea>
                  <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
              </div>
            </div>
            <div class="form-group text-center text-md-right mt-3">

              <button type="submit" class="button button--active button-contactForm">Create Blog</button>

            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection