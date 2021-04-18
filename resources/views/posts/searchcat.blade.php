@extends('layouts.app')

<style>
  .input-group .md-form .form-sm .form-1 input {
    border: 1px solid #bdbdbd;
    border-top-right-radius: 0.25rem;
    border-bottom-right-radius: 0.25rem;
  }
</style>

@section('content')
@if(session()->get('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}
  </div><br>
@endif
{{-- Search bar --}}
<form method="POST" action='{{ route("posts.search")}}'>
  {{ csrf_field() }}
  <div class="input-group md-form form-sm form-1 pl-0">
    <div class="input-group-prepend">
      <span class="input-group-text cyan lighten-2">
        <i class="fas fa-search text-white" aria-hidden="true"></i>
      </span>
    </div>
    <input class="form-control my-0 py-1" type="text" name="search" placeholder="Product name..." aria-label="Search">
      <span class="input-group-btn">
        <button type="submit" class="btn btn-default">Go!</button>
      </span>
  </div>
</form>
@if(count($posts) > 0 )
  @foreach($posts as $post)
  <div class="card-body">
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
      </div>
      <div class="col-md-8 col-sm-8">
        <h4><a href="posts/{{$post->id}}">{{$post->title}}</a></h4>
        <p class="text-muted mb-1">Category: <span>{{$post->category['name']}}</span></p>
        <p class="text-muted mb-1">Description: <span>{{$post->description}}</span></p>
        <p class="text-muted mb-1">Price: <span>{{$post->price}}</span></p>            
        <p class="text-muted mb-1">Condition: <span>{{$post->condition}}</span></p>
        <p class="text-muted mb-1">Location: <span>{{$post->location}}</span></p>
        <small>Posted on {{ $post->created_at }} by {{ $post->user->name }}</small>
      </div>
    </div>
  </div>
@endforeach
@else
  <p>No ads found</p>
@endif
@endsection
