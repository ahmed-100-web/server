@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <div class="col-12">

        <div class="card">
            <div class="card-header d-flex">
                Show Post <strong>{{ $post->category->name }}</strong>
                <a href="{{ route('post.index') }}" class="btn btn-primary btn-sm ml-auto">Backe To Posts</a>
            </div>
            <div class="card-body">
                 <div class="row">
                     @if ($post->image != '')
                         <div class="col-12 text-center">
                             <img src="{{ asset('assets/image/'.$post->image) }}" class="img-fluid" style="max-width:90%" alt="{{ $post->title }} ">
                         </div>
                     @endif

                     <div class="col-12 justify-content-center pt-5">
                         <h3>
                             {{ $post->title }}
                         </h3>
                         <small>{{ $post->category->name }}  ||By: {{ $post->user->name }} </small>

                         <p>
                             {!! $post->body !!}
                         </p>
                     </div>

                 </div>

            </div>
        </div>
        </div>
        </div>

@endsection
