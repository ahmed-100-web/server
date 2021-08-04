@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <div class="col-12">

        <div class="card">
            <div class="card-header d-flex">
                <b>Create New Post</b>
                <a href="{{ route('post.index') }}" class="btn btn-primary btn-sm ml-auto">Backe To Posts</a>
            </div>
            <div class="card-body">

                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">

                  @csrf
                  <div class="form-groub">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title"  value="{{ old('title') }}">
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-groub">
                    <label for="category">Category</label>
                    <select class="form-control" name="category">
                        <option></option>
                        @foreach ($category as $category )
                        <option value="{{ $category->id }}"  {{ old('category')== $category->id ? 'selected' : ''  }} >{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-groub">
                    <label for="body">Body</label>
                    <textarea class="form-control" name="body" rows="5">{{ old('body')}}</textarea>
                    @error('body')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-groub">
                    <label for="image">Image</label>
                    <input type="file" class="custom-file" name="image">
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="text-center">
                   <input type="submit" class="btn btn-success" name="save" value="Add Post">
                </div>

                </form>


            </div>
        </div>
    </div>
</div>

@endsection
